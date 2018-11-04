<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8" />
  <title>Dibujos con cuadrados (Formulario). for (5).
    Escriba su nombre</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="mclibre-php-ejercicios.css" title="Color" />
</head>

<body>
  <h1>Dibujos con cuadrados (Formulario)</h1>

  <form action="for-5-2-2.php" method="get">
    <p>Escriba un número (0 &lt; número &le; 50) y mostraré unos dibujos
      con el número de cuadrados que haya indicado.</p>

    <p><strong>Número de cuadrados por dibujo:</strong>
      <input type="number" name="cuadrados" min="1" max="50" value="10" />
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
