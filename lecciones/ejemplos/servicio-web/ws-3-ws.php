<?php
/**
 * Número al azar (con servicio web) - ws-3-ws.php
 *
 * @author    Bartolomé Sintes Marco <bartolome.sintes+mclibre@gmail.com>
 * @copyright 2018 Bartolomé Sintes Marco
 * @license   http://www.gnu.org/licenses/agpl.txt AGPL 3 or later
 * @version   2018-12-05
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
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8" />
  <title>
    Número al azar (con servicio web).
    Servicios web.
    Ejemplos. Programación web en PHP. Bartolomé Sintes Marco. www.mclibre.org
  </title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
</head>

<body>
<?php
$minimo = 10;
$maximo = 20;
$cantidad = 5;

$consulta = http_build_query(["min" => $minimo, "max" => $maximo, "n" => $cantidad]);
$numeros = json_decode(file_get_contents("http://" . $_SERVER["HTTP_HOST"] . dirname($_SERVER["PHP_SELF"]) ."/ws-3-webservice.php?$consulta"));

foreach ($numeros as $valor) {
    print "  <p>Número al azar del $minimo al $maximo (con servicio web): <strong>$valor</strong></p>\n";
}
?>
</body>
</html>
