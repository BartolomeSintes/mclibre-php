<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8" />
  <title>Rectángulo de estrellas 2 (Formulario). for (2).
    Escriba su nombre</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" type="text/css" href="mclibre-php-ejercicios.css" title="Color" />
</head>

<body>
  <h1>Rectángulo de estrellas 2 (Formulario)</h1>

  <form action="for-2-4-2.php" method="get">
    <p>Escriba el alto y ancho (1 &lt; números &le; 100) y mostraré un rectángulo
      de estrellas de ese tamaño.</p>

    <table>
      <tbody>
        <tr>
          <td><strong>Ancho:</strong></td>
          <td><input type="number" name="ancho" min="2" max="100" value="7" /></td>
        </tr>
        <tr>
          <td><strong>Alto:</strong></td>
          <td><input type="number" name="alto" min="2" max="100" value="5" /></td>
        </tr>
      </tbody>
    </table>

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

