<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <title>
    Letrero 1 (Formulario).
    Controles en formularios (1). Con formularios.
    Ejercicios. PHP. Bartolomé Sintes Marco. www.mclibre.org
  </title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="mclibre-php-ejercicios.css" title="Color">
</head>

<body>
  <h1>Letrero 1 (Formulario)</h1>

  <form action="controles-formularios-1-6-2.php" method="get">
    <p>Indique el texto y tamaño a mostrar:</p>

    <table>
      <tr>
        <td>Texto:</td>
        <td><textarea name="info[1]" rows="4" cols="40"></textarea></td>
      </tr>
      <tr>
        <td>Tamaño:</td>
        <td><input type="number" name="info[2]" min="20" value="80"></td>
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
      <time datetime="2024-12-19">19 de diciembre de 2024</time>
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
