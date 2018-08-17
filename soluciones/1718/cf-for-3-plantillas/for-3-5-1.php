<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8" />
  <title>Tabla de multiplicar (Formulario). for (3).
    Escriba su nombre</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" type="text/css" href="mclibre-php-soluciones.css" title="Color" />
</head>

<body>
  <h1>Tabla de multiplicar (Formulario)</h1>

  <form action="for-3-5-2.php" method="get">
    <p>Escriba el número de filas y columnas (0 &lt; número &le; 100) y su tamaño
      (30 &le; altura &le; 100; 50 &le; anchura &le; 100) y mostraré la tabla de
      multiplicar hasta esos valores.</p>

    <table>
      <tbody>
        <tr>
          <td><strong>Número de filas:</strong></td>
          <td><input type="number" name="filas" min="1" max="100" value="5" /></td>
          <td><strong>Altura:</strong></td>
          <td><input type="number" name="altura" min="30" max="100" value="50" /> px</td>
        </tr>
        <tr>
          <td><strong>Número de columnas:</strong></td>
          <td><input type="number" name="columnas" min="1" max="100" value="10" /></td>
          <td><strong>Anchura:</strong></td>
          <td><input type="number" name="anchura" min="30" max="100" value="70"  /> px</td>
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
