<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <title>
    Eliminar elemento de matriz (Formulario).
    Matrices (1). Con formularios.
    Ejercicios. PHP. Bartolomé Sintes Marco. www.mclibre.org
  </title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="mclibre-php-ejercicios.css" title="Color">
</head>

<body>
  <h1>Eliminar elemento de matriz (Formulario)</h1>

  <form action="matrices-1-4-2.php" method="get">
    <p>Indique el rango del número de valores y el rango de los valores y mostraré
       un numero aleatorio de valores aleatorios en los rangos indicados.</p>

    <p>Indique el valor que quiere eliminar.</p>

    <table>
      <tbody>
        <tr>
          <td>Número mínimo de valores:</td>
          <td><input type="number" name="numeroMinimo" min="1" value="10"></td>
        </tr>
        <tr>
          <td>Número máximo de valores:</td>
          <td><input type="number" name="numeroMaximo" min="1" value="20"></td>
        </tr>
        <tr>
          <td>Valor mínimo:</td>
          <td><input type="number" name="valorMinimo" min="0" value="0"></td>
        </tr>
        <tr>
          <td>Valor máximo:</td>
          <td><input type="number" name="valorMaximo" min="0" value="100"></td>
        </tr>
        <tr>
          <td>Valor a eliminar:</td>
          <td><input type="number" name="eliminar" min="0" value="0"></td>
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
