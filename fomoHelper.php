<?php
/**
* 2007-2018 PrestaShop
*
* NOTICE OF LICENSE
*
* This source file is subject to the Academic Free License (AFL 3.0)
* that is bundled with this package in the file LICENSE.txt.
* It is also available through the world-wide-web at this URL:
* http://opensource.org/licenses/afl-3.0.php
* If you did not receive a copy of the license and are unable to
* obtain it through the world-wide-web, please send an email
* to license@prestashop.com so we can send you a copy immediately.
*
* DISCLAIMER
*
* Do not edit or add to this file if you wish to upgrade PrestaShop to newer
* versions in the future. If you wish to customize PrestaShop for your
* needs please refer to http://www.prestashop.com for more information.
*
*  @author    PrestaShop SA <contact@prestashop.com>
*  @copyright 2007-2018 PrestaShop SA
*  @license   http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
*  International Registered Trademark & Property of PrestaShop SA
*/

class FomoHelper
{
    public static function displayFomoWidget()
    {
        $api_key = Configuration::get('FOMO_API_KEY', null);

        if ($api_key != null) {
            return '<script src="https://load.fomo.com/api/v1/' . $api_key . '/load.js" async></script>';
        }
    }

    public function createFomoEvent($params)
    {
        $url = Configuration::get('FOMO_WEBHOOK_URI', null);

        if ($url == null) {
            return;
        }

        $context = stream_context_create(array(
            'http' => array(
                'method' => 'POST',
                'header' => 'Content-type: application/x-www-form-urlencoded',
                'content' => http_build_query($params),
                'timeout' => 60
            )
        ));
        Tools::file_get_contents($url, false, $context);
    }
}
