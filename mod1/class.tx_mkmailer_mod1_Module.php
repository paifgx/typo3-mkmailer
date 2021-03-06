<?php

/***************************************************************
*  Copyright notice
*
*  (c) 2009 Rene Nitzsche (rene@system25.de)
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

tx_rnbase::load('tx_rnbase_mod_BaseModule');

/**
 * tx_mkmailer_module1
 *
 * Module 'MK Mailer' for the 'mkmailer' extension.
 *
 * @package         TYPO3
 * @subpackage      mkmailer
 * @author          René Nitzsche <dev@dmk-ebusiness.de>
 * @license         http://www.gnu.org/licenses/lgpl.html
 *                  GNU Lesser General Public License, version 3 or later
 */
class tx_mkmailer_mod1_Module extends tx_rnbase_mod_BaseModule
{
    public $pageinfo;

    /**
     * Initializes the backend module by setting internal variables, initializing the menu.
     *
     * @return void
     */
    public function init()
    {
        $GLOBALS['LANG']->includeLLFile('EXT:mkmailer/mod1/locallang_mod.xml');

        parent::init();
    }

    /**
     * (non-PHPdoc)
     * @see tx_rnbase_mod_BaseModule::getExtensionKey()
     */
    public function getExtensionKey()
    {
        return 'mkmailer';
    }
}
