<?php
header("Content-type: image/svg+xml");
$color = rand(0, 360);
print "<svg version=\"1.1\" xmlns=\"http://www.w3.org/2000/svg\" \n"
    . "    width=\"100\" height=\"100\" viewBox=\"-5 -5 100 100\">\n";
print "  <rect fill=\"hsl($color, 100%, 70%)\" stroke=\"hsl($color, 100%, 30%)\" stroke-width=\"4\" "
    . "x=\"0\" y=\"0\" width=\"90\" height=\"90\" />\n";
print "</svg>";
?>
