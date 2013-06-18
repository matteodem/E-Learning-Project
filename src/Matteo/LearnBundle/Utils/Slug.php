<?php

namespace Matteo\LearnBundle\Utils;

class Slug
{
    static public function slugify($text)
    {

        // replace ' and " with nothing
        $text = preg_replace('/(\')/', '', $text);
        $text = preg_replace('/(")/', '', $text);
        $toReplace = array("/ä/","/ö/","/ü/","/Ä/","/Ö/","/Ü/","/ß/");
        $replaceWith = array("ae","oe","ue","Ae","Oe","Ue","ss");
        
        // replace all 'Umlaute'
        $text = preg_replace($toReplace, $replaceWith, $text);

        // replace all non letters or digits by -
        $text = preg_replace('/\W+/', '-', $text);

        // trim and lowercase
        $text = strtolower(trim($text, '-'));


        return $text;
    }

    static public function isSlug($text)
    {
        preg_match('/[a-z\-]+/', $text, $matches);

        if (!empty($matches)) {
            return $matches[0] === $text;
        } else {
            return false;
        }
    }
}