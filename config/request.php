<?php

class Request{

    /**
     * Validate current domain, check if has ssl
     * 
     * @return String domainLing 
     */
    public static function getDomain(){
        $protocol=strpos(strtolower($_SERVER['SERVER_PROTOCOL']),'https') === FALSE ? 'http' : 'https';
        $domainLink=$protocol.'://'.$_SERVER['HTTP_HOST'];
        return $domainLink;
    } 

    /**
     * Filter all get Requests
     * 
     * @return Array
     */
    public static function getRequest(){
        return filter_input_array(INPUT_GET, FILTER_SANITIZE_STRING);
    }

    /**
     * Filter all post Requests
     * 
     * @return Array
     */
    public static function postRequest(){
        return filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
    }

    /**
     * Return all the post keys on the request
     * 
     * @return Array
     */
    public static function postKeys(){
        return array_keys(self::postRequest());
    }

    /**
     * Generate a new url with the controller and the action
     * 
     * @param String controller
     * @param Strinc action
     * 
     * @return String
     */
    public static function generateUrl($controller,$action){
        return self::getDomain() . '/'.$controller .'/'.$action;
    }
}