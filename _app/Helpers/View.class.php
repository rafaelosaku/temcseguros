<?php

/**
 * View.class [ HELPER MVC ]
 * Responsável por carregar o template, povoar e exibir, povoar e incluir arquivos PHP no sistema.
 * Arquitetura MCV
 * 
 * @copyright (c) 2015, Rafael Osaku
 */
class View {

    private static $Data;
    private static $Keys;
    private static $Values;
    private static $Template;
    
    public static function Load($Template) {
        self::$Template = (string) $Template;
        self::$Template = file_get_contents(self::$Template . '.tpl.html');
    }
    
    public static function Show(array $Data) {
        self::setKeys($Data);
        self::setValues();
        self::ShowView();
    }
    
    public static function Request($File, array $Data){
        extract($Data);
        require "{$File}.inc.php";
    }
    
    //PRIVATES
    
    private static function setKeys($Data) {
        self::$Data = $Data;
        self::$Keys = explode('&', '#' . implode("#&#", array_keys(self::$Data)) . '#');
    }
    
    private static function setValues() {
        self::$Values = array_values(self::$Data);
    }
    
    private static function ShowView(){
        echo str_replace(self::$Keys, self::$Values, self::$Template);
    }

}
