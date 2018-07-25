<?php
/**
 * Sesiones (2) 02 - apellidos-1.php
 *
 * @author    Escribe tu nombre
 *
 */

print "<!-- Ejercicio incompleto -->\n";

?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8" />
  <title>Apellidos (1). Sesiones (2) 02. Sesiones.
    Escribe tu nombre</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link href="mclibre-php-soluciones.css" rel="stylesheet" type="text/css"  title="Color" />
</head>

<body>
  <h1>Borrar datos (1)</h1>

<?php

print "  <p class=\"aviso\">Ejercicio incompleto</p>\n";

?>
  <form action="apellidos-2.php" method="get">
    <p>Escriba sus apellidos:</p>

    <p><strong>Apellidos:</strong> <input type="text" name="apellidos" size="30" maxlength="30" /></p>

    <p>
      <input type="submit" value="Guardar" />
      <input type="reset" value="Borrar" />
    </p>
  </form>

  <p><a href="index.php">Volver al inicio.</a></p>

  <footer>
    <p>Escribe tu nombre</p>
  </footer>
</body>
</html>
