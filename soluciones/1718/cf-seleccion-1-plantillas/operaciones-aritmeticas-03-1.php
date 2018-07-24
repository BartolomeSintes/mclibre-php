<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8" />
  <title>Convertidor de segundos a minutos y segundos (Formulario). Operaciones aritméticas.
    Escribe tu nombre</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link href="mclibre-php-soluciones.css" rel="stylesheet" type="text/css" title="Color" />
</head>

<body>
  <h1>Convertidor de segundos a minutos y segundos (Formulario)</h1>

  <form action="operaciones-aritmeticas-03-2.php" method="get">
    <p>Escriba un número de segundos para convertir a minutos y segundos.</p>

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
    <p>Escribe tu nombre</p>
  </footer>
</body>
</html>
