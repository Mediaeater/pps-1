<?
// path to config file
$config = "open-records-generator/config/config.php";
require_once($config);

// specific to this 'app'
$config_dir = $root."config/";
require_once($config_dir."url.php");

$db = db_connect("guest");

$oo = new Objects();
$mm = new Media();
$ww = new Wires();
$uu = new URL();

// self
if($uu->id)
	$item = $oo->get($uu->id);
else
	$item = $oo->get(0);
$name = strip_tags($item["name1"]);

// document title
$item = $oo->get($uu->id);
$title = $item["name1"] ? $item["name1"] : "PPS";

$type = "fade-in-out";
if (!$type)
    $type = "plain";
?><!DOCTYPE html>
<html>
    <head>
        <title><? echo $title; ?></title>
        <meta charset="UTF-8">
        <link rel="stylesheet" type="text/css" media="all" href="static/css/main.css">
        <link rel="stylesheet" type="text/css" media="all" href="static/css/animations.css"><?
        if($type == "fade-in" || $type == "fade-in-out")
        {
        ?><link rel="stylesheet" type="text/css" media="all" href="static/css/fade-in.css"><?
        }
        if($type == "fade-in-out")
        {
        ?><link rel="stylesheet" type="text/css" media="all" href="static/css/fade-in-out.css"><?
        }
    ?></head>
    <body>
