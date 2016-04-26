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
    
    // TODO: make this an array
    var animation_style = "in_order";
    // var animation_style = "alphabetical";
    var animation_delay = 50;
    
    var class_func = animation_style + "_classes";
    class_func = window[class_func];
    var animate_func = animation_style + "_animate";
    animate_func = window[animate_func];
      
    init_animation(animation_delay, class_func, animate_func);
    // show first tweet
    
    //
    /*
    var tweet = tweets[0];
    show(tweet);
    add_spans(tweet, alphabetical_classes);
    ti = 0;
    alphabetical_animate(tweet, animation_delay);
    */
    /*
    ajax_interval = setInterval(function() {
        get_tweets(max);
    }, ajax_duration);
    */
    /*
    tweet_interval = setInterval(show_next_tweet_a, tweet_duration);
    */
</script>
