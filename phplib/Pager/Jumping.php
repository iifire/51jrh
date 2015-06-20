 <?php

/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

require_once 'Pager/Common.php';

class Pager_Jumping extends Pager_Common {
	// {{{ Pager_Jumping()

	function Pager_Jumping($options = array ()) {
		$err = $this->setOptions($options);
		if ($err !== PAGER_OK) {
			return $this->raiseError($this->errorMessage($err), $err);
		}
		$this->build();
	}

	// }}}
	// {{{ getPageIdByOffset()

	function getPageIdByOffset($index) {
		if (!isset ($this->_pageData)) {
			$this->_generatePageData();
		}

		if (($index % $this->_perPage) > 0) {
			$pageID = ceil((float) $index / (float) $this->_perPage);
		} else {
			$pageID = $index / $this->_perPage;
		}
		return $pageID;
	}

	// }}}
	// {{{ getPageRangeByPageId()

	function getPageRangeByPageId($pageid = null) {
		$pageid = isset ($pageid) ? (int) $pageid : $this->_currentPage;
		if (isset ($this->_pageData[$pageid]) || is_null($this->_itemData)) {
			// I'm sure I'm missing something here, but this formula works
			// so I'm using it until I find something simpler.
			$start = ((($pageid + (($this->_delta - ($pageid % $this->_delta))) % $this->_delta) / $this->_delta) - 1) * $this->_delta + 1;
			return array (
				max($start, 1),
				min($start + $this->_delta - 1, $this->_totalPages)
			);
		} else {
			return array (
				0,
				0
			);
		}
	}

	// }}}
	// {{{ getLinks()

	function getLinks($pageID = null, $next_html = '') {
		//BC hack
		if (!empty ($next_html)) {
			$back_html = $pageID;
			$pageID = null;
		} else {
			$back_html = '';
		}

		if (!is_null($pageID)) {
			$this->links = '';
			if ($this->_totalPages > $this->_delta) {
				$this->links .= $this->_printFirstPage();
			}

			$_sav = $this->_currentPage;
			$this->_currentPage = $pageID;

			$this->links .= $this->_getBackLink('', $back_html);
			$this->links .= $this->_getPageLinks();
			$this->links .= $this->_getNextLink('', $next_html);
			if ($this->_totalPages > $this->_delta) {
				$this->links .= $this->_printLastPage();
			}
		}

		$back = str_replace('&nbsp;', '', $this->_getBackLink());
		$next = str_replace('&nbsp;', '', $this->_getNextLink());
		$pages = $this->_getPageLinks();
		$first = $this->_printFirstPage();
		$last = $this->_printLastPage();
		$all = $this->links;
		$linkTags = $this->linkTags;
		$linkTagsRaw = $this->linkTagsRaw;

		if (!is_null($pageID)) {
			$this->_currentPage = $_sav;
		}

		return array (
			$back,
			$pages,
			trim($next),
			$first,
			$last,
			$all,
			$linkTags,
			'back' => $back,
			'pages' => $pages,
			'next' => $next,
			'first' => $first,
			'last' => $last,
			'all' => $all,
			'linktags' => $linkTags,
			'linkTagsRaw' => $linkTagsRaw,
			
		);
	}

	// }}}
	// {{{ _getPageLinks()

	function _getPageLinks($url = '') {
		//legacy setting... the preferred way to set an option now
		//is adding it to the constuctor
		if (!empty ($url)) {
			$this->_path = $url;
		}

		//If there's only one page, don't display links
		if ($this->_clearIfVoid && ($this->_totalPages < 2)) {
			return '';
		}

		$links = '';
		$limits = $this->getPageRangeByPageId($this->_currentPage);

		for ($i = $limits[0]; $i <= min($limits[1], $this->_totalPages); $i++) {
			if ($i != $this->_currentPage) {
				$this->range[$i] = false;
				$this->_linkData[$this->_urlVar] = $i;
				$links .= $this->_renderLink(str_replace('%d', $i, $this->_altPage), $i);
			} else {
				$this->range[$i] = true;
				$links .= $this->_curPageSpanPre . $i . $this->_curPageSpanPost;
			}
			$links .= $this->_spacesBefore . (($i != $this->_totalPages) ? $this->_separator . $this->_spacesAfter : '');
		}
		return $links;
	}

	// }}}
}
?>
