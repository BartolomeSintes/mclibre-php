<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <title>
    Fruta preferida 1 (Formulario).
    Controles en formularios (1). Con formularios.
    Ejercicios. PHP. Bartolomé Sintes Marco. www.mclibre.org
  </title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="mclibre-php-ejercicios.css" title="Color">
</head>

<body>
  <h1>Fruta preferida 1 (Formulario)</h1>

  <form action="controles-formularios-1-4-2.php" method="get">
    <p>Indique su fruta preferida:<br>
      <label><input type="radio" name="fruta" value="la cereza"> Cereza</label><br>
      <label><input type="radio" name="fruta" value="la fresa"> Fresa</label><br>
      <label><input type="radio" name="fruta" value="el limón"> Limón</label><br>
      <label><input type="radio" name="fruta" value="la manzana"> Manzana</label><br>
      <label><input type="radio" name="fruta" value="la naranja"> Naranja</label><br>
      <label><input type="radio" name="fruta" value="la pera"> Pera</label>
    </p>

    <p>
      <input type="submit" value="Enviar">
      <input type="reset">
    </p>
  </form>

  <footer>
    <p class="ultmod">
      Última modificación de esta página:
      <time datetime="2019-10-24">24 de octubre de 2019</time>
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
