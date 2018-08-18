<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8" />
  <title>Tabla de una fila con casillas de verificación (Formulario 1). foreach (2). Sesiones.
    Ejercicios. PHP. Bartolomé Sintes Marco</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" type="text/css" href="mclibre-php-ejercicios.css" title="Color" />
</head>

<body>
  <h1>Tabla de una fila con casillas de verificación (Formulario 1)</h1>

  <form action="foreach-2-1-2.php" method="get">
    <p>Escriba un número (0 &lt; número &le; 20) y mostraré una tabla de una fila
      de ese tamaño con casillas de verificación en cada celda.</p>

    <p>Tamaño de la tabla: <input type="number" name="numero" min="1" max="20" value="10" /></p>

    <p>
      <input type="submit" value="Mostar" />
      <input type="reset" value="Borrar" />
    </p>
  </form>

  <footer>
    <p class="ultmod">
      Última modificación de esta página:
      <time datetime="2017-11-09">9 de noviembre de 2017</time>
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
