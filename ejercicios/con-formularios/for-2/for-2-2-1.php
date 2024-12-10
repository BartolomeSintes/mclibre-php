<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <title>
    Segmentos (Formulario). for (2).
    Ejercicios. PHP. Bartolomé Sintes Marco. www.mclibre.org
  </title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="mclibre-php-ejercicios.css" title="Color">
</head>

<body>
  <h1>Segmentos (Formulario)</h1>

  <form action="for-2-2-2.php" method="get">
    <p>Escriba el tamaño de cada segmento (4 &lt; tamaño &le; 8) y el
      número de segmentos (1 &lt; franjas &le; 6) y dibujaré esos segmentos.</p>

    <table>
      <tr>
        <td><strong>Tamaño:</strong></td>
        <td><input type="number" name="tamano" min="5" max="8" value="5"></td>
      </tr>
      <tr>
        <td><strong>Número de segmentos:</strong></td>
        <td><input type="number" name="segmentos" min="2" max="6" value="3"></td>
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
