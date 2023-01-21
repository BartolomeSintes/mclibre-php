<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <title>
    formaction form input. Formularios.
    Ejemplos. PHP. Bartolomé Sintes Marco. www.mclibre.org
  </title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
  <form action="form-input-formaction-2.php" method="get">
    <p>Nombre: <input type="text" name="nombre"></p>

    <p>
      <input type="submit" value="Enviar a 2">
      <input type="submit" value="Enviar a 3" formaction="form-input-formaction-3.php">
    </p>
  </form>
</body>
</html>
