<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8" />
  <title>Convertidor de temperaturas Celsius / Fahrenheit (Formulario). if ... elseif ... else ...
    Escriba su nombre</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link href="mclibre-php-soluciones.css" rel="stylesheet" type="text/css" title="Color" />
</head>

<body>
  <h1>Convertidor de temperaturas Celsius / Fahrenheit (Formulario)</h1>

  <form action="if-else-6-2.php" method="get">
    <p>Escriba una temperatura en grados Celsius o Fahrenheit (-273.15 &le; Celsius &lt; 10.000;
      -459.67 &le; Fahrenheit &lt; 10.000) para convertila a la otra unidad (Fahrenheit o Celsius).</p>

    <table>
      <tbody>
        <tr>
          <td><strong>Temperatura:</strong></td>
          <td>
            <input type="number" name="temperatura" min="-500" max="10000" step="any" />
            <select name="unidad">
              <option value="c" selected="selected">Celsius</option>
              <option value="f">Fahrenheit</option>
            </select>
          </td>
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
