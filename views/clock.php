<script type="text/javascript" src="<? echo $host; ?>static/js/clock.js"></script>
<?
if ($big_clock)
{
?><div id="clock-container-big">
    <canvas id="clock-canvas"></canvas>
</div>
<script>
    var canvas_id, size, hands, reverse;
    id = "clock-canvas";
    position = "centre";
    hands = true;
    reverse = true;
    
    init_clock(id, position, hands, reverse);
</script><?
}
else
{
?><div id="clock-container">
    <canvas id="clock-canvas"></canvas>
</div>
<audio id="pop">
    <source src="<? echo $host; ?>media/mp3/pop.mp3" type="audio/mpeg">
</audio>
<script>
    var id = "clock-canvas";
    var position = "lower-right";
    var hands = true;
    var reverse = false;
    
    init_clock(id, position, hands, reverse);
</script><?
}