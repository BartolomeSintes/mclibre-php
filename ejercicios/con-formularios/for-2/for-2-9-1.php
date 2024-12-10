<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <title>
    Triángulo de estrellas 5 (Formulario). for (2).
    Ejercicios. PHP. Bartolomé Sintes Marco. www.mclibre.org
  </title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="mclibre-php-ejercicios.css" title="Color">
</head>

<body>
  <h1>Triángulo de estrellas 5 (Formulario)</h1>

  <form action="for-2-9-2.php" method="get">
    <p>Escriba el alto (0 &lt; alto &le; 100) y mostraré un triángulo de estrellas de ese tamaño.</p>

    <table>
      <tr>
        <td><strong>Alto:</strong></td>
        <td><input type="number" name="alto" min="1" max="100" value="6"></td>
      </tr>
    </table>

    <p>
      <input type="submit" value="Dibujar">
      <input type="reset">
    </p>
  </form>

  <footer>
    <p class="ultmod">
      Última modificación de esta página:
      <time datetime="2016-11-06">6 de noviembre de 2016</time>
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
