<?php
/**
 * Sesiones (1) 02 - sesiones-1-02-1.php
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
  <title>Formulario Nombre 2 (Formulario). Sesiones.
    Escribe tu nombre</title> 
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link href="mclibre-php-soluciones.css" rel="stylesheet" type="text/css" title="Color" />
</head>

<body>
  <h1>Formulario Nombre 2 (Formulario)</h1>

<?php

print "  <p class=\"aviso\">Ejercicio incompleto</p>\n";

?>

  <form action="sesiones-1-02-2.php" method="get">
    <p>Escriba su nombre:</p>

    <p><strong>Nombre:</strong> <input type="text" name="nombre" size="20" maxlength="20" /></p>

    <p>
      <input type="submit" value="Siguiente" />
      <input type="reset" value="Borrar" />
    </p>
  </form>

  <footer>
    <p>Escribe tu nombre</p>
  </footer>
</body>
</html>
