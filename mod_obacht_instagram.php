<?php
/**
 * Obacht! Instagram
 * 
 * @package    Joomla.Tutorials
 * @subpackage Modules
 * @license    GNU/GPL, see LICENSE.php
 * @link       http://docs.joomla.org/J3.x:Creating_a_simple_module/Developing_a_Basic_Module
 * mod_helloworld is free software. This version may have been modified pursuant
 * to the GNU General Public License, and as distributed it includes or
 * is derivative of works licensed under the GNU General Public License or
 * other free or open source software licenses.
 */

// No direct access
defined('_JEXEC') or die;
// Include the syndicate functions only once
require_once dirname(__FILE__) . '/helper.php';

$token = modObachtInstagramHelper::getToken();
if($token == "NO TOKEN" || $token ==""){
    $refresh=modObachtInstagramHelper::refreshLongliveToken();
    if($refresh){
        $token = modObachtInstagramHelper::getToken();
        $instagram_posts = modObachtInstagramHelper::getInstagramPosts($token);
    }else{
        $token= modObachtInstagramHelper::getLongliveToken($params);
        $instagram_posts = modObachtInstagramHelper::getInstagramPosts($token);
    }
}else{
    $instagram_posts = modObachtInstagramHelper::getInstagramPosts($token);
}

require JModuleHelper::getLayoutPath('mod_obacht_instagram');