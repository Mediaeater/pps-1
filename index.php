<?
date_default_timezone_set("America/New_York");
$u = explode("/", rtrim($_SERVER['REQUEST_URI'], "/"));

$big_clock = false;

require_once("views/head.php");
require_once("views/clock.php");
if ($uu->id)
{
    if (!$big_clock)
    {
        require_once("views/title.php");
        require_once("views/tweets.php");
    }
    require_once("views/bird.php");
}
require_once("views/foot.php");
?>
