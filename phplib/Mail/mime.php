<?php
require_once 'PEAR.php';

require_once 'Mail/mimePart.php';

class Mail_mime {
	var $_txtbody;

	var $_htmlbody;

	var $_html_images = array ();

	var $_parts = array ();

	var $_headers = array ();

	var $_build_params = array (
		// What encoding to use for the headers
	// Options: quoted-printable or base64
	'head_encoding' => 'quoted-printable',
		// What encoding to use for plain text
	// Options: 7bit, 8bit, base64, or quoted-printable
	'text_encoding' => 'quoted-printable',
		// What encoding to use for html
	// Options: 7bit, 8bit, base64, or quoted-printable
	'html_encoding' => 'quoted-printable',
		// The character set to use for html
	'html_charset' => 'ISO-8859-1',
		// The character set to use for text
	'text_charset' => 'ISO-8859-1',
		// The character set to use for headers
	'head_charset' => 'ISO-8859-1',
		// End-of-line sequence
	'eol' => "\r\n",
		// Delay attachment files IO until building the message
	'delay_file_io' => false
	);

	function Mail_mime($params = array ()) {
		// Backward-compatible EOL setting
		if (is_string($params)) {
			$this->_build_params['eol'] = $params;
		} else
			if (defined('MAIL_MIME_CRLF') && !isset ($params['eol'])) {
				$this->_build_params['eol'] = MAIL_MIME_CRLF;
			}

		// Update build parameters
		if (!empty ($params) && is_array($params)) {
			while (list ($key, $value) = each($params)) {
				$this->_build_params[$key] = $value;
			}
		}
	}

	function setParam($name, $value) {
		$this->_build_params[$name] = $value;
	}

	function getParam($name) {
		return isset ($this->_build_params[$name]) ? $this->_build_params[$name] : null;
	}

	function setTXTBody($data, $isfile = false, $append = false) {
		if (!$isfile) {
			if (!$append) {
				$this->_txtbody = $data;
			} else {
				$this->_txtbody .= $data;
			}
		} else {
			$cont = $this->_file2str($data);
			if (PEAR :: isError($cont)) {
				return $cont;
			}
			if (!$append) {
				$this->_txtbody = $cont;
			} else {
				$this->_txtbody .= $cont;
			}
		}
		return true;
	}

	function getTXTBody() {
		return $this->_txtbody;
	}

	function setHTMLBody($data, $isfile = false) {
		if (!$isfile) {
			$this->_htmlbody = $data;
		} else {
			$cont = $this->_file2str($data);
			if (PEAR :: isError($cont)) {
				return $cont;
			}
			$this->_htmlbody = $cont;
		}

		return true;
	}

	function getHTMLBody() {
		return $this->_htmlbody;
	}

	function addHTMLImage($file, $c_type = 'application/octet-stream', $name = '', $isfile = true, $content_id = null) {
		$bodyfile = null;

		if ($isfile) {
			// Don't load file into memory
			if ($this->_build_params['delay_file_io']) {
				$filedata = null;
				$bodyfile = $file;
			} else {
				if (PEAR :: isError($filedata = $this->_file2str($file))) {
					return $filedata;
				}
			}
			$filename = ($name ? $name : $file);
		} else {
			$filedata = $file;
			$filename = $name;
		}

		if (!$content_id) {
			$content_id = md5(uniqid(time()));
		}

		$this->_html_images[] = array (
			'body' => $filedata,
			'body_file' => $bodyfile,
			'name' => $filename,
			'c_type' => $c_type,
			'cid' => $content_id
		);

		return true;
	}

	function addAttachment($file, $c_type = 'application/octet-stream', $name = '', $isfile = true, $encoding = 'base64', $disposition = 'attachment', $charset = '', $language = '', $location = '', $n_encoding = null, $f_encoding = null, $description = '', $h_charset = null) {
		$bodyfile = null;

		if ($isfile) {
			// Don't load file into memory
			if ($this->_build_params['delay_file_io']) {
				$filedata = null;
				$bodyfile = $file;
			} else {
				if (PEAR :: isError($filedata = $this->_file2str($file))) {
					return $filedata;
				}
			}
			// Force the name the user supplied, otherwise use $file
			$filename = ($name ? $name : $file);
		} else {
			$filedata = $file;
			$filename = $name;
		}

		if (!strlen($filename)) {
			$msg = "The supplied filename for the attachment can't be empty";
			$err = PEAR :: raiseError($msg);
			return $err;
		}
		$filename = $this->_basename($filename);

		$this->_parts[] = array (
			'body' => $filedata,
			'body_file' => $bodyfile,
			'name' => $filename,
			'c_type' => $c_type,
			'charset' => $charset,
			'encoding' => $encoding,
			'language' => $language,
			'location' => $location,
			'disposition' => $disposition,
			'description' => $description,
			'name_encoding' => $n_encoding,
			'filename_encoding' => $f_encoding,
			'headers_charset' => $h_charset,
			
		);

		return true;
	}

	function & _file2str($file_name) {
		// Check state of file and raise an error properly
		if (!file_exists($file_name)) {
			$err = PEAR :: raiseError('File not found: ' . $file_name);
			return $err;
		}
		if (!is_file($file_name)) {
			$err = PEAR :: raiseError('Not a regular file: ' . $file_name);
			return $err;
		}
		if (!is_readable($file_name)) {
			$err = PEAR :: raiseError('File is not readable: ' . $file_name);
			return $err;
		}

		// Temporarily reset magic_quotes_runtime and read file contents
		if ($magic_quote_setting = get_magic_quotes_runtime()) {
			@ ini_set('magic_quotes_runtime', 0);
		}
		$cont = file_get_contents($file_name);
		if ($magic_quote_setting) {
			@ ini_set('magic_quotes_runtime', $magic_quote_setting);
		}

		return $cont;
	}

	function & _addTextPart(& $obj, $text) {
		$params['content_type'] = 'text/plain';
		$params['encoding'] = $this->_build_params['text_encoding'];
		$params['charset'] = $this->_build_params['text_charset'];
		$params['eol'] = $this->_build_params['eol'];

		if (is_object($obj)) {
			$ret = $obj->addSubpart($text, $params);
			return $ret;
		} else {
			$ret = new Mail_mimePart($text, $params);
			return $ret;
		}
	}

	function & _addHtmlPart(& $obj) {
		$params['content_type'] = 'text/html';
		$params['encoding'] = $this->_build_params['html_encoding'];
		$params['charset'] = $this->_build_params['html_charset'];
		$params['eol'] = $this->_build_params['eol'];

		if (is_object($obj)) {
			$ret = $obj->addSubpart($this->_htmlbody, $params);
			return $ret;
		} else {
			$ret = new Mail_mimePart($this->_htmlbody, $params);
			return $ret;
		}
	}

	function & _addMixedPart() {
		$params = array ();
		$params['content_type'] = 'multipart/mixed';
		$params['eol'] = $this->_build_params['eol'];

		// Create empty multipart/mixed Mail_mimePart object to return
		$ret = new Mail_mimePart('', $params);
		return $ret;
	}

	function & _addAlternativePart(& $obj) {
		$params['content_type'] = 'multipart/alternative';
		$params['eol'] = $this->_build_params['eol'];

		if (is_object($obj)) {
			return $obj->addSubpart('', $params);
		} else {
			$ret = new Mail_mimePart('', $params);
			return $ret;
		}
	}

	function & _addRelatedPart(& $obj) {
		$params['content_type'] = 'multipart/related';
		$params['eol'] = $this->_build_params['eol'];

		if (is_object($obj)) {
			return $obj->addSubpart('', $params);
		} else {
			$ret = new Mail_mimePart('', $params);
			return $ret;
		}
	}

	function & _addHtmlImagePart(& $obj, $value) {
		$params['content_type'] = $value['c_type'];
		$params['encoding'] = 'base64';
		$params['disposition'] = 'inline';
		$params['filename'] = $value['name'];
		$params['cid'] = $value['cid'];
		$params['body_file'] = $value['body_file'];
		$params['eol'] = $this->_build_params['eol'];

		if (!empty ($value['name_encoding'])) {
			$params['name_encoding'] = $value['name_encoding'];
		}
		if (!empty ($value['filename_encoding'])) {
			$params['filename_encoding'] = $value['filename_encoding'];
		}

		$ret = $obj->addSubpart($value['body'], $params);
		return $ret;
	}

	function & _addAttachmentPart(& $obj, $value) {
		$params['eol'] = $this->_build_params['eol'];
		$params['filename'] = $value['name'];
		$params['encoding'] = $value['encoding'];
		$params['content_type'] = $value['c_type'];
		$params['body_file'] = $value['body_file'];
		$params['disposition'] = isset ($value['disposition']) ? $value['disposition'] : 'attachment';

		// content charset
		if (!empty ($value['charset'])) {
			$params['charset'] = $value['charset'];
		}
		// headers charset (filename, description)
		if (!empty ($value['headers_charset'])) {
			$params['headers_charset'] = $value['headers_charset'];
		}
		if (!empty ($value['language'])) {
			$params['language'] = $value['language'];
		}
		if (!empty ($value['location'])) {
			$params['location'] = $value['location'];
		}
		if (!empty ($value['name_encoding'])) {
			$params['name_encoding'] = $value['name_encoding'];
		}
		if (!empty ($value['filename_encoding'])) {
			$params['filename_encoding'] = $value['filename_encoding'];
		}
		if (!empty ($value['description'])) {
			$params['description'] = $value['description'];
		}

		$ret = $obj->addSubpart($value['body'], $params);
		return $ret;
	}

	function getMessage($separation = null, $params = null, $headers = null, $overwrite = false) {
		if ($separation === null) {
			$separation = $this->_build_params['eol'];
		}

		$body = $this->get($params);

		if (PEAR :: isError($body)) {
			return $body;
		}

		$head = $this->txtHeaders($headers, $overwrite);
		$mail = $head . $separation . $body;
		return $mail;
	}

	function getMessageBody($params = null) {
		return $this->get($params, null, true);
	}

	function saveMessage($filename, $params = null, $headers = null, $overwrite = false) {
		// Check state of file and raise an error properly
		if (file_exists($filename) && !is_writable($filename)) {
			$err = PEAR :: raiseError('File is not writable: ' . $filename);
			return $err;
		}

		// Temporarily reset magic_quotes_runtime and read file contents
		if ($magic_quote_setting = get_magic_quotes_runtime()) {
			@ ini_set('magic_quotes_runtime', 0);
		}

		if (!($fh = fopen($filename, 'ab'))) {
			$err = PEAR :: raiseError('Unable to open file: ' . $filename);
			return $err;
		}

		// Write message headers into file (skipping Content-* headers)
		$head = $this->txtHeaders($headers, $overwrite, true);
		if (fwrite($fh, $head) === false) {
			$err = PEAR :: raiseError('Error writing to file: ' . $filename);
			return $err;
		}

		fclose($fh);

		if ($magic_quote_setting) {
			@ ini_set('magic_quotes_runtime', $magic_quote_setting);
		}

		// Write the rest of the message into file
		$res = $this->get($params, $filename);

		return $res ? $res : true;
	}

	function saveMessageBody($filename, $params = null) {
		// Check state of file and raise an error properly
		if (file_exists($filename) && !is_writable($filename)) {
			$err = PEAR :: raiseError('File is not writable: ' . $filename);
			return $err;
		}

		// Temporarily reset magic_quotes_runtime and read file contents
		if ($magic_quote_setting = get_magic_quotes_runtime()) {
			@ ini_set('magic_quotes_runtime', 0);
		}

		if (!($fh = fopen($filename, 'ab'))) {
			$err = PEAR :: raiseError('Unable to open file: ' . $filename);
			return $err;
		}

		// Write the rest of the message into file
		$res = $this->get($params, $filename, true);

		return $res ? $res : true;
	}

	function & get($params = null, $filename = null, $skip_head = false) {
		if (isset ($params)) {
			while (list ($key, $value) = each($params)) {
				$this->_build_params[$key] = $value;
			}
		}

		if (isset ($this->_headers['From'])) {
			// Bug #11381: Illegal characters in domain ID
			if (preg_match('#(@[0-9a-zA-Z\-\.]+)#', $this->_headers['From'], $matches)) {
				$domainID = $matches[1];
			} else {
				$domainID = '@localhost';
			}
			foreach ($this->_html_images as $i => $img) {
				$cid = $this->_html_images[$i]['cid'];
				if (!preg_match('#' . preg_quote($domainID) . '$#', $cid)) {
					$this->_html_images[$i]['cid'] = $cid . $domainID;
				}
			}
		}

		if (count($this->_html_images) && isset ($this->_htmlbody)) {
			foreach ($this->_html_images as $key => $value) {
				$regex = array ();
				$regex[] = '#(\s)((?i)src|background|href(?-i))\s*=\s*(["\']?)' .
				preg_quote($value['name'], '#') . '\3#';
				$regex[] = '#(?i)url(?-i)\(\s*(["\']?)' .
				preg_quote($value['name'], '#') . '\1\s*\)#';

				$rep = array ();
				$rep[] = '\1\2=\3cid:' . $value['cid'] . '\3';
				$rep[] = 'url(\1cid:' . $value['cid'] . '\1)';

				$this->_htmlbody = preg_replace($regex, $rep, $this->_htmlbody);
				$this->_html_images[$key]['name'] = $this->_basename($this->_html_images[$key]['name']);
			}
		}

		$this->_checkParams();

		$null = null;
		$attachments = count($this->_parts) ? true : false;
		$html_images = count($this->_html_images) ? true : false;
		$html = strlen($this->_htmlbody) ? true : false;
		$text = (!$html && strlen($this->_txtbody)) ? true : false;

		switch (true) {
			case $text && !$attachments :
				$message = & $this->_addTextPart($null, $this->_txtbody);
				break;

			case !$text && !$html && $attachments :
				$message = & $this->_addMixedPart();
				for ($i = 0; $i < count($this->_parts); $i++) {
					$this->_addAttachmentPart($message, $this->_parts[$i]);
				}
				break;

			case $text && $attachments :
				$message = & $this->_addMixedPart();
				$this->_addTextPart($message, $this->_txtbody);
				for ($i = 0; $i < count($this->_parts); $i++) {
					$this->_addAttachmentPart($message, $this->_parts[$i]);
				}
				break;

			case $html && !$attachments && !$html_images :
				if (isset ($this->_txtbody)) {
					$message = & $this->_addAlternativePart($null);
					$this->_addTextPart($message, $this->_txtbody);
					$this->_addHtmlPart($message);
				} else {
					$message = & $this->_addHtmlPart($null);
				}
				break;

			case $html && !$attachments && $html_images :
				// * Content-Type: multipart/alternative;
				// * text
				// * Content-Type: multipart/related;
				// * html
				// * image...
				if (isset ($this->_txtbody)) {
					$message = & $this->_addAlternativePart($null);
					$this->_addTextPart($message, $this->_txtbody);

					$ht = & $this->_addRelatedPart($message);
					$this->_addHtmlPart($ht);
					for ($i = 0; $i < count($this->_html_images); $i++) {
						$this->_addHtmlImagePart($ht, $this->_html_images[$i]);
					}
				} else {
					// * Content-Type: multipart/related;
					// * html
					// * image...
					$message = & $this->_addRelatedPart($null);
					$this->_addHtmlPart($message);
					for ($i = 0; $i < count($this->_html_images); $i++) {
						$this->_addHtmlImagePart($message, $this->_html_images[$i]);
					}
				}
				/*
				// #13444, #9725: the code below was a non-RFC compliant hack
				// * Content-Type: multipart/related;
				// * Content-Type: multipart/alternative;
				// * text
				// * html
				// * image...
				$message =& $this->_addRelatedPart($null);
				if (isset($this->_txtbody)) {
				$alt =& $this->_addAlternativePart($message);
				$this->_addTextPart($alt, $this->_txtbody);
				$this->_addHtmlPart($alt);
				} else {
				$this->_addHtmlPart($message);
				}
				for ($i = 0; $i < count($this->_html_images); $i++) {
				$this->_addHtmlImagePart($message, $this->_html_images[$i]);
				}
				*/
				break;

			case $html && $attachments && !$html_images :
				$message = & $this->_addMixedPart();
				if (isset ($this->_txtbody)) {
					$alt = & $this->_addAlternativePart($message);
					$this->_addTextPart($alt, $this->_txtbody);
					$this->_addHtmlPart($alt);
				} else {
					$this->_addHtmlPart($message);
				}
				for ($i = 0; $i < count($this->_parts); $i++) {
					$this->_addAttachmentPart($message, $this->_parts[$i]);
				}
				break;

			case $html && $attachments && $html_images :
				$message = & $this->_addMixedPart();
				if (isset ($this->_txtbody)) {
					$alt = & $this->_addAlternativePart($message);
					$this->_addTextPart($alt, $this->_txtbody);
					$rel = & $this->_addRelatedPart($alt);
				} else {
					$rel = & $this->_addRelatedPart($message);
				}
				$this->_addHtmlPart($rel);
				for ($i = 0; $i < count($this->_html_images); $i++) {
					$this->_addHtmlImagePart($rel, $this->_html_images[$i]);
				}
				for ($i = 0; $i < count($this->_parts); $i++) {
					$this->_addAttachmentPart($message, $this->_parts[$i]);
				}
				break;

		}

		if (!isset ($message)) {
			$ret = null;
			return $ret;
		}

		// Use saved boundary
		if (!empty ($this->_build_params['boundary'])) {
			$boundary = $this->_build_params['boundary'];
		} else {
			$boundary = null;
		}

		// Write output to file
		if ($filename) {
			// Append mimePart message headers and body into file
			$headers = $message->encodeToFile($filename, $boundary, $skip_head);
			if (PEAR :: isError($headers)) {
				return $headers;
			}
			$this->_headers = array_merge($this->_headers, $headers);
			$ret = null;
			return $ret;
		} else {
			$output = $message->encode($boundary, $skip_head);
			if (PEAR :: isError($output)) {
				return $output;
			}
			$this->_headers = array_merge($this->_headers, $output['headers']);
			$body = $output['body'];
			return $body;
		}
	}

	function & headers($xtra_headers = null, $overwrite = false, $skip_content = false) {
		// Add mime version header
		$headers['MIME-Version'] = '1.0';

		// Content-Type and Content-Transfer-Encoding headers should already
		// be present if get() was called, but we'll re-set them to make sure
		// we got them when called before get() or something in the message
		// has been changed after get() [#14780]
		if (!$skip_content) {
			$headers += $this->_contentHeaders();
		}

		if (!empty ($xtra_headers)) {
			$headers = array_merge($headers, $xtra_headers);
		}

		if ($overwrite) {
			$this->_headers = array_merge($this->_headers, $headers);
		} else {
			$this->_headers = array_merge($headers, $this->_headers);
		}

		$headers = $this->_headers;

		if ($skip_content) {
			unset ($headers['Content-Type']);
			unset ($headers['Content-Transfer-Encoding']);
			unset ($headers['Content-Disposition']);
		} else
			if (!empty ($this->_build_params['ctype'])) {
				$headers['Content-Type'] = $this->_build_params['ctype'];
			}

		$encodedHeaders = $this->_encodeHeaders($headers);
		return $encodedHeaders;
	}

	function txtHeaders($xtra_headers = null, $overwrite = false, $skip_content = false) {
		$headers = $this->headers($xtra_headers, $overwrite, $skip_content);

		// Place Received: headers at the beginning of the message
		// Spam detectors often flag messages with it after the Subject: as spam
		if (isset ($headers['Received'])) {
			$received = $headers['Received'];
			unset ($headers['Received']);
			$headers = array (
				'Received' => $received
			) + $headers;
		}

		$ret = '';
		$eol = $this->_build_params['eol'];

		foreach ($headers as $key => $val) {
			if (is_array($val)) {
				foreach ($val as $value) {
					$ret .= "$key: $value" . $eol;
				}
			} else {
				$ret .= "$key: $val" . $eol;
			}
		}

		return $ret;
	}

	function setContentType($type, $params = array ()) {
		$header = $type;

		$eol = !empty ($this->_build_params['eol']) ? $this->_build_params['eol'] : "\r\n";

		// add parameters
		$token_regexp = '#([^\x21,\x23-\x27,\x2A,\x2B,\x2D' . ',\x2E,\x30-\x39,\x41-\x5A,\x5E-\x7E])#';
		if (is_array($params)) {
			foreach ($params as $name => $value) {
				if ($name == 'boundary') {
					$this->_build_params['boundary'] = $value;
				}
				if (!preg_match($token_regexp, $value)) {
					$header .= ";$eol $name=$value";
				} else {
					$value = addcslashes($value, '\\"');
					$header .= ";$eol $name=\"$value\"";
				}
			}
		}

		// add required boundary parameter if not defined
		if (preg_match('/^multipart\//i', $type)) {
			if (empty ($this->_build_params['boundary'])) {
				$this->_build_params['boundary'] = '=_' . md5(rand() . microtime());
			}

			$header .= ";$eol boundary=\"" . $this->_build_params['boundary'] . "\"";
		}

		$this->_build_params['ctype'] = $header;
	}

	function setSubject($subject) {
		$this->_headers['Subject'] = $subject;
	}

	function setFrom($email) {
		$this->_headers['From'] = $email;
	}

	function addTo($email) {
		if (isset ($this->_headers['To'])) {
			$this->_headers['To'] .= ", $email";
		} else {
			$this->_headers['To'] = $email;
		}
	}

	function addCc($email) {
		if (isset ($this->_headers['Cc'])) {
			$this->_headers['Cc'] .= ", $email";
		} else {
			$this->_headers['Cc'] = $email;
		}
	}

	function addBcc($email) {
		if (isset ($this->_headers['Bcc'])) {
			$this->_headers['Bcc'] .= ", $email";
		} else {
			$this->_headers['Bcc'] = $email;
		}
	}

	function encodeRecipients($recipients) {
		$input = array (
			"To" => $recipients
		);
		$retval = $this->_encodeHeaders($input);
		return $retval["To"];
	}

	function _encodeHeaders($input, $params = array ()) {
		$build_params = $this->_build_params;
		while (list ($key, $value) = each($params)) {
			$build_params[$key] = $value;
		}

		foreach ($input as $hdr_name => $hdr_value) {
			if (is_array($hdr_value)) {
				foreach ($hdr_value as $idx => $value) {
					$input[$hdr_name][$idx] = $this->encodeHeader($hdr_name, $value, $build_params['head_charset'], $build_params['head_encoding']);
				}
			} else {
				$input[$hdr_name] = $this->encodeHeader($hdr_name, $hdr_value, $build_params['head_charset'], $build_params['head_encoding']);
			}
		}

		return $input;
	}

	function encodeHeader($name, $value, $charset, $encoding) {
		return Mail_mimePart :: encodeHeader($name, $value, $charset, $encoding, $this->_build_params['eol']);
	}

	function _basename($filename) {
		// basename() is not unicode safe and locale dependent
		if (stristr(PHP_OS, 'win') || stristr(PHP_OS, 'netware')) {
			return preg_replace('/^.*[\\\\\\/]/', '', $filename);
		} else {
			return preg_replace('/^.*[\/]/', '', $filename);
		}
	}

	function _contentHeaders() {
		$attachments = count($this->_parts) ? true : false;
		$html_images = count($this->_html_images) ? true : false;
		$html = strlen($this->_htmlbody) ? true : false;
		$text = (!$html && strlen($this->_txtbody)) ? true : false;
		$headers = array ();

		// See get()
		switch (true) {
			case $text && !$attachments :
				$headers['Content-Type'] = 'text/plain';
				break;

			case !$text && !$html && $attachments :
			case $text && $attachments :
			case $html && $attachments && !$html_images :
			case $html && $attachments && $html_images :
				$headers['Content-Type'] = 'multipart/mixed';
				break;

			case $html && !$attachments && !$html_images && isset ($this->_txtbody) :
			case $html && !$attachments && $html_images && isset ($this->_txtbody) :
				$headers['Content-Type'] = 'multipart/alternative';
				break;

			case $html && !$attachments && !$html_images && !isset ($this->_txtbody) :
				$headers['Content-Type'] = 'text/html';
				break;

			case $html && !$attachments && $html_images && !isset ($this->_txtbody) :
				$headers['Content-Type'] = 'multipart/related';
				break;

			default :
				return $headers;
		}

		$this->_checkParams();

		$eol = !empty ($this->_build_params['eol']) ? $this->_build_params['eol'] : "\r\n";

		if ($headers['Content-Type'] == 'text/plain') {
			// single-part message: add charset and encoding
			$charset = 'charset=' . $this->_build_params['text_charset'];
			// place charset parameter in the same line, if possible
			// 26 = strlen("Content-Type: text/plain; ")
			$headers['Content-Type'] .= (strlen($charset) + 26 <= 76) ? "; $charset" : ";$eol $charset";
			$headers['Content-Transfer-Encoding'] = $this->_build_params['text_encoding'];
		} else
			if ($headers['Content-Type'] == 'text/html') {
				// single-part message: add charset and encoding
				$charset = 'charset=' . $this->_build_params['html_charset'];
				// place charset parameter in the same line, if possible
				$headers['Content-Type'] .= (strlen($charset) + 25 <= 76) ? "; $charset" : ";$eol $charset";
				$headers['Content-Transfer-Encoding'] = $this->_build_params['html_encoding'];
			} else {
				// multipart message: and boundary
				if (!empty ($this->_build_params['boundary'])) {
					$boundary = $this->_build_params['boundary'];
				} else
					if (!empty ($this->_headers['Content-Type']) && preg_match('/boundary="([^"]+)"/', $this->_headers['Content-Type'], $m)) {
						$boundary = $m[1];
					} else {
						$boundary = '=_' . md5(rand() . microtime());
					}

				$this->_build_params['boundary'] = $boundary;
				$headers['Content-Type'] .= ";$eol boundary=\"$boundary\"";
			}

		return $headers;
	}

	function _checkParams() {
		$encodings = array (
			'7bit',
			'8bit',
			'base64',
			'quoted-printable'
		);

		$this->_build_params['text_encoding'] = strtolower($this->_build_params['text_encoding']);
		$this->_build_params['html_encoding'] = strtolower($this->_build_params['html_encoding']);

		if (!in_array($this->_build_params['text_encoding'], $encodings)) {
			$this->_build_params['text_encoding'] = '7bit';
		}
		if (!in_array($this->_build_params['html_encoding'], $encodings)) {
			$this->_build_params['html_encoding'] = '7bit';
		}

		// text body
		if ($this->_build_params['text_encoding'] == '7bit' && !preg_match('/ascii/i', $this->_build_params['text_charset']) && preg_match('/[^\x00-\x7F]/', $this->_txtbody)) {
			$this->_build_params['text_encoding'] = 'quoted-printable';
		}
		// html body
		if ($this->_build_params['html_encoding'] == '7bit' && !preg_match('/ascii/i', $this->_build_params['html_charset']) && preg_match('/[^\x00-\x7F]/', $this->_htmlbody)) {
			$this->_build_params['html_encoding'] = 'quoted-printable';
		}
	}

} // End of class