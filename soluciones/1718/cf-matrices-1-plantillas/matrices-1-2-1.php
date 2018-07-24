<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8" />
  <title>Matrices 2 (Formulario). Matrices (1).
    Escribe tu nombre</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link href="mclibre-php-soluciones.css" rel="stylesheet" type="text/css" title="Color" />
</head>

<body>
  <h1>Matrices 2 (Formulario)</h1>

  <form action="matrices-1-2-2.php" method="get">
    <p>Indique el rango del número de valores y el rango de los valores y
      mostraré un numero aleatorio de valores aleatorios en los rangos indicados.</p>

    <table>
      <tbody>
        <tr>
          <td>Número mínimo de valores:</td>
          <td><input type="number" name="numeroMinimo" min="1" value="10" /></td>
        </tr>
        <tr>
          <td>Número máximo de valores:</td>
          <td><input type="number" name="numeroMaximo" min="1" value="20" /></td>
        </tr>
        <tr>
          <td>Valor mínimo:</td>
          <td><input type="number" name="valorMinimo" min="0" value="0" /></td>
        </tr>
        <tr>
          <td>Valor máximo:</td>
          <td><input type="number" name="valorMaximo" min="0" value="100" /></td>
        </tr>
      </tbody>
    </table>

    <p>
      <input type="submit" value="Mostrar" />
      <input type="reset" value="Borrar" />
    </p>
  </form>

  <footer>
    <p>Escribe tu nombre</p>
  </footer>
</body>
</html>
