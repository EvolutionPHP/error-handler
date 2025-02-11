<?php
/**
 * @package EvolutionScript
 * @author: EvolutionScript S.A.C.
 * @Copyright (c) 2010 - 2020, EvolutionScript.com
 * @link http://www.evolutionscript.com
 */

namespace EvolutionPHP\ErrorHandler;

use Psr\Log\LoggerInterface;

class LogHandler implements LoggerInterface
{
	/**
	 * @var $logger Logger
	 */
	private $logger;
	/**
	 * System is unusable.
	 *
	 * @param mixed[] $context
	 */
	public function emergency(string|\Stringable $message, array $context = []): void
	{
		$this->log('emergency', $message, $context);
	}

	/**
	 * Action must be taken immediately.
	 *
	 * Example: Entire website down, database unavailable, etc. This should
	 * trigger the SMS alerts and wake you up.
	 *
	 * @param mixed[] $context
	 */
	public function alert(string|\Stringable $message, array $context = []): void
	{
		$this->log('alert', $message, $context);
	}

	/**
	 * Critical conditions.
	 *
	 * Example: Application component unavailable, unexpected exception.
	 *
	 * @param mixed[] $context
	 */
	public function critical(string|\Stringable $message, array $context = []): void
	{
		$this->log('critical', $message, $context);
	}

	/**
	 * Runtime errors that do not require immediate action but should typically
	 * be logged and monitored.
	 *
	 * @param mixed[] $context
	 */
	public function error(string|\Stringable $message, array $context = []): void
	{
		$this->log('error', $message, $context);
	}

	/**
	 * Exceptional occurrences that are not errors.
	 *
	 * Example: Use of deprecated APIs, poor use of an API, undesirable things
	 * that are not necessarily wrong.
	 *
	 * @param mixed[] $context
	 */
	public function warning(string|\Stringable $message, array $context = []): void
	{
		$this->log('warning', $message, $context);
	}

	/**
	 * Normal but significant events.
	 *
	 * @param mixed[] $context
	 */
	public function notice(string|\Stringable $message, array $context = []): void
	{
		$this->log('notice', $message, $context);
	}

	/**
	 * Interesting events.
	 *
	 * Example: User logs in, SQL logs.
	 *
	 * @param mixed[] $context
	 */
	public function info(string|\Stringable $message, array $context = []): void
	{
		$this->log('info', $message, $context);
	}

	/**
	 * Detailed debug information.
	 *
	 * @param mixed[] $context
	 */
	public function debug(string|\Stringable $message, array $context = []): void
	{
		$this->log('debug', $message, $context);
	}

	/**
	 * Logs with an arbitrary level.
	 *
	 * @param mixed $level
	 * @param mixed[] $context
	 *
	 * @throws \Psr\Log\InvalidArgumentException
	 */
	public function log($level, string|\Stringable $message, array $context = []): void
	{
		if(!$this->logger){
			return;
		}
		$errors = [
			'emergency',
			'alert',
			'critical',
			'error',
			'warning',
			'notice'
		];
		if(isset($context['exception'])){

			$message .= ' in '.$context['exception']->getFile().' (line '.$context['exception']->getLine().').';
			if(count($context['exception']->getTrace()) > 0){
				$message .= "\nTrace: ".$context['exception']->getTraceAsString();
			}
		}
		//print_r($context['exception']->getTraceAsString());
		if(in_array($level, $errors)){
			$this->logger->write_log('error', $message);
		}else{
			$this->logger->write_log($level, $message);
		}
	}

	public function setLogger(Logger $logger)
	{
		$this->logger = $logger;
	}
}