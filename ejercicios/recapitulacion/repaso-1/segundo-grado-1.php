<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <title>
    Ecuación de segundo grado (Formulario). Repaso (1).
    Ejercicios. PHP. Bartolomé Sintes Marco. www.mclibre.org
  </title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="mclibre-php-ejercicios.css" title="Color">
</head>

<body>
  <h1>Ecuación de segundo grado (Formulario)</h1>

  <form action="segundo-grado-2.php" method="get">
    <p>Dado la ecuación de segundo grado <span style="font-size: 200%">a.x<sup>2</sup> + b.x + c = 0</span>, escriba los valores de los tres coeficientes y resolveré la ecuación:</p>

    <table>
      <tr>
        <td><strong>a:</strong></td>
        <td><input type="number" name="a" step="any"></td>
      </tr>
      <tr>
        <td><strong>b:</strong></td>
        <td><input type="number" name="b" step="any"></td>
      </tr>
      <tr>
        <td><strong>c:</strong></td>
        <td><input type="number" name="c" step="any"></td>
      </tr>
    </table>

    <p>
      <input type="submit" value="Resolver">
      <input type="reset">
    </p>
  </form>

  <footer>
    <p class="ultmod">
      Última modificación de esta página:
      <time datetime="2015-11-18">18 de noviembre de 2015</time>
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
