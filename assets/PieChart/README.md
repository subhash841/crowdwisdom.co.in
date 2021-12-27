# jquery-d3-donut-pie
Donut Pie plugin

Easly create d3 pie charts with d3.js/jquery 


init the pie
```javascript
$(".exp").donutpie();
```
update it with some data
```javascript
var data = [
             {"name" : "JavaScript", "hvalue" : 20 },
             {"name" : "d3", "hvalue" : 2},
             {"name" : "jQuery", "hvalue" : 25},
             // assign a color if you'd like to or one would be set for you.
             {"name" : "SVG", "hvalue" : 5, "color": "#00ff00" } 
        ];
        
$(".exp").donutpie('update', data);
```
Options
```javascript
$(".exp").donutpie({
  tooltip: false, // or true
  tooltipClass : "my-tooltip-class", // set a custom class for the tooltip
  radius : 400 //the donut radius size
});
```
custom tooltip class
```css
.donut-pie-tooltip-bubble {
        background-color: #ffffff;
        color           : #06346e;
        font-size       : 11px;
        padding         : 6px 12px 6px 12px;
        border-radius   : 2px 2px 2px 2px;
        box-shadow      : 1px 1px 1px 1px rgba(25, 25, 25, 0.15);
        text-align      : left;
        max-width       : 240px;
        font-family     : "Helvetica Neue", Helvetica, Arial, sans-serif;
      } 
```

demo: https://jsfiddle.net/yeac375b/9/
