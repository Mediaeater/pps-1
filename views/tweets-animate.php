<?
require_once("lib/pps_tweeter.php");
$date_fmt = "Ymd";
$time_fmt = "H:i:s";

$stream_id = "custom-723521388947116032";
$stream_id = "custom-721307714391920640";
$tweeter = new pps_tweeter();
$data = $tweeter->get_tweets($stream_id);
$tweets = $data->objects->tweets;
$users = $data->objects->users;

$tco_pattern = '/https:\/\/t\.co\/.*/';
$apos_pattern = "/(\w+)'(\w+)/";

?><section id="tweets"><?
    foreach($tweets as $t)
    {
        $text = $t->text;
        // remove t.co links
        $text = preg_replace($tco_pattern, '', $text);
        // replace dumb apostrophes with smart ones
        $text = preg_replace($apos_pattern, "$1’$2", $text);
        $author = $users->{$t->user->id}->screen_name;
        
        $dt = $t->created_at;
        $dt = strtotime($dt);
        $date = date($date_fmt, $dt);
        $time = date($time_fmt, $dt);
        $ts = "$time";
        
        $media = $t->entities->media;
        
        ?><figure class="animated fadeIn tweet hidden">
            <div class="text"><? 
                echo $text; 
            ?></div>
            <div class="time"><?
                echo $ts;
            ?></div>
        </figure><?
        
        if(isset($media))
        {
            foreacH($media as $m)
            {
        ?><figure class="animated fadeIn tweet hidden">
            <div class="media">
                <img src="<? echo $m->media_url; ?>">
            </div>
            <div class="time"><?
                echo $ts;
            ?></div>
        </figure>
        <?
            }
        }
    }
?>


<script type="text/javascript" src="static/js/tweets.js"></script>
<script type="text/javascript">
    var tweets = document.getElementsByClassName("tweet");
    var texts = document.getElementsByClassName("text");
    var index = 0;
    var tweet_duration = 10000;
    var tweet_interval;
    
    var animate = true;
    var ticker_delay = 50;
    var tweet = tweets[0];
    show(tweet);
    add_spans(tweet);
    ti = 0;
    display_spans_in_order(tweet);
    
    var tweet_display_div = document.getElementById("tweets-display");
    
    // initMessage("tweet-source", "tweets-display", animate, ticker_delay);
    tweet_interval = setInterval(show_next_tweet_a, tweet_duration);
</script>
