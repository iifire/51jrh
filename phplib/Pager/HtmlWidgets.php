<?php

/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

class Pager_HtmlWidgets {
	var $pager = null;

	// {{{ constructor

	function Pager_HtmlWidgets(& $pager) {
		$this->pager = & $pager;
	}

	// }}}
	// {{{ getPerPageSelectBox()

	function getPerPageSelectBox($start = 5, $end = 30, $step = 5, $showAllData = false, $extraParams = array ()) {
		// FIXME: needs POST support
		$optionText = '%d';
		$attributes = '';
		$checkMaxLimit = false;
		if (is_string($extraParams)) {
			//old behavior, BC maintained
			$optionText = $extraParams;
		} else {
			if (array_key_exists('optionText', $extraParams)) {
				$optionText = $extraParams['optionText'];
			}
			if (array_key_exists('attributes', $extraParams)) {
				$attributes = $extraParams['attributes'];
			}
			if (array_key_exists('checkMaxLimit', $extraParams)) {
				$checkMaxLimit = $extraParams['checkMaxLimit'];
			}
		}

		if (!strstr($optionText, '%d')) {
			return $this->pager->raiseError($this->pager->errorMessage(ERROR_PAGER_INVALID_PLACEHOLDER), ERROR_PAGER_INVALID_PLACEHOLDER);
		}
		$start = (int) $start;
		$end = (int) $end;
		$step = (int) $step;
		if (!empty ($_SESSION[$this->pager->_sessionVar])) {
			$selected = (int) $_SESSION[$this->pager->_sessionVar];
		} else {
			$selected = $this->pager->_perPage;
		}

		if ($checkMaxLimit && $this->pager->_totalItems >= 0 && $this->pager->_totalItems < $end) {
			$end = $this->pager->_totalItems;
		}

		$tmp = '<select name="' . $this->pager->_sessionVar . '"';
		if (!empty ($attributes)) {
			$tmp .= ' ' . $attributes;
		}
		if (!empty ($extraParams['autoSubmit'])) {
			if ('GET' == $this->pager->_httpMethod) {
				$selector = '\' + ' . 'this.options[this.selectedIndex].value + \'';
				if ($this->pager->_append) {
					$tmpLinkData = $this->pager->_linkData;
					if (isset ($tmpLinkData[$this->pager->_urlVar])) {
						$tmpLinkData[$this->pager->_urlVar] = $this->pager->getCurrentPageID();
					}
					$tmpLinkData[$this->pager->_sessionVar] = '1';
					$href = '?' . $this->pager->_http_build_query_wrapper($tmpLinkData);
					$href = htmlentities($this->pager->_url, ENT_COMPAT, 'UTF-8') . preg_replace('/(&|&amp;|\?)(' .
					$this->pager->_sessionVar . '=)(\d+)/', '\\1\\2' .
					$selector, htmlentities($href, ENT_COMPAT, 'UTF-8'));
				} else {
					$href = htmlentities($this->pager->_url . str_replace('%d', $selector, $this->pager->_fileName), ENT_COMPAT, 'UTF-8');
				}
				$tmp .= ' onchange="document.location.href=\'' . $href . '\'' . '"';
			}
			elseif ($this->pager->_httpMethod == 'POST') {
				$tmp .= " onchange='" . $this->pager->_generateFormOnClick($this->pager->_url, $this->pager->_linkData) . "'";
				$tmp = preg_replace('/(input\.name = \"' .
				$this->pager->_sessionVar . '\"; input\.value =) \"(\d+)\";/', '\\1 this.options[this.selectedIndex].value;', $tmp);
			}
		}

		$tmp .= '>';
		$last = $start;
		for ($i = $start; $i <= $end; $i += $step) {
			$last = $i;
			$tmp .= '<option value="' . $i . '"';
			if ($i == $selected) {
				$tmp .= ' selected="selected"';
			}
			$tmp .= '>' . sprintf($optionText, $i) . '</option>';
		}
		if ($showAllData && $last != $this->pager->_totalItems) {
			$tmp .= '<option value="' . $this->pager->_totalItems . '"';
			if ($this->pager->_totalItems == $selected) {
				$tmp .= ' selected="selected"';
			}
			$tmp .= '>';
			if (empty ($this->pager->_showAllText)) {
				$tmp .= str_replace('%d', $this->pager->_totalItems, $optionText);
			} else {
				$tmp .= $this->pager->_showAllText;
			}
			$tmp .= '</option>';
		}
		if (substr($tmp, -9, 9) !== '</option>') {
			//empty select
			$tmp .= '<option />';
		}
		$tmp .= '</select>';
		return $tmp;
	}

	// }}}
	// {{{ getPageSelectBox()

	function getPageSelectBox($params = array (), $extraAttributes = '') {
		$optionText = '%d';
		if (array_key_exists('optionText', $params)) {
			$optionText = $params['optionText'];
		}

		if (!strstr($optionText, '%d')) {
			return $this->pager->raiseError($this->pager->errorMessage(ERROR_PAGER_INVALID_PLACEHOLDER), ERROR_PAGER_INVALID_PLACEHOLDER);
		}

		$tmp = '<select name="' . $this->pager->_urlVar . '"';
		if (!empty ($extraAttributes)) {
			$tmp .= ' ' . $extraAttributes;
		}
		if (!empty ($params['autoSubmit'])) {
			if ($this->pager->_httpMethod == 'GET') {
				$selector = '\' + ' . 'this.options[this.selectedIndex].value + \'';
				if ($this->pager->_append) {
					$href = '?' . $this->pager->_http_build_query_wrapper($this->pager->_linkData);
					$href = htmlentities($this->pager->_url, ENT_COMPAT, 'UTF-8') . preg_replace('/(&|&amp;|\?)(' .
					$this->pager->_urlVar . '=)(\d+)/', '\\1\\2' .
					$selector, htmlentities($href, ENT_COMPAT, 'UTF-8'));
				} else {
					$href = htmlentities($this->pager->_url . str_replace('%d', $selector, $this->pager->_fileName), ENT_COMPAT, 'UTF-8');
				}
				$tmp .= ' onchange="document.location.href=\'' . $href . '\'' . '"';
			}
			elseif ($this->pager->_httpMethod == 'POST') {
				$tmp .= " onchange='" . $this->pager->_generateFormOnClick($this->pager->_url, $this->pager->_linkData) . "'";
				$tmp = preg_replace('/(input\.name = \"' .
				$this->pager->_urlVar . '\"; input\.value =) \"(\d+)\";/', '\\1 this.options[this.selectedIndex].value;', $tmp);
			}
		}
		$tmp .= '>';
		$start = 1;
		$end = $this->pager->numPages();
		$selected = $this->pager->getCurrentPageID();
		for ($i = $start; $i <= $end; $i++) {
			$tmp .= '<option value="' . $i . '"';
			if ($i == $selected) {
				$tmp .= ' selected="selected"';
			}
			$tmp .= '>' . sprintf($optionText, $i) . '</option>';
		}
		$tmp .= '</select>';
		return $tmp;
	}

	// }}}
}
?>
