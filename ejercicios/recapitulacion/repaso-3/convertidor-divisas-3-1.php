<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8" />
  <title>Convertidor de divisas 3 (Formulario). Repaso 3.
    Ejercicios. PHP. Bartolomé Sintes Marco</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" type="text/css" href="mclibre-php-ejercicios.css" title="Color" />
</head>

<body>
  <h1>Convertidor de divisas (Formulario)</h1>

  <form action="convertidor-divisas-3-2.php" method="get">
    <p>Escriba la cantidad de dinero (0 &lt; valores &lt; 1.000.000) y elija las divisas:</p>

    <p>Convertir <input type="text" name="cantidad" size="6" maxlength="6" />
      <select name="origen">
        <option selected="selected" value="EUR">Euros</option>
        <option value="USD">Dólares USA</option>
        <option value="GBP">Libras esterlinas</option>
        <option value="JPY">Yenes</option>
        <option value="ESP">Pesetas</option>
      </select>
      en
      <select name="destino">
        <option selected="selected" value="EUR">Euros</option>
        <option value="USD">Dólares USA</option>
        <option value="GBP">Libras esterlinas</option>
        <option value="JPY">Yenes</option>
        <option value="ESP">Pesetas</option>
      </select>
    </p>

    <p>
      <strong>Nota</strong>: La cotización de las monedas no está actualizada. Los valores utilizados son:<br />
      1 euro = 1,31481 dólares USA = 0,89807 libras esterlinas = 132,113 yenes japoneses = 166,386 antiguas pesetas españolas
    </p>

    <p class="der">
      <input type="submit" value="Convertir" />
      <input type="reset" value="Borrar" />
    </p>
  </form>

  <footer>
    <p class="ultmod">
      Última modificación de esta página:
      <time datetime="2012-11-13">13 de noviembre de 2012</time>
    </p>

    <p class="licencia">
      Esta página forma parte del curso <a href="http://www.mclibre.org/consultar/php/">
      <cite>Programación web en PHP</cite></a> por <cite>Bartolomé Sintes Marco</cite>.<br />
      y se distribuye bajo una <a rel="license" href="https://creativecommons.org/licenses/by-sa/4.0/deed.es_ES">
      Licencia Creative Commons Reconocimiento-CompartirIgual 4.0 Internacional (CC BY-SA 4.0)</a>.</p>
  </footer>
</body>
</html>
