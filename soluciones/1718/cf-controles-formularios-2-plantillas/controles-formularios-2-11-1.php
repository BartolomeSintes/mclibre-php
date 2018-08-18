<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8" />
  <title>Cuadrado con bordes redondeados (Formulario). Controles en formularios (2).
    Escriba su nombre</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" type="text/css" href="mclibre-php-ejercicios.css" title="Color" />
</head>

<body>
  <h1>Cuadrado con bordes redondeados (Formulario)</h1>

  <form action="controles-formularios-2-11-2.php" method="get">
    <p>Tamaño del cuadrado: <input type="number" name="lado" min="20" max="500" value="100" /></p>

    <p>Tamaño de la esquina redondeada: <input type="number" name="esquina" min="10" max="250" value="20" /></p>

    <p>
      <input type="submit" value="Enviar" />
      <input type="reset" value="Borrar" />
    </p>
  </form>

  <footer>
    <p>Escriba su nombre</p>
  </footer>
</body>
</html>
