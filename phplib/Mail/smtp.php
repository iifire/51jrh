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
// | Authors: Chuck Hagenbuch <chuck@horde.org> |
// | Jon Parise <jon@php.net> |
// +----------------------------------------------------------------------+

define('PEAR_MAIL_SMTP_ERROR_CREATE', 10000);

define('PEAR_MAIL_SMTP_ERROR_CONNECT', 10001);

define('PEAR_MAIL_SMTP_ERROR_AUTH', 10002);

define('PEAR_MAIL_SMTP_ERROR_FROM', 10003);

define('PEAR_MAIL_SMTP_ERROR_SENDER', 10004);

define('PEAR_MAIL_SMTP_ERROR_RECIPIENT', 10005);

define('PEAR_MAIL_SMTP_ERROR_DATA', 10006);

class Mail_smtp extends Mail {

	var $_smtp = null;

	var $host = 'localhost';

	var $port = 25;

	var $auth = false;

	var $username = '';

	var $password = '';

	var $localhost = 'localhost';

	var $timeout = null;

	var $verp = false;

	var $debug = false;

	var $persist = false;

	function Mail_smtp($params) {
		if (isset ($params['host']))
			$this->host = $params['host'];
		if (isset ($params['port']))
			$this->port = $params['port'];
		if (isset ($params['auth']))
			$this->auth = $params['auth'];
		if (isset ($params['username']))
			$this->username = $params['username'];
		if (isset ($params['password']))
			$this->password = $params['password'];
		if (isset ($params['localhost']))
			$this->localhost = $params['localhost'];
		if (isset ($params['timeout']))
			$this->timeout = $params['timeout'];
		if (isset ($params['verp']))
			$this->verp = $params['verp'];
		if (isset ($params['debug']))
			$this->debug = (boolean) $params['debug'];
		if (isset ($params['persist']))
			$this->persist = (boolean) $params['persist'];

		register_shutdown_function(array (
			& $this,
			'_Mail_smtp'
		));
	}

	function _Mail_smtp() {
		$this->disconnect();
	}

	function send($recipients, $headers, $body) {
		include_once 'Net/SMTP.php';

		/* If we don't already have an SMTP object, create one. */
		if (is_object($this->_smtp) === false) {
			$this->_smtp = & new Net_SMTP($this->host, $this->port, $this->localhost);

			/* If we still don't have an SMTP object at this point, fail. */
			if (is_object($this->_smtp) === false) {
				return PEAR :: raiseError('Failed to create a Net_SMTP object', PEAR_MAIL_SMTP_ERROR_CREATE);
			}

			/* Configure the SMTP connection. */
			if ($this->debug) {
				$this->_smtp->setDebug(true);
			}

			/* Attempt to connect to the configured SMTP server. */
			if (PEAR :: isError($res = $this->_smtp->connect($this->timeout))) {
				$error = $this->_error('Failed to connect to ' .
				$this->host . ':' . $this->port, $res);
				return PEAR :: raiseError($error, PEAR_MAIL_SMTP_ERROR_CONNECT);
			}

			/* Attempt to authenticate if authentication has been enabled. */
			if ($this->auth) {
				$method = is_string($this->auth) ? $this->auth : '';

				if (PEAR :: isError($res = $this->_smtp->auth($this->username, $this->password, $method))) {
					$error = $this->_error("$method authentication failure", $res);
					$this->_smtp->rset();
					return PEAR :: raiseError($error, PEAR_MAIL_SMTP_ERROR_AUTH);
				}
			}
		}

		$this->_sanitizeHeaders($headers);
		$headerElements = $this->prepareHeaders($headers);
		if (PEAR :: isError($headerElements)) {
			$this->_smtp->rset();
			return $headerElements;
		}
		list ($from, $textHeaders) = $headerElements;

		/* Since few MTAs are going to allow this header to be forged
		* unless it's in the MAIL FROM: exchange, we'll use
		* Return-Path instead of From: if it's set. */
		if (!empty ($headers['Return-Path'])) {
			$from = $headers['Return-Path'];
		}

		if (!isset ($from)) {
			$this->_smtp->rset();
			return PEAR :: raiseError('No From: address has been provided', PEAR_MAIL_SMTP_ERROR_FROM);
		}

		$args['verp'] = $this->verp;
		if (PEAR :: isError($res = $this->_smtp->mailFrom($from, $args))) {
			$error = $this->_error("Failed to set sender: $from", $res);
			$this->_smtp->rset();
			return PEAR :: raiseError($error, PEAR_MAIL_SMTP_ERROR_SENDER);
		}

		$recipients = $this->parseRecipients($recipients);
		if (PEAR :: isError($recipients)) {
			$this->_smtp->rset();
			return $recipients;
		}

		foreach ($recipients as $recipient) {
			if (PEAR :: isError($res = $this->_smtp->rcptTo($recipient))) {
				$error = $this->_error("Failed to add recipient: $recipient", $res);
				$this->_smtp->rset();
				return PEAR :: raiseError($error, PEAR_MAIL_SMTP_ERROR_RECIPIENT);
			}
		}

		/* Send the message's headers and the body as SMTP data. */
		if (PEAR :: isError($res = $this->_smtp->data($textHeaders . "\r\n\r\n" . $body))) {
			$error = $this->_error('Failed to send data', $res);
			$this->_smtp->rset();
			return PEAR :: raiseError($error, PEAR_MAIL_SMTP_ERROR_DATA);
		}

		/* If persistent connections are disabled, destroy our SMTP object. */
		if ($this->persist === false) {
			$this->disconnect();
		}

		return true;
	}

	function disconnect() {
		/* If we have an SMTP object, disconnect and destroy it. */
		if (is_object($this->_smtp) && $this->_smtp->disconnect()) {
			$this->_smtp = null;
		}

		/* We are disconnected if we no longer have an SMTP object. */
		return ($this->_smtp === null);
	}

	function _error($text, & $error) {
		/* Split the SMTP response into a code and a response string. */
		list ($code, $response) = $this->_smtp->getResponse();

		/* Build our standardized error string. */
		$msg = $text;
		$msg .= ' [SMTP: ' . $error->getMessage();
		$msg .= " (code: $code, response: $response)]";

		return $msg;
	}

}