<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8" />
  <title>Ejemplo de de recogida y comprobación de datos (Formulario). Ejemplo de ejercicio.
    Ejercicios. Programación web en PHP. Bartolomé Sintes Marco</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link href="mclibre-php-soluciones.css" rel="stylesheet" type="text/css" title="Color" />
</head>

<body>
  <h1>Ejemplo de recogida y comprobación de datos (Formulario)</h1>

  <form action="ejemplo-recogida-datos-2-2.php" method="get">
    <table>
      <tbody>
        <tr>
          <td>Escriba su nombre:</td>
          <td><input type="text" name="nombre" size="20" maxlength="20" /> </td>
        </tr>
        <tr>
          <td>Escriba su edad:</td>
          <td><input type="number" name="edad" min="1" max="120" /> años</td>
        </tr>
      </tbody>
    </table>

    <p>Es mayor de edad y acepta las condiciones:
      <input type="radio" name="acepto" value="Sí" /> Sí
      <input type="radio" name="acepto" value="No" /> No
    </p>

    <p>
      <input type="submit" value="Enviar" />
      <input type="reset" value="Borrar" />
    </p>
  </form>

  <footer>
    <p class="ultmod">
      Última modificación de esta página:
      <time datetime="2017-09-20">27 de septiembre de 2017</time></p>

    <p class="licencia">
      Este programa forma parte del curso <a href="http://www.mclibre.org/consultar/php/">
      Programación web en PHP</a> por <a href="http://www.mclibre.org/">Bartolomé
      Sintes Marco</a>.<br />
      El programa PHP que genera esta página está bajo
      <a rel="license" href="http://www.gnu.org/licenses/agpl.txt">licencia AGPL 3 o posterior</a>.</p>
  </footer>
</body>
</html>
