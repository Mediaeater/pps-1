<?
date_default_timezone_set("America/New_York");
require_once(__DIR__."/../lib/pps_tweeter.php");

define("DATE_FMT", "Y");
define("TIME_FMT", "H:i");

$q = $item["deck"];

$tweeter = new pps_tweeter();
$data = $tweeter->search_tweets($q);
// echo strlen(urlencode($q));
$tweets = $data->statuses;

$tco_pattern = '/https?:\/\/t\.c.*/';
$apos_pattern = "/(\w+)'(\w+)/";
$rquot_pattern = '/(?<=[\w,.?!…\)]|^)"/';
$lquot_pattern = '/"(?=\w|$)/';

$timestamps = array();

?><section id="tweets"><?
foreach($tweets as $t)
{
    // $t = $tweets->{$l->tweet->id};
    
    $text = $t->text;
    // remove t.co links
    // exchange them for real links. . . ?
    $text = preg_replace($tco_pattern, '', $text);
    
    // replace dumb apostrophes with smart ones
    $text = preg_replace($apos_pattern, "$1’$2", $text);
    
    // TODO: replace dumb double quotes
    
    $dt = $t->created_at;
    $dt = strtotime($dt);
    $date = date(DATE_FMT, $dt);
    $time = date(TIME_FMT, $dt);
    $ts = $time;
    
    $timestamps[] = $t->created_at;
    
    $handle = $t->user->screen_name;
    
    if ($item['url'] != 'computer-vision-exhibitionist')
    {
    ?><figure class="animated tweet fadeIn hidden"><?
        ?><div class="text"><? echo $text; ?></div>
        <div class="metadata">
            <span class="user-handle"><? echo $handle; ?></span>
            <!-- span class="time"><? echo $ts; ?></span -->
        </div>
    </figure><?
    }
    $i = 0;
    while($media = $t->entities->media[$i++])
    {
        $timestamps[] = $t->created_at;
    ?><figure class="animated tweet fadeIn hidden">
        <div class="media">
            <img src="<? echo $media->media_url; ?>"/>
        </div>
        <div class="metadata">
            <span class="user-handle"><? echo $handle; ?></span>
             <!-- span class="time"><? echo $ts; ?></span -->
        </div>
    </figure><?
    }
}
?></section>
<script>
    var dtstrings = <? echo json_encode($timestamps); ?>;
    var dts = [];
    for (var i = 0; i < dtstrings.length; i++) {
        dts.push(new Date(dtstrings[i]));
    }
</script>