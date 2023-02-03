<?php
/**
 * @author    Bartolomé Sintes Marco - bartolome.sintes+mclibre@gmail.com
 * @license   https://www.gnu.org/licenses/agpl-3.0.txt AGPL 3 or later
 * @link      https://www.mclibre.org
 */

// Constantes y variables configurables por el programador de la aplicación

define("SQLITE", 1);                        // Base de datos SQLITE
define("MYSQL", 2);                         // Base de datos MySQL

define("MENU_PRINCIPAL", 1);                // Menú principal
define("MENU_VOLVER", 2);                   // Menú Volver a inicio

// Variables configurables por el administrador de la aplicación

require_once "config.php";

// Valores de ordenación de la tabla

$cfg["tablaPersonasColumnasOrden"] = [
    "nombre ASC", "nombre DESC",
    "apellidos ASC", "apellidos DESC",
    "telefono ASC", "telefono DESC",
    "correo ASC", "correo DESC",
];

// Carga Biblioteca específica de la base de datos utilizada

if ($cfg["dbMotor"] == SQLITE) {
    require_once "biblioteca-sqlite.php";
} elseif ($cfg["dbMotor"] == MYSQL) {
    require_once "biblioteca-mysql.php";
}

// Funciones comunes

function recoge($var, $m = "")
{
    $tmp = is_array($m) ? [] : "";
    if (isset($_REQUEST[$var])) {
        if (!is_array($_REQUEST[$var]) && !is_array($m)) {
            $tmp = trim(htmlspecialchars($_REQUEST[$var]));
        } elseif (is_array($_REQUEST[$var]) && is_array($m)) {
            $tmp = $_REQUEST[$var];
            array_walk_recursive($tmp, function (&$valor) {
                $valor = trim(htmlspecialchars($valor));
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

function cabecera($texto, $menu)
{
    print "<!DOCTYPE html>\n";
    print "<html lang=\"es\">\n";
    print "<head>\n";
    print "  <meta charset=\"utf-8\">\n";
    print "  <title>\n";
    print "    $texto. Agenda.\n";
    print "    Ejercicios. Aplicaciones web. Bartolomé Sintes Marco. www.mclibre.org\n";
    print "  </title>\n";
    print "  <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">\n";
    print "  <link rel=\"stylesheet\" href=\"mclibre-php-proyectos.css\" title=\"Color\">\n";
    print "</head>\n";
    print "\n";
    print "<body>\n";
    print "  <header>\n";
    print "    <h1>Agenda - $texto</h1>\n";
    print "\n";
    print "    <nav>\n";
    print "      <ul>\n";
    if ($menu == MENU_PRINCIPAL) {
        print "        <li><a href=\"insertar-1.php\">Añadir registro</a></li>\n";
        print "        <li><a href=\"listar.php\">Listar</a></li>\n";
        print "        <li><a href=\"borrar-1.php\">Borrar</a></li>\n";
        print "        <li><a href=\"buscar-1.php\">Buscar</a></li>\n";
        print "        <li><a href=\"modificar-1.php\">Modificar</a></li>\n";
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
    print "      <time datetime=\"2023-01-17\">17 de enero de 2023</time>\n";
    print "    </p>\n";
    print "\n";
    print "    <p class=\"licencia\">\n";
    print "      Este programa forma parte del curso <strong><a href=\"https://www.mclibre.org/consultar/webapps/\">\n";
    print "      Aplicaciones web</a></strong> de <a href=\"https://www.mclibre.org/\" rel=\"author\">Bartolomé Sintes Marco</a>.<br>\n";
    print "      El programa PHP que genera esta página se distribuye bajo \n";
    print "      <a rel=\"license\" href=\"https://www.gnu.org/licenses/agpl-3.0.txt\">licencia AGPL 3 o posterior</a>.\n";
    print "    </p>\n";
    print "  </footer>\n";
    print "</body>\n";
    print "</html>\n";
}
