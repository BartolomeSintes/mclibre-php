<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8" />
  <title>Sucesiones aritméticas 4 (Formulario). for (4).
    Escriba su nombre</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" type="text/css" href="mclibre-php-ejercicios.css" title="Color" />
</head>

<body>
  <h1>Sucesiones aritméticas 4 (Formulario)</h1>

  <form action="for-4-4-2.php" method="get">
    <p>Escriba los tres valores y le mostraré los términos de la sucesión
      aritmética correspondiente.</p>

    <table>
      <tbody>
        <tr>
          <td><strong>Valor inicial:</strong></td>
          <td><input type="number" name="inicial" step="any" value="0" /></td>
        </tr>
        <tr>
          <td><strong>Valor final:</strong></td>
          <td><input type="number" name="final" step="any" value="60" /></td>
        </tr>
        <tr>
          <td><strong>Incremento:</strong></td>
          <td><input type="number" name="incremento" step="any" value="10" /></td>
        </tr>
      </tbody>
    </table>

    <p>
      <input type="submit" value="Mostrar" />
      <input type="reset" value="Borrar" />
    </p>
  </form>

  <footer>
    <p>Escriba su nombre</p>
  </footer>
</body>
</html>