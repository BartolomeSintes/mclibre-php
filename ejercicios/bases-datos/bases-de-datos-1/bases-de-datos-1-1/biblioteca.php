<?php
/**
 * @author    Bartolomé Sintes Marco - bartolome.sintes+mclibre@gmail.com
 * @license   http://www.gnu.org/licenses/agpl.txt AGPL 3 or later
 * @link      https://www.mclibre.org
 */

// Constantes comunes

define("GET", "get");                       // Formularios se envían con GET
define("POST", "post");                     // Formularios se envían con POST

define("MYSQL", "MySQL");                   // Base de datos MySQL
define("SQLITE", "SQLite");                 // Base de datos SQLITE

define("MENU_PRINCIPAL", "menuPrincipal");  // Menú principal
define("MENU_VOLVER", "menuVolver");        // Menú Volver a inicio

// Constantes y variables configurables

// Base de datos utilizada por la aplicación: MYSQL o SQLITE

$dbMotor = SQLITE;                          // Valores posibles: MYSQL o SQLITE

// Configuración Tabla Agenda

$tamAgendaNombre    = 40;                   // Tamaño de la columna Agenda > Nombre
$tamAgendaApellidos = 60;                   // Tamaño de la columna Agenda > Apellidos

// Método de envío de formularios

define("FORM_METHOD", GET);                 // Valores posibles: GET o POST

// Biblioteca base de datos

if ($dbMotor == MYSQL) {
    require_once "biblioteca-mysql.php";
} elseif ($dbMotor == SQLITE) {
    require_once "biblioteca-sqlite.php";
}

// Funciones comunes

function cabecera($texto, $menu)
{
    print "<!DOCTYPE html>\n";
    print "<html lang=\"es\">\n";
    print "<head>\n";
    print "  <meta charset=\"utf-8\">\n";
    print "  <title>\n";
    print "    $texto. Bases de datos 1-1. Bases de datos (1).\n";
    print "    Ejercicios. PHP. Bartolomé Sintes Marco. www.mclibre.org\n";
    print "  </title>\n";
    print "  <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">\n";
    print "  <link rel=\"stylesheet\" href=\"mclibre-php-proyectos.css\" title=\"Color\">\n";
    print "</head>\n";
    print "\n";
    print "<body>\n";
    print "  <header>\n";
    print "    <h1>Bases de datos 1-1 - $texto</h1>\n";
    print "\n";
    print "    <nav>\n";
    print "      <ul>\n";
    if ($menu == MENU_PRINCIPAL) {
        print "        <li><a href=\"borrar-todo-1.php\">Borrar todo</a></li>\n";
    } elseif ($menu == MENU_VOLVER) {
        print "        <li><a href=\"index.php\">Volver</a></li>\n";
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
    print "      <time datetime=\"2020-05-19\">19 de mayo de 2020</time>\n";
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
    print "</html>";
}
