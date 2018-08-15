<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8" />
  <title>Convertidor de pies y pulgadas a centímetros (Formulario). Operaciones aritméticas.
    Ejercicios. PHP. Bartolomé Sintes Marco</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link href="mclibre-php-soluciones.css" rel="stylesheet" type="text/css" title="Color" />
</head>

<body>
  <h1>Convertidor de pies y pulgadas a centímetros (Formulario)</h1>

  <form action="operaciones-aritmeticas-02-2.php" method="get">
    <p>Escriba un número de pies y pulgadas para convertir a centímetros.</p>

    <table>
      <tbody>
        <tr>
          <td><strong>Pies:</strong></td>
          <td><input type="number" name="pies" min="0" /></td>
        </tr>
        <tr>
          <td><strong>Pulgadas:</strong></td>
          <td><input type="number" name="pulgadas" min="0" step="any" /></td>
        </tr>
      </tbody>
    </table>

    <p>
      <input type="submit" value="Convertir" />
      <input type="reset" value="Borrar" />
    </p>
  </form>

  <footer>
    <p class="ultmod">
      Última modificación de esta página:
      <time datetime="2016-11-04">4 de noviembre de 2016</time>
    </p>

    <p class="licencia">
      Este programa forma parte del curso <strong><a href="http://www.mclibre.org/consultar/php/">Programación
      web en PHP</a></strong> de <a href="http://www.mclibre.org/" rel="author" >Bartolomé Sintes Marco</a>.<br />
      El programa PHP que genera esta página se distribuye bajo
      <a rel="license" href="http://www.gnu.org/licenses/agpl.txt">licencia AGPL 3 o posterior</a>.
    </p>
  </footer>
</body>
</html>
