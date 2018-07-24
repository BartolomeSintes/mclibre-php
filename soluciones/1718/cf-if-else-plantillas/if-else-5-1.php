<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8" />
  <title>Calculadora de años bisiestos (Formulario). if ... elseif ... else ...
    Escribe tu nombre</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link href="mclibre-php-soluciones.css" rel="stylesheet" type="text/css" title="Color" />
</head>

<body>
  <h1>Calculadora de años bisiestos (Formulario)</h1>

  <form action="if-else-5-2.php" method="get">
    <p>Escriba un año (0 &le; año &lt; 10.000) para comprobar si es bisiesto o no.</p>

    <table>
      <tbody>
        <tr>
          <td><strong>Año:</strong></td>
          <td><input type="number" name="anyo" min="0" max="10000" /></td>
        </tr>
      </tbody>
    </table>

    <p>
      <input type="submit" value="Comprobar" />
      <input type="reset" value="Borrar" />
    </p>
  </form>

  <footer>
    <p>Escribe tu nombre</p>
  </footer>
</body>
</html>
