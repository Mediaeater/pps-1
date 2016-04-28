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

function show_next_tweet_a(info)
{
    hide(tweets[index++]);   
    // reset to the first tweet
    if (index == tweets.length)
        index = 0;
    show(tweets[index]);
    
    if (info.use_spans)
        show_tweet(index, info);
}

function show_tweet(index, info)
{
    var tweet, text;
    tweet = tweets[index];
    
    text = tweet.getElementsByClassName("text")[0];
    add_spans(text, info.class_func);
    ti = 0;
    info.animate_func(text, info.delay);
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
            show_next_tweet_a(info[animation_style]);
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

function init_animation(info)
{
    show(tweets[index]);
    if (info.use_spans)
        show_tweet(index, info);
    
    tweet_interval = setInterval(function() {
        show_next_tweet_a(info)
    }, tweet_duration);
}

function add_spans(el, class_func)
{
    var cns;
    
    // check inputs
    if (el === undefined)
        return;
    
    cns = el.childNodes;
    
    // base case
    // TODO: make sure this isn't a "SCRIPT" tag
    // (or style tag or. . . )
    if (cns.length == 1 && cns[0].nodeType == 3)
    {
        var text = el.textContent;
        
        // i suppose this while loop is unnecessary
        // as we know that el only has one child? 
        while (el.firstChild)
            el.removeChild(el.firstChild);
        
        text = split_by_symbol(text);
        for (var i = 0; i < text.length; i++)
        {
            var s = document.createElement("span");
            s.innerHTML = text[i];
            class_func(s);
            el.appendChild(s);
        }
    }
    else
    {
        for (var i = 0; i < cns.length; i++)
        {
            if(cns[i].nodeType == 1 && cns[i].tagName != "SCRIPT")
                add_spans(cns[i], class_func);
        }
    }
}

// javascript + unicode = sadness
// https://mathiasbynens.be/notes/javascript-unicode
// this function takes a string and returns an array of unicode symbols
function split_by_symbol(string)
{
    var index = 0;
	var length = string.length;
	var output = [];
	for (; index < length - 1; ++index) {
		var charCode = string.charCodeAt(index);
		if (charCode >= 0xD800 && charCode <= 0xDBFF) {
			charCode = string.charCodeAt(index + 1);
			if (charCode >= 0xDC00 && charCode <= 0xDFFF) {
				output.push(string.slice(index, index + 2));
				++index;
				continue;
			}
		}
		output.push(string.charAt(index));
	}
	output.push(string.charAt(index));
	return output;    
}


function remove_spans(el)
{

}

function random_classes(s)
{
    s.classList.add("invisible");
}

function random_animate(el, delay)
{
    var random_index, els;
    
    // check inputs
    if (el === undefined)
        return; 
    if (delay === undefined)
        delay = 50;

    els = el.getElementsByClassName("invisible");
    random_index = Math.floor(Math.random() * els.length);
    setTimeout(function() {
        if (els[random_index] !== undefined)
        {
            els[random_index].classList.remove("invisible");
            if (els.length > 0)
                random_animate(el, delay);
        }
    }, delay); 
}

function shuffle(array)
{
    var current_index = array.length;
    var temp, random_index;
    
    while (0 !== current_index)
    {
        // pick a remaining element. . . 
        random_index = Math.floor(Math.random() * current_index);
        current_index--;
        
        // . . . and swap it with the current element.
        temp = array[current_index];
        array[current_index] = array[random_index];
        array[random_index] = temp;
    }
    
    return array;
}
function in_order_classes(s)
{
    s.classList.add("hidden");
}

function in_order_animate(el, delay)
{
    if (delay === undefined)
        delay = 50;
    var els = el.getElementsByClassName("hidden");
    setTimeout(function() {
        if (els[0] !== undefined)
        {
            els[0].classList.remove("hidden");
            if(els.length > 0)
                in_order_animate(el, delay);
        }
    }, delay);
}

function alphabetical_classes(s)
{
    c = s.textContent.toLowerCase();
    if (LETTERS.indexOf(c) >= 0)
        s.classList.add(c);
    else
        s.classList.add("punct");
    s.classList.add("invisible");
}

var ti = 0;

function alphabetical_animate(el, delay)
{
    if (delay === undefined)
        delay = 50;
    var els;
    
    setTimeout(function() {
        if (ti < LETTERS.length)
            els = el.getElementsByClassName(LETTERS[ti++]);
        else {
            els = el.getElementsByClassName("punct");
            ti++;
        }
        show_invisibles(els);
        if (ti <= LETTERS.length)
            alphabetical_animate(el, delay);
    }, delay);
}

function show_invisibles(elements)
{
    for (var i = 0; i < elements.length; i++)
    {
        elements[i].classList.add("animated", "fadeIn");
        elements[i].classList.remove("invisible");
    }
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