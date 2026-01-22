<?php
header("Content-type: text/css");
$color = rand(0, 360);
print "body {\n";
print "  background-color: hwb($color 85% 5%);\n";
print "  color: hwb($color 15% 55%);\n";
print "}\n";
