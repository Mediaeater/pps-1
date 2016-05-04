var canvas_container;
var canvas;     // canvas
var context;    // canvas context
var width;      // canvas width
var height;     // canvas height
var r;          // clock radius

var center = new Array();   // center coordinates
var hands = new Array();    // hand info
var lineWidths = new Array(); 
var handTimer;

// colour info
var colours = 
{
    bg: 'rgba(255, 255, 255, 0.0)',
    h: '#fff',
    m: '#fff',
    s: '#fff',
    circle: '#fff',
    circleopen: '#fff'
};

var size = "small";
var reverse = true;
var now = new Date();

var fr = 100; // frame rate
var speed = 1; // seconds to display one hour

var time = 
{
    // this is kind of cheating, amiright?
    h: now.getHours() - 1,
    m: 59,
    s: 59,
    hs: now.getHours(),
    ms: 0,
    ss: 0,
    delta: - (3600 / (fr * speed))
}

// set size variables
function set_size(width, height)
{
    var min, line_width_factor;
    
    if (size == "small")
    {
        width = window.innerWidth * 0.2;
        height = width;
        line_width_factor = 2.0;
    }
    else
    {
        width = windo.innerWidth;
        height = window.innerHeight;
        line_width_factor = 1.0;
    }
    min = Math.min(width, height);
    r = min * 0.8;

    // set the hand lengths
    hands = 
    {
        h: r * 0.5,
        m: r * 0.8,
        s: r * 0.9
    };
    
    lineWidths = 
    {
        h: 0.015,
        m: 0.015,
        s: 0.007,
        circle: 0.015
    };
    
    Object.keys(lineWidths).forEach(function(key, index) {
        lineWidths[key] *= (min * line_width_factor);
    });
    
    // make the canvas not look horrible on retina screens
    canvas.width = width * 2;
    canvas.height = height * 2;
    canvas.style.width = width.toString().concat('px');
    canvas.style.height = height.toString().concat('px');
    
    // set the center x and y coordinates
    center = 
    {
        x: width,
        y: height
    };
}

// canvasId: id of canvas on page
// a_pos: either "centre" or "lower-right"
// show_hands: boolean to either show or hide hands initially
function init_clock(canvas_id, a_pos, show_hands, rev)
{
    reverse = rev;
    canvas = document.getElementById(canvas_id);
    canvas_container = canvas.parentElement;
    // context = canvas.getContext('2d');
    
    if(a_pos)
        pos = a_pos;
    
    if(show_hands)
    {
        // open_clock();
        // draw_clock();
    }
    else
    {
        draw_blank_clock();
    }
    window.onresize = function(event) 
    {
        // draw_blank_clock();   
        if(handTimer)
            draw_clock();
        else
            draw_blank_clock();
    };  
}

function set_time(canvasId, a_pos, d)
{
    draw_blank_clock();
    draw_hands(d);
}

function draw_blank_clock()
{
    set_size();
    fill_bg();
    draw_circle();
}

function draw_clock(d)
{
    draw_blank_clock();
    if (reverse)
    {
        if (time.m == 0 && time.s == 0)
        {
            clearInterval(handTimer);
        }
        else
        {
            decrement_date();
        }
        draw_hands(d);
    }
    else
    {
        draw_hands(d);
    }
}

function decrement_date()
{
    var h, m, s, d;
    h = time.h;
    m = time.m;
    s = time.s;

    s = (s + time.delta);
    if (s < 0)
    {
        if (time.m == 0)
            s = 0;
        else
        {
            m += Math.floor(s / 60);
            s += 60;
        }
    }
    if (m < 0)
    {
        h += Math.floor(m / 60);
        m += 60;
        m = 0;
    }
    if (h < 0)
    {
        h += 12;
    }
    time.h = h;
    time.m = m;
    time.s = s;
}

function strike_hour()
{
    var tweets, header, container;
    var id, position, hands, reverse, pop;
    
    window.clearInterval(handTimer);
    handTimer = false;
    
    time = 
    {
        // this is kind of cheating, amiright?
        h: now.getHours() - 1,
        m: 59,
        s: 59,
        hs: now.getHours(),
        ms: 0,
        ss: 0,
        delta: - (3600 / (fr * speed))
    }
       
    container = document.getElementById("clock-container");
    container.id = "clock-container-big";
    tweets = document.getElementById("tweets");
    header = document.getElementsByTagName("HEADER")[0];
    tweets.classList.add("hidden");
    header.classList.add("hidden");
    pop = document.getElementById("pop");
    
    // this loop needs to be a timeout function
    pop.play();
    
    
    id = "clock-canvas";
    position = "centre";
    hands = true;
    reverse = true;
    
    init_clock(id, position, hands, reverse);
}

function unstrike_hour()
{
    var tweets, header, container;
    container = document.getElementById("clock-container-big");
    container.id = "clock-container";
    tweets = document.getElementById("tweets");
    header = document.getElementsByTagName("HEADER")[0];
    tweets.classList.remove("hidden");
    header.classList.remove("hidden");
    

    
    id = "clock-canvas";
    position = "lower-right";
    hands = true;
    reverse = false;
    
    init_clock(id, position, hands, reverse);
}

function strike()
{
    strike_hour();
    setTimeout(unstrike_hour, speed * 1000 + 5000);
}

function set_strike()
{
    var now, mills;
    now = new Date();
    mills = new Date(now.getFullYear(), now.getMonth(), now.getDate(), now.getHours(), 0, 0, 0) - now;
    if (mills < 0)
        mills += 3600000;
    mills = 1000*30;
    setTimeout(first_strike, 1000*10); 
}

function first_strike()
{
    strike();
    setInterval(strike, 1000*60*60);
}

function open_clock()
{
    handTimer = 
        window.setInterval
        (
            function() 
            {
                draw_clock();
            }, 
            1000 / fr
        );
}

function close_clock()
{
    window.clearInterval(handTimer);
    handTimer = false;
    draw_blank_clock();
}

function fill_bg(fill_colour)
{
    context = canvas.getContext('2d');
    context.strokeStyle = colours.bg;
    context.fillStyle = colours.bg;
    context.fillRect(0, 0, center.x*2, center.y*2);
}

function draw_circle(colour)
{
    if (colour) 
        context.strokeStyle = colour;
    else
        context.strokeStyle = colours.circle;
    
    context.lineCap = 'round';
    context.lineWidth = lineWidths.circle;
    context.beginPath();
    context.arc(center.x, center.y, r, 0, 2*Math.PI);
    context.stroke();
}

function draw_hands(d)
{
    var h, m, s, rad, k, kk;
    
    if (d === undefined)
        d = new Date();
        
    h = d.getHours();
    m = d.getMinutes();
    s = d.getSeconds();
    
    rad = 
    {
        h: (((h % 12) + m / 60.0) / 6.0) * Math.PI - (Math.PI / 2.0),
        m: (m + s / 60.0) / 30.0 * Math.PI - (Math.PI / 2.0),
        s: s / 30.0 * Math.PI - (Math.PI / 2.0)
    };
    
    // smooth second hand (uses milliseconds)
//     var ms = d.getMilliseconds();  
//     rad.s = (s + ms / 1000.0) / 30.0 * Math.PI - (Math.PI / 2.0);
//     
    for(k in rad)
    {
        kk = k;
        if (!(reverse && kk == "s"))
        {
            context.beginPath();
            context.strokeStyle = colours[k];
            context.lineWidth = lineWidths[k];
            context.moveTo(center.x, center.y);
            context.lineTo( Math.cos(rad[k]) * hands[k] + center.x, 
                            Math.sin(rad[k]) * hands[k] + center.y);
            context.stroke();
        }
    }
}