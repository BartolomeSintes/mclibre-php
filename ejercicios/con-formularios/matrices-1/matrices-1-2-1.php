<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <title>
    Matrices 2 (Formulario).
    Matrices (1). Con formularios.
    Ejercicios. PHP. Bartolomé Sintes Marco. www.mclibre.org
  </title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="mclibre-php-ejercicios.css" title="Color">
</head>

<body>
  <h1>Matrices 2 (Formulario)</h1>

  <form action="matrices-1-2-2.php" method="get">
    <p>Indique el rango del número de valores y el rango de los valores y
      mostraré un numero aleatorio de valores aleatorios en los rangos indicados.</p>

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
      <time datetime="2018-10-23">23 de octubre de 2018</time>
    </p>

    <p class="licencia">
      Esta página forma parte del curso <a href="http://www.mclibre.org/consultar/php/">
      <cite>Programación web en PHP</cite></a> por <cite>Bartolomé Sintes Marco</cite>.<br>
      y se distribuye bajo una <a rel="license" href="https://creativecommons.org/licenses/by-sa/4.0/deed.es_ES">
      Licencia Creative Commons Reconocimiento-CompartirIgual 4.0 Internacional (CC BY-SA 4.0)</a>.</p>
  </footer>
</body>
</html>
