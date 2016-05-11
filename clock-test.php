<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <script src="static/js/clock.js"></script>
        <script src="static/js/tweets.js"></script>
        <style type="text/css">
            html, body {
                background: #444444;
            }
            body {
                margin: 0px;
            }
        </style>
    </head>
    <body>
        <div id="clock-container">
            <canvas id="clock"></canvas>
        </div>
        <script>
            var canvas_id, size, colours;
            canvas_id = "clock";
            size = "large";
            colours = {};
            colours.bg = 'rgba(255, 255, 255, 0.0)';
            colours.h = '#FF5722';
            colours.m = '#FF5722';
            colours.s = '#FF5722';
            colours.circle = '#FF5722';
            colours.circleopen = '#FF5722';

            init_clock(canvas_id);
        </script>
    </body>
</html>