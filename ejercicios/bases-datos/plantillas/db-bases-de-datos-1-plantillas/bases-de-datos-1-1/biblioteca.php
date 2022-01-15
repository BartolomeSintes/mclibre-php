<?php
/**
 * @author Escriba aquí su nombre
 */

// Constantes y variables configurables por el programador de la aplicación

define("MYSQL", 1);                         // Base de datos MySQL
define("SQLITE", 2);                        // Base de datos SQLITE

define("MENU_PRINCIPAL", 1);                // Menú principal
define("MENU_VOLVER", 2);                   // Menú Volver a inicio

// Variables configurables por el administrador de la aplicación

require_once "config.php";

// Configuración Tabla Personas

$cfg["dbPersonasTamNombre"]    = 40;        // Tamaño de la columna Personas > Nombre
$cfg["dbPersonasTamApellidos"] = 60;        // Tamaño de la columna Personas > Apellidos

// Carga Biblioteca específica de la base de datos utilizada

if ($cfg["dbMotor"] == MYSQL) {
    require_once "biblioteca-mysql.php";
} elseif ($cfg["dbMotor"] == SQLITE) {
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

    print "    Ejercicio incompleto.\n";

    print "    Bases de datos (1) 1. Bases de datos (1).\n";
    print "    Escriba aquí su nombre\n";
    print "  </title>\n";
    print "  <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">\n";
    print "  <link rel=\"stylesheet\" href=\"mclibre-php-proyectos.css\" title=\"Color\">\n";
    print "</head>\n";
    print "\n";
    print "<body>\n";
    print "  <header>\n";
    print "    <p class=\"aviso\">Ejercicio incompleto</p>\n";
    print "\n";
    print "    <nav>\n";
    print "      <ul>\n";

    print "        <li>Ejercicio incompleto</li>\n";

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
    print "    <p>Escriba aquí su nombre</p>\n";
    print "  </footer>\n";
    print "</body>\n";
    print "</html>";
}
