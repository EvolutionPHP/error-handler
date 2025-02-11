<?php
/**
 * @package EvolutionScript
 * @author: EvolutionScript S.A.C.
 * @Copyright (c) 2010 - 2020, EvolutionScript.com
 * @link http://www.evolutionscript.com
 */

namespace EvolutionPHP\ErrorHandler;

use Symfony\Component\ErrorHandler\Debug;
use Symfony\Component\ErrorHandler\ErrorRenderer\HtmlErrorRenderer;

class ErrorHandler
{
	private $config = [
		'path' => '',
		'ext' => 'php',
		'file_permissions' => 0644,
		'level' => 0,
		'date_format' => 'Y-m-d H:i:s'
	];

	/**
	 * @var $logger Logger
	 */
	private $logger;

	/**
	 * @var $handler LogHandler
	 */
	private $handler;
	public function __construct($config = [])
	{
		foreach ($this->config as $key => $value) {
			if (isset($config[$key])) {
				$this->config[$key] = $config[$key];
			}
		}
		$this->startLogger();
	}

	private function startLogger()
	{
		$this->logger = new Logger($this->config);
		$this->handler = new LogHandler();
		$this->handler->setLogger($this->logger);
	}

	public function debug()
	{
		$debug = Debug::enable();
		$debug->setDefaultLogger($this->handler);
	}

	public function register()
	{
		HtmlErrorRenderer::setTemplate(__DIR__.'/views/error.html.php');
		$handle = \Symfony\Component\ErrorHandler\ErrorHandler::register();
		$handle->setDefaultLogger($this->handler);
		$handle->throwAt(E_ALL - E_WARNING - E_NOTICE - E_DEPRECATED - E_USER_DEPRECATED - E_USER_NOTICE - E_USER_WARNING, true);
	}

	/**
	 * Write Log File
	 *
	 * Generally this function will be called using the global log_message() function
	 *
	 * @param	string	$level 	The error level: 'error', 'debug' or 'info'
	 * @param	string	$msg 	The error message
	 * @return	bool
	 */
	public function write_log($level, $msg)
	{
		$this->logger->write_log($level, $msg);
	}

	public function warningError($msg)
	{
		trigger_error($msg, E_USER_WARNING);
	}

	public function noticeError($msg)
	{
		trigger_error($msg, E_USER_NOTICE);
	}

	public function alertError($msg)
	{
		trigger_error($msg, E_USER_ERROR);
	}
}