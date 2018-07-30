<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8" />
  <title>Ley de Ohm (Formulario). Repaso (2).
    Ejercicios. PHP. Bartolomé Sintes Marco</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link href="mclibre-php-soluciones.css" rel="stylesheet" type="text/css" title="Color" />
</head>

<body>
  <h1>Ley de Ohm (Formulario)</h1>

  <form action="ley-ohm-2.php" method="get">

    <p>Dado este circuito <img src="circuito.png" alt="Ley de Ohm" width="200" height="135" />, escriba la tensión, la intensidad o la resistencia y comprobaré si los valores son correctos o completaré el valor que falte:</p>

    <table>
      <tbody>
        <tr>
          <td><strong>Tensión:</strong></td>
          <td><input type="number" name="tension" step="any" /> V</td>
        </tr>
        <tr>
          <td><strong>Intensidad:</strong></td>
          <td><input type="number" name="intensidad" step="any" /> A</td>
        </tr>
        <tr>
          <td><strong>Resistencia:</strong></td>
          <td><input type="number" name="resistencia" min="0" step="any" /> &Omega;</td>
        </tr>
      </tbody>
    </table>

    <p>
      <input type="submit" value="Calcular" />
      <input type="reset" value="Borrar" />
    </p>
  </form>

  <footer>
    <p class="ultmod">
      Última modificación de esta página:
      <time datetime="2015-11-18">18 de noviembre de 2015</time></p>

    <p class="licencia">
      Esta página forma parte del curso <a href="http://www.mclibre.org/consultar/php/">
      <cite>Programación web en PHP</cite></a> por <cite>Bartolomé Sintes Marco</cite>.<br />
      y se distribuye bajo una <a rel="license" href="https://creativecommons.org/licenses/by-sa/4.0/deed.es_ES">
      Licencia Creative Commons Reconocimiento-CompartirIgual 4.0 Internacional (CC BY-SA 4.0)</a>.</p>
  </footer>
</body>
</html>

