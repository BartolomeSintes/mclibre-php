<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <title>
    form (1). Formularios.
    Ejemplos. PHP. Bartolomé Sintes Marco. www.mclibre.org
  </title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <style> h1 { margin: 0; }</style>
</head>

<body>
  <h1>Formulario</h1>
  <form action="form-1-2.php" method="get">
    <p>Nombre: <input type="text" name="nombre"></p>

    <p>
      Curso:
      <input type="radio" name="curso" value="Primero"> 1º
      <input type="radio" name="curso" value="Segundo"> 2º
    </p>

    <p>
        <input type="submit" value="Enviar">
        <input type="reset">
    </p>
  </form>
</body>
</html>
