<?
date_default_timezone_set("America/New_York");
require_once(__DIR__."/../lib/pps_tweeter.php");

$max_old = $_GET["max"];

$date_fmt = "YMd";
$time_fmt = "H:i:s";

$stream_id = "custom-723521388947116032";
// $stream_id = "custom-721307714391920640";
$tweeter = new pps_tweeter();
$data = $tweeter->get_tweets($stream_id);

// file_put_contents('out.txt', print_r($data, true));

$timeline = array_reverse($data->response->timeline);

// echo "min: $min;";
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
    $text = preg_replace($tco_pattern, '', $text);
    /*
    foreach($t->entities->urls as $u)
    {
        // 
        // $text = str_replace($u->url, $u->display_url, $text);
    }
    
    if(isset($t->entities->media))
    {
        foreach($t->entities->media as $m)
            $text = str_replace($m->url, $m->display_url, $text);
    }
    */
    // exchange them for real links. . . ?
    // replace dumb apostrophes with smart ones
    $text = preg_replace($apos_pattern, "$1’$2", $text);
    // replace quotes
    // $text = preg_replace($lquot_pattern, "&#8220;", $text);
    // $text = preg_replace($rquot_pattern, "&#8221;", $text);
    
    $author = $users->{$t->user->id}->screen_name;
    
    $dt = $t->created_at;
    $dt = strtotime($dt);
    $date = date($date_fmt, $dt);
    $time = date($time_fmt, $dt);
    // $ts = "(@$author) $date at $time";
    $ts = $time;
    
    $media = $t->entities->media[0];
    
    ?><figure class="animated fadeIn tweet hidden"><?
        if($media)
        {
        ?><div class="media">
            <img src="<? echo $media->media_url; ?>"/>
        </div><?
        }
        ?><div class="text"><? 
            echo $text; 
        ?></div>
        <div class="time"><?
            echo $ts;
        ?></div>
    </figure><?
}
?></section>