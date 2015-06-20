<?php

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
//
// $Id: Mail.php,v 1.17 2006/09/15 03:41:18 jon Exp $

require_once 'PEAR.php';

class Mail {
	var $sep = "\r\n";

	function & factory($driver, $params = array ()) {
		$driver = strtolower($driver);
		@ include_once 'Mail/' . $driver . '.php';
		$class = 'Mail_' . $driver;
		if (class_exists($class)) {
			$mailer = new $class ($params);
			return $mailer;
		} else {
			return PEAR :: raiseError('Unable to find class for driver ' . $driver);
		}
	}

	function send($recipients, $headers, $body) {
		$this->_sanitizeHeaders($headers);

		// if we're passed an array of recipients, implode it.
		if (is_array($recipients)) {
			$recipients = implode(', ', $recipients);
		}

		// get the Subject out of the headers array so that we can
		// pass it as a seperate argument to mail().
		$subject = '';
		if (isset ($headers['Subject'])) {
			$subject = $headers['Subject'];
			unset ($headers['Subject']);
		}

		// flatten the headers out.
		list (, $text_headers) = Mail :: prepareHeaders($headers);

		return mail($recipients, $subject, $body, $text_headers);

	}

	function _sanitizeHeaders(& $headers) {
		foreach ($headers as $key => $value) {
			$headers[$key] = preg_replace('=((<CR>|<LF>|0x0A/%0A|0x0D/%0D|\\n|\\r)\S).*=i', null, $value);
		}
	}

	function prepareHeaders($headers) {
		$lines = array ();
		$from = null;

		foreach ($headers as $key => $value) {
			if (strcasecmp($key, 'From') === 0) {
				include_once 'Mail/RFC822.php';
				$parser = & new Mail_RFC822();
				$addresses = $parser->parseAddressList($value, 'localhost', false);
				if (PEAR :: isError($addresses)) {
					return $addresses;
				}

				$from = $addresses[0]->mailbox . '@' . $addresses[0]->host;

				// Reject envelope From: addresses with spaces.
				if (strstr($from, ' ')) {
					return false;
				}

				$lines[] = $key . ': ' . $value;
			}
			elseif (strcasecmp($key, 'Received') === 0) {
				$received = array ();
				if (is_array($value)) {
					foreach ($value as $line) {
						$received[] = $key . ': ' . $line;
					}
				} else {
					$received[] = $key . ': ' . $value;
				}
				// Put Received: headers at the top. Spam detectors often
				// flag messages with Received: headers after the Subject:
				// as spam.
				$lines = array_merge($received, $lines);
			} else {
				// If $value is an array (i.e., a list of addresses), convert
				// it to a comma-delimited string of its elements (addresses).
				if (is_array($value)) {
					$value = implode(', ', $value);
				}
				$lines[] = $key . ': ' . $value;
			}
		}

		return array (
			$from,
			join($this->sep, $lines)
		);
	}

	function parseRecipients($recipients) {
		include_once 'Mail/RFC822.php';

		// if we're passed an array, assume addresses are valid and
		// implode them before parsing.
		if (is_array($recipients)) {
			$recipients = implode(', ', $recipients);
		}

		// Parse recipients, leaving out all personal info. This is
		// for smtp recipients, etc. All relevant personal information
		// should already be in the headers.
		$addresses = Mail_RFC822 :: parseAddressList($recipients, 'localhost', false);

		// If parseAddressList() returned a PEAR_Error object, just return it.
		if (PEAR :: isError($addresses)) {
			return $addresses;
		}

		$recipients = array ();
		if (is_array($addresses)) {
			foreach ($addresses as $ob) {
				$recipients[] = $ob->mailbox . '@' . $ob->host;
			}
		}

		return $recipients;
	}

}