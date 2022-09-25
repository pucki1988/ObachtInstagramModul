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
    

    public static function getInstagramPosts($token)
    {
        $url = "https://graph.instagram.com/me/media?fields=id,media_url,media_type,permalink,caption,username,thumbnail_url&limit=6&access_token=".$token;
        $ch = curl_init();    
        curl_setopt($ch, CURLOPT_URL, $url); 
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE ); 
        $result = curl_exec($ch); 
        curl_close($ch); 
        return json_decode($result)->data;
    }


    public static function getToken()
    {
        $db = JFactory::getDbo();
        
        try{
        // Retrieve the shout. Note that we are now retrieving the id not the lang field.
        $query = $db->getQuery(true)
                    ->select($db->quoteName('token'))
                    ->from($db->quoteName('#__obacht_instagram'))
                    ->where('id = 1 AND expire_time > NOW() + INTERVAL 3 DAY' );
        // Prepare the query
        $db->setQuery($query);
        // Load the row.
        $result = $db->loadResult();
        // Return the Hello.
        return $result;
        }catch(Exception $ex){
            return "NO TOKEN";
        }
    }

    public static function refreshLongliveToken()
    {
        $db = JFactory::getDbo();
        // Retrieve the shout. Note that we are now retrieving the id not the lang field.
        $query = $db->getQuery(true)
                    ->select($db->quoteName('token'))
                    ->from($db->quoteName('#__obacht_instagram'))
                    ->where('id = 1');
        // Prepare the query
        $db->setQuery($query);
        // Load the row.
        $result = $db->loadResult();
        
        if($result == "NO TOKEN")
        {
            return false;
        }else{
            $url = "https://graph.instagram.com/refresh_access_token?grant_type=ig_refresh_token&access_token=".$result;
            $ch = curl_init();    
            curl_setopt($ch, CURLOPT_URL, $url); 
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE ); 
            $res = curl_exec($ch); 
            curl_close($ch); 
            
            $seconds=json_decode($res)->expires_in;
            $fields = array(
                $db->quoteName('token') . ' = ' . $db->quote(json_decode($res)->access_token),
                $db->quoteName('expire_time') . ' = '. $db->quote(date('Y-m-d H:m:s', strtotime('+ 50 days')))
            );
            $conditions = array(
                $db->quoteName('id') . ' = 1' 
            );

            $query->update($db->quoteName('#__obacht_instagram'))->set($fields)->where($conditions);
            $db->setQuery($query);

            $result = $db->execute();
            return true;
        }
    }

    public static function getLongliveToken($params)
    {
            $db = JFactory::getDbo();
            $query = $db->getQuery(true);
            $shorttoken = $params->get('shorttime_token');
            $app_secret=$params->get('insta_app_secret');
            $url = "https://graph.instagram.com/access_token?grant_type=ig_exchange_token&client_secret=".$app_secret."&access_token=".$shorttoken;
            $ch = curl_init();    
            curl_setopt($ch, CURLOPT_URL, $url); 
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE ); 
            $res = curl_exec($ch); 
            curl_close($ch); 

            
            if(isset(json_decode($res)->access_token))
            {
            
            $seconds=json_decode($res)->expires_in;
            $fields = array(
                $db->quoteName('token') . ' = ' . $db->quote(json_decode($res)->access_token),
                $db->quoteName('expire_time') . ' = '.$db->quote(date('Y-m-d H:m:s', strtotime('+ 50 days')))
            );
            $conditions = array(
                $db->quoteName('id') . ' = 1' 
            );

            $query->update($db->quoteName('#__obacht_instagram'))->set($fields)->where($conditions);
            $db->setQuery($query);

            $result = $db->execute();
            
            return json_decode($res)->access_token;
            }else{
                return "NO TOKEN";
            }
    }
}
