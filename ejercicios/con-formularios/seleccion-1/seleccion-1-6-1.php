<?php
/**
 * Cuenta palos - cuenta-palos-1.php
 *
 * @author    Bartolomé Sintes Marco <bartolome.sintes+mclibre@gmail.com>
 * @copyright 2025 Bartolomé Sintes Marco
 * @license   http://www.gnu.org/licenses/agpl.txt AGPL 3 or later
 * @version   2025-02-08
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
  <meta charset="utf-8">
  <title>
    Cuenta palos (Formulario).
    Selección (1). Con formularios.
    Ejercicios. PHP. Bartolomé Sintes Marco. www.mclibre.org
  </title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="mclibre-php-ejercicios.css" title="Color">
</head>

<body>
  <h1>Cuenta palos (Formulario)</h1>

  <form action="seleccion-1-6-2.php" method="get">
    <p>Elija un número de cartas (entre 3 y 7) y dos palos.</p>

    <table>
      <tbody>
        <tr>
          <td><strong>Número de cartas:</strong></td>
          <td><input type="number" name="cantidad" min="3" max="7" value="5"></td>
        </tr>
        <tr>
          <td><strong>Palo 1:</strong></td>
          <td>
            <select name="palo1">
              <option value="">...</option>
              <option value="c">Corazones</option>
              <option value="d">Rombos</option>
              <option value="p">Picas</option>
              <option value="t">Tréboles</option>
            </select>
          </td>
        </tr>
        <tr>
        <td><strong>Palo 2:</strong></td>
          <td>
            <select name="palo2">
              <option value="">...</option>
              <option value="c">Corazones</option>
              <option value="d">Rombos</option>
              <option value="p">Picas</option>
              <option value="t">Tréboles</option>
            </select>
          </td>
        </tr>
      </tbody>
    </table>

    <p>
      <input type="submit" value="Mostrar">
      <input type="reset" value="Borrar">
    </p>
  </form>

  <footer>
    <p class="ultmod">
      Última modificación de esta página:
      <time datetime="2025-02-08">8 de febrero de 2025</time>
    </p>

    <p class="licencia">
      Este programa forma parte del curso <strong><a href="http://www.mclibre.org/consultar/php/">Programación
      web en PHP</a></strong> de <a href="http://www.mclibre.org/" rel="author" >Bartolomé Sintes Marco</a>.<br>
      El programa PHP que genera esta página se distribuye bajo
      <a rel="license" href="http://www.gnu.org/licenses/agpl.txt">licencia AGPL 3 o posterior</a>.
    </p>
  </footer>
</body>
</html>
