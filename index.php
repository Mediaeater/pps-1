<?
date_default_timezone_set("America/New_York");
$u = explode("/", rtrim($_SERVER['REQUEST_URI'], "/"));

$big_clock = false;

require_once("views/head.php");
if ($uu->id)
{
    require_once("views/clock.php");
    if (!$big_clock)
    {
        require_once("views/title.php");
        require_once("views/tweets.php");
    }
    require_once("views/bird.php");
}
else
{
    require_once("views/menu.php");
}
require_once("views/foot.php");
?>
