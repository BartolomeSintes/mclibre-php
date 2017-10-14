<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8" />
    <title>Eliminar elemento de matriz (Formulario). Matrices (1).
      Ejercicios. Programación web en PHP. Bartolomé Sintes Marco</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="mclibre-php-soluciones.css" rel="stylesheet" type="text/css" title="Color" />
  </head>

  <body>
    <h1>Eliminar elemento de matriz (Formulario)</h1>

    <form action="matrices-1-4-2.php" method="get">
      <p>Indique el rango del número de valores y el rango de los valores
        y mostraré un numero aleatorio de valores aleatorios en los rangos indicados.</p>

      <p>Indique el valor que quiere eliminar.</p>

      <table>
        <tbody>
          <tr>
            <td>Número mínimo de valores:</td>
            <td><input type="number" name="numeroMinimo" min="1" value="10" /></td>
          </tr>
          <tr>
            <td>Número máximo de valores:</td>
            <td><input type="number" name="numeroMaximo" min="1" value="20" /></td>
          </tr>
          <tr>
            <td>Valor mínimo:</td>
            <td><input type="number" name="valorMinimo" min="0" value="0" /></td>
          </tr>
          <tr>
            <td>Valor máximo:</td>
            <td><input type="number" name="valorMaximo" min="0" value="100" /></td>
          </tr>
          <tr>
            <td>Valor a eliminar:</td>
            <td><input type="number" name="eliminar" min="0" value="0" /></td>
          </tr>
        </tbody>
      </table>

      <p>
        <input type="submit" value="Mostrar" />
        <input type="reset" value="Borrar" />
      </p>
    </form>

    <footer>
      <p class="ultmod">
        Última modificación de esta página:
        <time datetime="2016-11-07">7 de noviembre de 2016</time></p>

      <p class="licencia">
        Esta página forma parte del curso <a href="http://www.mclibre.org/consultar/php/">
        <cite>Programación web en PHP</cite></a> por <cite>Bartolomé Sintes Marco</cite>.<br />
        y se distribuye bajo una <a rel="license" href="https://creativecommons.org/licenses/by-sa/4.0/deed.es_ES">
        Licencia Creative Commons Reconocimiento-CompartirIgual 4.0 Internacional (CC BY-SA 4.0)</a>.</p>
    </footer>
  </body>
</html>
