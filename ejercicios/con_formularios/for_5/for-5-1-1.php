<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8" />
  <title>Dibujos con líneas (Formulario). for (5).
    Ejercicios. PHP. Bartolomé Sintes Marco</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link href="mclibre-php-soluciones.css" rel="stylesheet" type="text/css" title="Color" />
</head>

<body>
  <h1>Dibujos con líneas (Formulario)</h1>

  <form action="for-5-1-2.php" method="get">
    <p>Escriba un número (0 &lt; número &le; 50) y mostraré unos dibujos
      con el número de líneas que haya indicado.</p>

    <p><strong>Número de líneas por dibujo:</strong>
      <input type="number" name="lineas" min="1" max="50" value="10" /></p>

    <p>
      <input type="submit" value="Dibujar" />
      <input type="reset" value="Borrar" />
    </p>
  </form>

  <footer>
    <p class="ultmod">
      Última modificación de esta página:
      <time datetime="2016-11-06">6 de noviembre de 2016</time></p>

    <p class="licencia">
      Esta página forma parte del curso <a href="http://www.mclibre.org/consultar/php/">
      <cite>Programación web en PHP</cite></a> por <cite>Bartolomé Sintes Marco</cite>.<br />
      y se distribuye bajo una <a rel="license" href="https://creativecommons.org/licenses/by-sa/4.0/deed.es_ES">
      Licencia Creative Commons Reconocimiento-CompartirIgual 4.0 Internacional (CC BY-SA 4.0)</a>.</p>
  </footer>
</body>
</html>
