<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8" />
  <title>Tabla de multiplicar con cabecera (Formulario). for (3).
    Escriba su nombre</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" type="text/css" href="mclibre-php-soluciones.css" title="Color" />
</head>

<body>
  <h1>Tabla de multiplicar con cabecera (Formulario)</h1>

  <form action="for-3-4-2.php" method="get">
    <p>Escriba un número (0 &lt; número &le; 100) y mostraré la tabla de
      multiplicar hasta ese número.</p>

    <table>
      <tbody>
        <tr>
          <td><strong>Número:</strong></td>
          <td><input type="number" name="numero" min="1" max="100" value="10" /></td>
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
