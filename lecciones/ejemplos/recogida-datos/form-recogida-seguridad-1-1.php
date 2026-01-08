<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <title>
    Seguridad en las entradas (1). Recogida de datos.
    Ejemplos. PHP. Bartolomé Sintes Marco. www.mclibre.org
  </title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
  <form action="form-recogida-seguridad-1-2.php" method="get">
    <p>
      Nombre:
      <input type="text" name="nombre" size="52" value="<a href='https://mclibre.org' target='blank'>Pepito Conejo</a>" readonly>
    </p>

    <p><input type="submit" value="Enviar"></p>
  </form>
</body>
</html>
