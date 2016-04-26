function show_next_tweet()
{
    // is it bad to increment index here?
    // probs too easy to miss?
    hide(tweets[index++]);
    
    // reset to the first tweet
    if (index == tweets.length)
        index = 0;

    show(tweets[index]);
}

function show_next_tweet_a()
{
    hide(tweets[index++]);
    
    // reset to the first tweet
    if (index == tweets.length)
        index = 0;
    tweet = tweets[index];
    show(tweet);

    add_spans(tweet);
    ti = 0;
    display_spans_in_order(tweet);
}

function show_prev_tweet()
{
    // is it bad to increment index here?
    // probs too easy to miss?
    hide(tweets[index--]);
    
    // reset to the last tweet
    if (index == -1)
        index = tweets.length-1;

    show(tweets[index]);
}

function toggle_rotation()
{
    if(tweet_interval)
    {
        clearInterval(tweet_interval);
        tweet_interval = null;
    }
    else
    {
        show_next_tweet();
        tweet_interval = setInterval(show_next_tweet, tweet_duration);
    }
}

document.onkeydown = function(e) {
    e = e || window.event;
    switch(e.which || e.keyCode) {
        case 32: // spacebar
            toggle_rotation();
        break;
        case 37: // left
            show_prev_tweet();
        break;
        case 39: // right
            show_next_tweet_a();
        break;
        default: return; // exit this handler for other keys
    }
    e.preventDefault();
}

function hide(el)
{
    el.classList.add('fadeOut');
    el.classList.add('hidden');
}

function show(el)
{
    el.classList.remove('hidden');
}


var parseXml;

if (window.DOMParser) {
    parseXml = function(xmlStr) {
        return ( new window.DOMParser() ).parseFromString(xmlStr, "text/xml");
    };
} else if (typeof window.ActiveXObject != "undefined" && new window.ActiveXObject("Microsoft.XMLDOM")) {
    parseXml = function(xmlStr) {
        var xmlDoc = new window.ActiveXObject("Microsoft.XMLDOM");
        xmlDoc.async = "false";
        xmlDoc.loadXML(xmlStr);
        return xmlDoc;
    };
} else {
    parseXml = function() { return null; }
}