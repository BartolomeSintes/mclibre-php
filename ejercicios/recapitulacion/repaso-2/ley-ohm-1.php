<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <title>
    Ley de Ohm (Formulario). Repaso (2).
    Ejercicios. PHP. Bartolomé Sintes Marco. www.mclibre.org
  </title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="mclibre-php-ejercicios.css" title="Color">
</head>

<body>
  <h1>Ley de Ohm (Formulario)</h1>

  <form action="ley-ohm-2.php" method="get">

    <p>Dado este circuito <img src="circuito.png" alt="Ley de Ohm" width="200" height="135">, escriba la tensión, la intensidad o la resistencia y comprobaré si los valores son correctos o completaré el valor que falte:</p>

    <table>
      <tr>
        <td><strong>Tensión:</strong></td>
        <td><input type="number" name="tension" step="any"> V</td>
      </tr>
      <tr>
        <td><strong>Intensidad:</strong></td>
        <td><input type="number" name="intensidad" step="any"> A</td>
      </tr>
      <tr>
        <td><strong>Resistencia:</strong></td>
        <td><input type="number" name="resistencia" min="0" step="any"> &Omega;</td>
      </tr>
    </table>

    <p>
      <input type="submit" value="Calcular">
      <input type="reset" value="Borrar">
    </p>
  </form>

  <footer>
    <p class="ultmod">
      Última modificación de esta página:
      <time datetime="2015-11-18">18 de noviembre de 2015</time>
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

