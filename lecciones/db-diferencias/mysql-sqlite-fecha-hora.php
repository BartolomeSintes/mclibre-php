<?php
/**
 * Diferencias entre MySQL y SQLite - mysql-sqlite-fecha-hora.php
 *
 * @author    Bartolomé Sintes Marco <bartolome.sintes+mclibre@gmail.com>
 * @copyright 2010 Bartolomé Sintes Marco
 * @license   http://www.gnu.org/licenses/agpl.txt AGPL 3 or later
 * @version   2010-04-20
 * @link      https://www.mclibre.org
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

define("MYSQL",     "MySQL");
define("SQLITE",    "SQLite");
define("TAM_FECHA", 10);                        // Tamaño del campo Fecha
define("MYSQL_HOST", "mysql:host=localhost");   // Nombre de host MYSQL
define("MYSQL_USER",    "root");                // Nombre de usuario de MySQL
define("MYSQL_PASSWORD", "");                   // Contraseña de usuario de MySQL

function conectaDb()
{
    global $dbMotor, $dbDb;

    try {
        if ($dbMotor == MYSQL) {
            $db = new PDO(MYSQL_HOST, MYSQL_USER, MYSQL_PASSWORD);
            $db->setAttribute(PDO::MYSQL_ATTR_USE_BUFFERED_QUERY, true);
        } elseif ($dbMotor == SQLITE) {
            $db = new PDO("sqlite:$dbDb");
        }
        return $db;
    } catch (PDOException $e) {
        print "          <li>Error: No puede conectarse con la base de datos.</li>\n";
        print "          <li>Error: " . $e->getMessage() . "</li>\n";
        print "        </ol>\n";
    }
}

function borraTodoMySQL($db)
{
    global $dbDb, $dbTabla;

    print "<li>Borrado y creación de tabla en MySQL:\n";
    print "  <ul>\n";
    $consulta = "DROP DATABASE $dbDb";
    if ($db->query($consulta)) {
        print "           <li>Base de datos borrada correctamente.</li>\n";
    } else {
        print "           <li>Error al borrar la base de datos.</li>\n";
    }
    $consulta = "CREATE DATABASE $dbDb";
    if ($db->query($consulta)) {
        print "           <li>Base de datos creada correctamente.</li>\n";
        $consultaCreaTabla = "CREATE TABLE $dbTabla (
            id INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
            fecha DATE,
            PRIMARY KEY(id)
            )";
        if ($db->query($consultaCreaTabla)) {
            print "            <li>Tabla creada correctamente.</li>\n";
        } else {
            print "            <li>Error al crear la tabla.</li>\n";
        }
    } else {
        print "            <li>Error al crear la base de datos.</li>\n";
    }
    print "          </ul>\n";
    print "        </li>\n";
}

function borraTodoSqlite($db)
{
    global $dbDb, $dbTabla;

    print "          <li>Borrado y creación de tabla en SQLite:\n";
    print "            <ul>\n";
    $consulta = "DROP TABLE $dbTabla";
    if ($db->query($consulta)) {
        print "              <li>Tabla borrada correctamente.</li>\n";
    } else {
        print "              <li>Error al borrar la tabla.</li>\n";
    }
    $consultaCreaTabla = "CREATE TABLE $dbTabla (
        id INTEGER PRIMARY KEY,
        fecha DATE
        )";
    if ($db->query($consultaCreaTabla)) {
        print "              <li>Tabla creada correctamente.</li>\n";
    } else {
        print "              <li>Error al crear la tabla de Préstamos.</li>\n";
    }
    print "            </ul>\n";
    print "          </li>\n";
}

function pruebaDb() {

    global $dbMotor, $db, $dbTabla;

    // Inserción de registro
    print "          <li>Inserción de fechas:\n";
    print "            <ul>\n";

    $fecha = date("Y-m-d");
    print "              <li>Fecha a insertar: $fecha</li>\n";
    $consulta = "INSERT INTO $dbTabla
        VALUES (NULL, '$fecha')";
    if ($db->query($consulta)) {
        print "              <li>Registro creado correctamente.</li>\n";
    } else {
        print "              <li>Error al crear el registro.<li>\n";
    }
    $fecha = "";
    print "              <li>Fecha a insertar: $fecha</li>\n";
    $consulta = "INSERT INTO $dbTabla
        VALUES (NULL, '$fecha')";
    if ($db->query($consulta)) {
        print "              <li>Registro creado correctamente.</li>\n";
    } else {
        print "              <li>Error al crear el registro.<li>\n";
    }

    print "            </ul>\n";
    print "          </li>\n";

    print "          <li>Recuperación de fecha:\n";
    print "            <ul>\n";
    $consulta = "SELECT COUNT(*) FROM $dbTabla";
    $result = $db->query($consulta);
    if (!$result) {
        print "              <li>Error en la consulta.</li>\n";
    } elseif ($result->fetchColumn() == 0) {
        print "              <li>No se ha creado todavía ningún registro.</li>\n";
    } else {
        $consulta = "SELECT * FROM $dbTabla";
        $result = $db->query($consulta);
        if (!$result) {
            print "              <li>Error en la consulta.</li>\n";
        } else {
            foreach ($result as $valor) {
                print "              <li>Fecha insertada: $valor[fecha]</li>\n";
            }
        }
    }
    print "            </ul>\n";
    print "          </li>\n";

    print "        </ol>\n";
}

print "<!DOCTYPE html>\n";
print "<html lang=\"es\">\n";
print "<head>\n";
print "  <meta charset=\"utf-8\">\n";
print "  <title>\n";
print "    Diferencias entre MySQL y SQLite - Fecha.\n";
print "    PHP. Bartolomé Sintes Marco. www.mclibre.org\n";
print "  </title>\n";
print "  <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">\n";
print "  <link rel=\"stylesheet\" href=\"mclibre-php-ejercicios.css\" title=\"Color\">\n";
print "</head>\n";
print "\n";
print "<body>\n";
print "  <h1>Diferencias entre MySQL y SQLite - Fecha</h1>\n";
print "\n";
print "  <p>Este programa prueba el amacenamiento de fechas en SQLite y MySQL</p>\n";
print "\n";

// Prueba con SQLite
print "  <table>\n";
print "    <tr>\n";
print "      <td>\n";
print "        <h2>SQLite</h2>\n";
$dbMotor = SQLITE;
$dbDb    = "/tmp/mclibre_db-diferencias.sqlite";  // Nombre de la base de datos
$dbTabla = "fecha";             // Nombre de la tabla
print "        <ol>\n";
$db = conectaDb();
borraTodoSqlite($db);
pruebaDB();
print "      </td>\n";
print "      <td>\n";

// Prueba con MySQL
print "        <h2>MySQL</h2>\n";
$dbMotor = MYSQL;
$dbDb    = "mclibre_db-diferencias";     // Nombre de la base de datos
$dbTabla = $dbDb . ".fecha";      // Nombre de la tabla
print "        <ol>\n";
$db = conectaDb();
if ($db) {
    borraTodoMySQL($db);
    pruebaDB();
}
print "      </td>\n";
print "    </tr>\n";
print "  </table>\n";
print "\n";

print "  <footer>\n";
print "    <p class=\"ultmod\">\n";
print "      Última modificación de esta página:\n";
print "      <time datetime=\"2010-04-20\">20 de abril de 2010</time>\n";
print "    </p>\n";
print "\n";
print "    <p class=\"licencia\">\n";
print "      Este programa forma parte del curso <strong><a href=\"https://www.mclibre.org/consultar/php/\">Programación \n";
print "      web en PHP</a></strong> de <a href=\"https://www.mclibre.org/\" rel=\"author\">Bartolomé Sintes Marco</a>.<br>\n";
print "      El programa PHP que genera esta página se distribuye bajo \n";
print "      <a rel=\"license\" href=\"http://www.gnu.org/licenses/agpl.txt\">licencia AGPL 3 o posterior</a>.\n";
print "    </p>\n";
print "  </footer>\n";
print "</body>\n";
print "</html>\n";
?>
