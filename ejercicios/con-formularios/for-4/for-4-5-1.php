<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <title>
    Sucesiones aritméticas 5 (Formulario). for (4).
    Ejercicios. PHP. Bartolomé Sintes Marco. www.mclibre.org
  </title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="mclibre-php-ejercicios.css" title="Color">
</head>

<body>
  <h1>Sucesiones aritméticas 5 (Formulario)</h1>

  <form action="for-4-5-2.php" method="get">
    <p>Escriba tres de estos valores y le mostraré los términos de la sucesión
      aritmética correspondiente.
    </p>

    <table>
      <tbody>
        <tr>
          <td><strong>Valor inicial:</strong></td>
          <td><input type="number" name="inicial" step="any" value="0"></td>
        </tr>
        <tr>
          <td><strong>Valor final:</strong></td>
          <td><input type="number" name="final" step="any" value="60"></td>
        </tr>
        <tr>
          <td><strong>Incremento:</strong></td>
          <td><input type="number" name="incremento" step="any" value="12"></td>
        </tr>
        <tr>
          <td><strong>Número de valores:</strong></td>
          <td><input type="number" name="valores" step="1" min="1" value="5"></td>
        </tr>
      </tbody>
    </table>

    <p>
      <input type="submit" value="Mostrar">
      <input type="reset" value="Borrar">
    </p>
  </form>

  <footer>
    <p class="ultmod">
      Última modificación de esta página:
      <time datetime="2016-11-06">6 de noviembre de 2016</time>
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
