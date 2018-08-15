<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8" />
  <title>Comparador de tres números (Formulario). if ... elseif ... else ...
    Escriba su nombre</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link href="mclibre-php-soluciones.css" rel="stylesheet" type="text/css" title="Color" />
</head>

<body>
  <h1>Comparador de tres números (Formulario)</h1>

  <form action="if-else-3-2.php" method="get">
    <p>Escriba tres números (-1.000 &lt; números &lt; 1.000) para comprobar si hay números iguales.</p>

    <table>
      <tbody>
        <tr>
          <td><strong>Primer número:</strong></td>
          <td><input type="number" name="numero1" min="-1000" max="1000" step="any" /></td>
        </tr>
        <tr>
          <td><strong>Segundo número:</strong></td>
          <td><input type="number" name="numero2" min="-1000" max="1000" step="any" /></td>
        </tr>
        <tr>
          <td><strong>Tercer número:</strong></td>
          <td><input type="number" name="numero3" min="-1000" max="1000" step="any" /></td>
        </tr>
      </tbody>
    </table>

    <p>
      <input type="submit" value="Comprobar" />
      <input type="reset" value="Borrar" />
    </p>
  </form>

  <footer>
    <p>Escriba su nombre</p>
  </footer>
</body>
</html>
