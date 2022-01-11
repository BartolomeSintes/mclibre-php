<?php
/**
 * @author    Bartolomé Sintes Marco - bartolome.sintes+mclibre@gmail.com
 * @license   https://www.gnu.org/licenses/agpl-3.0.txt AGPL 3 or later
 * @link      https://www.mclibre.org
 */

// Constantes y variables configurables por el programador de la aplicación

define("GET", "get");                       // Formularios se envían con GET
define("POST", "post");                     // Formularios se envían con POST

define("MYSQL", 1);                         // Base de datos MySQL
define("SQLITE", 2);                        // Base de datos SQLITE

define("MENU_PRINCIPAL", 1);                // Menú principal sin conectar
define("MENU_PRINCIPAL_CONECTADO", 2);      // Menú principal conectado
define("MENU_VOLVER", 3);                   // Menú Volver a inicio
define("MENU_PERSONAS", 4);                 // Menú Personas

define("PROFUNDIDAD_0", 0);                 // Profundidad de nivel de la página: directorio raíz
define("PROFUNDIDAD_1", 1);                 // Profundidad de nivel de la página: subdirectorio

// Variables configurables por el administrador de la aplicación

require_once "config.php";

// Configuración Tabla Personas

$cfg["dbPersonasTamNombre"]    = 40;        // Tamaño de la columna Personas > Nombre
$cfg["dbPersonasTamApellidos"] = 60;        // Tamaño de la columna Personas > Apellidos
$cfg["dbPersonasTamTelefono"]  = 10;        // Tamaño de la columna Personas > Teléfono
$cfg["dbPersonasTamCorreo"]    = 50;        // Tamaño de la columna Personas > Correo

// Valores de ordenación de la tabla

$cfg["dbPersonasColumnasOrden"] = [
    "nombre ASC", "nombre DESC",
    "apellidos ASC", "apellidos DESC",
    "telefono ASC", "telefono DESC",
    "correo ASC", "correo DESC",
];

// Carga Biblioteca específica de la base de datos utilizada

if ($cfg["dbMotor"] == MYSQL) {
    require_once "biblioteca-mysql.php";
} elseif ($cfg["dbMotor"] == SQLITE) {
    require_once "biblioteca-sqlite.php";
}

// Funciones comunes

function recoge($var, $m = "")
{
    if (!isset($_REQUEST[$var])) {
        $tmp = (is_array($m)) ? [] : "";
    } elseif (!is_array($_REQUEST[$var])) {
        $tmp = trim(htmlspecialchars($_REQUEST[$var], ENT_QUOTES, "UTF-8"));
    } else {
        $tmp = $_REQUEST[$var];
        array_walk_recursive($tmp, function (&$valor) {
            $valor = trim(htmlspecialchars($valor, ENT_QUOTES, "UTF-8"));
        });
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
    print "    $texto. Bases de datos (3) 1. Bases de datos (3).\n";
    print "    Ejercicios. PHP. Bartolomé Sintes Marco. www.mclibre.org\n";
    print "  </title>\n";
    print "  <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">\n";
    if ($profundidadDirectorio == PROFUNDIDAD_0) {
        print "  <link rel=\"stylesheet\" href=\"comunes/mclibre-php-proyectos.css\" title=\"Color\" />\n";
    } elseif ($profundidadDirectorio == PROFUNDIDAD_1) {
        print "  <link rel=\"stylesheet\" href=\"../comunes/mclibre-php-proyectos.css\" title=\"Color\" />\n";
    }
    print "</head>\n";
    print "\n";
    print "<body>\n";
    print "  <header>\n";
    print "    <h1>Bases de datos (3) 1 - $texto</h1>\n";
    print "\n";
    print "    <nav>\n";
    print "      <ul>\n";
    if ($menu == MENU_PRINCIPAL) {
        print "        <li><a href=\"acceso/login.php\">Conectarse</a></li>\n";
    } elseif ($menu == MENU_PRINCIPAL_CONECTADO) {
        print "        <li><a href=\"db-personas/index.php\">Personas</a></li>\n";
        print "        <li><a href=\"acceso/logout.php\">Desconectarse</a></li>\n";
    } elseif ($menu == MENU_VOLVER) {
        print "        <li><a href=\"../index.php\">Volver</a></li>\n";
    } elseif ($menu == MENU_PERSONAS) {
        print "        <li><a href=\"../index.php\">Volver</a></li>\n";
        print "        <li><a href=\"insertar-1.php\">Añadir registro</a></li>\n";
        print "        <li><a href=\"listar.php\">Listar</a></li>\n";
        print "        <li><a href=\"borrar-1.php\">Borrar</a></li>\n";
        print "        <li><a href=\"buscar-1.php\">Buscar</a></li>\n";
        print "        <li><a href=\"modificar-1.php\">Modificar</a></li>\n";
        print "        <li><a href=\"borrar-todo-1.php\">Borrar todo</a></li>\n";
    } else {
        print "        <li>Error en la selección de menú</li>\n";
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
    print "      <time datetime=\"2022-01-11\">11 de enero de 2022</time>\n";
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
    print "</html>";
}
