<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8" />
  <title>Índice de masa corporal (Formulario). Operaciones aritméticas.
    Ejercicios. PHP. Bartolomé Sintes Marco</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link href="mclibre-php-soluciones.css" rel="stylesheet" type="text/css" title="Color" />
</head>

<body>
  <h1>Índice de masa corporal (Formulario)</h1>

  <form action="operaciones-aritmeticas-01-2.php" method="get">
    <p>Escriba su peso en kilogramos y su altura en centímetros para calcular su índice de masa corporal.</p>

    <table>
      <tbody>
        <tr>
          <td><strong>Peso:</strong></td>
          <td><input type="number" name="peso" min="1" /> kg</td>
        </tr>
        <tr>
          <td><strong>Altura:</strong></td>
          <td><input type="number" name="altura" min="1" /> cm</td>
        </tr>
      </tbody>
    </table>

    <p>
      <input type="submit" value="Calcular" />
      <input type="reset" value="Borrar" />
    </p>
  </form>

  <footer>
    <p class="ultmod">
      Última modificación de esta página:
      <time datetime="2016-11-04">4 de noviembre de 2016</time>
    </p>

    <p class="licencia">
      Este programa forma parte del curso <a href="http://www.mclibre.org/consultar/php/">
      Programación web en PHP</a> por <a href="http://www.mclibre.org/">Bartolomé
      Sintes Marco</a>.<br />
      El programa PHP que genera esta página está bajo
      <a rel="license" href="http://www.gnu.org/licenses/agpl.txt">licencia AGPL 3 o posterior</a>.</p>
  </footer>
</body>
</html>
