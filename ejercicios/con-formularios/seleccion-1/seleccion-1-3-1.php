<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <title>Puntos en cuadrantes (Formulario).
    Selección (1). Con formularios.
    Ejercicios. PHP. Bartolomé Sintes Marco. www.mclibre.org
  </title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="mclibre-php-ejercicios.css" title="Color">
</head>

<body>
  <h1>Puntos en cuadrantes (Formulario)</h1>

  <form action="seleccion-1-3-2.php" method="get">
    <p>Elija el número de puntos y el cuadrante a considerar.</p>

    <table>
      <tbody>
        <tr>
          <td><strong>Número de puntos:</strong></td>
          <td><input type="number" name="cantidad" min="3" max="12" value="7">
        </tr>
        <tr>
          <td><strong>Cuadrante:</strong></td>
          <td>
            <select name="cuadrante">
              <option>Arriba a la derecha</option>
              <option>Abajo a la derecha</option>
              <option>Abajo a la izquierda</option>
              <option>Arriba a la izquierda</option>
            </select>
          </td>
        </tr>
      </tbody>
    </table>

    <p>
      <input type="submit" value="Dibujar">
      <input type="reset" value="Borrar">
    </p>
  </form>

  <footer>
    <p class="ultmod">
      Última modificación de esta página:
      <time datetime="2025-02-08">8 de febrero de 2025</time>
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
