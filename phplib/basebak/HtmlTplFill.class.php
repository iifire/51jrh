<?php
/**
 * 模板填充类
 * @author gary (yanggaojiao@qq.com)
 * @date 2014-11-30 
 */
define('DEFAULT_BEGIN_TAG', "<\%#");
define('DEFAULT_END_TAG', "#\%>");

class HtmlTplFill {
	private $FileName;
	private $BeginTag;
	private $EndTag;
	private $TplFillContent;
	private $OutContent;

	/*
	* \brief 初始化模板
	* \param[in] $filename 页面模版的路径
	* \throw OssException
	*/
	function __construct($filename, $sBeginTag = DEFAULT_BEGIN_TAG, $sEndTag = DEFAULT_END_TAG) {
		$this->BeginTag = $sBeginTag;
		$this->EndTag = $sEndTag;
		if (!file_exists($filename)) {
			throw new OssException("Template File [$filename] Not Exists.\n");
		}
		$this->FileName = $filename;
		//把文件内容全部读入到
		$this->TplFillContent = file_get_contents($this->FileName);
	}

	public function Fill($sTagName, $ValueMap = NULL) {
		$Section = $this->GetSection($sTagName);
		if ($ValueMap != NULL && is_array($ValueMap)) {
			$this->FillSection($Section, $ValueMap);
		}
		return $Section;
	}

	public function GetOutContent() {
		return $this->OutContent;
	}

	private function GetSection($sTagName) {
		if ($sTagName == "") {
			return $this->TplFillContent;
		}
		$FullTarget = ($this->BeginTag) . $sTagName . ($this->EndTag);
		$StartPos = strpos($this->TplFillContent, $FullTarget, 0);
		if ($StartPos === false) {
			throw new OssException("Begin Fill Target $FullTarget Cannot Find In Template Fill File.\n");
		}
		$StartPos = $StartPos +strlen($FullTarget);
		$EndPos = strpos($this->TplFillContent, $FullTarget, $StartPos);
		if ($EndPos === false) {
			throw new OssException("End Fill Target $FullTarget Cannot Find In Template Fill File.\n");
		}
		return substr($this->TplFillContent, $StartPos, ($EndPos - $StartPos));
	}

	private function FillSection(& $Section, $ValueMap) {
		$keys = array_keys($ValueMap);
		//$values = array_values($ValueMap);
		foreach ($keys as $keyid => $keyname)
			//for($i;$i<count($keys);++$i)
			{
			$Target = ($this->BeginTag) . $keyname . ($this->EndTag);
			$Section = str_replace($Target, $ValueMap[$keyname], $Section);
		}
	}
}
?>
