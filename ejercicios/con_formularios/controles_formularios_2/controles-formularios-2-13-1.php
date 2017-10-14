<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8" />
  <title>Gradiente en cuadrado (Formulario). Controles en formularios (2).
    Ejercicios. Programación web en PHP. Bartolomé Sintes Marco</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link href="mclibre-php-soluciones.css" rel="stylesheet" type="text/css" title="Color" />
</head>

<body>
  <h1>Gradiente en cuadrado (Formulario)</h1>

  <form action="controles-formularios-2-13-2.php" method="get">

    <table>
      <tbody>
        <tr>
          <td>Tamaño de la figura:</td>
          <td><input type="number" name="lado" min="20" max="500" value="200" /></td>
        </tr>
        <tr>
          <td>Color inicial:</td>
          <td><input type="color" name="inicial" value="#ffffff" /></td>
        </tr>
        <tr>
          <td>Color final:</td>
          <td><input type="color" name="final" value="#000000" /></td>
        </tr>
      </tbody>
    </table>

    <p>
      <input type="submit" value="Enviar" />
      <input type="reset" value="Borrar" />
    </p>
  </form>

  <footer>
    <p class="ultmod">
      Última modificación de esta página:
      <time datetime="2016-10-24">24 de octubre de 2016</time></p>

    <p class="licencia">
      Este programa forma parte del curso <a href="http://www.mclibre.org/consultar/php/">
      Programación web en PHP</a> por <a href="http://www.mclibre.org/">Bartolomé
      Sintes Marco</a>.<br />
      El programa PHP que genera esta página está bajo
      <a rel="license" href="http://www.gnu.org/licenses/agpl.txt">licencia AGPL 3 o posterior</a>.</p>
  </footer>
</body>
</html>
