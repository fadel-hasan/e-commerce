<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;

class MarkdownController extends Controller
{
    // convert text to heading in html
    private static $headeing = [
        '/^###### (.*)/m' => '<h6>$1</h6>',
        '/^##### (.*)/m' => '<h5>$1</h5>',
        '/^#### (.*)/m' => '<h4>$1</h4>',
        '/^### (.*)/m' => '<h3>$1</h3>',
        '/^## (.*)/m' => '<h2>$1</h2>',
        '/^# (.*)/m' => '<h1>$1</h1>',
    ];
    // convert text to bold or link in html
    private static $etc = [
        '/\*(.*?)\*/' => '<b>$1</b>',
        '/\[(.*?)\]\((.*?)\)/' => '<a href="$2">$1</a>',
    ];
    // Create new text
    public static function convertToHtml(string $string) :string
    {
        $string = preg_replace(array_keys(self::$headeing),array_values(self::$headeing),nl2br($string));
        $res = '';
        foreach (explode(PHP_EOL,$string) as $key => $value) {
            if (!empty($value) and !preg_match('/^<h/',$value)) {
                $res .= "<p class='markdown'>{$value}</p>";
            } else {
                $res .= $value;
            }
        }
        $string = preg_replace(array_keys(self::$etc),array_values(self::$etc),$res);
        return $string;
    }
}
