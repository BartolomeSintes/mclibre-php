<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8" />
  <title>Convertidor de centímetros a kilómetros, metros y centímetros (Formulario) if ... elseif ... else ...
    Escriba su nombre</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" type="text/css" href="mclibre-php-soluciones.css" title="Color" />
</head>

<body>
  <h1>Convertidor de centímetros a kilómetros, metros y centímetros (Formulario)</h1>

  <form action="if-else-7-2.php" method="get">
    <p>Escriba una distancia en centímetros (0 &le; distancia &lt; 1.000.000.000)
      para convertirla a kilómetros, metros y centímetros.</p>

    <table>
      <tbody>
        <tr>
          <td><strong>Distancia:</strong></td>
          <td><input type="number" name="distancia" min="0" max="999999999" /> cm</td>
        </tr>
      </tbody>
    </table>

    <p>
      <input type="submit" value="Convertir" />
      <input type="reset" value="Borrar" />
    </p>
  </form>

  <footer>
    <p>Escriba su nombre</p>
  </footer>
</body>
</html>
