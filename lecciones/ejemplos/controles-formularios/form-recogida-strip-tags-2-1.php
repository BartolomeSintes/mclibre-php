<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <title>
    Eliminar etiquetas: strip_tags (2). Recogida de datos.
    Ejemplos. PHP. Bartolomé Sintes Marco. www.mclibre.org
  </title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
  <form action="form-recogida-strip-tags-2-2.php" method="get">
    <p>
      Nombre:
      <input type="text" name="nombre" size="52" value="<i>bbb</i> aaa <pepe>Pérez < pepe>Pérez">
    </p>

    <p><input type="submit" value="Enviar"></p>
  </form>
</body>
</html>
