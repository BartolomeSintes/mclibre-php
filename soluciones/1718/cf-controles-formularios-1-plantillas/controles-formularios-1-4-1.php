<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8" />
  <title>Fruta preferida 1 (Formulario). Controles en formularios (1).
    Escriba su nombre</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" type="text/css" href="mclibre-php-soluciones.css" title="Color" />
</head>

<body>
  <h1>Fruta preferida 1 (Formulario)</h1>

  <form action="controles-formularios-1-4-2.php" method="get">
    <p>Indique su fruta preferida:<br />
      <label><input type="radio" name="fruta" value="las cerezas" /> Cerezas</label><br />
      <label><input type="radio" name="fruta" value="la fresa" /> Fresas</label><br />
      <label><input type="radio" name="fruta" value="el limón" /> Limón</label><br />
      <label><input type="radio" name="fruta" value="la manzana" /> Manzana</label><br />
      <label><input type="radio" name="fruta" value="la naranja" /> Naranja</label><br />
      <label><input type="radio" name="fruta" value="la pera" /> Pera</label>
    </p>

    <p>
      <input type="submit" value="Enviar" />
      <input type="reset" value="Borrar" />
    </p>
  </form>

  <footer>
    <p>Escriba su nombre</p>
  </footer>
</body>
</html>
