<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <title>
    Índice de masa corporal (Formulario).
    Operaciones aritméticas. Con formularios.
    Ejercicios. PHP. Bartolomé Sintes Marco. www.mclibre.org
  </title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="mclibre-php-ejercicios.css" title="Color">
</head>

<body>
  <h1>Índice de masa corporal (Formulario)</h1>

  <form action="operaciones-aritmeticas-01-2.php" method="get">
    <p>Escriba su peso en kilogramos y su altura en centímetros para calcular su índice de masa corporal.</p>

    <table>
      <tbody>
        <tr>
          <td><strong>Peso:</strong></td>
          <td><input type="number" name="peso" min="1"> kg</td>
        </tr>
        <tr>
          <td><strong>Altura:</strong></td>
          <td><input type="number" name="altura" min="1"> cm</td>
        </tr>
      </tbody>
    </table>

    <p>
      <input type="submit" value="Calcular">
      <input type="reset" value="Borrar">
    </p>
  </form>

  <footer>
    <p class="ultmod">
      Última modificación de esta página:
      <time datetime="2019-10-24">24 de octubre de 2019</time>
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
