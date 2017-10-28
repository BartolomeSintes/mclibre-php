<?php
/**
 * Diferencias entre MySQL y SQLite - mysql-sqlite-fecha-hora.php
 *
 * @author    Bartolomé Sintes Marco <bartolome.sintes+mclibre@gmail.com>
 * @copyright 2010 Bartolomé Sintes Marco
 * @license   http://www.gnu.org/licenses/agpl.txt AGPL 3 or later
 * @version   2010-04-20
 * @link      http://www.mclibre.org
 *
 *  This program is free software: you can redistribute it and/or modify
 *  it under the terms of the GNU Affero General Public License as published by
 *  the Free Software Foundation, either version 3 of the License, or
 *  any later version.
 *
 *  This program is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU Affero General Public License for more details.
 *
 *  You should have received a copy of the GNU Affero General Public License
 *  along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */

define('MYSQL',     'MySQL');
define('SQLITE',    'SQLite');
define('TAM_FECHA', 10);                        // Tamaño del campo Fecha
define('MYSQL_HOST', 'mysql:host=localhost');   // Nombre de host MYSQL
define('MYSQL_USUARIO', 'root');                // Nombre de usuario de MySQL
define('MYSQL_PASSWORD', "");                   // Contraseña de usuario de MySQL

function conectaDb()
{
    global $dbMotor, $dbDb;

    try {
        if ($dbMotor==MYSQL) {
            $db = new PDO(MYSQL_HOST, MYSQL_USUARIO, MYSQL_PASSWORD);
            $db->setAttribute(PDO::MYSQL_ATTR_USE_BUFFERED_QUERY, true);
        } elseif ($dbMotor==SQLITE) {
            $db = new PDO('sqlite:'.$dbDb);
        }
        return($db);
    } catch (PDOException $e) {
        print "  <li>Error: No puede conectarse con la base de datos.</li>\n";
        print "  <li>Error: " . $e->getMessage() . "</li>\n";
        print "</ol>\n";
    }
}

function borraTodoMySQL($db)
{
    global $dbDb, $dbTabla;

    print "<li>Borrado y creación de tabla en MySQL:\n  <ul>\n";
    $consulta = "DROP DATABASE $dbDb";
    if ($db->query($consulta)) {
        print "    <li>Base de datos borrada correctamente.</li>\n";
    } else {
        print "    <li>Error al borrar la base de datos.</li>\n";
    }
    $consulta = "CREATE DATABASE $dbDb";
    if ($db->query($consulta)) {
        print "    <li>Base de datos creada correctamente.</li>\n";
        $consultaCreaTabla = "CREATE TABLE $dbTabla (
            id INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
            fecha DATE,
            PRIMARY KEY(id)
            )";
        if ($db->query($consultaCreaTabla)) {
            print "    <li>Tabla creada correctamente.</li>\n";
        } else {
            print "    <li>Error al crear la tabla.</li>\n";
        }
    } else {
        print "    <li>Error al crear la base de datos.</li>\n";
    }
    print "  </ul>\n</li>\n";
}

function borraTodoSqlite($db)
{
    global $dbDb, $dbTabla;

    print "<li>Borrado y creación de tabla en SQLite:\n  <ul>\n";
    $consulta = "DROP TABLE $dbTabla";
    if ($db->query($consulta)) {
        print "    <li>Tabla borrada correctamente.</li>\n";
    } else {
        print "    <li>Error al borrar la tabla.</li>\n";
    }
    $consultaCreaTabla = "CREATE TABLE $dbTabla (
        id INTEGER PRIMARY KEY,
        fecha DATE
        )";
    if ($db->query($consultaCreaTabla)) {
        print "    <li>Tabla creada correctamente.</li>\n";
    } else {
        print "    <li>Error al crear la tabla de Préstamos.</li>\n";
    }
    print "  </ul>\n</li>\n";
}

function pruebaDb() {

    global $dbMotor, $db, $dbTabla;

    // Inserción de registro
    print "<li>Inserción de fechas:\n  <ul>\n";

    $fecha = date('Y-m-d');
    print "    <li>Fecha a insertar: $fecha</li>\n";
    $consulta = "INSERT INTO $dbTabla
        VALUES (NULL, '$fecha')";
    if ($db->query($consulta)) {
        print "    <li>Registro creado correctamente.</li>\n";
    } else {
        print "    <li>Error al crear el registro.<li>\n";
    }
    $fecha = "";
    print "    <li>Fecha a insertar: $fecha</li>\n";
    $consulta = "INSERT INTO $dbTabla
        VALUES (NULL, '$fecha')";
    if ($db->query($consulta)) {
        print "    <li>Registro creado correctamente.</li>\n";
    } else {
        print "    <li>Error al crear el registro.<li>\n";
    }

    print "  </ul>\n</li>\n";

    print "<li>Recuperación de fecha:\n  <ul>\n";
    $consulta = "SELECT COUNT(*) FROM $dbTabla";
    $result = $db->query($consulta);
    if (!$result) {
        print "    <li>Error en la consulta.</li>\n";
    } elseif ($result->fetchColumn()==0) {
        print "    <li>No se ha creado todavía ningún registro.</li>\n";
    } else {
        $consulta = "SELECT * FROM $dbTabla";
        $result = $db->query($consulta);
        if (!$result) {
            print "    <li>Error en la consulta.</li>\n";
        } else {
            foreach ($result as $valor) {
                print "    <li>Fecha insertada: $valor[fecha]</li>\n";
            }
        }
    }
    print "  </ul>\n</li>\n";

    print "</ol>\n";
}

print "<?xml version=\"1.0\" encoding=\"utf-8\"?>
<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Strict//EN\"
       \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd\">
<html xmlns=\"http://www.w3.org/1999/xhtml\">
<head>
  <meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />
  <title>www.mclibre.org - Diferencias entre MySQL y SQLite - Fecha</title>
  <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\" />
  <link href=\"mclibre-php-soluciones.css\" rel=\"stylesheet\" type=\"text/css\" />
</head>

<body>
<h1>Diferencias entre MySQL y SQLite - Fecha</h1>
<div id=\"contenido\">\n";

print "<p>Este programa prueba el amacenamiento de fechas en SQLite y MySQL</p>\n";

// Prueba con SQLite
print "<table>\n  <tr>\n    <td>\n";
print "<h2>SQLite</h2>\n";
$dbMotor = SQLITE;
$dbDb     = '/home/barto/mclibre/tmp/mclibre/mclibre_db-diferencias.sqlite';  // Nombre de la base de datos
$dbTabla = 'fecha';             // Nombre de la tabla
print "<ol>\n";
$db = conectaDb();
borraTodoSqlite($db);
pruebaDB();
print "    </td>\n    <td>\n";

// Prueba con MySQL
print "<h2>MySQL</h2>\n";
$dbMotor = MYSQL;
$dbDb     = 'mclibre_db-diferencias';     // Nombre de la base de datos
$dbTabla = $dbDb.'.fecha';      // Nombre de la tabla
print "<ol>\n";
$db = conectaDb();
if ($db) {
    borraTodoMySQL($db);
    pruebaDB();
}
print "    </td>\n  </tr>\n</table>\n";

print '</div>

<div id="pie">
<address>
  Este programa forma parte del curso "Páginas web con PHP" disponible en <a
  href="http://www.mclibre.org/">http://www.mclibre.org</a><br />
  Autor: Bartolomé Sintes Marco<br />
  Última modificación de este programa: 20 de abril de 2010
</address>
<p class="licencia">El programa PHP que genera esta página está bajo
<a rel="license" href="http://www.gnu.org/licenses/agpl.txt">licencia AGPL 3 o
posterior</a>.</p>
</div>
</body>
</html>';

?>
