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

document.onkeydown = function(e) {
    e = e || window.event;
    switch(e.which || e.keyCode) {
        case 37: // left
            show_next_tweet();
        break;
        case 39: // right
            show_next_tweet();
        break;
        default: return; // exit this handler for other keys
    }
    e.preventDefault();
}

function hide(el)
{
    el.classList.add('hidden');
}

function show(el)
{
    el.classList.remove('hidden');
}