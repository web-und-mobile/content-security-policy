<?php

/*
 * Content Security Policy
 * This PHP script writes CSP violation information sent by clients into a log file.
 * The script is for demonstration purposes only.
 *
 * For further details, please read: https://content-security-policy.com
 * Author: Michael Schams - https://schams.net
 *
 * @package    csp-report
 * @author     Michael Schams <schams.net>
 * @link       https://schams.net
 */

// Determine directory path used for temporary files
$temp_directory = sys_get_temp_dir();

// Remove trailing slash from path
// (behaviour of function sys_get_temp_dir() is inconsistent across systems)
$temp_directory = preg_replace('/\/$/', '', $temp_directory);

// Define log file name
$log_filename = $temp_directory . DIRECTORY_SEPARATOR . 'csp-report.log';

// Open log file
$stream = @fopen($log_filename, 'a');

if ($stream !== false) {

	// Read entire HTTP body sent by client into a string and convert JSON to an array
	$data = json_decode(file_get_contents('php://input'));

	// Write array to log file
	fputs($stream, print_r($data, 1) . PHP_EOL);

	// Close file handler
	fclose($stream);
}
