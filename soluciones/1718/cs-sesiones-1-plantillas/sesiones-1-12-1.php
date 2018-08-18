<?php
/**
 * Sesiones (1) 12 - sesiones-1-12-1.php
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
  <title>Carrera de coches (1). Sesiones.
    Escriba su nombre</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" type="text/css" href="mclibre-php-ejercicios.css" title="Color" />
</head>

<body>
  <h1>Carrera de coches (1)</h1>

  <form action="sesiones-1-12-2.php" method="get">
    <p>Haga clic en los botones para tirar el dado y mover el punto:</p>

    <table>
      <tr>
        <td><button type="submit" name="accion" value="a" style="font-size: 40px; line-height: 40px;">A</button></td>

<?php

print "  <p class=\"aviso\">Ejercicio incompleto</p>\n";

?>

      </tr>
      <tr>
        <td><button type="submit" name="accion" value="b" style="font-size: 40px; line-height: 40px;">B</button></td>

<?php

print "  <p class=\"aviso\">Ejercicio incompleto</p>\n";

?>

      </tr>
    </table>

    <p><button type="submit" name="accion" value="empezar">Volver a empezar</button></p>
  </form>

  <footer>
    <p>Escriba su nombre</p>
  </footer>
</body>
</html>