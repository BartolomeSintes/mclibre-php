<?php
/**
 * Sucesiones aritméticas - for-1-1.php
 *
 * @author    Bartolomé Sintes Marco <bartolome.sintes+mclibre@gmail.com>
 * @copyright 2014 Bartolomé Sintes Marco
 * @license   http://www.gnu.org/licenses/agpl.txt AGPL 3 or later
 * @version   2014-10-07
 * @link      http://www.mclibre.org
 *
 *  This program is free software: you can redistribute it and/or modify
 *  it under the terms of the GNU Affero General Public License as published by
 *  the Free Software Foundation, either version 3 of the License, or
 *  any later version.
 *
 *  This program is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU Affero General Public License for more details.
 *
 *  You should have received a copy of the GNU Affero General Public License
 *  along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */

print "<?xml version=\"1.0\" encoding=\"utf-8\"?>\n";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
       "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>Sucesión aritmética 1. for (1).
  Ejercicios. PHP. Bartolomé Sintes Marco</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link href="mclibre-php-soluciones.css" rel="stylesheet" type="text/css"
  title="Color" />
</head>
<body>

<h1>Sucesión aritmética 1</h1>

<p>Este programa escribe la misma sucesión tres veces, cada vez con
un <strong>bucle for</strong> distinto:</p>

<?php

print "<pre>\n";
print "<strong>for (\$i = 1; ... ; \$i++) :</strong>";
for ($i = 1; $i <= 10; $i++) {
    printf("%6d", $i + 1);
}
print "\n";
print "\n";
print "<strong>for (\$i = 0; ... ; \$i++) :</strong>";
for ($i = 0; $i < 10; $i++) {
    printf("%6d", $i + 2);
}
print "\n";
print "\n";
print "<strong>print \"\$i\"; :             </strong>";
for ($i = 2; $i <= 11; $i++) {
    printf("%6d", $i);
}
print "\n";
print "</pre>\n";


print "<pre>\n";
print "<strong>for (\$i = 1; ... ; \$i++) :</strong>";
for ($i = 1; $i <= 9; $i++) {
    printf("%6d", 2 * $i);
}
print "\n";
print "\n";
print "<strong>for (\$i = 0; ... ; \$i++) :</strong>";
for ($i = 0; $i < 9; $i++) {
    printf("%6d", 2 * $i + 2);
}
print "\n";
print "\n";
print "<strong>print \"\$i\"; :             </strong>";
for ($i = 2; $i <= 18; $i = $i + 2) {
    printf("%6d", $i);
}
print "\n";
print "</pre>\n";


print "<pre>\n";
print "<strong>for (\$i = 1; ... ; \$i++) :</strong>";
for ($i = 1; $i <= 10; $i++) {
    printf("%6d", 3 * $i + 2);
}
print "\n";
print "\n";
print "<strong>for (\$i = 0; ... ; \$i++) :</strong>";
for ($i = 0; $i < 10; $i++) {
    printf("%6d", 3 * $i + 5);
}
print "\n";
print "\n";
print "<strong>print \"\$i\"; :             </strong>";
for ($i = 5; $i <= 32; $i = $i + 3) {
    printf("%6d", $i);
}
print "\n";
print "</pre>\n";


print "<pre>\n";
print "<strong>for (\$i = 1; ... ; \$i++) :</strong>";
for ($i = 1; $i <= 6; $i++) {
    printf("%6d", 5 * $i - 5);
}
print "\n";
print "\n";
print "<strong>for (\$i = 0; ... ; \$i++) :</strong>";
for ($i = 0; $i < 6; $i++) {
    printf("%6d", 5 * $i);
}
print "\n";
print "\n";
print "<strong>print \"\$i\"; :             </strong>";
for ($i = 0; $i <= 25; $i = $i + 5) {
    printf("%6d", $i);
}
print "\n";
print "</pre>\n";


print "<pre>\n";
print "<strong>for (\$i = 1; ... ; \$i++) :</strong>";
for ($i = 1; $i <= 10; $i++) {
    printf("%6d", 10 - 2 * $i);
}
print "\n";
print "\n";
print "<strong>for (\$i = 0; ... ; \$i++) :</strong>";
for ($i = 0; $i < 10; $i++) {
    printf("%6d", - 2 * $i + 8);
}
print "\n";
print "\n";
print "<strong>print \"\$i\"; :             </strong>";
for ($i = 8; $i >= -10; $i = $i - 2) {
    printf("%6d", $i);
}
print "\n";
print "</pre>\n";


print "<pre>\n";
print "<strong>for (\$i = 1; ... ; \$i++) :</strong>";
for ($i = 1; $i <= 7; $i++) {
    printf("%6d", 45 - 5 * $i);
}
print "\n";
print "\n";
print "<strong>for (\$i = 0; ... ; \$i++) :</strong>";
for ($i = 0; $i < 7; $i++) {
    printf("%6d", - 5 * $i + 40);
}
print "\n";
print "\n";
print "<strong>print \"\$i\"; :             </strong>";
for ($i = 40; $i >= 10; $i = $i - 5) {
    printf("%6d", $i);
}
print "\n";
print "</pre>\n";


print "<pre>\n";
print "<strong>for (\$i = 1; ... ; \$i++) :</strong>";
for ($i = 1; $i <= 8; $i++) {
    printf("%6d", -1 - 6 * $i);
}
print "\n";
print "\n";
print "<strong>for (\$i = 0; ... ; \$i++) :</strong>";
for ($i = 0; $i < 8; $i++) {
    printf("%6d", - 6 * $i - 7);
}
print "\n";
print "\n";
print "<strong>print \"\$i\"; :             </strong>";
for ($i = -7; $i >= -49; $i = $i - 6) {
    printf("%6d", $i);
}
print "\n";
print "</pre>\n";

?>

<p class="ultmod">Última modificación de esta página: 7 de octubre de 2014</p>

<p class="licencia">
Este programa forma parte del curso <a href="http://www.mclibre.org/consultar/php/">
<cite>Programación web en PHP</cite></a> por <cite>Bartolomé Sintes Marco</cite>.<br />
El programa PHP que genera esta página está bajo
<a rel="license" href="http://www.gnu.org/licenses/agpl.txt">licencia AGPL 3 o
posterior</a></p>
</body>
</html>
