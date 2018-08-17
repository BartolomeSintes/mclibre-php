<?php
/**
 * Sesiones (2) 04 - nuevo-1.php
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
  <title>Nuevo dato (1). Sesiones (2) 04. Sesiones.
    Ejercicios. PHP. Bartolomé Sintes Marco</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" type="text/css" href="mclibre-php-soluciones.css" title="Color" />
</head>

<body>
  <h1>Nuevo dato (1)</h1>

  <form action="nuevo-2.php" method="get">
    <p>Escriba el nuevo dato:</p>

    <table>
      <tbody>
        <tr>
          <td><strong>Nombre del dato:</strong></td>
          <td><input type="text" name="nombre" size="20" maxlength="20" /></td>
        </tr>
        <tr>
          <td><strong>Valor del dato:</strong></td>
          <td><input type="text" name="valor" size="30" maxlength="30" /></td>
        </tr>
      </tbody>
    </table>

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
