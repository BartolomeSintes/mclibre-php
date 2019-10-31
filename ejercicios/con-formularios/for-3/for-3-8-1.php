<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <title>
    Tabla numerada (Formulario).
    for (3). Con formularios.
    Ejercicios. PHP. Bartolomé Sintes Marco. www.mclibre.org
  </title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="mclibre-php-ejercicios.css" title="Color">
</head>

<body>
  <h1>Tabla numerada (Formulario)</h1>

  <form action="for-3-8-2.php" method="get">
    <p>Escriba dos números y mostraré una tabla con el número de columnas
      (0 &lt; columnas &le; 100) que indique y con las primeras celdas numeradas
      (0 &lt; numeradas &le; 1.000).
    </p>

    <table>
      <tbody>
        <tr>
          <td><label for="columnas">Número de columnas:</label></td>
          <td><input type="number" name="columnas" min="1" max="100" value="5" id="columnas"></td>
        </tr>
        <tr>
          <td><label for="numeradas">Número de celdas numeradas:</label></td>
          <td><input type="number" name="numeradas" min="1" max="1000" value="17" id="numeradas"></td>
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
      <time datetime="2019-10-24">24 de octubre de 2019</time>
    </p>

    <p class="licencia">
      Este programa forma parte del curso <strong><a href="http://www.mclibre.org/consultar/php/">Programación
      web en PHP</a></strong> de <a href="http://www.mclibre.org/" rel="author">Bartolomé Sintes Marco</a>.<br>
      El programa PHP que genera esta página se distribuye bajo
      <a rel="license" href="http://www.gnu.org/licenses/agpl.txt">licencia AGPL 3 o posterior</a>.
    </p>
    </footer>
</body>
</html>
