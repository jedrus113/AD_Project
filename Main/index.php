<?php

/*
 *
 * "The main script.
 *
 *   WELCOME. :)" - Andrzej Dąbski
 *
 */


/*
 * Very importat begining.
 *   Remember to define AD_ROOT.
 */
  define('AD_ROOT', '/var/www/AD_Project/');

  function load_class($class_name){
    include_once AD_ROOT . 'Class/' . $class_name . '.php';
  }
  function load_page($page_name){
	  include_once AD_ROOT . 'Temples/' . $page_name . '.php';
  }
  function load_config($config_name) {
    include_once AD_ROOT . 'Configs/' . $config_name . '.conf.php';
  }

  load_class('Authorization');
  Authorization::get_instance();
  load_page('index');

?>
