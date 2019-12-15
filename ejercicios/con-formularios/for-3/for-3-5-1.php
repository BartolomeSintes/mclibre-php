<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <title>
    Tabla de multiplicar (Formulario).
    for (3). Con formularios.
    Ejercicios. PHP. Bartolomé Sintes Marco. www.mclibre.org
  </title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="mclibre-php-ejercicios.css" title="Color">
</head>

<body>
  <h1>Tabla de multiplicar (Formulario)</h1>

  <form action="for-3-5-2.php" method="get">
    <p>Escriba el número de filas y columnas (0 &lt; número &le; 100) y su tamaño
      (30 &le; altura &le; 100; 50 &le; anchura &le; 100) y mostraré la tabla de
      multiplicar hasta esos valores.
    </p>

    <table>
      <tbody>
        <tr>
          <td><label for="filas">Número de filas:</label></td>
          <td><input type="number" name="filas" min="1" max="100" value="5" id="filas"></td>
          <td><label for="altura">Altura:</label></td>
          <td><input type="number" name="altura" min="30" max="100" value="50" id="altura"> <label for="altura">px</label></td>
        </tr>
        <tr>
          <td><label for="columnas">Número de columnas:</label></td>
          <td><input type="number" name="columnas" min="1" max="100" value="10" id="columnas"></td>
          <td><label for="anchura">Anchura:</label></td>
          <td><input type="number" name="anchura" min="30" max="100" value="70" id="anchura"> <label for="anchura">px</label></td>
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
      Este programa forma parte del curso <strong><a href="https://www.mclibre.org/consultar/php/">Programación
      web en PHP</a></strong> de <a href="https://www.mclibre.org/" rel="author">Bartolomé Sintes Marco</a>.<br>
      El programa PHP que genera esta página se distribuye bajo
      <a rel="license" href="http://www.gnu.org/licenses/agpl.txt">licencia AGPL 3 o posterior</a>.
    </p>
  </footer>
</body>
</html>
