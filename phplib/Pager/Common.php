 <?php

/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

if (substr($_SERVER['PHP_SELF'], -1) == '/') {
	$http = (isset ($_SERVER['HTTPS']) && ('on' == strtolower($_SERVER['HTTPS']))) ? 'https://' : 'http://';
	define('PAGER_CURRENT_FILENAME', '');
	define('PAGER_CURRENT_PATHNAME', $http . $_SERVER['HTTP_HOST'] . str_replace('\\', '/', $_SERVER['PHP_SELF']));
} else {
	define('PAGER_CURRENT_FILENAME', preg_replace('/(.*)\?.*/', '\\1', basename($_SERVER['PHP_SELF'])));
	define('PAGER_CURRENT_PATHNAME', str_replace('\\', '/', dirname($_SERVER['PHP_SELF'])));
}
define('PAGER_OK', 0);
define('ERROR_PAGER', -1);
define('ERROR_PAGER_INVALID', -2);
define('ERROR_PAGER_INVALID_PLACEHOLDER', -3);
define('ERROR_PAGER_INVALID_USAGE', -4);
define('ERROR_PAGER_NOT_IMPLEMENTED', -5);

class Pager_Common {
	// {{{ class vars

	var $_totalItems;

	var $_perPage = 10;

	var $_delta = 10;

	var $_currentPage = 1;

	var $_totalPages = 1;

	var $_linkClass = '';

	var $_classString = '';

	var $_path = PAGER_CURRENT_PATHNAME;

	var $_fileName = PAGER_CURRENT_FILENAME;

	var $_fixFileName = true;

	var $_append = true;

	var $_httpMethod = 'GET';

	var $_formID = '';

	var $_importQuery = true;

	var $_urlVar = 'pageID';

	var $_linkData = array ();

	var $_extraVars = array ();

	var $_excludeVars = array ();

	var $_expanded = true;

	var $_accesskey = false;

	var $_attributes = '';

	var $_onclick = '';

	var $_altFirst = 'first page';

	var $_altPrev = 'previous page';

	var $_altNext = 'next page';

	var $_altLast = 'last page';

	var $_altPage = 'page';

	var $_prevImg = '&lt;&lt; Back';

	var $_prevImgEmpty = null;

	var $_nextImg = 'Next &gt;&gt;';

	var $_nextImgEmpty = null;

	var $_separator = '';

	var $_spacesBeforeSeparator = 0;

	var $_spacesAfterSeparator = 1;

	var $_curPageLinkClassName = '';

	var $_curPageSpanPre = '';

	var $_curPageSpanPost = '';

	var $_firstPagePre = '[';

	var $_firstPageText = '';

	var $_firstPagePost = ']';

	var $_lastPagePre = '[';

	var $_lastPageText = '';

	var $_lastPagePost = ']';

	var $_spacesBefore = '';

	var $_spacesAfter = '';

	var $_firstLinkTitle = 'first page';

	var $_nextLinkTitle = 'next page';

	var $_prevLinkTitle = 'previous page';

	var $_lastLinkTitle = 'last page';

	var $_showAllText = '';

	var $_itemData = null;

	var $_clearIfVoid = true;

	var $_useSessions = false;

	var $_closeSession = false;

	var $_sessionVar = 'setPerPage';

	var $_pearErrorMode = null;

	// }}}
	// {{{ public vars

	var $links = '';

	var $linkTags = '';

	var $linkTagsRaw = array ();

	var $range = array ();

	var $_allowed_options = array (
		'totalItems',
		'perPage',
		'delta',
		'linkClass',
		'path',
		'fileName',
		'fixFileName',
		'append',
		'httpMethod',
		'formID',
		'importQuery',
		'urlVar',
		'altFirst',
		'altPrev',
		'altNext',
		'altLast',
		'altPage',
		'prevImg',
		'prevImgEmpty',
		'nextImg',
		'nextImgEmpty',
		'expanded',
		'accesskey',
		'attributes',
		'onclick',
		'separator',
		'spacesBeforeSeparator',
		'spacesAfterSeparator',
		'curPageLinkClassName',
		'curPageSpanPre',
		'curPageSpanPost',
		'firstPagePre',
		'firstPageText',
		'firstPagePost',
		'lastPagePre',
		'lastPageText',
		'lastPagePost',
		'firstLinkTitle',
		'nextLinkTitle',
		'prevLinkTitle',
		'lastLinkTitle',
		'showAllText',
		'itemData',
		'clearIfVoid',
		'useSessions',
		'closeSession',
		'sessionVar',
		'pearErrorMode',
		'extraVars',
		'excludeVars',
		'currentPage',
		
	);

	// }}}
	// {{{ build()

	function build() {
		//reset
		$this->_pageData = array ();
		$this->links = '';
		$this->linkTags = '';
		$this->linkTagsRaw = array ();

		$this->_generatePageData();
		$this->_setFirstLastText();

		if ($this->_totalPages > (2 * $this->_delta + 1)) {
			$this->links .= $this->_printFirstPage();
		}

		$this->links .= $this->_getBackLink();
		$this->links .= $this->_getPageLinks();
		$this->links .= $this->_getNextLink();

		$this->linkTags .= $this->_getFirstLinkTag();
		$this->linkTags .= $this->_getPrevLinkTag();
		$this->linkTags .= $this->_getNextLinkTag();
		$this->linkTags .= $this->_getLastLinkTag();

		$this->linkTagsRaw['first'] = $this->_getFirstLinkTag(true);
		$this->linkTagsRaw['prev'] = $this->_getPrevLinkTag(true);
		$this->linkTagsRaw['next'] = $this->_getNextLinkTag(true);
		$this->linkTagsRaw['last'] = $this->_getLastLinkTag(true);

		if ($this->_totalPages > (2 * $this->_delta + 1)) {
			$this->links .= $this->_printLastPage();
		}
	}

	// }}}
	// {{{ getPageData()

	function getPageData($pageID = null) {
		$pageID = empty ($pageID) ? $this->_currentPage : $pageID;

		if (!isset ($this->_pageData)) {
			$this->_generatePageData();
		}
		if (!empty ($this->_pageData[$pageID])) {
			return $this->_pageData[$pageID];
		}
		return array ();
	}

	// }}}
	// {{{ getPageIdByOffset()

	function getPageIdByOffset($index) {
		$msg = 'function "getPageIdByOffset()" not implemented.';
		return $this->raiseError($msg, ERROR_PAGER_NOT_IMPLEMENTED);
	}

	// }}}
	// {{{ getOffsetByPageId()

	function getOffsetByPageId($pageID = null) {
		$pageID = isset ($pageID) ? $pageID : $this->_currentPage;
		if (!isset ($this->_pageData)) {
			$this->_generatePageData();
		}

		if (isset ($this->_pageData[$pageID]) || is_null($this->_itemData)) {
			return array (
				max(($this->_perPage * ($pageID -1)) + 1, 1),
				min($this->_totalItems, $this->_perPage * $pageID)
			);
		}
		return array (
			0,
			0
		);
	}

	// }}}
	// {{{ getPageRangeByPageId()

	function getPageRangeByPageId($pageID = null) {
		$msg = 'function "getPageRangeByPageId()" not implemented.';
		return $this->raiseError($msg, ERROR_PAGER_NOT_IMPLEMENTED);
	}

	// }}}
	// {{{ getLinks()

	function getLinks($pageID = null, $next_html = '') {
		$msg = 'function "getLinks()" not implemented.';
		return $this->raiseError($msg, ERROR_PAGER_NOT_IMPLEMENTED);
	}

	// }}}
	// {{{ getCurrentPageID()

	function getCurrentPageID() {
		return $this->_currentPage;
	}

	// }}}
	// {{{ getNextPageID()

	function getNextPageID() {
		return ($this->getCurrentPageID() == $this->numPages() ? false : $this->getCurrentPageID() + 1);
	}

	// }}}
	// {{{ getPreviousPageID()

	function getPreviousPageID() {
		return $this->isFirstPage() ? false : $this->getCurrentPageID() - 1;
	}

	// }}}
	// {{{ numItems()

	function numItems() {
		return $this->_totalItems;
	}

	// }}}
	// {{{ numPages()

	function numPages() {
		return (int) $this->_totalPages;
	}

	// }}}
	// {{{ isFirstPage()

	function isFirstPage() {
		return ($this->_currentPage < 2);
	}

	// }}}
	// {{{ isLastPage()

	function isLastPage() {
		return ($this->_currentPage == $this->_totalPages);
	}

	// }}}
	// {{{ isLastPageComplete()

	function isLastPageComplete() {
		return !($this->_totalItems % $this->_perPage);
	}

	// }}}
	// {{{ _generatePageData()

	function _generatePageData() {
		// Been supplied an array of data?
		if (!is_null($this->_itemData)) {
			$this->_totalItems = count($this->_itemData);
		}
		$this->_totalPages = ceil((float) $this->_totalItems / (float) $this->_perPage);
		$i = 1;
		if (!empty ($this->_itemData)) {
			foreach ($this->_itemData as $key => $value) {
				$this->_pageData[$i][$key] = $value;
				if (count($this->_pageData[$i]) >= $this->_perPage) {
					$i++;
				}
			}
		} else {
			$this->_pageData = array ();
		}

		//prevent URL modification
		$this->_currentPage = min($this->_currentPage, $this->_totalPages);
	}

	// }}}
	// {{{ _renderLink()

	function _renderLink($altText, $linkText) {
		if ($this->_httpMethod == 'GET') {
			if ($this->_append) {
				$href = '?' . $this->_http_build_query_wrapper($this->_linkData);
			} else {
				$href = str_replace('%d', $this->_linkData[$this->_urlVar], $this->_fileName);
			}
			$onclick = '';
			if (array_key_exists($this->_urlVar, $this->_linkData)) {
				$onclick = str_replace('%d', $this->_linkData[$this->_urlVar], $this->_onclick);
			}
			return sprintf('<a href="%s"%s%s%s%s title="%s">%s</a>', htmlentities($this->_url . $href, ENT_COMPAT, 'UTF-8'), empty ($this->_classString) ? '' : ' ' . $this->_classString, empty ($this->_attributes) ? '' : ' ' . $this->_attributes, empty ($this->_accesskey) ? '' : ' accesskey="' . $this->_linkData[$this->_urlVar] . '"', empty ($onclick) ? '' : ' onclick="' . $onclick . '"', $altText, $linkText);
		}
		elseif ($this->_httpMethod == 'POST') {
			$href = $this->_url;
			if (!empty ($_GET)) {
				$href .= '?' . $this->_http_build_query_wrapper($_GET);
			}
			return sprintf("<a href='javascript:void(0)' onclick='%s'%s%s%s title='%s'>%s</a>", $this->_generateFormOnClick($href, $this->_linkData), empty ($this->_classString) ? '' : ' ' . $this->_classString, empty ($this->_attributes) ? '' : ' ' . $this->_attributes, empty ($this->_accesskey) ? '' : ' accesskey=\'' . $this->_linkData[$this->_urlVar] . '\'', $altText, $linkText);
		}
		return '';
	}

	// }}}
	// {{{ _generateFormOnClick()

	function _generateFormOnClick($formAction, $data) {
		// Check we have an array to work with
		if (!is_array($data)) {
			trigger_error('_generateForm() Parameter 1 expected to be Array or Object. Incorrect value given.', E_USER_WARNING);
			return false;
		}

		if (!empty ($this->_formID)) {
			$str = 'var form = document.getElementById("' . $this->_formID . '"); var input = ""; ';
		} else {
			$str = 'var form = document.createElement("form"); var input = ""; ';
		}

		// We /shouldn't/ need to escape the URL ...
		$str .= sprintf('form.action = "%s"; ', htmlentities($formAction, ENT_COMPAT, 'UTF-8'));
		$str .= sprintf('form.method = "%s"; ', $this->_httpMethod);
		foreach ($data as $key => $val) {
			$str .= $this->_generateFormOnClickHelper($val, $key);
		}

		if (empty ($this->_formID)) {
			$str .= 'document.getElementsByTagName("body")[0].appendChild(form);';
		}

		$str .= 'form.submit(); return false;';
		return $str;
	}

	// }}}
	// {{{ _generateFormOnClickHelper

	function _generateFormOnClickHelper($data, $prev = '') {
		$str = '';
		if (is_array($data) || is_object($data)) {
			// foreach key/visible member
			foreach ((array) $data as $key => $val) {
				// append [$key] to prev
				$tempKey = sprintf('%s[%s]', $prev, $key);
				$str .= $this->_generateFormOnClickHelper($val, $tempKey);
			}
		} else { // must be a literal value
			// escape newlines and carriage returns
			$search = array (
				"\n",
				"\r"
			);
			$replace = array (
				'\n',
				'\n'
			);
			$escapedData = str_replace($search, $replace, $data);
			// am I forgetting any dangerous whitespace?
			// would a regex be faster?
			// if it's already encoded, don't encode it again
			if (!$this->_isEncoded($escapedData)) {
				$escapedData = urlencode($escapedData);
			}
			$escapedData = htmlentities($escapedData, ENT_QUOTES, 'UTF-8');

			$str .= 'input = document.createElement("input"); ';
			$str .= 'input.type = "hidden"; ';
			$str .= sprintf('input.name = "%s"; ', $prev);
			$str .= sprintf('input.value = "%s"; ', $escapedData);
			$str .= 'form.appendChild(input); ';
		}
		return $str;
	}

	// }}}
	// {{{ _isRegexp()

	function _isRegexp($string) {
		return preg_match('/^\/.*\/([Uims]+)?$/', $string);
	}

	// }}}
	// {{{ _getLinksData()

	function _getLinksData() {
		$qs = array ();
		if ($this->_importQuery) {
			if ($this->_httpMethod == 'POST') {
				$qs = $_POST;
			}
			elseif ($this->_httpMethod == 'GET') {
				$qs = $_GET;
			}
		}
		foreach ($this->_excludeVars as $exclude) {
			$use_preg = $this->_isRegexp($exclude);
			foreach (array_keys($qs) as $qs_item) {
				if ($use_preg) {
					if (preg_match($exclude, $qs_item, $matches)) {
						foreach ($matches as $m) {
							unset ($qs[$m]);
						}
					}
				}
				elseif ($qs_item == $exclude) {
					unset ($qs[$qs_item]);
					break;
				}
			}
		}
		if (count($this->_extraVars)) {
			$this->_recursive_urldecode($this->_extraVars);
			$qs = array_merge($qs, $this->_extraVars);
		}
		if (count($qs) && function_exists('get_magic_quotes_gpc') && -1 == version_compare(PHP_VERSION, '5.2.99') && get_magic_quotes_gpc()) {
			$this->_recursive_stripslashes($qs);
		}
		return $qs;
	}

	// }}}
	// {{{ _recursive_stripslashes()

	function _recursive_stripslashes(& $var) {
		if (is_array($var)) {
			foreach (array_keys($var) as $k) {
				$this->_recursive_stripslashes($var[$k]);
			}
		} else {
			$var = stripslashes($var);
		}
	}

	// }}}
	// {{{ _recursive_urldecode()

	function _recursive_urldecode(& $var) {
		if (is_array($var)) {
			foreach (array_keys($var) as $k) {
				$this->_recursive_urldecode($var[$k]);
			}
		} else {
			$trans_tbl = array_flip(get_html_translation_table(HTML_ENTITIES));
			$var = strtr($var, $trans_tbl);
		}
	}

	// }}}
	// {{{ _getBackLink()

	function _getBackLink($url = '', $link = '') {
		//legacy settings... the preferred way to set an option
		//now is passing it to the factory
		if (!empty ($url)) {
			$this->_path = $url;
		}
		if (!empty ($link)) {
			$this->_prevImg = $link;
		}
		$back = '';
		if ($this->_currentPage > 1) {
			$this->_linkData[$this->_urlVar] = $this->getPreviousPageID();
			$back = $this->_renderLink($this->_altPrev, $this->_prevImg) . $this->_spacesBefore . $this->_spacesAfter;
		} else
			if ($this->_prevImgEmpty !== null && $this->_totalPages > 1) {
				$back = $this->_prevImgEmpty . $this->_spacesBefore . $this->_spacesAfter;
			}
		return $back;
	}

	// }}}
	// {{{ _getPageLinks()

	function _getPageLinks($url = '') {
		$msg = 'function "_getPageLinks()" not implemented.';
		return $this->raiseError($msg, ERROR_PAGER_NOT_IMPLEMENTED);
	}

	// }}}
	// {{{ _getNextLink()

	function _getNextLink($url = '', $link = '') {
		//legacy settings... the preferred way to set an option
		//now is passing it to the factory
		if (!empty ($url)) {
			$this->_path = $url;
		}
		if (!empty ($link)) {
			$this->_nextImg = $link;
		}
		$next = '';
		if ($this->_currentPage < $this->_totalPages) {
			$this->_linkData[$this->_urlVar] = $this->getNextPageID();
			$next = $this->_spacesAfter . $this->_renderLink($this->_altNext, $this->_nextImg) . $this->_spacesBefore . $this->_spacesAfter;
		} else
			if ($this->_nextImgEmpty !== null && $this->_totalPages > 1) {
				$next = $this->_spacesAfter . $this->_nextImgEmpty . $this->_spacesBefore . $this->_spacesAfter;
			}
		return $next;
	}

	// }}}
	// {{{ _getFirstLinkTag()

	function _getFirstLinkTag($raw = false) {
		if ($this->isFirstPage() || ($this->_httpMethod != 'GET')) {
			return $raw ? array () : '';
		}
		if ($raw) {
			return array (
				'url' => $this->_getLinkTagUrl(1),
				'title' => $this->_firstLinkTitle
			);
		}
		return sprintf('<link rel="first" href="%s" title="%s" />' . "\n", $this->_getLinkTagUrl(1), $this->_firstLinkTitle);
	}

	// }}}
	// {{{ _getPrevLinkTag()

	function _getPrevLinkTag($raw = false) {
		if ($this->isFirstPage() || ($this->_httpMethod != 'GET')) {
			return $raw ? array () : '';
		}
		if ($raw) {
			return array (
				'url' => $this->_getLinkTagUrl($this->getPreviousPageID()),
				'title' => $this->_prevLinkTitle
			);
		}
		return sprintf('<link rel="previous" href="%s" title="%s" />' . "\n", $this->_getLinkTagUrl($this->getPreviousPageID()), $this->_prevLinkTitle);
	}

	// }}}
	// {{{ _getNextLinkTag()

	function _getNextLinkTag($raw = false) {
		if ($this->isLastPage() || ($this->_httpMethod != 'GET')) {
			return $raw ? array () : '';
		}
		if ($raw) {
			return array (
				'url' => $this->_getLinkTagUrl($this->getNextPageID()),
				'title' => $this->_nextLinkTitle
			);
		}
		return sprintf('<link rel="next" href="%s" title="%s" />' . "\n", $this->_getLinkTagUrl($this->getNextPageID()), $this->_nextLinkTitle);
	}

	// }}}
	// {{{ _getLastLinkTag()

	function _getLastLinkTag($raw = false) {
		if ($this->isLastPage() || ($this->_httpMethod != 'GET')) {
			return $raw ? array () : '';
		}
		if ($raw) {
			return array (
				'url' => $this->_getLinkTagUrl($this->_totalPages),
				'title' => $this->_lastLinkTitle
			);
		}
		return sprintf('<link rel="last" href="%s" title="%s" />' . "\n", $this->_getLinkTagUrl($this->_totalPages), $this->_lastLinkTitle);
	}

	// }}}
	// {{{ _getLinkTagUrl()

	function _getLinkTagUrl($pageID) {
		$this->_linkData[$this->_urlVar] = $pageID;
		if ($this->_append) {
			$href = '?' . $this->_http_build_query_wrapper($this->_linkData);
		} else {
			$href = str_replace('%d', $this->_linkData[$this->_urlVar], $this->_fileName);
		}
		return htmlentities($this->_url . $href, ENT_COMPAT, 'UTF-8');
	}

	// }}}
	// {{{ getPerPageSelectBox()

	function getPerPageSelectBox($start = 5, $end = 30, $step = 5, $showAllData = false, $extraParams = array ()) {
		include_once 'Pager/HtmlWidgets.php';
		$widget = new Pager_HtmlWidgets($this);
		return $widget->getPerPageSelectBox($start, $end, $step, $showAllData, $extraParams);
	}

	// }}}
	// {{{ getPageSelectBox()

	function getPageSelectBox($params = array (), $extraAttributes = '') {
		include_once 'Pager/HtmlWidgets.php';
		$widget = new Pager_HtmlWidgets($this);
		return $widget->getPageSelectBox($params, $extraAttributes);
	}

	// }}}
	// {{{ _printFirstPage()

	function _printFirstPage() {
		if ($this->isFirstPage()) {
			return '';
		}
		$this->_linkData[$this->_urlVar] = 1;
		return $this->_renderLink(str_replace('%d', 1, $this->_altFirst), $this->_firstPagePre . $this->_firstPageText . $this->_firstPagePost) . $this->_spacesBefore . $this->_spacesAfter;
	}

	// }}}
	// {{{ _printLastPage()

	function _printLastPage() {
		if ($this->isLastPage()) {
			return '';
		}
		$this->_linkData[$this->_urlVar] = $this->_totalPages;
		return $this->_renderLink(str_replace('%d', $this->_totalPages, $this->_altLast), $this->_lastPagePre . $this->_lastPageText . $this->_lastPagePost);
	}

	// }}}
	// {{{ _setFirstLastText()

	function _setFirstLastText() {
		if ($this->_firstPageText == '') {
			$this->_firstPageText = '1';
		}
		if ($this->_lastPageText == '') {
			$this->_lastPageText = $this->_totalPages;
		}
	}

	// }}}
	// {{{ _http_build_query_wrapper()

	function _http_build_query_wrapper($data) {
		$data = (array) $data;
		if (empty ($data)) {
			return '';
		}
		$separator = ini_get('arg_separator.output');
		if ($separator == '&amp;') {
			$separator = '&'; //the string is escaped by htmlentities anyway...
		}
		$tmp = array ();
		foreach ($data as $key => $val) {
			if (is_scalar($val)) {
				//array_push($tmp, $key.'='.$val);
				$val = urlencode($val);
				array_push($tmp, $key . '=' . str_replace('%2F', '/', $val));
				continue;
			}
			// If the value is an array, recursively parse it
			if (is_array($val)) {
				array_push($tmp, $this->__http_build_query($val, urlencode($key)));
				continue;
			}
		}
		return implode($separator, $tmp);
	}

	// }}}
	// {{{ __http_build_query()

	function __http_build_query($array, $name) {
		$tmp = array ();
		$separator = ini_get('arg_separator.output');
		if ($separator == '&amp;') {
			$separator = '&'; //the string is escaped by htmlentities anyway...
		}
		foreach ($array as $key => $value) {
			if (is_array($value)) {
				//array_push($tmp, $this->__http_build_query($value, sprintf('%s[%s]', $name, $key)));
				array_push($tmp, $this->__http_build_query($value, $name . '%5B' . $key . '%5D'));
			}
			elseif (is_scalar($value)) {
				//array_push($tmp, sprintf('%s[%s]=%s', $name, htmlentities($key), htmlentities($value)));
				array_push($tmp, $name . '%5B' . urlencode($key) . '%5D=' . urlencode($value));
			}
			elseif (is_object($value)) {
				//array_push($tmp, $this->__http_build_query(get_object_vars($value), sprintf('%s[%s]', $name, $key)));
				array_push($tmp, $this->__http_build_query(get_object_vars($value), $name . '%5B' . $key . '%5D'));
			}
		}
		return implode($separator, $tmp);
	}

	// }}}
	// {{{ _isEncoded()

	function _isEncoded($string) {
		$hexchar = '&#[\dA-Fx]{2,};';
		return preg_match("/^(\s|($hexchar))*$/Uims", $string) ? true : false;
	}

	// }}}
	// {{{ raiseError()

	function raiseError($msg, $code) {
		include_once 'PEAR.php';
		if (empty ($this->_pearErrorMode)) {
			$this->_pearErrorMode = PEAR_ERROR_RETURN;
		}
		return PEAR :: raiseError($msg, $code, $this->_pearErrorMode);
	}

	// }}}
	// {{{ setOptions()

	function setOptions($options) {
		foreach ($options as $key => $value) {
			if (in_array($key, $this->_allowed_options) && (!is_null($value))) {
				$this-> {
					'_' . $key }
				= $value;
			}
		}

		//autodetect http method
		if (!isset ($options['httpMethod']) && !isset ($_GET[$this->_urlVar]) && isset ($_POST[$this->_urlVar])) {
			$this->_httpMethod = 'POST';
		} else {
			$this->_httpMethod = strtoupper($this->_httpMethod);
		}

		if (substr($this->_path, -1, 1) == '/') {
			$this->_fileName = ltrim($this->_fileName, '/'); //strip leading slash
		}

		if ($this->_append) {
			if ($this->_fixFileName) {
				$this->_fileName = PAGER_CURRENT_FILENAME; //avoid possible user error;
			}
			$this->_url = $this->_path . (empty ($this->_path) ? '' : '/') . $this->_fileName;
		} else {
			$this->_url = $this->_path;
			if (0 != strncasecmp($this->_fileName, 'javascript', 10)) {
				$this->_url .= (empty ($this->_path) ? '' : '/');
			}
			if (false === strpos($this->_fileName, '%d')) {
				trigger_error($this->errorMessage(ERROR_PAGER_INVALID_USAGE), E_USER_WARNING);
			}
		}
		if (substr($this->_url, 0, 2) == '//') {
			$this->_url = substr($this->_url, 1);
		}
		if (false === strpos($this->_altPage, '%d')) {
			//by default, append page number at the end
			$this->_altPage .= ' %d';
		}

		$this->_classString = '';
		if (strlen($this->_linkClass)) {
			$this->_classString = 'class="' . $this->_linkClass . '"';
		}

		if (strlen($this->_curPageLinkClassName)) {
			$this->_curPageSpanPre .= '<span class="' . $this->_curPageLinkClassName . '">';
			$this->_curPageSpanPost = '</span>' . $this->_curPageSpanPost;
		}

		$this->_perPage = max($this->_perPage, 1); //avoid possible user errors

		if ($this->_useSessions && !isset ($_SESSION)) {
			session_start();
		}
		if (!empty ($_REQUEST[$this->_sessionVar])) {
			$this->_perPage = max(1, (int) $_REQUEST[$this->_sessionVar]);
			if ($this->_useSessions) {
				$_SESSION[$this->_sessionVar] = $this->_perPage;
			}
		}

		if (!empty ($_SESSION[$this->_sessionVar]) && $this->_useSessions) {
			$this->_perPage = $_SESSION[$this->_sessionVar];
		}

		if ($this->_closeSession) {
			session_write_close();
		}

		$this->_spacesBefore = str_repeat('&nbsp;', $this->_spacesBeforeSeparator);
		$this->_spacesAfter = str_repeat('&nbsp;', $this->_spacesAfterSeparator);

		if (isset ($_REQUEST[$this->_urlVar]) && empty ($options['currentPage'])) {
			$this->_currentPage = (int) $_REQUEST[$this->_urlVar];
		}
		$this->_currentPage = max($this->_currentPage, 1);
		$this->_linkData = $this->_getLinksData();

		return PAGER_OK;
	}

	// }}}
	// {{{ getOption()

	function getOption($name) {
		if (!in_array($name, $this->_allowed_options)) {
			$msg = 'invalid option: ' . $name;
			return $this->raiseError($msg, ERROR_PAGER_INVALID);
		}
		return $this-> {
			'_' . $name };
	}

	// }}}
	// {{{ getOptions()

	function getOptions() {
		$options = array ();
		foreach ($this->_allowed_options as $option) {
			$options[$option] = $this-> {
				'_' . $option };
		}
		return $options;
	}

	// }}}
	// {{{ errorMessage()

	function errorMessage($code) {
		static $errorMessages;
		if (!isset ($errorMessages)) {
			$errorMessages = array (
				ERROR_PAGER => 'unknown error',
				ERROR_PAGER_INVALID => 'invalid',
				ERROR_PAGER_INVALID_PLACEHOLDER => 'invalid format - use "%d" as placeholder.',
				ERROR_PAGER_INVALID_USAGE => 'if $options[\'append\'] is set to false, ' .
				' $options[\'fileName\'] MUST contain the "%d" placeholder.',
				ERROR_PAGER_NOT_IMPLEMENTED => 'not implemented'
			);
		}

		return (isset ($errorMessages[$code]) ? $errorMessages[$code] : $errorMessages[ERROR_PAGER]);
	}

	// }}}
}
?>
