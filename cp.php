<?php
/**
 * 2023 codePresta.com
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the General Public License (GPL 2.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/GPL-2.0
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade the module to newer
 * versions in the future.
 *
 *  @author    codepresta.com <hello@codepresta.com>
 *  @copyright 2023 codepresta.com
 *  @license   http://opensource.org/licenses/GPL-2.0 General Public License (GPL 2.0)
 *  @version   1.0.0
 *  @created   10 December 2023
 *  @last updated 10 December 2023
 */

include(dirname(__FILE__).'/../../config/config.inc.php');
include(dirname(__FILE__).'/../../init.php');
require_once _PS_MODULE_DIR_ . 'mymails/mymails.php';
if (substr(Tools::encrypt('myemailscp'), 0, 30) != Tools::getValue('token'))
    die('Ohhh......What happened.. Bad token');

$module = new Mymails();
$module->init();
