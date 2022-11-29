<?php

namespace Tests;

class SortAttributes 
{

    public function sortAttr(string $html) : string 
    {
 
        $pattern = "|<[^>]+>|";
        
        $result = preg_replace_callback($pattern, function ($matches) {
            
            $strTagComAtributos = $matches[0];

            $preg_atributos = "|<[^>]+? (.+?)>|";

            preg_match($preg_atributos, $strTagComAtributos, $result, PREG_OFFSET_CAPTURE);

            $offset = $result[1][1];
            $strAtributos = $result[1][0];

            if ($strAtributos) {

                $start = substr($strTagComAtributos, 0, $offset);

                $pattern = "/[-.0-9:A-Z_a-z]+=([\"']).+?\\1|[-.0-9:A-Z_a-z][^\s]*/";
                
                preg_match_all($pattern, $strAtributos, $result);
                $result = $result[0];

                sort($result);
                $ret = implode(' ', $result);
                $end = substr($strTagComAtributos, strlen($strAtributos) + $offset);
                $finalStr = $start . $ret . $end;

            } else {
        
                $finalStr = $strTagComAtributos;
            }
            return $finalStr;

        }, $html);

        return $result;
    }

}