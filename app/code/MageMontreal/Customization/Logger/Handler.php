<?php
/**
 * @category  Magemontreal
 * @package   Magemontreal_Customization
 * @author    Bashid <imbashid@gmail.com>
 */
declare(strict_types=1);

namespace MageMontreal\Customization\Logger;

use Monolog\Logger;

/**
 *
 * class Handler
 */
class Handler extends \Magento\Framework\Logger\Handler\Base
{
    /**
     * Logging level
     * @var int
     */
    protected $loggerType = Logger::INFO;

    /**
     * File name
     * @var string
     */
    protected $fileName = '/var/log/page-view.log';
}