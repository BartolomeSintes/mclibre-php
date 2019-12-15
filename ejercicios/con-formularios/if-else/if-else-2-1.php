<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <title>
    Comprobador de múltiplos (Formulario).
    if ... elseif ... else ... Con formularios.
    Ejercicios. PHP. Bartolomé Sintes Marco. www.mclibre.org
  </title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="mclibre-php-ejercicios.css" title="Color">
</head>

<body>
  <h1>Comprobador de múltiplos (Formulario)</h1>

  <form action="if-else-2-2.php" method="get">
    <p>Escriba dos números enteros (0 &lt; números &lt; 1.000)
      para comprobar si uno es múltiplo del otro o no.</p>

    <table>
      <tbody>
        <tr>
          <td><label for="numero1">Un número:</label></td>
          <td><input type="number" name="numero1" min="0" max="1000" step="any" id="numero1"></td>
        </tr>
        <tr>
          <td><label for="numero2">Otro número:</label></td>
          <td><input type="number" name="numero2" min="0" max="1000" step="any" id="numero2"></td>
        </tr>
      </tbody>
    </table>

    <p>
      <input type="submit" value="Comprobar">
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
