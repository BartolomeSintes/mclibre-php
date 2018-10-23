<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8" />
  <title>
    Cuadrado con bordes redondeados (Formulario).
    Controles en formularios (2). Con formularios.
    Ejercicios. Programación web en PHP. Bartolomé Sintes Marco. www.mclibre.org
  </title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" type="text/css" href="mclibre-php-ejercicios.css" title="Color" />
</head>

<body>
  <h1>Cuadrado con bordes redondeados (Formulario)</h1>

  <form action="controles-formularios-2-11-2.php" method="get">
    <p>Tamaño del cuadrado: <input type="number" name="lado" min="20" max="500" value="100" /></p>

    <p>Tamaño de la esquina redondeada: <input type="number" name="esquina" min="10" max="250" value="20" /></p>

    <p>
      <input type="submit" value="Enviar" />
      <input type="reset" value="Borrar" />
    </p>
  </form>

  <footer>
    <p class="ultmod">
      Última modificación de esta página:
      <time datetime="2018-10-22">22 de octubre de 2018</time>
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
