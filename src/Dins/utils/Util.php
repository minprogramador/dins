<?php

namespace Dins\utils;

class Util {
    
    public function curl($url, $cookies=false, $post=false, $header=true, $referer=null, $follow=false, $proxy=false, $headers=false, $timeout=5)
    {   
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HEADER, $header);
        if ($cookies) curl_setopt($ch, CURLOPT_COOKIE, $cookies);
        curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 6.1; rv:12.0) Gecko/20100101 Firefox/12.0');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, $follow);
        if(isset($referer)){ curl_setopt($ch, CURLOPT_REFERER,$referer); }

        else{ curl_setopt($ch, CURLOPT_REFERER,$url); }
        
        if($post){
            if($post == 'vai'){
                curl_setopt($ch, CURLOPT_POST, true);
                curl_setopt($ch, CURLOPT_POSTFIELDS, ""); 

            }else{
                curl_setopt($ch, CURLOPT_POST, 1);
                curl_setopt($ch, CURLOPT_POSTFIELDS, $post); 
            }
        }
        
        if($headers) {
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        }

        if(!stristr($proxy, ':')) {
            echo "\n\n========= ops sem proxy no curl ===========\n\n";
            die;
        }

        if(is_array($proxy)){
            if(strlen($proxy['ip']) > 5){
                curl_setopt($ch, CURLOPT_PROXY, trim(rtrim($proxy['ip'])) . ":" . trim(rtrim($proxy['porta'])));
                if(strlen($proxy['user']) > 3){
                    if(strlen($proxy, 'user') > 3){
                        if(strlen($proxy['user']) > 3){
                            curl_setopt($ch, CURLOPT_PROXYUSERPWD, trim(rtrim($proxy['user'])) . ":" . trim(rtrim($proxy['pass'])));
                        }
                    }
                }
            }
        }else{
            if(stristr($proxy, ':')){
                curl_setopt($ch, CURLOPT_PROXY, $proxy);
            }
        }

        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE); 
        curl_setopt ($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_TIMEOUT, $timeout); 
        curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
        
        $res = curl_exec( $ch);
        curl_close($ch); 
        #return utf8_decode($res);
        return ($res);
    }
    
     public function unique_multidim_array($array, $key) {
        $temp_array = array();
        $i = 0;
        $key_array = array();
       
        foreach($array as $val) {
            if (!in_array($val[$key], $key_array)) {
                $key_array[$i] = $val[$key];
                $temp_array[$i] = $val;
            }
            $i++;
        }
        return $temp_array;
    }

    public function clean_string($value) {
        return str_replace(array("\n",'  '), '', $value);
    }

    public function limpa_strings($str) {
        if(is_array($str)){
            return $str;
        }
        $str  = strip_tags($str);
        $check  = substr($str, 0, 1);
        if($check == ' ') {
            $str = substr($str, 1);
        }
        
        $str = str_replace(array("\n", "\t", "\r", '&nbsp;'), '', $str);
        return trim(rtrim($str));
     }
    

    public function corta($str, $left, $right) 
    {
        $str = substr ( stristr ( $str, $left ), strlen ( $left ) );
        @$leftLen = strlen ( stristr ( $str, $right ) );
        $leftLen = $leftLen ? - ($leftLen) : strlen ( $str );  
        $str = substr ( $str, 0, $leftLen );
        return $str;
    }
    public static function arr2ini(array $a, array $parent = array()) {
        $out = '';
        foreach ($a as $k => $v) {
            if (is_array($v)) {
                $sec = array_merge((array) $parent, (array) $k);
                $out .= '[' . join('.', $sec) . ']' . PHP_EOL;
                $out .= arr2ini($v, $sec);
            } else {
                $out .= "$k=". '"'.$v.'"' . PHP_EOL;
            }
        }
        return $out;
    }

    public static function getCookies($get)
    {
        preg_match_all('/Set-Cookie: (.*);/U',$get,$temp);
        $cookie = $temp[1];
        $cookies = implode('; ',$cookie);
        return $cookies;
    }

    public function parseForm($data)
    {
        $post = array();
        if(preg_match_all('/<input(.*)>/U', $data, $matches)){
            foreach($matches[0] as $input){
                if(!stristr($input, "name=")) continue;
                if(preg_match('/name=(".*"|\'.*\')/U', $input, $name))
                {
                    $key = substr($name[1], 1, -1);
                    if(preg_match('/value=(".*"|\'.*\')/U', $input, $value)) $post[$key] = substr($value[1], 1, -1);
                    else $post[$key] = "";
                }
            }
        }
        return $post;
    }

    public function xss($data, $problem='')
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        $data = strip_tags($data);

        if ($problem && strlen($data) == 0){ return ($problem); }
        return $data;
    }
    
    
}
