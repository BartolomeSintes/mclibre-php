<?php
/**
 * Poliagenda -  biblioteca.php
 *
 * @author    Bartolomé Sintes Marco <bartolome.sintes+mclibre@gmail.com>
 * @copyright 2008 Bartolomé Sintes Marco
 * @license   http://www.gnu.org/licenses/agpl.txt AGPL 3 or later
 * @version   2008-03-02
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

define ("MYSQL", "MySQL");
define ("SQLITE", "SQLite");
$dbMotor = SQLITE;                         // Base de datos empleada
if ($dbMotor == MYSQL) {
    define("MYSQL_HOST", "mysql:host=localhost"); // Nombre de host MYSQL
    define("MYSQL_USER",    "root");      // Nombre de usuario de MySQL
    define("MYSQL_PASSWORD", "");         // Contraseña de usuario de MySQL
    $dbDb       = "mclibre_poliagenda";  // Nombre de la base de datos
    $dbUsuarios = $dbDb . ".usuarios";      // Nombre de la tabla de Usuarios
    $dbAgenda   = $dbDb . ".agenda";        // Nombre de la tabla de Agendas
    $consultaExisteTabla = "SELECT COUNT(*) as existe_db
        FROM INFORMATION_SCHEMA.SCHEMATA WHERE SCHEMA_NAME='$dbDb'";
} elseif ($dbMotor == SQLITE) {
    $dbDb       = "/home/barto/mclibre/tmp/mclibre/mclibre_poliagenda.sqlite3";  // Nombre de la base de datos
    $dbUsuarios = "usuarios";             // Nombre de la tabla de Usuarios
    $dbAgenda   = "agenda";               // Nombre de la tabla de Agendas
    $consultaExisteTabla = "SELECT COUNT(*) as existe_db
        FROM sqlite_master WHERE type='table' AND name='$dbUsuarios'";
}

$administradorNombre   = "root";   // Nombre del usuario Administrador
$administradorPassword = "root";   // Password del usuario Administrador
$administradorIdioma   = "es_ES";  // Idioma del usuario Administrador
$idiomaPredeterminado  = "es_ES";  // Idioma predeterminado
// Si $administradorPassword != "", al crearse las tablas, se crea el usuario
// Si $administradorPassword == "", no se crea el usuario
// Lo he hecho para que en el ejemplo colgado en la web la gente pueda entrar
// como Administrador
$tamUsuario     = 20;  // Tamaño del campo Usuario
$tamPassword    = 20;  // Tamaño del campo Contraseña
$tamIdioma      = 5;   // Tamaño del campo Idioma
$tamCifrado     = 32;  // Tamaño del campo contraseña en MD5
$tamNombre      = 40;  // Tamaño del campo Nombre
$tamApellidos   = 60;  // Tamaño del campo Apellidos
$tamTelefono    = 10;  // Tamaño del campo Teléfono
$tamCorreo      = 50;  // Tamaño del campo Correo
$maxRegUsuarios = 20;  // Número máximo de registros en la tabla Usuarios
$maxRegAgenda   = 20;  // Número máximo de registros por usuario en la tabla Agenda
$recorta = [
    "usuario"   => $tamUsuario,
    "password"  => $tamCifrado,
    "nombre"    => $tamNombre,
    "apellidos" => $tamApellidos,
    "telefono"  => $tamTelefono,
    "correo"    => $tamCorreo
];

if (isset($_SESSION["multiagendaIdioma"])) {
    $language = $_SESSION["multiagendaIdioma"];
} elseif (isset($_REQUEST["idioma"])) {
    $language = recogeIdioma();
} else {
    $language = $idiomaPredeterminado;
}
putenv("LC_ALL=$language");
setlocale(LC_ALL, $language);
bindtextdomain("messages", "./locale");
textdomain("messages");

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
        cabecera(_("Error grave"));
        print "    <p>" . _("Error: No puede conectarse con la base de datos") . ".</p>\n";
        print "\n";
//        print "  <p>Error: " . $e->getMessage() . "</p>\n";
//        print "\n";
        pie();
        exit();
    }
}

function borraTodoMySQL($db)
{
    global $dbDb, $dbAgenda, $dbUsuarios, $tamUsuario, $tamIdioma, $tamCifrado,
        $tamNombre, $tamApellidos, $tamTelefono, $tamCorreo,
        $administradorNombre, $administradorPassword;

    $consulta = "DROP DATABASE $dbDb";
    if ($db->query($consulta)) {
        print "    <p>" . _("Base de datos borrada correctamente") . ".</p>\n";
        print "\n";
    } else {
        print "    <p>" . _("Error al borrar la base de datos") . ".</p>\n";
        print "\n";
    }
    $consulta = "CREATE DATABASE $dbDb";
    if ($db->query($consulta)) {
        print "    <p>" . _("Base de datos creada correctamente") . ".</p>\n";
        print "\n";
        $consulta_creatabla_usuarios = "CREATE TABLE $dbUsuarios (
            id INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
            usuario VARCHAR($tamUsuario),
            password VARCHAR($tamCifrado),
            idioma VARCHAR($tamIdioma),
            PRIMARY KEY(id) )";
        if ($db->query($consulta_creatabla_usuarios)) {
            print "    <p>" . _("Tabla de Usuarios creada correctamente") . ".</p>\n";
            print "\n";
        } else {
            print "    <p>" . _("Error al crear la tabla de Usuarios") . ".</p>\n";
            print "\n";
        }
        if ($administradorPassword != "") {
            $consulta = "INSERT INTO $dbUsuarios VALUES (NULL,
                '$administradorNombre', '" . md5($administradorPassword)
                . "', '$tamIdioma')";
            if ($db->query($consulta)) {
                print "    <p>" . _("Registro de Usuario Administrador creado correctamente") . ".</p>\n";
                print "\n";
            } else {
                print "    <p>" . _("Error al crear el registro de Usuario Administrador") . ".</p>\n";
                print "\n";
            }
        }
        $consulta_creatabla_agenda = "CREATE TABLE $dbAgenda (
            id INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
            id_usuario INTEGER UNSIGNED,
            nombre VARCHAR($tamNombre),
            apellidos VARCHAR($tamApellidos),
            telefono VARCHAR($tamTelefono),
            correo VARCHAR($tamCorreo),
            PRIMARY KEY(id) )";
        if ($db->query($consulta_creatabla_agenda)) {
            print "    <p>" . _("Tabla de Agenda creada correctamente") . ".</p>\n";
            print "\n";
        } else {
            print "    <p>" . _("Error al crear la tabla de Agenda") . ".</p>\n";
            print "\n";
        }
    } else {
        print "    <p>" . _("Error al crear la base de datos") . ".</p>\n";
        print "\n";
    }
}

function borraTodoSqlite($db)
{
    global $dbAgenda, $dbUsuarios, $tamUsuario, $tamCifrado, $tamIdioma,
        $tamNombre, $tamApellidos, $tamTelefono, $tamCorreo,
        $administradorNombre, $administradorPassword;

    $consulta = "DROP TABLE $dbAgenda";
    if ($db->query($consulta)) {
       print "    <p>" . _("Tabla de Agenda borrada correctamente") . ".</p>\n";
       print "\n";
    } else {
        print "    <p>" . _("Error al borrar la tabla de Agenda") . ".</p>\n";
        print "\n";
    }
    $consulta = "DROP TABLE $dbUsuarios";
    if ($db->query($consulta)) {
       print "    <p>" . _("Tabla de Usuarios borrada correctamente") . ".</p>\n";
       print "\n";
    } else {
        print "    <p>" . _("Error al borrar la tabla de Usuarios") . ".</p>\n";
        print "\n";
    }
    $consulta_creatabla_usuarios = "CREATE TABLE $dbUsuarios (
        id INTEGER PRIMARY KEY,
        usuario VARCHAR($tamUsuario),
        password VARCHAR($tamCifrado),
        idioma VARCHAR($tamIdioma)
        )";
    if ($db->query($consulta_creatabla_usuarios)) {
        print "    <p>" . _("Tabla de Usuarios creada correctamente.") . "</p>\n";
        print "\n";
    } else {
        print "    <p>" . _("Error al crear la tabla de Usuarios") . ".</p>\n";
        print "\n";
    }
    if ($administradorPassword != "") {
        $consulta = "INSERT INTO $dbUsuarios VALUES (NULL,
            '$administradorNombre', '" . md5($administradorPassword)
            . "', '$tamIdioma')";
        if ($db->query($consulta)) {
            print "    <p>" . _("Registro de Usuario Administrador creado correctamente") . ".</p>\n";
            print "\n";
        } else {
            print "    <p>" . _("Error al crear el registro de Usuario Administrador") . ".</p>\n";
            print "\n";
        }
    }
    $consulta_creatabla_agenda = "CREATE TABLE $dbAgenda (
        id INTEGER PRIMARY KEY,
        id_usuario INTEGER,
        nombre VARCHAR($tamNombre),
        apellidos VARCHAR($tamApellidos),
        telefono VARCHAR($tamTelefono),
        correo VARCHAR($tamCorreo)
        )";
    if ($db->query($consulta_creatabla_agenda)) {
       print "    <p>" . _("Tabla de Agenda creada correctamente") . ".</p>\n";
       print "\n";
    } else {
        print "    <p>" . _("Error al crear la tabla de Agenda") . ".</p>\n";
        print "\n";
    }
}

function recorta($campo, $cadena)
{
    global $recorta;

    $tmp = isset($recorta[$campo]) ? substr($cadena, 0, $recorta[$campo]) : $cadena;
    return $tmp;
}

function recogeParaConsulta($db, $var, $var2="")
{
    $tmp = (isset($_REQUEST[$var])&&($_REQUEST[$var] != "")) ?
        trim(strip_tags($_REQUEST[$var])) : trim(strip_tags($var2));
    $tmp = str_replace("&", "&amp;",  $tmp);
    $tmp = str_replace('"', "&quot;", $tmp);
    $tmp = recorta($var, $tmp);
    if (!is_numeric($tmp)) {
        $tmp = $db->quote($tmp);
    }
    return $tmp;
}

function recogeMatrizParaConsulta($db, $var)
{
    $tmpMatriz = [];
    if (isset($_REQUEST[$var]) && is_array($_REQUEST[$var])) {
        foreach ($_REQUEST[$var] as $indice => $valor) {
            $tmp = trim(strip_tags($indice));
            if (get_magic_quotes_gpc()) {
                $tmp = stripslashes($tmp);
            }
            $tmp = str_replace("&", "&amp;",  $tmp);
            $tmp = str_replace('"', "&quot;", $tmp);
            $tmp = recorta($var, $tmp);
            if (!is_numeric($tmp)) {
                $tmp = $db->quote($tmp);
            }
            $indiceLimpio = $tmp;

            $tmp = trim(strip_tags($valor));
            if (get_magic_quotes_gpc()) {
                $tmp = stripslashes($tmp);
            }
            $tmp = str_replace("&", "&amp;",  $tmp);
            $tmp = str_replace('"', "&quot;", $tmp);
            $tmp = recorta($var, $tmp);
            if (!is_numeric($tmp)) {
                $tmp = $db->quote($tmp);
            }
            $valorLimpio  = $tmp;

            $tmpMatriz[$indiceLimpio] = $valorLimpio;
        }
    }
    return $tmpMatriz;
}

function quitaComillasExteriores($var)
{
    if (is_string($var)) {
        if (isset($var[0])&&($var[0] == "'")) {
            $var = substr($var, 1, strlen($var)-1);
        }
        if (isset($var[strlen($var)-1])&&($var[strlen($var)-1] == "'")) {
            $var = substr($var, 0, strlen($var)-1);
        }
    }
    return $var;
}

function recogeIdioma()
{
    $tmp=(isset($_REQUEST["idioma"]))?trim(strip_tags($_REQUEST["idioma"])):"es_ES";
    if ($tmp != "es_ES" && $tmp != "en_GB" ) {
        $tmp = "es_ES";
    }
    return $tmp;
}

function menuIdioma()
{
    print "    <ul>\n";
    print "      <li><a href=\"" . $_SERVER["PHP_SELF"] . "?idioma=en_GB\">English</a></li>\n";
    print "      <li><a href=\"" . $_SERVER["PHP_SELF"] . "?idioma=es_ES\">Español</a></li>\n";
    print "    </ul>\n";
}

function cabecera($texto, $menu="menu_principal")
{
    global $administradorNombre;

    print "<!DOCTYPE html>\n";
    print "<html lang=\"es\">\n";
    print "<head>\n";
    print "  <meta charset=\"utf-8\">\n";
    print "  <title>\n";
    print "    " . _("Agenda multilingüe") . ". $texto.\n";
    print "    Ejercicios. PHP. Bartolomé Sintes Marco. www.mclibre.org\n";
    print "  </title>\n";
    print "  <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">\n";
    print "  <link rel=\"stylesheet\" href=\"mclibre-php-proyectos.css\" title=\"Color\">\n";
    print "</head>\n";
    print "\n";
    print "<body>\n";
    if ($menu == "menu_principal") {
        print "  <h1>" . _("Agenda multilingüe");
    } else {
        print "  <h1>" . _("Agenda de") . " $menu";
    }
    print " - " . _($texto) . "</h1>\n";
    print "\n";
    print "  <nav>\n";
    print "    <ul>\n";
    if ($menu == "menu_principal") {
        print "      <li><a href=\"index.php\">" . _("Conectar") . "</a></li>\n";
    } elseif ($menu == $administradorNombre) {
        print "      <li><a href=\"borrar-todo-1.php\">" . _("Borrar todo") . "</a></li>\n";
        print "      <li><a href=\"salir.php\">" . _("Desconectar") . "</a></li>\n";
    } else {
        print "      <li><a href=\"insertar-1.php\">" . _("Añadir") . "</a></li>\n";
        print "      <li><a href=\"listar.php\">" . _("Listar") . "</a></li>\n";
        print "      <li><a href=\"modificar-1.php\">" . _("Modificar") . "</a></li>\n";
        print "      <li><a href=\"buscar-1.php\">" . _("Buscar") . "</a></li>\n";
        print "      <li><a href=\"borrar-1.php\">" . _("Borrar") . "</a></li>\n";
        print "      <li><a href=\"salir.php\">" . _("Desconectar") . "</a></li>\n";
    }
    print "    </ul>\n";
    print "  </nav>\n";
    print "\n";
    print "  <main>\n";
}

function pie()
{
    global $administradorPassword, $_SESSION;

    if ($administradorPassword != "" && !isset($_SESSION["multiagendaUsuario"])) {
        print "    <p><strong>" . _("Nota") . "</strong>: "
           . _("El usuario Administrador se llama <strong>root</strong> y su contraseña es también <strong>root</strong>") . ".</p>\n";
        print "\n";
    }
    print "  </main>\n";
    print "\n";

    print "  <footer>\n";
    print "    <p class=\"ultmod\">\n";
    print "      " . _("Última modificación de esta página") . ":\n";
    print "      <time datetime=\"2008-02-27\">" . _("27 de febrero de 2008") . "</time>\n";
    print "    </p>\n";
    print "\n";
    print "    <p class=\"licencia\">\n";
    print "      Este programa forma parte del curso <strong><a href=\"http://www.mclibre.org/consultar/php/\">Programación \n";
    print "      web en PHP</a></strong> de <a href=\"http://www.mclibre.org/\" rel=\"author\">Bartolomé Sintes Marco</a>.<br>\n";
    print "      El programa PHP que genera esta página se distribuye bajo \n";
    print "      <a rel=\"license\" href=\"http://www.gnu.org/licenses/agpl.txt\">licencia AGPL 3 o posterior</a>.\n";
    print "    </p>\n";
    print "  </footer>\n";
    print "</body>\n";
    print "</html>\n";
}
