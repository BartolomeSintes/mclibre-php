<?php
/**
 * Sesiones (2) 03 - nombre-1.php
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
  <title>Nombre (1). Sesiones (2) 03. Sesiones.
    Escriba su nombre</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" type="text/css" href="mclibre-php-ejercicios.css" title="Color" />
</head>

<body>
  <h1>Nombre (1)</h1>

<?php

print "  <p class=\"aviso\">Ejercicio incompleto</p>\n";

?>
  <form action="nombre-2.php" method="get">
    <p>Escriba su nombre:</p>

    <p><strong>Nombre:</strong> <input type="text" name="nombre" size="20" maxlength="20" /></p>

    <p>
      <input type="submit" value="Guardar" />
      <input type="reset" value="Borrar" />
    </p>
  </form>

  <p><a href="index.php">Volver al inicio.</a></p>

  <footer>
    <p>Escriba su nombre</p>
  </footer>
</body>
</html>
