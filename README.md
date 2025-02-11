# PHP Error Handler

Error handler and save logs in files.

## Installation

Use [Composer](http://getcomposer.org) to install Logger into your project:
```bash
composer require evolutionphp/error-handler
```


## Configuration

### Setup the logger
```php
$config = [
	'path' => __DIR__.'/logs/',
	'ext' => 'php',
	'file_permissions' => 0644,
	'level' => 4,
	'date_format' => 'Y-m-d H:i:s'
];
$errorHandler = new \EvolutionPHP\ErrorHandler\ErrorHandler($config);
```
- path: Directory where log files will be saved.
- ext: set the extension of your log files. Leaving it blank will default to 'php'.
- file_permissions: The file system permissions to be applied on newly created log files.   
  This MUST be an integer (no quotes) and you MUST use octal integer notation (i.e. 0700, 0644, etc.)
- level: You can enable error logging by setting a level over zero. The level determines what gets logged. Threshold options are:  
   0 = Disables logging, Error logging TURNED OFF  
   1 = Error Messages (including PHP errors)  
   2 = Debug Messages  
   3 = Informational Messages  
   4 = All Messages
- date_format: Each item that is logged has an associated date. You can use PHP date codes to set your own date formatting

### Debug mode
```php
$errorHandler = new \EvolutionPHP\ErrorHandler\ErrorHandler($config);
$errorHandler->debug();
```
### Production mode
```php
$errorHandler = new \EvolutionPHP\ErrorHandler\ErrorHandler($config);
$errorHandler->register();
```
### Write a log
```php
$errorHandler = new \EvolutionPHP\ErrorHandler\ErrorHandler($config);
$errorHandler->write_log('error','This is an error log.')
```

### Throw an error
```php
$errorHandler = new \EvolutionPHP\ErrorHandler\ErrorHandler($config);
$errorHandler->alertError('This is an exception.');
```