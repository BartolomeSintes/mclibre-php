<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <title>
    Rombo de estrellas (Formulario). Repaso 3.
    Ejercicios. PHP. Bartolomé Sintes Marco. www.mclibre.org
  </title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="mclibre-php-ejercicios.css" title="Color">
</head>

<body>
  <h1>Rombo de estrellas (Formulario)</h1>

  <form action="rombo-estrellas-1-2.php" method="get">
    <p>Escriba el alto (0 &lt; alto &le; 30) y mostraré un rombo de estrellas de ese tamaño.</p>

    <table class="borde">
      <tbody>
        <tr>
          <td><strong>Alto:</strong></td>
          <td><input type="text" name="alto" size="3" maxlength="3"></td>
        </tr>
      </tbody>
    </table>

    <p class="der">
      <input type="submit" value="Dibujar">
      <input type="reset" value="Borrar">
    </p>
  </form>

  <footer>
    <p class="ultmod">
      Última modificación de esta página:
      <time datetime="2014-11-04">4 de noviembre de 2014</time>
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
