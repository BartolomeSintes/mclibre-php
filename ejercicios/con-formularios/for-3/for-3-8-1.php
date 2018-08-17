<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8" />
  <title>Tabla numerada (Formulario). for (3).
    Ejercicios. PHP. Bartolomé Sintes Marco</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" type="text/css" href="mclibre-php-soluciones.css" title="Color" />
</head>

<body>
  <h1>Tabla numerada (Formulario)</h1>

  <form action="for-3-8-2.php" method="get">
    <p>Escriba dos números y mostraré una tabla con el número de columnas
      (0 &lt; columnas &le; 100) que indique y con las primeras celdas numeradas
      (0 &lt; numeradas &le; 1.000).</p>

    <table>
      <tbody>
        <tr>
          <td><strong>Número de columnas:</strong></td>
          <td><input type="number" name="columnas" min="1" max="100" value="5" /></td>
        </tr>
        <tr>
          <td><strong>Número de celdas numeradas:</strong></td>
          <td><input type="number" name="numeradas" min="1" max="1000" value="17" /></td>
        </tr>
      </tbody>
    </table>

    <p>
      <input type="submit" value="Mostrar" />
      <input type="reset" value="Borrar" />
    </p>
  </form>

  <footer>
    <p class="ultmod">
      Última modificación de esta página:
      <time datetime="2016-11-06">6 de noviembre de 2016</time>
    </p>

    <p class="licencia">
      Esta página forma parte del curso <a href="http://www.mclibre.org/consultar/php/">
      <cite>Programación web en PHP</cite></a> por <cite>Bartolomé Sintes Marco</cite>.<br />
      y se distribuye bajo una <a rel="license" href="https://creativecommons.org/licenses/by-sa/4.0/deed.es_ES">
      Licencia Creative Commons Reconocimiento-CompartirIgual 4.0 Internacional (CC BY-SA 4.0)</a>.</p>
    </footer>
</body>
</html>
