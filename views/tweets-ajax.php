<?
date_default_timezone_set("America/New_York");
require_once(__DIR__."/../lib/pps_tweeter.php");

define("DATE_FMT", "Y");
define("TIME_FMT", "H:i");

$stream_id = "custom-723521388947116032";

$q_arr = array();
$q_arr[] = '"police drawing"';
$q_arr[] = '"police sketch"';
$q_arr[] = '"help identify"';
$q_arr[] = '"looking to identify"';
$q_arr[] = '"identify this person"';
$q_arr[] = '"help identify this person"';

$tweeter = new pps_tweeter();
$data = $tweeter->search_tweets($q_arr);
$tweets = $data->statuses;

$tco_pattern = '/https?:\/\/t\.co\/.*/';
$apos_pattern = "/(\w+)'(\w+)/";
$rquot_pattern = '/(?<=[\w,.?!…\)]|^)"/';
$lquot_pattern = '/"(?=\w|$)/';

?><section id="tweets"><?
foreach($tweets as $t)
{
    // $t = $tweets->{$l->tweet->id};
    
    $text = $t->text;
    // remove t.co links
    // exchange them for real links. . . ?
    $text = preg_replace($tco_pattern, '', $text);
    
    // replace dumb apostrophes with smart ones
    $text = preg_replace($apos_pattern, "$1’$2", $text);
    
    // TODO: replace dumb double quotes
    
    $dt = $t->created_at;
    $dt = strtotime($dt);
    $date = date(DATE_FMT, $dt);
    $time = date(TIME_FMT, $dt);
    $ts = $time;
    
    $handle = $t->user->screen_name;
    
    ?><figure class="animated tweet fadeIn hidden"><?
        ?><div class="text"><? echo $text; ?></div>
        <div class="metadata">
            <span class="user-handle"><? echo $handle; ?></span>
            <span class="time"><? echo $ts; ?></span>
        </div>
    </figure><?
    $i = 0;
    while($media = $t->entities->media[$i++])
    {
    ?><figure class="animated tweet fadeIn hidden">
        <div class="media">
            <img src="<? echo $media->media_url; ?>"/>
        </div>
        <div class="metadata">
            <span class="user-handle"><? echo $handle; ?></span>
            <span class="time"><? echo $ts; ?></span>
        </div>
    </figure><?
    }
}
?></section>