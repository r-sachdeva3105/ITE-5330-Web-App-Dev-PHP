<?php
// Include Composer's autoloader
require 'vendor/autoload.php';

use App\CustomLogger;

// Create an instance of your logger
$logger = new CustomLogger();

// Log some messages
$logger->logInfo('This is an informational log entry.');
$logger->logError('This is an error log entry.');
