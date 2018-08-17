<?php
/**
 * Sesiones (1) 05 - sesiones-1-05-1.php
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
  <title>Mover un punto en dos dimensiones. Sesiones.
    Escriba su nombre</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" type="text/css" href="mclibre-php-soluciones.css" title="Color" />
</head>

<body>
  <h1>Mover un punto en dos dimensiones</h1>

  <form action="sesiones-1-05-2.php" method="get">
    <p>Haga clic en los botones para mover el punto:</p>

    <table>
      <tr>
        <td>
          <table style="float: left">
            <tr>
              <th style="width:70px"></th>
              <th style="width:70px"><button type="submit" name="accion" value="arriba" style="font-size: 60px; line-height: 60px;">&#x1F446;</button></th>
              <th style="width:70px"></th>
            </tr>
            <tr>
              <th><button type="submit" name="accion" value="izquierda" style="font-size: 60px; line-height: 60px;">&#x1F448;</button></th>
              <th><button type="submit" name="accion" value="centro">Volver al<br />centro</button></th>
              <th><button type="submit" name="accion" value="derecha" style="font-size: 60px; line-height: 60px;">&#x1F449;</button></th>
            </tr>
            <tr>
              <th></th>
              <th><button type="submit" name="accion" value="abajo" style="font-size: 60px; line-height: 60px;">&#x1F447;</button></th>
              <th></th>
            </tr>
          </table>
        </td>
        <td>
          <svg version="1.1" xmlns="http://www.w3.org/2000/svg"
            width="400" height="400" viewbox="-200 -200 400 400" style="border: black 2px solid">
<?php

print "  <p class=\"aviso\">Ejercicio incompleto</p>\n";

?>
          </svg>
        </td>
      </tr>
    </table>
  </form>

  <footer>
    <p>Escriba su nombre</p>
  </footer>
</body>
</html>
