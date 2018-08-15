<?php
/**
 * Bases de datos 2-3 - biblioteca.php
 *
 * @author    Escriba su nombre
 *
 */

// Constantes y variables globales

define("GET",    "get");                   // Formularios se envían con GET
define("POST",   "post");                  // Formularios se envían con POST

define("MYSQL",          "MySQL");         // Base de datos MySQL
define("SQLITE",         "SQLite");        // Base de datos SQLITE

define("MENU_PRINCIPAL", "menuPrincipal"); // Menú principal
define("MENU_VOLVER",    "menuVolver");    // Menú Volver a inicio

$columnas = [                              // Nombre de las columnas de la tabla
    "nombre",
    "apellidos",
    "telefono",
    "correo"
];

// Constantes y variables configurables

require_once "config.php";

// Biblioteca base de datos

if ($dbMotor == MYSQL) {
    require_once "biblioteca-mysql.php";
} elseif ($dbMotor == SQLITE) {
    require_once "biblioteca-sqlite.php";
}

// Funciones comunes

function recoge($var)
{
    $tmp = (isset($_REQUEST[$var]))
        ? trim(htmlspecialchars($_REQUEST[$var], ENT_QUOTES, "UTF-8"))
        : "";
    return $tmp;
}

function recogeMatriz($var)
{
    $tmpMatriz = [];
    if (isset($_REQUEST[$var]) && is_array($_REQUEST[$var])) {
        foreach ($_REQUEST[$var] as $indice => $valor) {
            $indiceLimpio = trim(htmlspecialchars($indice, ENT_QUOTES, "UTF-8"));
            $valorLimpio  = trim(htmlspecialchars($valor,  ENT_QUOTES, "UTF-8"));
            $tmpMatriz[$indiceLimpio] = $valorLimpio;
        }
    }
    return $tmpMatriz;
}

function recogeColumna($var, $var2)
{
    global $columnas;

    foreach($columnas as $columna) {
        if (isset($_REQUEST[$var]) && $_REQUEST[$var] == $columna) {
            return $columna;
        }
    }
    return $var2;
}

function recogeOrden($var, $var2)
{
    if (isset($_REQUEST[$var]) && $_REQUEST[$var] == "ASC") {
        return "ASC";
    } elseif (isset($_REQUEST[$var]) && $_REQUEST[$var] == "DESC") {
        return "DESC";
    } else {
        return $var2;
    }
}

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
