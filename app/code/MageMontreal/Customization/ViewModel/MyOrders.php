<?php
/**
 * @category  Magemontreal
 * @package   Magemontreal_Customization
 * @author    Bashid <imbashid@gmail.com>
 */
namespace MageMontreal\Customization\ViewModel;

use Magento\Framework\View\Element\Block\ArgumentInterface;
use Magento\Sales\Model\Order\Config;
use Magento\Sales\Model\ResourceModel\Order\CollectionFactoryInterface;
use Magento\Framework\ObjectManagerInterface;
use Magento\Customer\Model\SessionFactory;
use Magento\Customer\Model\Session;

/**
 *  class MyOrders
 */
class MyOrders implements ArgumentInterface
{
    /**
     * @var ObjectManagerInterface
     */
    private $object;
    /**
     * @var CollectionFactoryInterface
     */
    private $orderCollection;
    /**
     * @var Config
     */
    private $orderConfig;


    /**
     * @param ObjectManagerInterface $interface
     * @param CollectionFactoryInterface $orderCollection
     * @param Config $orderConfig
     */
    public function __construct(
        ObjectManagerInterface $interface,
        CollectionFactoryInterface $orderCollection,
        Config $orderConfig
    ) {
        $this->object = $interface;
        $this->orderCollection = $orderCollection;
        $this->orderConfig = $orderConfig;
    }

    /**
     * get Session Object
     *
     * @return Session
     */
    public function getCustomerSession(): Session
    {
        // Should avoid using object manager.
        // https://github.com/magento/magento2/issues/3294
        return $this->object->create(SessionFactory::class)->create();
    }

    /**
     * @return bool
     */
    public function getIsLoggedIn(): bool
    {
        return $this->getCustomerSession()->isLoggedIn();
    }

    /**
     * Get Order count
     *
     * @return int
     */
    public function getOrderCount(): int
    {
        return  $this->orderCollection->create($this->getCustomerSession()->getCustomerId())
            ->addFieldToSelect('*')
            ->addFieldToFilter(
                'status',
                ['in' => $this->orderConfig->getVisibleOnFrontStatuses()]
            )->count();
    }
}