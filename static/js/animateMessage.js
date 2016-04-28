
// 	animateMessage.js
//
// 	adapted from animatePunctuation.js
//
//   	source : {id}
//   	display : {id}
//		animate : {true, false}	
//		delay : ## [50]

// 	globals	
var timeout;
var pointer;
const LETTERS = "abcdefghijklmnopqrstuvwxyz";

function initMessage(sourceId, displayId, animate, delay) 
{
    var source = document.getElementById(sourceId); 
    var display = document.getElementById(displayId);
    var message = buildMessage(source);
    pointer = 0;                      

    if (animate) 
    {
        clearTimeout(timeout);
        timeout = null;
        if (delay === null)
            delay = 50;
        animateMessage(source, display, message, delay);
    } 
    else 
    {
        display.appendChild(message);
    }
    // hideShowMessage('displayWrapper','displayControl','show');
}


function buildMessage(root) 
{
    var next;
    var node = root.firstChild;
    var message = document.createDocumentFragment();

    do 
    {      
        next = node.nextSibling;

        if (node.nodeType === 1) 
        {
            message.appendChild(node.cloneNode(true));
        } 
        else if (node.nodeType === 3) 
        {
            var text = node.textContent;
            for (i = 0; i < text.length; i++) 
            {
                var temp = document.createElement("span");
                temp.textContent = text[i];
                message.appendChild(temp);
            }
        }
    } 
    while (node = next);
    return message;
}

function animateMessage(source,display,message,delay)
{
    if (pointer < message.childNodes.length)
    {
        display.appendChild(message.childNodes[pointer].cloneNode(true));
        pointer++;
        timeout = setTimeout(function(){
            animateMessage(source, display, message, delay);
        }, delay);
    } 
    else 
    {
        console.log("stop");
        startStopAnimateMessage();
    }
}

function startStopAnimateMessage()
{
    if (timeout == null)
    {            
        initMessage("animateMessage","target",true,delay);			
        return true;
    } 
    else 
    {
        clearTimeout(timeout);
        timeout = null;
        return false;
    }
}


function hideShowMessage(displayId,controlId,forceAction)
{
    var display = document.getElementById(displayId);
    var control = document.getElementById(controlId);

    if ((display.style.overflow != "hidden") || forceAction == "hide") 
    {
        display.style.overflow = "hidden";
        display.style.height = "20px";
        control.textContent = "+";
    } 
    else if ((display.style.overflow == "hidden") || forceAction == "show") 
    {
        display.style.overflow = "auto";
        display.style.height = "auto";
        control.textContent = "×";
    }
}


function setCookie(name)
{
    if (getCookie(name) == "") 
    {
        document.cookie=name+"=true";
        return true;
    } 
    else
        return false;
}


function expireCookie(name) 
{
    if (getCookie(name) != "") 
    {
        document.cookie = name+"=; expires=Thu, 01 Jan 1970 00:00:00 GMT";
        return true;
    } 
    else
        return false;
}


function getCookie(name)
{
    var cname = name + "=";
    var ca = document.cookie.split(';');

    for(var i = 0; i < ca.length; i++) 
    {
        var c = ca[i];
        while (c.charAt(0)==' ') c = c.substring(1);
        if (c.indexOf(cname) != -1) return c.substring(cname.length,c.length);
    }
    
    return "";
}


function checkCookie(name)
{
    if (getCookie(name) != "")
        return true;
    else
        return false;
}

/* 
*/

function init_animation(info)
{
    var tweet = tweets[index];
    var text = tweet.getElementsByClassName("text")[0];
    show(tweet);
    
    add_spans(text, info.class_func);
    ti = 0;
    info.animate_func(text, info.delay);
    
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
