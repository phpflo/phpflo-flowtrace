<?php
/*
 * This file is part of the phpflo/flowtrace package.
 *
 * (c) Marc Aschmann <maschmann@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace PhpFlo\Logger;

use Psr\Log\AbstractLogger;
use Psr\Log\LoggerInterface;

/**
 * Class SimpleFile
 *
 * @package PhpFlo\Logger
 * @author Marc Aschmann <maschmann@gmail.com>
 */
class SimpleFile extends AbstractLogger implements LoggerInterface
{
    const DEFAULT_FILENAME = 'flow.log';

    /**
     * @var string
     */
    private $logFile;

    /**
     * @param string $logFile path/filename to log to.
     */
    public function __construct($logFile)
    {
        $log = pathinfo($logFile);

        if (isset($log['dirname']) && !is_dir($log['dirname'])) {
            throw new \InvalidArgumentException(
                "Directory does not exist: {$log['dirname']}"
            );
        }

        if (!isset($log['filename'])) {
            $log['filename'] = self::DEFAULT_FILENAME;
        }
        $this->logFile = $logFile;
    }

    /**
     * Logs with an arbitrary level.
     *
     * @param mixed $level
     * @param string $message
     * @param array $context
     *
     * @return void
     */
    public function log($level, $message, array $context = array())
    {
        file_put_contents(
            $this->logFile, $message . PHP_EOL, FILE_APPEND
        );
    }
}
