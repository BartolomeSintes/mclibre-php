<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8" />
  <title>Rombo de estrellas 2 (Formulario). Repaso 3.
    Ejercicios. PHP. Bartolomé Sintes Marco</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" type="text/css" href="mclibre-php-ejercicios.css" title="Color" />
</head>

<body>
  <h1>Rombo de estrellas (Formulario)</h1>

  <form action="rombo-estrellas-2-2.php" method="get">
    <p>Escriba el alto (0 &lt; alto &le; 30) y mostraré un rombo de estrellas de ese tamaño.</p>

    <table class="borde">
      <tbody>
        <tr>
          <td><strong>Alto:</strong></td>
          <td><input type="text" name="alto" size="3" maxlength="3" /></td>
        </tr>
      </tbody>
    </table>

    <p class="der">
      <input type="submit" value="Dibujar" />
      <input type="reset" value="Borrar" />
    </p>
  </form>

  <footer>
    <p class="ultmod">
      Última modificación de esta página:
      <time datetime="2012-11-13">13 de noviembre de 2012</time>
    </p>

    <p class="licencia">
      Esta página forma parte del curso <a href="http://www.mclibre.org/consultar/php/">
      <cite>Programación web en PHP</cite></a> por <cite>Bartolomé Sintes Marco</cite>.<br />
      y se distribuye bajo una <a rel="license" href="https://creativecommons.org/licenses/by-sa/4.0/deed.es_ES">
      Licencia Creative Commons Reconocimiento-CompartirIgual 4.0 Internacional (CC BY-SA 4.0)</a>.</p>
  </footer>
</body>
</html>
