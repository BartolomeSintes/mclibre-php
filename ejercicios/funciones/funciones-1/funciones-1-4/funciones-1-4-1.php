<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <title>
    Convertidor de distancias y tiempos. Sin funciones (Formulario).
    Funciones (1). Funciones.
    Ejercicios. PHP. Bartolomé Sintes Marco. www.mclibre.org
  </title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="mclibre-php-ejercicios.css" title="Color">
</head>

<body>
  <h1>Convertidor de distancias y tiempos Sin funciones (Formulario)</h1>

  <form action="funciones-1-4-2.php" method="get">
    <p>
      Quiero convertir:
      <input type="number" name="numero" size="40">
      <select name="inicial">
        <optgroup label="Sistema métrico">
          <option value="km">km</option>
          <option value="m">m</option>
          <option value="cm">cm</option>
        </optgroup>
        <optgroup label="Tiempo">
          <option value="h">horas</option>
          <option value="min">minutos</option>
          <option value="s">segundos</option>
         </optgroup>
      </select>
      a
      <select name="final">
        <optgroup label="Sistema métrico">
          <option value="km">km</option>
          <option value="m">m</option>
          <option value="cm">cm</option>
        </optgroup>
        <optgroup label="Tiempo">
          <option value="h">horas</option>
          <option value="min">minutos</option>
          <option value="s">segundos</option>
         </optgroup>
      </select>
    </p>

    <p>
      <input type="submit" value="Convertir">
      <input type="reset" value="Borrar">
    </p>
  </form>

  <footer>
    <p class="ultmod">
      Última modificación de esta página:
      <time datetime="2018-12-09">9 de diciembre de 2018</time>
    </p>

    <p class="licencia">
      Este programa forma parte del curso <strong><a href="https://www.mclibre.org/consultar/php/">Programación
      web en PHP</a></strong> de <a href="https://www.mclibre.org/" rel="author">Bartolomé Sintes Marco</a>.<br>
      El programa PHP que genera esta página se distribuye bajo
      <a rel="license" href="http://www.gnu.org/licenses/agpl.txt">licencia AGPL 3 o posterior</a>.
    </p>
  </footer>
</body>
</html>
