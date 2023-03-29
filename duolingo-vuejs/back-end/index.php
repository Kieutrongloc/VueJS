<?php
$folder =  isset($_REQUEST['folder'])? $_REQUEST['folder']: '';
switch ($folder) {
    case "courses":
        require 'courses/loc-get-courses.php';
        break;
    case "lessons":
        require "lessons/index.php";
        break;
    default:
        require 'courses/get-courses.php';
  }

//   http://localhost/www/VueJS/duolingo-vuejs/back-end/?folder=courses