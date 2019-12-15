<?php
/**
 * Registro de usuarios 3 - comunes/biblioteca.php
 *
 * @author    Bartolomé Sintes Marco <bartolome.sintes+mclibre@gmail.com>
 * @copyright 2019 Bartolomé Sintes Marco
 * @license   http://www.gnu.org/licenses/agpl.txt AGPL 3 or later
 * @version   2019-05-07
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

// Constantes y variables globales

define("GET",    "get");                   // Formularios se envían con GET
define("POST",   "post");                  // Formularios se envían con POST

define("MYSQL",          "MySQL");         // Base de datos MySQL
define("SQLITE",         "SQLite");        // Base de datos SQLITE

define("MENU_PRINCIPAL",          "menuPrincipal");        // Menú principal
define("MENU_INSTALAR",           "menuInstalar");         // Menú Instalar
define("MENU_IDENTIFICAR",        "menuIdentificar");      // Menú Indentificar usuario
define("MENU_TABLA_USUARIOS_WEB", "menuTablaUsuariosWeb"); // Menú Gestión Tabla Usuarios Web
define("MENU_ERROR",              "menuError");            // Menú Error conexión con BD


define("NIVEL_1",           "1");                    // Usuario web de nivel Usuario
define("NIVEL_2",           "2");                    // Usuario web de nivel Administrador
define("NIVEL_3",           "3");                    // Usuario web de nivel Gran Jefe

$usuariosWebNiveles = [
    ["Usuario",       NIVEL_1],
    ["Administrador", NIVEL_2],
    ["Gran Jefe",     NIVEL_3]
];

$columnasUsuariosWeb = [                 // Nombre de las columnas de la tabla Usuarios web
    "usuario",
    "password",
    "nivel"
];

$orden = [ "ASC", "DESC" ];                // Valores de ordenación

// Constantes y variables configurables

require_once "config.php";

// Biblioteca base de datos

if ($dbMotor == MYSQL) {
    require_once "biblioteca-mysql.php";
} elseif ($dbMotor == SQLITE) {
    require_once "biblioteca-sqlite.php";
}

// Funciones comunes

function cabecera($texto, $menu, $profundidadDirectorio)
{
    print "<!DOCTYPE html>\n";
    print "<html lang=\"es\">\n";
    print "<head>\n";
    print "  <meta charset=\"utf-8\">\n";
    print "  <title>\n";
    print "    $texto. ";
    print "    Registro de usuario 3. Bases de datos.\n";
    print "    Ejercicios. PHP. Bartolomé Sintes Marco. www.mclibre.org\n";
    print "  </title>\n";
    print "  <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">\n";
    if ($profundidadDirectorio == 0) {
        print "  <link rel=\"stylesheet\" href=\"comunes/mclibre-php-proyectos.css\" title=\"Color\">\n";
    } else if ($profundidadDirectorio == 1) {
        print "  <link rel=\"stylesheet\" href=\"../comunes/mclibre-php-proyectos.css\" title=\"Color\">\n";
    }
    print "</head>\n";
    print "\n";
    print "<body>\n";
    print "  <header>\n";
    print "    <h1>Registro de usuarios 3 - $texto</h1>\n";
    print "\n";
    print "    <nav>\n";
    print "      <ul>\n";
    if (!isset($_SESSION["id"])) {
        if ($menu == MENU_PRINCIPAL) {
            print "        <li><a href=\"acceso/conectar-1.php\">Identificarse</a></li>\n";
        } elseif ($menu == MENU_INSTALAR) {
            print "        <li><a href=\"../index.php\">Inicio</a></li>\n";
        } elseif ($menu == MENU_IDENTIFICAR) {
            print "        <li><a href=\"../index.php\">Inicio</a></li>\n";
        } elseif ($menu == MENU_ERROR) {
            print "        <li><a href=\"../index.php\">Inicio 1</a></li>\n";
            print "        <li><a href=\"index.php\">Inicio 2</a></li>\n";
        } else {
            print "        <li>Error en la selección de menú</li>\n";
        }
    } elseif ($_SESSION["nivel"] == 1) {
        if ($menu == MENU_PRINCIPAL) {
            print "        <li><a href=\"acceso/salir.php\">Salir</a></li>\n";
        } elseif ($menu == MENU_ERROR) {
            print "        <li><a href=\"../index.php\">Inicio 1</a></li>\n";
            print "        <li><a href=\"index.php\">Inicio 2</a></li>\n";
        } else {
            print "        <li>Error en la selección de menú</li>\n";
        }
    } elseif ($_SESSION["nivel"] == 2 || $_SESSION["nivel"] == 3) {
        if ($menu == MENU_PRINCIPAL) {
            print "        <li><a href=\"db-usuarios/index.php\">Usuarios</a></li>\n";
            print "        <li><a href=\"acceso/salir.php\">Salir</a></li>\n";
        } elseif ($menu == MENU_INSTALAR) {
            print "        <li><a href=\"../index.php\">Inicio</a></li>\n";
        } elseif ($menu == MENU_IDENTIFICAR) {
            print "        <li><a href=\"../index.php\">Inicio</a></li>\n";
        } elseif ($menu == MENU_TABLA_USUARIOS_WEB) {
            print "        <li><a href=\"../index.php\">Inicio</a></li>\n";
            print "        <li><a href=\"insertar-1.php\">Añadir registro</a></li>\n";
            print "        <li><a href=\"listar.php\">Listar</a></li>\n";
            print "        <li><a href=\"borrar-1.php\">Borrar</a></li>\n";
            print "        <li><a href=\"buscar-1.php\">Buscar</a></li>\n";
            print "        <li><a href=\"modificar-1.php\">Modificar</a></li>\n";
        } elseif ($menu == MENU_ERROR) {
            print "        <li><a href=\"../index.php\">Inicio 1</a></li>\n";
            print "        <li><a href=\"index.php\">Inicio 2</a></li>\n";
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
    print "      <time datetime=\"2019-05-07\">7 de mayo de 2019</time>\n";
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

function encripta($var)
{
    // Si se cambia el algortimo de encriptación hay que cambiar $tamPassword
    return (md5($var));
}

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
