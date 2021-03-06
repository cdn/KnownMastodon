<?php
/**
 * Intellectual Property of #Mastodon
 * 
 * @copyright (c) 2017, #Mastodon
 * @author V.A. (Victor) Angelier <victor@thecodingcompany.se>
 * @version 1.0
 * @license http://www.apache.org/licenses/GPL-compatibility.html GPL
 * 
 */
define('CLASS_DR', __DIR__);
set_include_path(get_include_path().PATH_SEPARATOR.CLASS_DR);
    
spl_autoload_register(function($name){
    //For namespaces we replace \ with / to correct the Path
    $filename = str_replace("\\", "/", $name);
     \Idno\Core\Idno::site()->logging()->log("Mastodon: autoload filename ".$filename);
    require_once "{$filename}.php";    
});