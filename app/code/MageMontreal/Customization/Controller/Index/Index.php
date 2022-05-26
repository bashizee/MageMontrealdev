<?php
/**
 * @category  Magemontreal
 * @package   Magemontreal_Customization
 * @author    Bashid <imbashid@gmail.com>
 */
declare(strict_types=1);

namespace MageMontreal\Customization\Controller\Index;

use Magento\Framework\App\Action\HttpGetActionInterface;
use Magento\Framework\App\RequestInterface;
use Magento\Framework\Controller\Result\JsonFactory;
use MageMontreal\Customization\Logger\Logger;

/**
 * Class Index
 */
class Index implements HttpGetActionInterface
{
    /**
     * @var JsonFactory
     */
    protected $resultJsonFactory;

    /**
     * @var RequestInterface
     */
    protected $requestInterface;

    /**
     * @var Logger
     */
    protected $mageLogger;

    /**
     * @param JsonFactory $resultJsonFactory
     * @param RequestInterface $request
     * @param Logger $mageLogger
     */
    public function __construct(
        JsonFactory $resultJsonFactory,
        RequestInterface $request,
        Logger $mageLogger
    ) {
        $this->resultJsonFactory = $resultJsonFactory;
        $this->requestInterface = $request;
        $this->mageLogger = $mageLogger;
    }

    /**
     * Log when someone visit the page
     *
     * @return array
     */
    public function execute()
    {
        $data = $this->requestInterface->getParams();
        $this->mageLogger->info($data['title'].": " . $data['url']." - ".$data['clientIp']);
        $resultJson = $this->resultJsonFactory
            ->create();
        return $resultJson->setData([]);
    }

}