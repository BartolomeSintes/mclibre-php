<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8" />
  <title>Dibujos con líneas (Formulario). for (5).
    Escriba su nombre</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" type="text/css" href="mclibre-php-ejercicios.css" title="Color" />
</head>

<body>
  <h1>Dibujos con líneas (Formulario)</h1>

  <form action="for-5-1-2.php" method="get">
    <p>Escriba un número (0 &lt; número &le; 50) y mostraré unos dibujos
      con el número de líneas que haya indicado.</p>

    <p><strong>Número de líneas por dibujo:</strong>
      <input type="number" name="lineas" min="1" max="50" value="10" />
    </p>

    <p>
      <input type="submit" value="Dibujar" />
      <input type="reset" value="Borrar" />
    </p>
  </form>

  <footer>
    <p>Escriba su nombre</p>
  </footer>
</body>
</html>
