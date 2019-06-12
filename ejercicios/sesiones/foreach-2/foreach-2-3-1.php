<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <title>
    Encuesta (Formulario 1).
    foreach (2). Sesiones.
    Ejercicios. PHP. Bartolomé Sintes Marco. www.mclibre.org
  </title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="mclibre-php-ejercicios.css" title="Color">
</head>

<body>
<h1>Encuesta (Formulario 1)</h1>

  <form action="foreach-2-3-2.php" method="get">
    <p>Escriba el número de preguntas (1 &le; número &le; 10) y respuestas (2
    &le; número &le; 10) y mostraré una encuesta ficticia.</p>

    <table>
      <tbody>
        <tr>
          <td><strong>Número de preguntas:</strong></td>
          <td><input type="number" name="preguntas" min="1" max="10" value="7"></td>
        </tr>
        <tr>
          <td><strong>Número de respuestas:</strong></td>
          <td><input type="number" name="respuestas" min="2" max="10" value="3"></td>
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
      <time datetime="2018-11-01">1 de noviembre de 2018</time>
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
