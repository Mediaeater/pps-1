<?
require_once("pps_tweeter.php");

$stream_id = "custom-723521388947116032";
$tweeter = new pps_tweeter();
$data = $tweeter->get_tweets($stream_id, 2, "383082362502448128");

file_put_contents('out.txt', print_r($data, true));
?>