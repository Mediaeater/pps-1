<?
require_once("lib/pps_tweeter.php");
$date_fmt = "l, d F Y";
$time_fmt = "H.i.s";

$stream_id = "custom-723521388947116032";
$tweeter = new pps_tweeter();
$data = $tweeter->get_tweets($stream_id);
$tweets = $data->objects->tweets;
$users = $data->objects->users;

$tco_pattern = '/https:\/\/t\.co\/.*/';
$apos_pattern = "/(\w+)'(\w+)/";

?><section id="tweets"><?
    $show = true;
    foreach($tweets as $t)
    {
        $text = $t->text;
        // remove t.co links
        $text = preg_replace($tco_pattern, '', $text);
        // replace dumb apostrophes with smart ones
        $text = preg_replace($apos_pattern, "$1’$2", $text);
        
        $dt = $t->created_at;
        $dt = strtotime($dt);
        $date = date($date_fmt, $dt);
        $time = date($time_fmt, $dt);
        $ts = $date." at ".$time;
        
        $media = $t->entities->media[0];
        
        if($show)
        {
        ?><figure class="animated fadeIn tweet"><?
        }
        else
        {
        ?><figure class="animated fadeIn tweet hidden"><?
        }
            ?><div class="text"><? 
                echo $text; 
            ?></div><?
            ?><div class="time"><?
                echo $ts;
            ?></div>
        </figure><?
        
        if($media)
        {
        ?><figure class="animated fadeIn tweet hidden">
            <div class="media">
                <img src="<? echo $media->media_url; ?>">
            </div>
        </figure>
        <?
        }
        $show = false;
    }
?></section>
<script type="text/javascript" src="static/js/tweets.js"></script>
<script type="text/javascript">
    var tweets = document.getElementsByClassName("tweet");
    var index = 0;
    var tweet_duration = 6000;
    var tweet_interval;

    tweet_interval = setInterval(show_next_tweet, tweet_duration);
</script>