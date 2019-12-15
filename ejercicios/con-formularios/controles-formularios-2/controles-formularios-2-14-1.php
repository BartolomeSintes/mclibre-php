<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <title>
    Datos personales 5 (Formulario).
    Controles en formularios (2). Con formularios.
    Ejercicios. PHP. Bartolomé Sintes Marco. www.mclibre.org
  </title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="mclibre-php-ejercicios.css" title="Color">
</head>

<body>
  <h1>Datos personales 5 (Formulario)</h1>

  <form action="controles-formularios-2-14-2.php" method="get">
    <p>Escriba los datos siguientes:</p>

    <table>
      <tbody>
        <tr>
          <td>
            <label>
              <strong>Nombre:</strong><br>
              <input type="text" name="nombre" size="20" maxlength="20">
            </label>
          </td>
          <td>
            <label>
              <strong>Apellidos:</strong><br>
              <input type="text" name="apellidos" size="20" maxlength="20">
            </label>
          </td>
          <td>
            <strong>Edad:</strong><br>
            <select name="edad">
              <option>...</option>
              <option value="1">Menos de 20 años</option>
              <option value="2">Entre 20 y 39 años</option>
              <option value="3">Entre 40 y 59 años</option>
              <option value="4">60 años o más</option>
            </select>
          </td>
        </tr>
        <tr>
          <td>
            <label>
              <strong>Peso:</strong><br>
              <input type="number" name="peso" min="1" max="250"> kg
            </label>
          </td>
          <td>
            <strong>Sexo:</strong><br>
            <label><input type="radio" name="genero" value="hombre">Hombre</label>
            <label><input type="radio" name="genero" value="mujer">Mujer</label>
          </td>
          <td>
            <strong>Estado Civil:</strong><br>
            <label><input type="radio" name="estadoCivil" value="soltero">Soltero</label>
            <label><input type="radio" name="estadoCivil" value="casado">Casado</label>
            <label><input type="radio" name="estadoCivil" value="otro">Otro</label>
          </td>
        </tr>
      </tbody>
    </table>

    <table style="border-spacing: 5px;">
      <tbody>
        <tr>
          <td rowspan="2" class="borde"><strong>Aficiones:</strong></td>
          <td><label><input type="checkbox" name="cine">Cine</label></td>
          <td><label><input type="checkbox" name="literatura">Literatura</label></td>
          <td><label><input type="checkbox" name="tebeos">Tebeos</label></td>
        </tr>
        <tr>
          <td><label><input type="checkbox" name="deporte">Deporte</label></td>
          <td><label><input type="checkbox" name="musica">Música</label></td>
          <td><label><input type="checkbox" name="television">Televisión</label></td>
        </tr>
      </tbody>
    </table>

    <p>
      <input type="submit" value="Enviar">
      <input type="reset" value="Borrar">
    </p>
  </form>

  <footer>
    <p class="ultmod">
      Última modificación de esta página:
      <time datetime="2019-10-24">24 de octubre de 2019</time>
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
