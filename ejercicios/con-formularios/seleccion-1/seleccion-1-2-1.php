<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <title>Camisetas (Formulario).
    Selección (1). Con formularios.
    Ejercicios. PHP. Bartolomé Sintes Marco. www.mclibre.org
  </title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="mclibre-php-ejercicios.css" title="Color">
</head>

<body>
  <h1>Camisetas (Formulario)</h1>

  <p>Configure su camiseta:</p>

  <form action="seleccion-1-2-2.php" method="get">
    <p>Color de la camiseta: <input type="color" name="color" value="#9FE4A9"></p>

    <p>
      Sexo:
      <label><input type="radio" name="genero" value="h"> Hombre</label> -
      <label><input type="radio" name="genero" value="m"> Mujer</label>
    </p>

    <p>Texto (9 letras y espacios): <input type="text" name="texto" size="12"></p>

    <p>
      <input type="submit" value="Enviar">
      <input type="reset" value="Borrar">
    </p>
  </form>

  <footer>
    <p class="ultmod">
      Última modificación de esta página:
      <time datetime="2025-01-09">9 de enero de 2025</time>
    </p>

    <p class="licencia">
      Este programa forma parte del curso <strong><a href="http://www.mclibre.org/consultar/php/">Programación
      web en PHP</a></strong> de <a href="http://www.mclibre.org/" rel="author" >Bartolomé Sintes Marco</a>.<br>
      El programa PHP que genera esta página se distribuye bajo
      <a rel="license" href="http://www.gnu.org/licenses/agpl.txt">licencia AGPL 3 o posterior</a>.
    </p>
  </footer>
</body>
</html>
