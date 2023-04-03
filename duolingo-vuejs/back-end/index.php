<?php
$folder =  isset($_REQUEST['folder'])? $_REQUEST['folder']: '';
switch ($folder) {
    case "courses":
        require 'courses/get-courses.php';
        break;
    case "question":
        require "questions/index.php";
        break;
    case "lessons":
        require "lessons/get-lessons.php";
        break;
    default:
        require 'courses/get-courses.php';
  }

//   http://localhost/www/VueJS/duolingo-vuejs/back-end/?folder=courses