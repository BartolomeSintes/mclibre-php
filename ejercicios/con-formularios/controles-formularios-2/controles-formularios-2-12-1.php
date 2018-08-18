<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8" />
  <title>Círculo o cuadrado (Formulario). Controles en formularios (2).
    Ejercicios. Programación web en PHP. Bartolomé Sintes Marco</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" type="text/css" href="mclibre-php-ejercicios.css" title="Color" />
</head>

<body>
  <h1>Círculo o cuadrado (Formulario)</h1>

  <form action="controles-formularios-2-12-2.php" method="get">
    <p>Tamaño de la figura: <input type="number" name="lado" min="20" max="500" value="50" /></p>

    <p>Forma de la figura:
      <label><input type="radio" name="forma" value="cuadrado" />Cuadrado</label>
      <label><input type="radio" name="forma" value="circulo" />Círculo </label>
    </p>

    <p>
      <input type="submit" value="Enviar" />
      <input type="reset" value="Borrar" />
    </p>
  </form>

  <footer>
    <p class="ultmod">
      Última modificación de esta página:
      <time datetime="2016-10-24">24 de octubre de 2016</time>
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
