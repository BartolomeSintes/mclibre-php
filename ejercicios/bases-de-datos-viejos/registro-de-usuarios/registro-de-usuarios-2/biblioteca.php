<?php
/**
 * Registro de usuarios 2 - biblioteca.php
 *
 * @author    Bartolomé Sintes Marco <bartolome.sintes+mclibre@gmail.com>
 * @copyright 2013 Bartolomé Sintes Marco
 * @license   http://www.gnu.org/licenses/agpl.txt AGPL 3 or later
 * @version   2013-03-10
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

define("FORM_METHOD",         "get");  // Formularios se envían con GET
//define("FORM_METHOD",         "post"); // Formularios se envían con POST
define("MYSQL",               "MySQL");
define("SQLITE",              "SQLite");

define("MENU_PRINCIPAL",      "menuPrincipal");    // Menú principal
define("MENU_VOLVER",         "menuVolver");       // Menú Volver a inicio
define("MENU_IDENTIFICADO",   "menuIdentificado"); // Menú Usuario idetificado
define("MAX_REG_USUARIOS",    20);     // Número máximo de registros en la tabla Usuarios

$tamUsuario        = 20;  // Tamaño del campo Usuarios > Usuario
$tamPassword       = 20;  // Tamaño del campo Usuarios > Contraseña
$tamCifrado        = 32;  // Tamaño del campo Usuarios > Contraseña en MD5
$tamMaxRegUsuarios = 20;  // Número máximo de registros en la tabla Usuarios

$administradorNombre   = "root";  // Nombre del usuario Administrador
$administradorPassword = "root";  // Password del usuario Administrador
// Si $administradorPassword != "", al crearse las tablas, se crea el usuario
// Si $administradorPassword == "", no se crea el usuario
// Lo he hecho para que en el ejemplo colgado en la web la gente pueda entrar
// como Administrador

$dbMotor = SQLITE;                         // Base de datos empleada
if ($dbMotor == MYSQL) {
    define("MYSQL_HOST",     "mysql:host=localhost"); // Nombre de host MYSQL
    define("MYSQL_USER",     "root");      // Nombre de usuario de MySQL
    define("MYSQL_PASSWORD", "");          // Contraseña de usuario de MySQL
    $dbDb       = "mclibre_registrousuarios";  // Nombre de la base de datos
    $dbUsuarios = $dbDb . ".usuarios";      // Nombre de la tabla de Usuarios
} elseif ($dbMotor == SQLITE) {
    $dbDb       = "/tmp/mclibre_registrousuarios_2.sqlite";  // Nombre de la base de datos
    $dbUsuarios = "usuarios";             // Nombre de la tabla de Usuarios
}

$recorta = [
    "usuario"   => $tamUsuario,
    "password"  => $tamPassword
];

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
        cabecera("Error grave", MENU_PRINCIPAL);
        print "    <p>Error: No puede conectarse con la base de datos.</p>\n";
        print "\n";
        print "    <p>Error: " . $e->getMessage() . "</p>\n";
        print "\n";
        pie();
        exit;
    }
}

function recorta($campo, $cadena)
{
    global $recorta;

    $tmp = isset($recorta[$campo])
        ? substr($cadena, 0, $recorta[$campo])
        : $cadena;
    return $tmp;
}

// Función de recogida de datos
function recoge($key, $type = "")
{
    if (!is_string($key) && !is_int($key) || $key == "") {
        trigger_error("Function recoge(): Argument #1 (\$key) must be a non-empty string or an integer", E_USER_ERROR);
    } elseif ($type !== "" && $type !== []) {
        trigger_error("Function recoge(): Argument #2 (\$type) is optional, but if provided, it must be an empty array or an empty string", E_USER_ERROR);
    }
    $tmp = $type;
    if (isset($_REQUEST[$key])) {
        if (!is_array($_REQUEST[$key]) && !is_array($type)) {
            $tmp = trim(htmlspecialchars($_REQUEST[$key]));
        } elseif (is_array($_REQUEST[$key]) && is_array($type)) {
            $tmp = $_REQUEST[$key];
            array_walk_recursive($tmp, function (&$value) {
                $value = trim(htmlspecialchars($value));
            });
        }
    }
    return $tmp;
}

function cabecera($texto, $menu=MENU_PRINCIPAL)
{
    print "<!DOCTYPE html>\n";
    print "<html lang=\"es\">\n";
    print "<head>\n";
    print "  <meta charset=\"utf-8\">\n";
    print "  <title>Registro de usuarios 2. $texto.\n";
    print "    Ejercicios. PHP. Bartolomé Sintes Marco. www.mclibre.org</title>\n";
    print "  <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">\n";
    print "  <link rel=\"stylesheet\" href=\"mclibre-php-proyectos.css\" title=\"Color\">\n";
    print "</head>\n";
    print "\n";
    print "<body>\n";
    print "  <h1>Registro de usuarios - $texto</h1>\n";
    print "\n";
    print "  <nav>\n";
    print "    <ul>\n";
    if ($menu == MENU_PRINCIPAL) {
        print "      <li><a href=\"conectar-1.php\">Conectarse</a></li>\n";
        print "      <li><a href=\"registrar-1.php\">Registrar nuevo usuario</a></li>\n";
        print "      <li><a href=\"borrar-todo-1.php\">Borrar todo</a></li>\n";
    } elseif ($menu == MENU_IDENTIFICADO) {
        print "      <li><a href=\"desconectar.php\">Desconectarse</a></li>\n";
    } elseif ($menu == MENU_VOLVER) {
        print "      <li><a href=\"index.php\">Volver al inicio</a></li>\n";
    }
    print "    </ul>\n";
    print "  </nav>\n";
    print "\n";
    print "  <main>\n";
}

function pie()
{
    print "  </main>\n";
    print "\n";

    print "  <footer>\n";
    print "    <p class=\"ultmod\">\n";
    print "      Última modificación de esta página:\n";
    print "      <time datetime=\"2013-03-10\">10 de marzo de 2013</time>\n";
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
}
