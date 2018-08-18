<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8" />
  <title>Convertidor de segundos a horas, minutos y segundos (Formulario). Operaciones aritméticas.
    Escriba su nombre</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" type="text/css" href="mclibre-php-ejercicios.css" title="Color" />
</head>

<body>
  <h1>Convertidor de segundos a horas, minutos y segundos (Formulario)</h1>

  <form action="operaciones-aritmeticas-04-2.php" method="get">
    <p>Escriba un número de segundos para convertir a horas, minutos y segundos.</p>

    <table>
      <tbody>
        <tr>
          <td><strong>Segundos:</strong></td>
          <td><input type="number" name="segundos" min="0" /> </td>
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
