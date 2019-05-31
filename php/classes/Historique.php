<?php
abstract class Historique{
    public static function addURL(){
        $currentpageurl = $_SERVER['REQUEST_URI'];
        if(!isset($_COOKIE['pageurl'][0])){
            $_COOKIE['pageurl'] = array();
            setcookie("pageurl[0]", $currentpageurl, time() + 86400, '/');
        }else{
            $num = count($_COOKIE['pageurl']);
            setcookie("pageurl[$num]", $currentpageurl, time() + 86400, '/');
        }
        
    }
    public static function set($key, $value, $time = 86400){
        setcookie($key, $value, time() + $time, '/') ;
    }
    public static function get($key){
        if (isset($_COOKIE[$key]) ){
            return $_COOKIE[$key];
        }
        return null;
    }
    public static function deleteURL(){
        if (isset($_COOKIE['pageurl'])){
            extract($_COOKIE);
            for($i=0; $i<count($_COOKIE['pageurl']); $i++){
                setcookie("pageurl[$i]",'',time()-3600, '/');
            }
            return $_COOKIE['pageurl'];
            
        }
    }
}