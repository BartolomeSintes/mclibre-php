<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8" />
  <title>
    Reparto de tríos (Formulario).
    Selección (1). Con formularios.
    Ejercicios. PHP. Bartolomé Sintes Marco. www.mclibre.org
  </title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" type="text/css" href="mclibre-php-ejercicios.css" title="Color" />
</head>

<body>
  <h1>Reparto de tríos (Formulario)</h1>

  <form action="seleccion-1-7-2.php" method="get">
    <p>Escriba un número de jugadores (3 &lt; número &le; 10) y repartiré tres
    cartas a cada jugador.</p>

    <table>
      <tbody>
        <tr>
          <td><strong>Número de jugadores:</strong></td>
          <td><input type="number" name="jugadores" min="3" max="10" value="6" /> </td>
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

