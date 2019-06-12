<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <title>Contador de días 1 (Formulario). Repaso (1).
    Ejercicios. PHP. Bartolomé Sintes Marco. www.mclibre.org</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="mclibre-php-ejercicios.css" title="Color">
</head>

<body>
  <h1>Contador de días (Formulario)</h1>

  <form action="contador-dias-2.php" method="get">
    <p>Escriba un número de semanas (0 &lt; semanas &le; 20) y mostraré un calendario.</p>

    <p><strong>Número de semanas:</strong> <input type="number" name="numero" min="1" max="20" value="5"></p>

    <p>
      <input type="submit" value="Convertir">
      <input type="reset" value="Borrar">
    </p>
  </form>

  <footer>
    <p class="ultmod">
      Última modificación de esta página:
      <time datetime="2015-11-18">18 de noviembre de 2015</time>
    </p>

    <p class="licencia">
      Esta página forma parte del curso <a href="http://www.mclibre.org/consultar/php/">
      <cite>Programación web en PHP</cite></a> por <cite>Bartolomé Sintes Marco</cite>.<br>
      y se distribuye bajo una <a rel="license" href="https://creativecommons.org/licenses/by-sa/4.0/deed.es_ES">
      Licencia Creative Commons Reconocimiento-CompartirIgual 4.0 Internacional (CC BY-SA 4.0)</a>.</p>
  </footer>
</body>
</html>
