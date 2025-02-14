<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <title>
    Convertidor de temperaturas Celsius / Fahrenheit (Formulario).
    Selección (1). Con formularios.
    Ejercicios. PHP. Bartolomé Sintes Marco. www.mclibre.org
  </title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="mclibre-php-ejercicios.css" title="Color">
</head>

<body>
  <h1>Convertidor de temperaturas Celsius / Fahrenheit (Formulario)</h1>

  <form action="seleccion-1-5-2.php" method="get">
    <p>Escriba una temperatura en grados Celsius o Fahrenheit (-273.15 &le; Celsius &lt; 10.000;
      -459.67 &le; Fahrenheit &lt; 10.000) para convertirla a la otra unidad (Fahrenheit o Celsius).
    </p>

    <p>
      <label>
        Temperatura:
        <input type="number" name="temperatura" min="-500" max="10000" step="any">
      </label>
      <select name="unidad">
        <option value="c" selected>Celsius</option>
        <option value="f">Fahrenheit</option>
      </select>
    </p>

    <p>
      <input type="submit" value="Convertir">
      <input type="reset">
    </p>
  </form>

  <footer>
    <p class="ultmod">
      Última modificación de esta página:
      <time datetime="2025-02-08">8 de febrero de 2025</time>
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
