<?php
/**
 * Sesiones (1) 11 - sesiones-1-11-1.php
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
  <title>Tirada de dados. Sesiones.
    Escribe tu nombre</title> 
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link href="mclibre-php-soluciones.css" rel="stylesheet" type="text/css" title="Color" />
</head>

<body>
  <h1>Tirada de dados</h1>

<?php

print "  <p class=\"aviso\">Ejercicio incompleto</p>\n";

?>

  <form action="sesiones-1-11-2.php" method="get">
    <p>Haga clic en los botones para aumentar o disminuir el número de dados o para volver a tirarlos:</p>

    <p>
      <button type="submit" name="accion" value="bajar" style="font-size: 2rem">-</button>

<?php

print "  <p class=\"aviso\">Ejercicio incompleto</p>\n";

?>
	  
      <button type="submit" name="accion" value="subir" style="font-size: 2rem">+</button>
    </p>

    <p><button type="submit" name="accion" value="tirar">Tirar dados</button></p>
  </form>

  <footer>
    <p>Escribe tu nombre</p>
  </footer>
</body>
</html>
