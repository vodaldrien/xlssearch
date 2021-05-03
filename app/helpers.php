<?php

if (!function_exists('translate_diacritics')) {
    function translate_diacritics(String $string): String
    {
        $from = array(
            'á','à','á','â','ã','ä','å','ă',
            'ß','ç',
            'è','é','ê','ë',
            'ì','í','î','ï','ñ',
            'ò','ó','ô','õ','ö',
            'ù','ú','û','ü',
            'ș','ț',
        );

        $to = [
            'a','a','a','a','a','a','a','a',
            'b','c',
            'e','e','e','e',
            'i','i','i','i','n',
            'o','o','o','o','o',
            'u','u','u','u',
            's','t'
        ];

        return \str_replace($from, $to, $string);
    }
}

