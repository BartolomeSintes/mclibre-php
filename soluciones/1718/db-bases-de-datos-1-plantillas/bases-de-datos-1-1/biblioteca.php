<?php
/**
 * Bases de datos 1-1 - biblioteca.php
 *
 * @author    Escriba su nombre
 *
 */

// Constantes y variables globales

define("FORM_METHOD",    "get");           // Formularios se envían con GET
//define("FORM_METHOD",    "post");        // Formularios se envían con POST

define("MYSQL",          "MySQL");         // Base de datos MySQL
define("SQLITE",         "SQLite");        // Base de datos SQLITE

define("MENU_PRINCIPAL", "menuPrincipal"); // Menú principal
define("MENU_VOLVER",    "menuVolver");    // Menú Volver a inicio

$tamNombre    = 40;                        // Tamaño de la columna Nombre
$tamApellidos = 60;                        // Tamaño de la columna Apellidos

$dbMotor = SQLITE;                         // Base de datos empleada (MYSQL o SQLITE)

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
    print "  <meta charset=\"utf-8\" />\n";
    print "  <title>Ejercicio incompleto</title>\n";
    print "  <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\" />\n";
    print "  <link rel=\"stylesheet\" type=\"text/css\" href=\"mclibre-php-soluciones-proyectos.css\" "
        . "title=\"Estilo Proyectos PHP de mclibre\" />\n";
    print "</head>\n";
    print "\n";
    print "<body>\n";
    print "  <header>\n";
    print "    <h1 class=\"aviso\">Ejercicio incompleto</h1>\n";
    print "\n";
    print "    <nav>\n";
    print "      <ul>\n";
    print "        <li class=\"aviso\">Ejercicio incompleto</li>\n";
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
    print "    <p>Escriba su nombre</p>\n";
    print "  </footer>\n";
    print "</body>\n";
    print "</html>";
}
