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


if (!defined('_PS_VERSION_')) {
    exit;
}

class Mymails extends Module
{

    public function __construct()
    {
        $this->name = 'mymails';
        $this->tab = 'advertising_marketing';
        $this->version = '1.0.0';
        $this->author = 'codePresta.com';
        $this->need_instance = 0;

        /**
         * Set $this->bootstrap to true if your module is compliant with bootstrap (PrestaShop 1.6)
         */
        $this->bootstrap = true;

        parent::__construct();

        $this->displayName = $this->l('My mails');
        $this->description = $this->l('With this addon, you can export customer details. Email, telephone, mobile, name, surname in JSON format');
    }

    /**
     * Don't forget to create update methods if needed:
     * http://doc.prestashop.com/display/PS16/Enabling+the+Auto-Update
     */
    public function install()
    {
        return parent::install() && $this->registerHook('displayBackOfficeHeader');
    }

    public function uninstall()
    {
        return parent::uninstall();
    }

    /**
     * Load the configuration form
     */
    public function getContent()
    {

        $this->context->smarty->assign([
            'cp_url'  => Tools::getHttpHost(true)._MODULE_DIR_.$this->name.'/cp.php?token='.substr(Tools::encrypt('myemailscp'), 0, 30),
        ]);

        $output = $this->context->smarty->fetch($this->local_path.'cp.tpl');
        return $output;
    }

    public function hookDisplayBackOfficeHeader()
    {
        if (Tools::getValue('configure') == $this->name){
            Media::addJsDef(array(
                'mymails' => array(
                      'trans'         => $this->getTranslations()
                )
            ));
            $this->context->controller->addCSS($this->_path.'back.css');
            $this->context->controller->addJS($this->_path.'back.js');
        }
    }


    public function getTranslations(){
        return array(
            'copy'    => $this->l('Copy completed'),
        );
    }




    /***
     * @param $shop
     * @return array|bool|mysqli_result|PDOStatement|resource
     * @throws PrestaShopDatabaseException
     */
    public function getCustomers($shop)
    {
        $sql = 'SELECT a.`email`, a.`firstname`, a.`lastname`,
                       b.`phone`, b.`phone_mobile` as mobile
                FROM `'._DB_PREFIX_.'customer` as a
                LEFT JOIN `'._DB_PREFIX_.'address` as b
                ON b.`id_customer`=a.`id_customer`';

        $res = Db::getInstance()->executeS($sql);

        foreach ($res as $k => $r){
            $res[$k]['shop'] = $shop;
        }

        return  $res;
    }

    /**
     * @return void
     * @throws PrestaShopDatabaseException
     */
    public function init(){

        $shop_name = $this->context->shop->name; // shop name
        $customers = $this->getCustomers($shop_name);
        $json = json_encode($customers);
        header('Content-disposition: attachment; filename='.$shop_name.'.json');
        header('Content-type: application/json');
        echo $json;
        die;
    }



}
