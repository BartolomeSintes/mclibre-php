<?php
/**
 * Biblioteca - biblioteca.php
 *
 * @author    Bartolomé Sintes Marco <bartolome.sintes+mclibre@gmail.com>
 * @copyright 2009 Bartolomé Sintes Marco
 * @license   http://www.gnu.org/licenses/agpl.txt AGPL 3 or later
 * @version   2009-05-21
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

define("FORM_METHOD",            "get");  // Formularios se envían con GET
//define("FORM_METHOD",            "post"); // Formularios se envían con POST
define ("MYSQL", "MySQL");
define ("SQLITE", "SQLite");
$dbMotor = SQLITE;                        // Base de datos empleada
if ($dbMotor == MYSQL) {
    define("MYSQL_HOST", "mysql:host=localhost"); // Nombre de host MYSQL
    define("MYSQL_USER",    "root");      // Nombre de usuario de MySQL
    define("MYSQL_PASSWORD", "");         // Contraseña de usuario de MySQL
    $dbDb        = "mclibre_biblioteca";  // Nombre de la base de datos
    $dbObras     = $dbDb . ".obras";        // Nombre de la tabla Obras
    $dbUsuarios  = $dbDb . ".usuarios";     // Nombre de la tabla Usuarios
    $dbPrestamos = $dbDb . ".prestamos";    // Nombre de la tabla de Préstamos
} elseif ($dbMotor == SQLITE) {
    $dbDb        = "/tmp/mclibre_biblioteca.sqlite";  // Nombre de la base de datos
    $dbObras     = "obras";               // Nombre de la tabla Obras
    $dbUsuarios  = "usuarios";            // Nombre de la tabla Usuarios
    $dbPrestamos = "prestamos";           // Nombre de la tabla de Préstamos
}

define("ZONA_HORARIA",      "Europe/Madrid");  // Zona horaria del servidor
define("TAM_TITULO",        50);  // Tamaño del campo Obras > Título
define("TAM_AUTOR",         50);  // Tamaño del campo Obras > Autor
define("TAM_EDITORIAL",     50);  // Tamaño del campo Obras > Editorial
define("TAM_NOMBRE",        50);  // Tamaño del campo Usuarios > Nombre
define("TAM_APELLIDOS",     50);  // Tamaño del campo Usuarios > Apellidos
define("TAM_DNI",           10);  // Tamaño del campo Usuarios > DNI
define("TAM_FECHA",         10);  // Tamaño del campo Préstamo > Fecha
define("MAX_REG_OBRAS",     20);  // Número máximo de registros en la tabla Obras
define("MAX_REG_USUARIOS",  20);  // Número máximo de registros en la tabla Usuarios
define("MAX_REG_PRESTAMOS", 20);  // Número máximo de registros en la tabla Préstamos

$recorta = [
    "titulo"    => TAM_TITULO,
    "autor"     => TAM_AUTOR,
    "editorial" => TAM_EDITORIAL,
    "nombre"    => TAM_NOMBRE,
    "apellidos" => TAM_APELLIDOS,
    "dni"       => TAM_DNI,
    "fecha"     => TAM_FECHA
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
        cabecera("Error grave", false);
        print "    <p>Error: No puede conectarse con la base de datos.</p>\n";
        print "\n";
//        print "    <p>Error: " . $e->getMessage() . "</p>\n";
//        print "\n";
        pie();
        exit();
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
    $tmp = (isset($_REQUEST[$var]) && ($_REQUEST[$var] != "")) ?
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
        if (isset($var[0]) && ($var[0] == "'")) {
            $var = substr($var, 1, strlen($var)-1);
        }
        if (isset($var[strlen($var)-1]) && ($var[strlen($var)-1] == "'")) {
            $var = substr($var, 0, strlen($var)-1);
        }
    }
    return $var;
}

function fechaDma($amd)
{
    return substr($amd, 8, 2)."-".substr($amd, 5, 2)."-".substr($amd, 0, 4);
}

function fechaAmd($dma)
{
    return substr($dma, 7, 4)."-".substr($dma, 4, 2)."-".substr($dma, 1, 2);
}

function cabecera($texto, $menu="menuPrincipal")
{
    print "<!DOCTYPE html>\n";
    print "<html lang=\"es\">\n";
    print "<head>\n";
    print "  <meta charset=\"utf-8\">\n";
    print "  <title>\n";
    print "    $texto. Biblioteca.\n";
    print "    Ejercicios. PHP. Bartolomé Sintes Marco. www.mclibre.org\n";
    print "  </title>\n";
    print "  <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">\n";
    print "  <link rel=\"stylesheet\" href=\"mclibre-php-proyectos.css\" title=\"Color\">\n";
    print "</head>\n";
    print "\n";
    print "<body>\n";
    print "  <h1>Biblioteca - $texto</h1>\n";
    print "\n";
    print "  <nav>\n";
    print "    <ul>\n";
    if ($menu == "menuObras") {
        print "      <li><a href=\"index.php\">Inicio</a></li>\n";
        print "      <li><a href=\"obr-insertar-1.php\">Añadir</a></li>\n";
        print "      <li><a href=\"obr-listar.php\">Listar</a></li>\n";
        print "      <li><a href=\"obr-buscar-1.php\">Buscar</a></li>\n";
        print "      <li><a href=\"obr-modificar-1.php\">Modificar</a></li>\n";
        print "      <li><a href=\"obr-borrar-1.php\">Borrar</a></li>\n";
        print "      <li><a href=\"obr-borrar-todo-1.php\">Borrar todo</a></li>\n";
    } elseif ($menu == "menuUsuarios") {
        print "      <li><a href=\"index.php\">Inicio</a></li>\n";
        print "      <li><a href=\"usu-insertar-1.php\">Añadir</a></li>\n";
        print "      <li><a href=\"usu-listar.php\">Listar</a></li>\n";
        print "      <li><a href=\"usu-buscar-1.php\">Buscar</a></li>\n";
        print "      <li><a href=\"usu-modificar-1.php\">Modificar</a></li>\n";
        print "      <li><a href=\"usu-borrar-1.php\">Borrar</a></li>\n";
        print "      <li><a href=\"usu-borrar-todo-1.php\">Borrar todo</a></li>\n";
    } elseif ($menu == "menuPrestamos") {
        print "      <li><a href=\"index.php\">Inicio</a></li>\n";
        print "      <li><a href=\"pre-insertar-1.php\">Préstamo</a></li>\n";
        print "      <li><a href=\"pre-devolucion-1.php\">Devolución</a></li>\n";
        print "      <li><a href=\"pre-listar.php\">Listar</a></li>\n";
        print "      <li><a href=\"pre-borrar-1.php\">Borrar</a></li>\n";
        print "      <li><a href=\"pre-borrar-todo-1.php?\">Borrar todo</a></li>\n";
    } else {
        print "      <li><a href=\"obr-index.php\">Obras</a></li>\n";
        print "      <li><a href=\"usu-index.php\">Usuarios</a></li>\n";
        print "      <li><a href=\"pre-index.php\">Préstamos</a></li>\n";
        print "      <li><a href=\"com-borrar-todo-1.php\">Borrar todo</a></li>\n";
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
    print "      <time datetime=\"2009-05-21\">21 de mayo de 2009</time>\n";
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
