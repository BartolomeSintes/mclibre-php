<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <title>
    Gradiente en cuadrado (Formulario).
    Controles en formularios (2). Con formularios.
    Ejercicios. PHP. Bartolomé Sintes Marco. www.mclibre.org
  </title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="mclibre-php-ejercicios.css" title="Color">
</head>

<body>
  <h1>Gradiente en cuadrado (Formulario)</h1>

  <form action="controles-formularios-2-13-2.php" method="get">

    <table>
      <tr>
        <td><label for="control1">Tamaño de la figura:<label></td>
        <td><input type="number" name="lado" min="20" max="500" value="200" id="control1"></td>
      </tr>
      <tr>
        <td><label for="control2">Color inicial:</label></td>
        <td><input type="color" name="inicial" value="#ffffff" id="control2"></td>
      </tr>
      <tr>
        <td><label for="control3">Color final:</label></td>
        <td><input type="color" name="final" value="#000000" id="control3"></td>
      </tr>
    </table>

    <p>
      <input type="submit" value="Enviar">
      <input type="reset">
    </p>
  </form>

  <footer>
    <p class="ultmod">
      Última modificación de esta página:
      <time datetime="2022-10-29">29 de octubre de 2022</time>
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
