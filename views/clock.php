<script type="text/javascript" src="<? echo $host; ?>static/js/clock.js"></script>
<?
if ($big_clock)
{
?><div id="clock-container-big">
    <canvas id="clock-canvas"></canvas>
</div>
<script>
    var id = "clock-canvas";
    var position = "centre";
    var hands = true;
    var reverse = true;
    
    init_clock(id, position, hands, reverse);
</script><?
}
else
{
?><div id="clock-container">
    <canvas id="clock-canvas"></canvas>
</div>
<script>
    var id = "clock-canvas";
    var position = "lower-right";
    var hands = true;
    var reverse = false;
    
    init_clock(id, position, hands, reverse);
</script><?
}