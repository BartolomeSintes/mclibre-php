<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <title>Su cambio (Formulario).
    Selección (1). Con formularios.
    Ejercicios. PHP. Bartolomé Sintes Marco. www.mclibre.org
  </title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="mclibre-php-ejercicios.css" title="Color">
</head>

<body>
  <h1>Su cambio (Formulario)</h1>

  <form action="seleccion-1-1-2.php" method="get">
    <p>Indique la cantidad a pagar y los billetes entregados.</p>

    <table>
      <tbody>
        <tr>
          <td><strong>Cantidad a pagar:</strong></td>
          <td><input type="number" name="deuda" min="0" step="100" value="1000"></td>
        </tr>
        <tr>
          <td><strong>Billetes de 200:</strong></td>
          <td><input type="number" name="b200" min="0"></td>
        </tr>
        <tr>
          <td><strong>Billetes de 100:</strong></td>
          <td>
            <select name="b100">
              <option>0</option>
              <option>1</option>
              <option>2</option>
              <option>3</option>
            </select>
          </td>
        </tr>
      </tbody>
    </table>

    <p>
      <input type="submit" value="Mostrar">
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
