<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8" />
  <title>
    Comparador de tres números enteros (Formulario).
    if ... elseif ... else ... Con formularios.
    Ejercicios. PHP. Bartolomé Sintes Marco. www.mclibre.org
  </title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="mclibre-php-ejercicios.css" title="Color" />
</head>

<body>
  <h1>Comparador de tres números enteros (Formulario)</h1>

  <form action="if-else-4-2.php" method="get">
    <p>Escriba tres números enteros (-1.000 &lt; números &lt; 1.000)
      para comprobar si hay números iguales.</p>

    <table>
      <tbody>
        <tr>
          <td><strong>Primer número:</strong></td>
          <td><input type="number" name="numero1" min="-1000" max="1000" /></td>
        </tr>
        <tr>
          <td><strong>Segundo número:</strong></td>
          <td><input type="number" name="numero2" min="-1000" max="1000" /></td>
        </tr>
        <tr>
          <td><strong>Tercer número:</strong></td>
          <td><input type="number" name="numero3" min="-1000" max="1000" /></td>
        </tr>
      </tbody>
    </table>

    <p>
      <input type="submit" value="Comprobar" />
      <input type="reset" value="Borrar" />
    </p>
  </form>

  <footer>
    <p class="ultmod">
      Última modificación de esta página:
      <time datetime="2018-10-23">23 de octubre de 2018</time>
    </p>

    <p class="licencia">
      Esta página forma parte del curso <a href="http://www.mclibre.org/consultar/php/">
      <cite>Programación web en PHP</cite></a> por <cite>Bartolomé Sintes Marco</cite>.<br />
      y se distribuye bajo una <a rel="license" href="https://creativecommons.org/licenses/by-sa/4.0/deed.es_ES">
      Licencia Creative Commons Reconocimiento-CompartirIgual 4.0 Internacional (CC BY-SA 4.0)</a>.</p>
  </footer>
</body>
</html>
