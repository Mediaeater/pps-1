<?
require_once("lib/pps_tweeter.php");
$date_fmt = "l, d F Y";
$time_fmt = "H.i.s";

$stream_id = "custom-723521388947116032";
$tweeter = new pps_tweeter();
$data = $tweeter->get_tweets($stream_id);
$tweets = $data->objects->tweets;
$users = $data->objects->users;

?><section id="tweets"><?
    $show = true;
    foreach($tweets as $t)
    {
        $text = $t->text;
        $dt = $t->created_at;
        $dt = strtotime($dt);
        $date = date($date_fmt, $dt);
        $time = date($time_fmt, $dt);
        $ts = $date." at ".$time;
        $media = $t->entities->media[0];
        if($show)
        {
        ?><figure class="tweet"><?
        }
        else
        {
        ?><figure class="tweet hidden"><?
        }
            ?><div class="text"><? 
                echo $text; 
            ?></div><?
            ?><div class="time"><?
                echo $ts;
            ?></div>
        </figure><?
        $show = false;
    }
?></section>
<script type="text/javascript" src="static/js/tweets.js"></script>
<script type="text/javascript">
    var tweets = document.getElementsByClassName("tweet");
    var index = 0;
    
    var x;
    x = setInterval(show_next_tweet, 20000);
</script>