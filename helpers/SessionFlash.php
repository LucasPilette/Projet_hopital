<?php 
session_start();
class SessionFlash {
    public static function set(string $message):void{
        $_SESSION['message']=$message;
    }

    public static function unset($key){
        unset($_SESSION[$key]);
    }
    public static function display($key):string{
        $display = $_SESSION[$key] ?? '';
        SessionFlash::unset($key);
        return $display;
    }
}