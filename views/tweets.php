<?
require_once("views/tweets-ajax.php");
require_once("views/clock.php");
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
    var animation_style = "random";
    
    // TODO: make this an array
    var info = {}
    info["plain"] = {
        "delay": 50,
        "class_func": function() {},
        "animate_func": function() {}
    }
    info["in_order"] = {
        "delay": 100,
        "class_func": in_order_classes,
        "animate_func": in_order_animate
    }
    info["alphabetical"] = {
        "delay": 200,
        "class_func": alphabetical_classes,
        "animate_func": alphabetical_animate
    }
    info["random"] = {
        "delay": 10,
        "class_func": random_classes,
        "animate_func": random_animate
    }
    init_animation(info[animation_style]);
</script>
