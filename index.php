<?php

$request_uri = explode('?', $_SERVER['REQUEST_URI'], 2);

switch ($request_uri[0]) {
    case '/':
        if (file_exists("index.html")) { echo file_get_contents("index.html"); }
        else { header('HTTP/1.0 400 Bad Request'); echo file_get_contents("404.html"); }
        break;
    case '/newsletter':
        include_once 'newsletter.php';
        break;
    case '/cliente':
        include_once 'cliente.php';
        break;

    default:
        if (file_exists("$request_uri[0].html")) { echo file_get_contents("$request_uri[0].html"); }
        else { header('HTTP/1.0 404 Not Found'); echo file_get_contents("404.html");}
        break;
}