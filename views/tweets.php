<?
require_once("views/tweets-ajax.php");
?>
<script type="text/javascript" src="static/js/tweets.js"></script>
<script type="text/javascript" src="static/js/tweets-ajax.js"></script>
<script type="text/javascript">
    var tweets = document.getElementsByClassName("tweet");
    var index = 0;
    tweets[index].classList.remove('hidden');
    var tweet_duration = 6000;
    var tweet_interva;
    var ajax_interval;
    var ajax_duration = 1000;
    var max = "<? echo $max; ?>";
    console.log(max);
    
    /*
    ajax_interval = setInterval(function() {
        get_tweets(max);
    }, ajax_duration);
    */
    tweet_interval = setInterval(show_next_tweet, tweet_duration);
</script>
