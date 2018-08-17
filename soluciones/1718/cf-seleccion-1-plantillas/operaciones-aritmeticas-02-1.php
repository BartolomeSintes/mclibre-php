<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8" />
  <title>Convertidor de pies y pulgadas a centímetros (Formulario). Operaciones aritméticas.
    Escriba su nombre</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" type="text/css" href="mclibre-php-soluciones.css" title="Color" />
</head>

<body>
  <h1>Convertidor de pies y pulgadas a centímetros (Formulario)</h1>

  <form action="operaciones-aritmeticas-02-2.php" method="get">
    <p>Escriba un número de pies y pulgadas para convertir a centímetros.</p>

    <table>
      <tbody>
        <tr>
          <td><strong>Pies:</strong></td>
          <td><input type="number" name="pies" min="0" /> </td>
        </tr>
        <tr>
          <td><strong>Pulgadas:</strong></td>
          <td><input type="number" name="pulgadas" min="0" step="any" /> </td>
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
