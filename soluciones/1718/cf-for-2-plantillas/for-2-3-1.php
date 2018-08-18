<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8" />
  <title>Dos cuadrados (Formulario). for (2).
    Escriba su nombre</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" type="text/css" href="mclibre-php-ejercicios.css" title="Color" />
</head>

<body>
  <h1>Dos cuadrados (Formulario)</h1>

  <form action="for-2-3-2.php" method="get">
    <p>Escriba el tamaño de los cuadrados (1 &le; números &le; 15) y dibujaré dos cuadrados.</p>

    <table>
      <tbody>
        <tr>
          <td><strong>Tamaño:</strong></td>
          <td><input type="number" name="tamano" min="1" max="15" value="5" /></td>
        </tr>
      </tbody>
    </table>

    <p>
      <input type="submit" value="Dibujar" />
      <input type="reset" value="Borrar" />
    </p>
  </form>

  <footer>
    <p>Escriba su nombre</p>
  </footer>
</body>
</html>

