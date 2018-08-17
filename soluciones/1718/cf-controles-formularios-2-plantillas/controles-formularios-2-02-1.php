<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8" />
  <title>Datos personales 2 (Formulario). Controles en formularios (2).
    Escriba su nombre</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" type="text/css" href="mclibre-php-soluciones.css" title="Color" />
</head>

<body>
  <h1>Datos personales 2 (Formulario)</h1>

  <form action="controles-formularios-2-02-2.php" method="get">
    <p>Escriba su edad: <input type="number" name="edad" min="5" max="130" /></p>

    <p>Escriba su peso: <input type="number" name="peso" step="0.1" min="10" max="150" /></p>

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
