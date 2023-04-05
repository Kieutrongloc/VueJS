<?php
$folder =  isset($_REQUEST['folder'])? $_REQUEST['folder']: '';
switch ($folder) {
    case "sign-in":
        require 'sign-in/sign-in.php';
        break;
    case "courses":
        require 'courses/get-courses.php';
        break;
    case "units":
        require 'units/get-units.php';
        break;
    case "questions":
        require "questions/get-questions.php";
        break;
    case "answers":
        require "answers/get-answers.php";
        break;
    case "lessons":
        require "lessons/get-lessons.php";
        break;
    // default:
    //     require 'courses/get-courses.php';
  }

//   http://localhost/www/VueJS/duolingo-vuejs/back-end/?folder=courses