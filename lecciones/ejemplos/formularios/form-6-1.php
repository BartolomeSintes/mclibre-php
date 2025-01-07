<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <title>
    form (6). Formularios.
    Ejemplos. PHP. Bartolomé Sintes Marco. www.mclibre.org
  </title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
  <form action="form-6-2.php" method="get">
    <p>Nombre: <input type="text" name="nombre"></p>

    <p>Edad: <input type="number" name="1"></p>

    <p>
      Aficiones:
      <input type="checkbox" name="aficion[1]"> Deporte
      <input type="checkbox" name="aficion[2]"> Lectura
    </p>

    <p><input type="submit" value="Enviar"></p>
  </form>
</body>
</html>
