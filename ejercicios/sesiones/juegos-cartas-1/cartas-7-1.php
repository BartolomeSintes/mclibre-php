<?php
/**
 * Cambio de cartas (1) - cartas-7-1.php
 *
 * @author    Bartolomé Sintes Marco <bartolome.sintes+mclibre@gmail.com>
 * @copyright 2021 Bartolomé Sintes Marco
 * @license   http://www.gnu.org/licenses/agpl.txt AGPL 3 or later
 * @version   2021-12-02
 * @link      https://www.mclibre.org
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
// Se accede a la sesión
session_name("cartas-7");
session_start();

if (!isset($_SESSION["baraja"])) {
    $_SESSION["baraja"] = [];
    foreach (["p", "c", "d", "t"] as $palo) {
        for ($i = 1; $i <= 10; $i++) {
            $_SESSION["baraja"][] = "$palo$i";
        }
    }
    for ($i = 0; $i < 5; $i++) {
        $azar = array_rand($_SESSION["baraja"]);
        $_SESSION["jugador"][] = $_SESSION["baraja"][$azar];
        unset($_SESSION["baraja"][$azar]);
    }
    $_SESSION["cambios"] = 0;
    $_SESSION["puntos"] = 0;
    for ($i = 0; $i < 5; $i++) {
        $jugador2[$i] = substr($_SESSION["jugador"][$i], 1);
    }
    foreach (array_count_values($jugador2) as $indice => $valor) {
        $_SESSION["puntos"] +=  $indice * $valor * $valor;
    }
}

?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <title>
    Cambio de cartas.
    Juegos de cartas (1). Sesiones.
    Ejercicios. PHP. Bartolomé Sintes Marco. www.mclibre.org
  </title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="mclibre-php-ejercicios.css" title="Color">
</head>

<body>
  <h1>Cambio de cartas (1)</h1>

  <p>La puntuación total es la suma de los valores de las cartas. Las cartas repetidas valen el doble, las repetidas tres veces el triple y las repetidas cuatro veces valen cuatro veces más.</p>

  <p>Puede cambiar hasta cinco cartas. Haga clic en la carta que desee cambiar:</p>

  <form action="cartas-7-2.php" method="get">
<?php
print "    <p>\n";
for ($i = 0; $i < 5; $i++) {
    print "      <button type=\"submit\" name=\"accion\" value=\"$i\">\n";
    print "        <img src=\"img/cartas/{$_SESSION["jugador"][$i]}.svg\" alt=\"{$_SESSION["jugador"][$i]}\" width=\"100\">\n";
    print "      </button>\n";
}
print "    </p>\n";
print "\n";
print "    <p>Cambios realizados: $_SESSION[cambios]. Puntuación: $_SESSION[puntos]</p>\n";
?>

    <p><input type="submit" name="accion" value="Reiniciar"></p>
  </form>

  <footer>
    <p class="ultmod">
      Última modificación de esta página:
      <time datetime="2021-12-02">2 de diciembre de 2021</time>
    </p>

    <p class="licencia">
      Este programa forma parte del curso <strong><a href="https://www.mclibre.org/consultar/php/">Programación
      web en PHP</a></strong> de <a href="https://www.mclibre.org/" rel="author">Bartolomé Sintes Marco</a>.<br>
      El programa PHP que genera esta página se distribuye bajo
      <a rel="license" href="http://www.gnu.org/licenses/agpl.txt">licencia AGPL 3 o posterior</a>.
    </p>
  </footer>
</body>
</html>
