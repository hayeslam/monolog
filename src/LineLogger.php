<?php
/**
 * Created by PhpStorm.
 * User: hayes
 * Date: 2018/8/16
 * Time: 下午3:12
 */

namespace Hayes\Monolog;

use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use Monolog\Processor\UidProcessor;
use Monolog\Formatter\LineFormatter;
use Monolog\Processor\IntrospectionProcessor;

class LineLogger
{
    /**
     * @var Logger
     */
    private $handle;

    /**
     * @var string
     */
    private $format = "[%extra.uid%][%datetime%][%level_name%][%extra.file%:%extra.line%] %message%\n";

    /**
     * Logger constructor.
     * @param string $filename
     * @param string $channel
     * @param int $level
     * @throws \Exception
     */
    public function __construct(string $filename, string $channel = 'logger', int $level = Logger::INFO)
    {
        $formatter = new LineFormatter($this->format);
        $streamHandler = new StreamHandler($filename, $level);
        $streamHandler->setFormatter($formatter);
        $streamHandler->pushProcessor(new UidProcessor());
        $streamHandler->pushProcessor(new IntrospectionProcessor());

        $this->handle = new Logger($channel);
        $this->handle->pushHandler($streamHandler);
    }

    /**
     * @param string $message
     * @param array $content
     */
    public function debug(string $message, array $content = [])
    {
        $this->handle->addDebug($message, $content);
    }

    /**
     * @param string $message
     * @param array $content
     */
    public function info(string $message, array $content = [])
    {
        $this->handle->addInfo($message, $content);
    }

    /**
     * @param string $message
     * @param array $content
     */
    public function notice(string $message, array $content = [])
    {
        $this->handle->addNotice($message, $content);
    }

    /**
     * @param string $message
     * @param array $content
     */
    public function warning(string $message, array $content = [])
    {
        $this->handle->addWarning($message, $content);
    }

    /**
     * @param string $message
     * @param array $content
     */
    public function error(string $message, array $content = [])
    {
        $this->handle->addError($message, $content);
    }

    /**
     * @param string $message
     * @param array $content
     */
    public function critical(string $message, array $content = [])
    {
        $this->handle->addCritical($message, $content);
    }

    /**
     * @param string $message
     * @param array $content
     */
    public function alert(string $message, array $content = [])
    {
        $this->handle->addAlert($message, $content);
    }

    /**
     * @param string $message
     * @param array $content
     */
    public function emergency(string $message, array $content = [])
    {
        $this->handle->addEmergency($message, $content);
    }
}