<?php

//
// +----------------------------------------------------------------------+
// | PHP Version 4 |
// +----------------------------------------------------------------------+
// | Copyright (c) 1997-2003 The PHP Group |
// +----------------------------------------------------------------------+
// | This source file is subject to version 2.02 of the PHP license, |
// | that is bundled with this package in the file LICENSE, and is |
// | available at through the world-wide-web at |
// | http://www.php.net/license/2_02.txt. |
// | If you did not receive a copy of the PHP license and are unable to |
// | obtain it through the world-wide-web, please send a note to |
// | license@php.net so we can mail you a copy immediately. |
// +----------------------------------------------------------------------+
// | Author: Chuck Hagenbuch <chuck@horde.org> |
// +----------------------------------------------------------------------+

class Mail_sendmail extends Mail {

	var $sendmail_path = '/usr/sbin/sendmail';

	var $sendmail_args = '-i';

	function Mail_sendmail($params) {
		if (isset ($params['sendmail_path'])) {
			$this->sendmail_path = $params['sendmail_path'];
		}
		if (isset ($params['sendmail_args'])) {
			$this->sendmail_args = $params['sendmail_args'];
		}

		/*
		* Because we need to pass message headers to the sendmail program on
		* the commandline, we can't guarantee the use of the standard "\r\n"
		* separator. Instead, we use the system's native line separator.
		*/
		if (defined('PHP_EOL')) {
			$this->sep = PHP_EOL;
		} else {
			$this->sep = (strpos(PHP_OS, 'WIN') === false) ? "\n" : "\r\n";
		}
	}

	function send($recipients, $headers, $body) {
		$recipients = $this->parseRecipients($recipients);
		if (PEAR :: isError($recipients)) {
			return $recipients;
		}
		$recipients = escapeShellCmd(implode(' ', $recipients));

		$this->_sanitizeHeaders($headers);
		$headerElements = $this->prepareHeaders($headers);
		if (PEAR :: isError($headerElements)) {
			return $headerElements;
		}
		list ($from, $text_headers) = $headerElements;

		if (!isset ($from)) {
			return PEAR :: raiseError('No from address given.');
		}
		elseif (strpos($from, ' ') !== false || strpos($from, ';') !== false || strpos($from, '&') !== false || strpos($from, '`') !== false) {
			return PEAR :: raiseError('From address specified with dangerous characters.');
		}

		$from = escapeShellCmd($from);
		$mail = @ popen($this->sendmail_path . (!empty ($this->sendmail_args) ? ' ' . $this->sendmail_args : '') . " -f$from -- $recipients", 'w');
		if (!$mail) {
			return PEAR :: raiseError('Failed to open sendmail [' . $this->sendmail_path . '] for execution.');
		}

		// Write the headers following by two newlines: one to end the headers
		// section and a second to separate the headers block from the body.
		fputs($mail, $text_headers . $this->sep . $this->sep);

		fputs($mail, $body);
		$result = pclose($mail);
		if (version_compare(phpversion(), '4.2.3') == -1) {
			// With older php versions, we need to shift the pclose
			// result to get the exit code.
			$result = $result >> 8 & 0xFF;
		}

		if ($result != 0) {
			return PEAR :: raiseError('sendmail returned error code ' . $result, $result);
		}

		return true;
	}

}