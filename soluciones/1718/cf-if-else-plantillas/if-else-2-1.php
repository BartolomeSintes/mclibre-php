<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8" />
  <title>Comprobador de múltiplos (Formulario). if ... elseif ... else ...
    Escriba su nombre</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link href="mclibre-php-soluciones.css" rel="stylesheet" type="text/css" title="Color" />
</head>

<body>
  <h1>Comprobador de múltiplos (Formulario)</h1>

  <form action="if-else-2-2.php" method="get">

    <p>Escriba dos números enteros (0 &lt; números &lt; 1.000)
      para comprobar si uno es múltiplo del otro o no.</p>

    <table>
      <tbody>
        <tr>
          <td><strong>Un número:</strong></td>
          <td><input type="number" name="numero1" min="0" max="1000" step="any" /></td>
        </tr>
        <tr>
          <td><strong>Otro número:</strong></td>
          <td><input type="number" name="numero2" min="0" max="1000" step="any" /></td>
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
