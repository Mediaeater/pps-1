<?
date_default_timezone_set("America/New_York");
$big_clock = false;

require_once("views/head.php");
if (!$big_clock)
{
    require_once("views/title.php");
    require_once("views/tweets.php");
}
require_once("views/clock.php");
require_once("views/foot.php");
?>
