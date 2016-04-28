<?
$uri = explode('/', $_SERVER['REQUEST_URI']);
$type = $uri[2];
if (!$type)
    $type = "plain";
?><!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" type="text/css" media="all" href="static/css/main.css">
        <link rel="stylesheet" type="text/css" media="all" href="static/css/animations.css"><?
        if($uri[2] == "fade-in" || $uri[2] == "fade-in-out")
        {
        ?><link rel="stylesheet" type="text/css" media="all" href="static/css/fade-in.css"><?
        }
        if($uri[2] == "fade-in-out")
        {
        ?><link rel="stylesheet" type="text/css" media="all" href="static/css/fade-in-out.css"><?
        }
    ?></head>
    <body>
