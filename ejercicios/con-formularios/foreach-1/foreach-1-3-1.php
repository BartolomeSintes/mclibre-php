<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8" />
  <title>Encuesta (Formulario). foreach (1).
    Ejercicios. PHP. Bartolomé Sintes Marco</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link href="mclibre-php-soluciones.css" rel="stylesheet" type="text/css" title="Color" />
</head>

<body>
  <h1>Encuesta (Formulario)</h1>

  <form action="foreach-1-3-2.php" method="get">
    <p>Escriba el número de preguntas (1 &le; número &le; 10) y respuestas (2 &le; número &le; 10) y mostraré una encuesta ficticia.</p>

    <table>
      <tbody>
        <tr>
          <td><strong>Número de preguntas:</strong></td>
          <td><input type="number" name="preguntas" min="1" max="10" value="7" /></td>
        </tr>
        <tr>
          <td><strong>Número de respuestas:</strong></td>
          <td><input type="number" name="respuestas" min="2" max="10" value="3" /></td>
        </tr>
      </tbody>
    </table>

    <p>
      <input type="submit" value="Mostar" />
      <input type="reset" value="Borrar" />
    </p>
  </form>

  <footer>
    <p class="ultmod">
      Última modificación de esta página:
      <time datetime="2015-11-05">5 de noviembre de 2015</time>
    </p>

    <p class="licencia">
      Esta página forma parte del curso <a href="http://www.mclibre.org/consultar/php/">
      <cite>Programación web en PHP</cite></a> por <cite>Bartolomé Sintes Marco</cite>.<br />
      y se distribuye bajo una <a rel="license" href="https://creativecommons.org/licenses/by-sa/4.0/deed.es_ES">
      Licencia Creative Commons Reconocimiento-CompartirIgual 4.0 Internacional (CC BY-SA 4.0)</a>.</p>
  </footer>
</body>
</html>
