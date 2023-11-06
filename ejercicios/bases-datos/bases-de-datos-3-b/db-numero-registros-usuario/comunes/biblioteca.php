<?php
/**
 * @author    Bartolomé Sintes Marco - bartolome.sintes+mclibre@gmail.com
 * @license   https://www.gnu.org/licenses/agpl-3.0.txt AGPL 3 or later
 * @link      https://www.mclibre.org
 */

// Constantes y variables configurables por el programador de la aplicación

define("SQLITE", 1);                        // Base de datos SQLITE
define("MYSQL", 2);                         // Base de datos MySQL

define("MENU_PRINCIPAL", 1);                // Menú principal sin conectar
define("MENU_VOLVER", 2);                   // Menú Volver a inicio
define("MENU_ADMINISTRADOR", 3);            // Menú Administrador
define("MENU_USUARIOS", 4);                 // Menú Usuarios
define("MENU_PERSONAS", 5);                 // Menú Personas

define("PROFUNDIDAD_0", "");                // Profundidad de nivel de la página: directorio raíz
define("PROFUNDIDAD_1", "../");             // Profundidad de nivel de la página: subdirectorio
define("PROFUNDIDAD_2", "../../");          // Profundidad de nivel de la página: sub-subdirectorio

define("NIVEL_USUARIO_BASICO", 10);         // Usuario web de nivel Usuario Básico
define("NIVEL_ADMINISTRADOR", 20);          // Usuario web de nivel Administrador

// Variables configurables por el administrador de la aplicación

require_once "config.php";

// Valores de ordenación de las tablas

$cfg["tablaPersonasColumnasOrden"] = [
    "nombre ASC", "nombre DESC",
    "apellidos ASC", "apellidos DESC",
    "telefono ASC", "telefono DESC",
    "correo ASC", "correo DESC",
];

$cfg["tablaUsuariosColumnasOrden"] = [
    "usuario ASC", "usuario DESC",
    "password ASC", "password DESC",
    "nivel ASC", "nivel DESC",
    "registros ASC", "registros DESC",
];

// Niveles de usuario

$cfg["usuariosNiveles"] = [
    NIVEL_USUARIO_BASICO => "Usuario Básico",
    NIVEL_ADMINISTRADOR  => "Administrador",
];

// Carga Biblioteca específica de la base de datos utilizada

if ($cfg["dbMotor"] == SQLITE) {
    require_once "biblioteca-sqlite.php";
} elseif ($cfg["dbMotor"] == MYSQL) {
    require_once "biblioteca-mysql.php";
}

// Tablas

$cfg["dbTablas"] = [
    $cfg["tablaUsuarios"],
    $cfg["tablaPersonas"],
];

// Funciones comunes

// Función de recogida de datos
function recoge($key, $type = "")
{
    if ($type !== "" && $type !== []) {
        trigger_error("Function recoge(): argument #2 (\$type) must be an empty array or an empty string.", E_USER_ERROR);
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

function recogeValores($var, $valoresValidos, $valorPredeterminado)
{
    foreach ($valoresValidos as $valorValido) {
        if (isset($_REQUEST[$var]) && $_REQUEST[$var] == $valorValido) {
            return $valorValido;
        }
    }
    return $valorPredeterminado;
}

function cabecera($texto, $menu, $profundidadDirectorio)
{
    print "<!DOCTYPE html>\n";
    print "<html lang=\"es\">\n";
    print "<head>\n";
    print "  <meta charset=\"utf-8\">\n";
    print "  <title>\n";
    print "    $texto. Número de registros. Bases de datos (3 B).\n";
    print "    Ejercicios. PHP. Bartolomé Sintes Marco. www.mclibre.org\n";
    print "  </title>\n";
    print "  <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">\n";
    print "  <link rel=\"stylesheet\" href=\"{$profundidadDirectorio}comunes/mclibre-php-proyectos.css\" title=\"Color\">\n";
    print "</head>\n";
    print "\n";
    print "<body>\n";
    print "  <header>\n";
    print "    <h1>Número de registros - $texto</h1>\n";
    print "\n";
    print "    <nav>\n";
    print "      <ul>\n";
    if (!isset($_SESSION["conectado"])) {
        if ($menu == MENU_PRINCIPAL) {
            print "        <li><a href=\"acceso/login-1.php\">Conectarse</a></li>\n";
        } elseif ($menu == MENU_VOLVER) {
            print "        <li><a href=\"../index.php\">Volver</a></li>\n";
        } else {
            print "        <li>Error en la selección de menú</li>\n";
        }
    } elseif ($_SESSION["nivel"] == NIVEL_USUARIO_BASICO) {
        if ($menu == MENU_PRINCIPAL) {
            print "        <li><a href=\"db/tabla-personas/index.php\">Personas</a></li>\n";
            print "        <li><a href=\"acceso/logout.php\">Desconectarse</a></li>\n";
        } elseif ($menu == MENU_VOLVER) {
            print "        <li><a href=\"../index.php\">Volver</a></li>\n";
        } elseif ($menu == MENU_PERSONAS) {
            print "        <li><a href=\"../../index.php\">Volver</a></li>\n";
            print "        <li><a href=\"insertar-1.php\">Añadir registro</a></li>\n";
            print "        <li><a href=\"listar.php\">Listar</a></li>\n";
            print "        <li><a href=\"borrar-1.php\">Borrar</a></li>\n";
            print "        <li><a href=\"buscar-1.php\">Buscar</a></li>\n";
            print "        <li><a href=\"modificar-1.php\">Modificar</a></li>\n";
        } else {
            print "        <li>Error en la selección de menú</li>\n";
        }
    } elseif ($_SESSION["nivel"] == NIVEL_ADMINISTRADOR) {
        if ($menu == MENU_PRINCIPAL) {
            print "        <li><a href=\"db/tabla-personas/index.php\">Personas</a></li>\n";
            print "        <li><a href=\"db/tabla-usuarios/index.php\">Usuarios</a></li>\n";
            print "        <li><a href=\"administrador/index.php\">Administrador</a></li>\n";
            print "        <li><a href=\"acceso/logout.php\">Desconectarse</a></li>\n";
        } elseif ($menu == MENU_VOLVER) {
            print "        <li><a href=\"../index.php\">Volver</a></li>\n";
        } elseif ($menu == MENU_ADMINISTRADOR) {
            print "        <li><a href=\"../index.php\">Volver</a></li>\n";
            print "        <li><a href=\"borrar-todo-1.php\">Borrar todo</a></li>\n";
        } elseif ($menu == MENU_USUARIOS) {
            print "        <li><a href=\"../../index.php\">Volver</a></li>\n";
            print "        <li><a href=\"insertar-1.php\">Añadir registro</a></li>\n";
            print "        <li><a href=\"listar.php\">Listar</a></li>\n";
            print "        <li><a href=\"borrar-1.php\">Borrar</a></li>\n";
            print "        <li><a href=\"buscar-1.php\">Buscar</a></li>\n";
            print "        <li><a href=\"modificar-1.php\">Modificar</a></li>\n";
        } elseif ($menu == MENU_PERSONAS) {
            print "        <li><a href=\"../../index.php\">Volver</a></li>\n";
            print "        <li><a href=\"insertar-1.php\">Añadir registro</a></li>\n";
            print "        <li><a href=\"listar.php\">Listar</a></li>\n";
            print "        <li><a href=\"borrar-1.php\">Borrar</a></li>\n";
            print "        <li><a href=\"buscar-1.php\">Buscar</a></li>\n";
            print "        <li><a href=\"modificar-1.php\">Modificar</a></li>\n";
        } else {
            print "        <li>Error en la selección de menú</li>\n";
        }
    }
    print "      </ul>\n";
    print "    </nav>\n";
    print "  </header>\n";
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
    print "      <time datetime=\"2023-01-30\">30 de enero de 2023</time>\n";
    print "    </p>\n";
    print "\n";
    print "    <p class=\"licencia\">\n";
    print "      Este programa forma parte del curso <strong><a href=\"https://www.mclibre.org/consultar/php/\">Programación \n";
    print "      web en PHP</a></strong> de <a href=\"https://www.mclibre.org/\" rel=\"author\">Bartolomé Sintes Marco</a>.<br>\n";
    print "      El programa PHP que genera esta página se distribuye bajo \n";
    print "      <a rel=\"license\" href=\"https://www.gnu.org/licenses/agpl-3.0.txt\">licencia AGPL 3 o posterior</a>.\n";
    print "    </p>\n";
    print "  </footer>\n";
    print "</body>\n";
    print "</html>\n";
}

function encripta($cadena)
{
    global $cfg;

    return hash($cfg["hashAlgorithm"], $cadena);
}
