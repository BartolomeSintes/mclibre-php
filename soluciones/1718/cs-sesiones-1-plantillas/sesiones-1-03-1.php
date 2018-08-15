<?php
/**
 * Sesiones (1) 03 - sesiones-1-03-1.php
 *
 * @author    Escriba su nombre
 *
 */

print "<!-- Ejercicio incompleto -->\n";

?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8" />
  <title>Subir y bajar número. Sesiones.
    Escriba su nombre</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link href="mclibre-php-soluciones.css" rel="stylesheet" type="text/css" title="Color" />
</head>

<body>
  <h1>Subir y bajar número</h1>

  <form action="sesiones-1-03-2.php" method="get">
    <p>Haga clic en los botones para modificar el valor:</p>

    <p>
      <button type="submit" name="accion" value="bajar" style="font-size: 4rem">-</button>

<?php

print "  <p class=\"aviso\">Ejercicio incompleto</p>\n";

?>

      <button type="submit" name="accion" value="subir" style="font-size: 4rem">+</button>
    </p>

    <p><input type="submit" name="accion" value="Poner a cero" /></p>
  </form>

  <footer>
    <p>Escriba su nombre</p>
  </footer>
</body>
</html>
