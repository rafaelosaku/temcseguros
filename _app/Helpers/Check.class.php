<?php

/**
 * Check.class [ HELPER ]
 * Classe responsavel por manipular e validar dados do sistema.
 *
 * @copyright (c) 2015, Rafael Osaku
 */
class Check {

    private static $Data;
    private static $Format;

    public static function Email($Email) {
        self::$Data = (string) $Email;
        self::$Format = '/[a-z0-9_\.\-]+@[a-z0-9_\.\-]*[a-z0-9_\.\-]+\.[a-z]{2,4}$/';

        if (preg_match(self::$Format, self::$Data)):
            return true;
        else:
            return false;
        endif;
    }

    public static function Name($Name) {
        self::$Data = strip_tags(trim((string) $Name));

        if (function_exists('iconv')):
            $Converted = iconv('UTF-8', 'ASCII//TRANSLIT//IGNORE', self::$Data);
            self::$Data = ($Converted !== false ? $Converted : self::$Data);
        endif;

        self::$Data = preg_replace('/[^A-Za-z0-9]+/', '-', self::$Data);
        self::$Data = trim(self::$Data, '-');

        return strtolower(self::$Data);
    }

    public static function Data($Data) {
        self::$Format = explode(' ', $Data);
        self::$Data = explode('/', self::$Format[0]);

        if (empty(self::$Format[1])):
            self::$Format[1] = date('H:i:s');
        endif;

        self::$Data = self::$Data[2] . '-' . self::$Data[1] . '-' . self::$Data[0] . ' ' . self::$Format[1];
        return self::$Data;
    }

    public static function Words($String, $Limite, $Pointer = null) {
        self::$Data = strip_tags(trim($String));
        self::$Format = (int) $Limite;

        $ArrWords = explode(' ', self::$Data);
        $NumWords = count($ArrWords);
        $NewWords = implode(' ', array_slice($ArrWords, 0, self::$Format));

        $Pointer = (empty($Pointer) ? '...' : ' ' . $Pointer);
        $Result = (self::$Format < $NumWords ? $NewWords . $Pointer : $String);
        return $Result;
    }

    public static function CatByName($CategoryName) {
        $read = new Read;
        $read->ExeRead('ws_categories', "WHERE category_name = :name", "name={$CategoryName}");
        if ($read->getRowCount()):
            return $read->getResult()[0]['category_id'];
        else:
            echo "A categoria {$CategoryName} nao foi encontrada!";
            die;
        endif;
    }

    // ws_siteviews_online
    public static function UserOnLine() {
        $now = date('Y-m-d H:i:s');
        $deleteUserOnline = new Delete;
        $deleteUserOnline->ExeDelete('ws_siteviews_online', "WHERE online_endview < :now", "now={$now}");

        $readUserOnline = new Read;
        $readUserOnline->ExeRead("ws_siteviews_online");
        return $readUserOnline->getRowCount();
    }

    public static function Image($ImageUrl, $ImageDes, $ImageW = null, $ImageH = null) {
        self::$Data = 'uploads/' . $ImageUrl;

        if (file_exists(self::$Data) && !is_dir(self::$Data)):
            $path = HOME;
            $imagem = self::$Data;
            // return $path . $imagem;
            return "<img src=\"{$path}/tim.php?src={$path}/{$imagem}&w={$ImageW}&h={$ImageH}\" alt=\"{$ImageDes}\" title=\"{$ImageDes}\"/>";
        endif;
    }

}
