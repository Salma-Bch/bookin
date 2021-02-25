<?php


namespace utility;


class Format
{
    public static function getFormatId(int $idLength, int $id){
        return str_pad($id,$idLength,0, STR_PAD_LEFT);
    }

}