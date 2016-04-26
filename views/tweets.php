<?
require_once("views/tweets-ajax.php");
?>
<script type="text/javascript" src="static/js/animateMessage.js"></script>
<script type="text/javascript" src="static/js/tweets.js"></script>
<script type="text/javascript" src="static/js/tweets-ajax.js"></script>
<script type="text/javascript">
    var tweets = document.getElementsByClassName("tweet");
    var index = 0;
    var tweet_duration = 12000;
    var tweet_interval;
    var ajax_duration = 1000;
    var ajax_interval;
    
    var max = "<? echo $max; ?>";
    console.log(max);
    
    // show first tweet
    var ticker_delay = 50;
    var tweet = tweets[0];
    show(tweet);
    add_spans(tweet);
    ti = 0;
    display_spans_in_order(tweet);
    
    /*
    ajax_interval = setInterval(function() {
        get_tweets(max);
    }, ajax_duration);
    */
    tweet_interval = setInterval(show_next_tweet_a, tweet_duration);
</script>
