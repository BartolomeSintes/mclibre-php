<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <title>
    Comprobación inputs relacionados. Comprobación de datos.
    Ejemplos. PHP. Bartolomé Sintes Marco. www.mclibre.org
  </title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
  <form action="form-recogida-input-relacionados-2.php" method="get">
    <p>
        Operación:
        <input type="radio" name="operacion" value="suma"> Suma
        <input type="radio" name="operacion" value="resta"> Resta
        <input type="radio" name="operacion" value="multiplicacion"> Multiplicación
        <input type="radio" name="operacion" value="division"> División
    </p>

    <p>
        Números:
        <input type="text" name="x">
        <input type="text" name="y">
    </p>

    <p>
        <input type="submit" value="Enviar">
        <input type="reset">
    </p>
  </form>
</body>
</html>
