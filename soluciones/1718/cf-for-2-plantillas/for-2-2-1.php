<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8" />
  <title>Segmentos (Formulario). for (2).
    Escriba su nombre</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" type="text/css" href="mclibre-php-ejercicios.css" title="Color" />
</head>

<body>
  <h1>Segmentos (Formulario)</h1>

  <form action="for-2-2-2.php" method="get">
    <p>Escriba el tamaño de cada segmento (4 &lt; tamaño &le; 8) y el
      número de segmentos (1 &lt; franjas &le; 6) y dibujaré esos segmentos.</p>

    <table>
      <tbody>
        <tr>
          <td><strong>Tamaño:</strong></td>
          <td><input type="number" name="tamano" min="5" max="8" value="5" /></td>
        </tr>
        <tr>
          <td><strong>Número de segmentos:</strong></td>
          <td><input type="number" name="segmentos" min="2" max="6" value="3" /></td>
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

