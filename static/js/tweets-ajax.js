function get_tweets(max)
{
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() 
    {
        if(xhttp.readyState < 4)
        {
            // console.log("waiting");
        }
        else if (xhttp.readyState == 4 && xhttp.status == 200) {
            // console.log("done");
            var old_tweets = document.getElementById("tweets");
            var new_tweets = parseXml(xhttp.responseText).getElementById("tweets");
            old_n = old_tweets.getElementsByTagName("figure").length;
            new_n = new_tweets.getElementsByTagName("figure").length;
            console.log(old_n + " / " + new_n);
            if (old_n != new_n)
            {
                old_tweets.innerHTML = new_tweets.innerHTML;
                // index = 0;
                show(tweets[index]);
                console.log('new tweet!');
            }
        }
    };        
    var script = "views/tweets-ajax.php";
    if (max) {
        script += "?max=" + max;
    }
    console.log(max);
    xhttp.open("GET", script, true);
    xhttp.send();
}