<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8" />
  <title>Ecuación de segundo grado (Formulario). Repaso (1).
    Ejercicios. PHP. Bartolomé Sintes Marco</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" type="text/css" href="mclibre-php-soluciones.css" title="Color" />
</head>

<body>
  <h1>Ecuación de segundo grado (Formulario)</h1>

  <form action="segundo-grado-2.php" method="get">
    <p>Dado la ecuación de segundo grado <span style="font-size: 200%">a.x<sup>2</sup> + b.x + c = 0</span>, escriba los valores de los tres coeficientes y resolveré la ecuación:</p>

    <table>
      <tbody>
        <tr>
          <td><strong>a:</strong></td>
          <td><input type="number" name="a" step="any" /></td>
        </tr>
        <tr>
          <td><strong>b:</strong></td>
          <td><input type="number" name="b" step="any" /></td>
        </tr>
        <tr>
          <td><strong>c:</strong></td>
          <td><input type="number" name="c" step="any" /></td>
        </tr>
      </tbody>
    </table>

    <p>
      <input type="submit" value="Resolver" />
      <input type="reset" value="Borrar" />
    </p>
  </form>

  <footer>
    <p class="ultmod">
      Última modificación de esta página:
      <time datetime="2015-11-18">18 de noviembre de 2015</time>
    </p>

    <p class="licencia">
      Esta página forma parte del curso <a href="http://www.mclibre.org/consultar/php/">
      <cite>Programación web en PHP</cite></a> por <cite>Bartolomé Sintes Marco</cite>.<br />
      y se distribuye bajo una <a rel="license" href="https://creativecommons.org/licenses/by-sa/4.0/deed.es_ES">
      Licencia Creative Commons Reconocimiento-CompartirIgual 4.0 Internacional (CC BY-SA 4.0)</a>.</p>
  </footer>
</body>
</html>
