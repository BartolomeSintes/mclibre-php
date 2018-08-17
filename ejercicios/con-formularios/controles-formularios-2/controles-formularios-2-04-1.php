<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8" />
  <title>Datos personales 4 (Formulario). Controles en formularios (2).
  Ejercicios. Programación web en PHP. Bartolomé Sintes Marco</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" type="text/css" href="mclibre-php-soluciones.css" title="Color" />
</head>

<body>
  <h1>Datos personales 4 (Formulario)</h1>

  <form action="controles-formularios-2-04-2.php" method="get">
    <p>Indique su dirección de correo: <input type="email" name="correo" size="40" /></p>

    <p>Confirme su dirección de correo: <input type="email" name="correo2" size="40" /></p>

    <p>Indique si quiere recibir correos nuestros:
      <select name="recibir">
        <option value="-1">...</option>
        <option value="1">Sí</option>
        <option value="0">No</option>
      </select>
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
    Este programa forma parte del curso <a href="http://www.mclibre.org/consultar/php/">
    Programación web en PHP</a> por <a href="http://www.mclibre.org/">Bartolomé
    Sintes Marco</a>.<br />
    El programa PHP que genera esta página está bajo
    <a rel="license" href="http://www.gnu.org/licenses/agpl.txt">licencia AGPL 3 o posterior</a>.</p>
</footer>
</body>
</html>
