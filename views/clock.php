<script type="text/javascript" src="<? echo $host; ?>static/js/clock.js"></script>
<?
if ($big_clock)
{
?><div id="clock-container-big">
    <canvas id="clock-canvas"></canvas>
</div>
<script>
    var canvas_id, size, colours;
    canvas_id = "clock-canvas";
    size = "large";
    colours = {};
    colours.bg = 'rgba(255, 255, 255, 0.0)';
    colours.h = '#FF5722';
    colours.m = '#FF5722';
    colours.s = '#FF5722';
    colours.circle = '#FF5722';
    colours.circleopen = '#FF5722';
        
    init_clock(canvas_id);
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
    var canvas_id, size, colours;
    canvas_id = "clock-canvas";
    size = "small";
    colours = {};
    colours.bg = 'rgba(255, 255, 255, 0.0)';
    colours.h = '#FFF';
    colours.m = '#FFF';
    colours.s = '#FFF';
    colours.circle = '#FFF';
    colours.circleopen = '#FFF';

    init_clock(canvas_id);
</script><?
}