<?
require_once("views/tweets-ajax.php");
require_once("views/clock.php");
?>
<script type="text/javascript" src="static/js/tweets.js"></script>
<script type="text/javascript" src="static/js/tweets-ajax.js"></script>
<script type="text/javascript">
    var tweets = document.getElementsByClassName("tweet");
    var index = 0;
    var tweet_duration = 15000;
    var tweet_interval;
    var ajax_duration = 1000;
    var ajax_interval;

    // $type is defined in head.php
    var animation_style = "<? echo $type; ?>"; 
    
    // TODO: make this an array
    var info = {}
    info["plain"] = {
        delay: 50,
        use_spans: false,
        class_func: undefined,
        animate_func: undefined
    }
    info["fade-in-out"] = {
        delay: 50,
        use_spans: false,
        class_func: undefined,
        animate_func: undefined
    }
    info["in-order"] = {
        delay: 75,
        use_spans: true,
        class_func: in_order_classes,
        animate_func: in_order_animate
    }
    info["alphabetical"] = {
        delay: 200,
        use_spans: true,
        class_func: alphabetical_classes,
        animate_func: alphabetical_animate
    }
    info["random"] = {
        delay: 10,
        use_spans: true,
        class_func: random_classes,
        animate_func: random_animate
    }
    init_animation(info[animation_style]);
</script>
