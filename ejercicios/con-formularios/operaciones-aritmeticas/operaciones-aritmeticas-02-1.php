<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <title>
    Convertidor de pies y pulgadas a centímetros (Formulario).
    Operaciones aritméticas. Con formularios.
    Ejercicios. PHP. Bartolomé Sintes Marco. www.mclibre.org
  </title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="mclibre-php-ejercicios.css" title="Color">
</head>

<body>
  <h1>Convertidor de pies y pulgadas a centímetros (Formulario)</h1>

  <form action="operaciones-aritmeticas-02-2.php" method="get">
    <p>Escriba un número de pies y pulgadas para convertir a centímetros.</p>

    <table>
      <tbody>
        <tr>
          <td><label for="pies">Pies:</label></td>
          <td><input type="number" name="pies" min="0" id="pies"></td>
        </tr>
        <tr>
          <td><label for="pulgadas">Pulgadas:</label></td>
          <td><input type="number" name="pulgadas" min="0" step="any" id="pulgadas"></td>
        </tr>
      </tbody>
    </table>

    <p>
      <input type="submit" value="Convertir">
      <input type="reset" value="Borrar">
    </p>
  </form>

  <footer>
    <p class="ultmod">
      Última modificación de esta página:
      <time datetime="2019-10-24">24 de octubre de 2019</time>
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
