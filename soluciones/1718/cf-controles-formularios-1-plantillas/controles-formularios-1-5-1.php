<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8" />
  <title>Fruta preferida 2 (Formulario). Controles en formularios (1).
    Escribe tu nombre</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link href="mclibre-php-soluciones.css" rel="stylesheet" type="text/css" title="Color" />
</head>

<body>
  <h1>Fruta preferida 2 (Formulario)</h1>

  <form action="controles-formularios-1-5-2.php" method="get">
    <p>Indique su fruta preferida:<br />
      <label><input type="radio" name="fruta" value="cerezas.svg" /> Cerezas</label><br />
      <label><input type="radio" name="fruta" value="fresa.svg" /> Fresas</label><br />
      <label><input type="radio" name="fruta" value="limon.svg" /> Limón</label><br />
      <label><input type="radio" name="fruta" value="manzana.svg" /> Manzana</label><br />
      <label><input type="radio" name="fruta" value="naranja.svg" /> Naranja</label><br />
      <label><input type="radio" name="fruta" value="pera.svg" /> Pera</label>
    </p>

    <p>
      <input type="submit" value="Enviar" />
      <input type="reset" value="Borrar" />
    </p>
  </form>

  <footer>
    <p>Escribe tu nombre</p>
  </footer>
</body>
</html>
