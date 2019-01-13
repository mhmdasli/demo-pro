<?php
/**
 * Created by PhpStorm.
 * User: mohmd
 * Date: 06/01/2019
 */

namespace App\traits;


Trait Theme
{
    /*
     * Theme create
     * receive theme name
     * loads pages from themes directory
     * return twig
     */
    public static function create($theme){
        //load theme from
        $loader = new \Twig_Loader_Filesystem(__DIR__ . '/../../themes' . $theme);
        $twig = new \Twig_Environment($loader, array(
            'debug' => true,
        ));
        // adds dump method to twigs
        $twig->addExtension(new \Twig_Extension_Debug());
        return $twig;
    }
}