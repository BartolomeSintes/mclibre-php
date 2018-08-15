<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8" />
  <title>Triángulo de estrellas 5 (Formulario). for (2).
    Ejercicios. PHP. Bartolomé Sintes Marco</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link href="mclibre-php-soluciones.css" rel="stylesheet" type="text/css" title="Color" />
</head>

<body>
  <h1>Triángulo de estrellas 5 (Formulario)</h1>

  <form action="for-2-9-2.php" method="get">
    <p>Escriba el alto (0 &lt; alto &le; 100) y mostraré un triángulo de
      estrellas de ese tamaño.</p>

    <table>
      <tbody>
        <tr>
          <td><strong>Alto:</strong></td>
          <td><input type="number" name="alto" min="1" max="100" value="6" /></td>
        </tr>
      </tbody>
    </table>

    <p>
      <input type="submit" value="Dibujar" />
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
