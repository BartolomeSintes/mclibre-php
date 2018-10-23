<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8" />
  <title>Tablas con casillas de verificación (Formulario). foreach (2).
    Ejercicios. Programación web en PHP. Bartolomé Sintes Marco. www.mclibre.org
  </title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" type="text/css" href="mclibre-php-ejercicios.css" title="Color" />
</head>

<body>
  <h1>Tablas con casillas de verificación (Formulario)</h1>

  <form action="foreach-2-2-2.php" method="get">
    <p>Escriba el número de tablas y su tamaño (0 &lt; números &le; 20) y dibujaré
      tablas cuadradas de ese tamaño con casillas de verificación en cada celda.</p>

    <table class="borde">
      <tbody>
        <tr>
          <td><strong>Número de tablas:</strong></td>
          <td><input type="text" name="tablas" size="3" maxlength="3" /></td>
        </tr>
        <tr>
          <td><strong>Tamaño:</strong></td>
          <td><input type="text" name="tamano" size="3" maxlength="3" /></td>
        </tr>
      </tbody>
    </table>

    <p class="der">
      <input type="submit" value="Dibujar" />
      <input type="reset" value="Borrar" />
    </p>
  </form>

  <footer>
    <p class="ultmod">
      Última modificación de esta página:
      <time datetime="2016-10-16">16 de octubre de 2014</time>
    </p>

    <p class="licencia">
      Este programa forma parte del curso <strong><a href="http://www.mclibre.org/consultar/php/">Programación
      web en PHP</a></strong> de <a href="http://www.mclibre.org/" rel="author" >Bartolomé Sintes Marco</a>.<br />
      El programa PHP que genera esta página se distribuye bajo
      <a rel="license" href="http://www.gnu.org/licenses/agpl.txt">licencia AGPL 3 o posterior</a>.
    </p>
  </footer>
</body>
</html>
