<?php
/**
 * Helper class for Obacht Instagram! module
 * 
 * @package    Joomla.Tutorials
 * @subpackage Modules
 * @link http://docs.joomla.org/J3.x:Creating_a_simple_module/Developing_a_Basic_Module
 * @license        GNU/GPL, see LICENSE.php
 * mod_helloworld is free software. This version may have been modified pursuant
 * to the GNU General Public License, and as distributed it includes or
 * is derivative of works licensed under the GNU General Public License or
 * other free or open source software licenses.
 */
class ModObachtInstagramHelper
{
    /**
     * Retrieves the hello message
     *
     * @param   array  $params An object containing the module parameters
     *
     * @access public
     */    

    public static function getInstagramPosts($params)
    {
        $token = $params->get('longtime_api_token');
        $url = "https://graph.instagram.com/me/media?fields=id,media_url,media_type,permalink,caption,username&limit=6&access_token=".$token;
        $ch = curl_init();    
        curl_setopt($ch, CURLOPT_URL, $url); 
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE ); 
        $result = curl_exec($ch); 
        curl_close($ch); 
        return json_decode($result)->data;
    }
}
