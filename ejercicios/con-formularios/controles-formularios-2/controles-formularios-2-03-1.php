<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8" />
  <title>Datos personales 3 (Formulario). Controles en formularios (2).
    Ejercicios. Programación web en PHP. Bartolomé Sintes Marco. www.mclibre.org</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" type="text/css" href="mclibre-php-ejercicios.css" title="Color" />
</head>

<body>
  <h1>Datos personales 3 (Formulario)</h1>

  <form action="controles-formularios-2-03-2.php" method="get">
    <p>Indique su sexo y aficiones:</p>

    <p><strong>Sexo:</strong>
      <label><input type="radio" name="genero" value="hombre" />Hombre</label>
      <label><input type="radio" name="genero" value="mujer" />Mujer</label></p>

    <p><strong>Aficiones:</strong>
      <label><input type="checkbox" name="cine" />Cine</label>
      <label><input type="checkbox" name="literatura" />Literatura</label>
      <label><input type="checkbox" name="musica" />Música</label>
    </p>

    <p>
      <input type="submit" value="Enviar" />
      <input type="reset" value="Borrar" />
    </p>
  </form>

  <footer>
    <p class="ultmod">
      Última modificación de esta página:
      <time datetime="2016-11-03">3 de noviembre de 2016</time>
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
