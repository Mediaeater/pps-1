<?
date_default_timezone_set("America/New_York");
require_once(__DIR__."/../lib/pps_tweeter.php");

define("DATE_FMT", "Y");
define("TIME_FMT", "H:i:s");

$stream_id = "custom-723521388947116032";
$stream_id = "custom-721307714391920640";
$tweeter = new pps_tweeter();
$data = $tweeter->get_tweets($stream_id);

$timeline = array_reverse($data->response->timeline);
$tweets = $data->objects->tweets;
$users = $data->objects->users;

$tco_pattern = '/https?:\/\/t\.co\/.*/';
$apos_pattern = "/(\w+)'(\w+)/";
$rquot_pattern = '/(?<=[\w,.?!…\)]|^)"/';
$lquot_pattern = '/"(?=\w|$)/';

?><section id="tweets"><?
foreach($timeline as $l)
{
    $t = $tweets->{$l->tweet->id};
    
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
    
    ?><figure class="tweet hidden"><?
        ?><div class="text"><? echo $text; ?></div>
        <div class="time"><? echo $t->created_at; ?></div>
    </figure><?
    $i = 0;
    while($media = $t->entities->media[$i++])
    {
    ?><figure class="tweet hidden">
        <div class="media">
            <img src="<? echo $media->media_url; ?>"/>
        </div>
        <div class="time"><? echo $t->created_at; ?></div>
    </figure><?
    }
}
?></section>