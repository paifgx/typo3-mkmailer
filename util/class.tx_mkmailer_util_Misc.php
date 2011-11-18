<?php
/***************************************************************
*  Copyright notice
*
*  (c) 2009 Rene Nitzsche (nitzsche@das-medienkombinat.de)
*  All rights reserved
*
*  This script is part of the TYPO3 project. The TYPO3 project is
*  free software; you can redistribute it and/or modify
*  it under the terms of the GNU General Public License as published by
*  the Free Software Foundation; either version 2 of the License, or
*  (at your option) any later version.
*
*  The GNU General Public License can be found at
*  http://www.gnu.org/copyleft/gpl.html.
*
*  This script is distributed in the hope that it will be useful,
*  but WITHOUT ANY WARRANTY; without even the implied warranty of
*  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
*  GNU General Public License for more details.
*
*  This copyright notice MUST APPEAR in all copies of the script!
***************************************************************/


require_once(t3lib_extMgm::extPath('rn_base') . 'class.tx_rnbase.php');


/**
 */
class tx_mkmailer_util_Misc {

	/**
	 * Will process the input string with the parseFunc function from tslib_cObj based on configuration set in "lib.parseFunc_RTE" in the current TypoScript template.
	 * This is useful for rendering of content in RTE fields where the transformation mode is set to "ts_css" or so.
	 * Notice that this requires the use of "css_styled_content" to work right.
	 *
	 * @param	string		The input text string to process
	 * @return	string		The processed string
	 * @see tslib_cObj::parseFunc()
	 */
	function getRTEText($str)	{
		tx_rnbase::load('tx_rnbase_util_Misc');
		tx_rnbase_util_Misc::prepareTSFE(); // Ist bei Aufruf aus BE notwendig!
		$parseFunc = $GLOBALS['TSFE']->tmpl->setup['lib.']['parseFunc_RTE.'];
		if (TYPO3_MODE == 'BE') {
			$pid = tx_rnbase_configurations::getExtensionCfgValue('mkmailer', 'cronpage');
			$setup = self::loadTS($pid);
			$parseFunc = $setup['lib.']['parseFunc_RTE.'];
			// TS-Config prüfen. TODO: Das sollte besser gemacht werden.
			if(!is_array($GLOBALS['TSFE']->config)) 
				$GLOBALS['TSFE']->config = $GLOBALS['TSFE']->tmpl->setup;
		}
		$cObj = t3lib_div::makeInstance('tslib_cObj');
		if (is_array($parseFunc))	$str = $cObj->parseFunc($str, $parseFunc);
		return $str;
	}

	function loadTS($pageUid = 0) {
		$sysPageObj = t3lib_div::makeInstance('t3lib_pageSelect');
		$rootLine = $sysPageObj->getRootLine($pageUid);
		$TSObj = t3lib_div::makeInstance('t3lib_tsparser_ext');
		$TSObj->tt_track = 0;
		$TSObj->init();
		$TSObj->runThroughTemplates($rootLine);
		$TSObj->generateConfig();
		return $TSObj->setup;
	}

	/**
	 * Wandelt einen String mit Mailadressen in Objekte der Klasse tx_mkmailer_mail_IAddress um.
	 *
	 * @param string $addrStr
	 * @return array[tx_mkmailer_mail_IAddress]
	 */
	public static function parseAddressString($addrStr) {
		tx_rnbase::load('tx_mkmailer_mail_Address');
		
		$ret = array();
		if(!strlen(trim($addrStr))) return $ret;
		$addrArr = t3lib_div::trimExplode(',', $addrStr);
		foreach($addrArr As $addr) {
			$ret[] = new tx_mkmailer_mail_Address($addr);
		}
		return $ret;
	}
}
if (defined('TYPO3_MODE') && $TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/mkmailer/util/class.tx_mkmailer_util_Misc.php'])	{
  include_once($TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/mkmailer/util/class.tx_mkmailer_util_Misc.php']);
}
?>