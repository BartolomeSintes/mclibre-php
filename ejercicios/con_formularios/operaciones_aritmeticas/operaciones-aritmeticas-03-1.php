<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8" />
    <title>Convertidor de segundos a minutos y segundos (Formulario). Operaciones aritméticas.
      Ejercicios. PHP. Bartolomé Sintes Marco</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="mclibre_php_soluciones.css" rel="stylesheet" type="text/css" title="Color" />
  </head>

  <body>
    <h1>Convertidor de segundos a minutos y segundos (Formulario)</h1>

    <form action="operaciones_aritmeticas_3_2.php" method="get">
      <p>Escriba un número de segundos para convertir a minutos y segundos.</p>

      <table>
        <tbody>
          <tr>
            <td><strong>Segundos:</strong></td>
            <td><input type="number" name="segundos" min="0" /> </td>
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
        <time datetime="2016-11-04">4 de noviembre de 2016</time></p>

      <p class="licencia">
        Este programa forma parte del curso <a href="http://www.mclibre.org/consultar/php/">
        Programación web en PHP</a> por <a href="http://www.mclibre.org/">Bartolomé
        Sintes Marco</a>.<br />
        El programa PHP que genera esta página está bajo
        <a rel="license" href="http://www.gnu.org/licenses/agpl.txt">licencia AGPL 3 o posterior</a>.</p>
    </footer>
  </body>
</html>
