<?php
/**
 * Blog - biblioteca.php
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

define("ZONA_HORARIA",        "Europe/Madrid");  // Zona horaria del servidor
define("CABECERA_CON_CURSOR", true);             // Para función cabecera()
define("CABECERA_SIN_CURSOR", false);            // Para función cabecera()
define("FORM_METHOD",            "get");  // Formularios se envían con GET
//define("FORM_METHOD",            "post"); // Formularios se envían con POST
define("MYSQL",               "MySQL");
define("SQLITE",              "SQLite");
define("TAM_ENTRADA",         255);  // Tamaño del campo Entradas > Entrada
define("MAX_REG_ENTRADAS",    10);   // Número máximo de registros en la tabla Entradas

$dbMotor = SQLITE;                     // Base de datos empleada
if ($dbMotor == MYSQL) {
    define("MYSQL_HOST", "mysql:host=localhost"); // Nombre de host MYSQL
    define("MYSQL_USER",    "root");   // Nombre de usuario de MySQL
    define("MYSQL_PASSWORD", "");      // Contraseña de usuario de MySQL
    $dbDb       = "mclibre_blog";     // Nombre de la base de datos
    $dbEntradas = $dbDb . ".entradas";  // Nombre de la tabla Entradas
} elseif ($dbMotor == SQLITE) {
    $dbDb       = "/home/barto/mclibre/tmp/mclibre/mclibre_entradas.sqlite";  // Nombre de la base de datos
    $dbEntradas = "entradas";         // Nombre de la tabla Entradas
}

$recorta = [
    "entrada" => TAM_ENTRADA
];

function conectaDb()
{
    global $dbMotor, $dbDb;

    try {
        if ($dbMotor == MYSQL) {
            $db = new PDO(MYSQL_HOST, MYSQL_USER, MYSQL_PASSWORD);
            $db->setAttribute(PDO::MYSQL_ATTR_USE_BUFFERED_QUERY, true);
        } elseif ($dbMotor == SQLITE) {
            $db = new PDO("sqlite:" . $dbDb);
        }
        return($db);
    } catch (PDOException $e) {
        cabecera("Error grave", CABECERA_SIN_CURSOR, "");
        print "    <p>Error: No puede conectarse con la base de datos.</p>\n";
        print "\n";
//        print "    <p>Error: " . $e->getMessage() . "</p>\n";
//        print "\n";
        pie();
        exit;
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
    if (get_magic_quotes_gpc()) {
        $tmp = stripslashes($tmp);
    }
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

function recogefecha($db, $var)
{
    date_default_timezone_set(ZONA_HORARIA);
    $fecha = recogeParaConsulta($db, $var, date("Y-m-d"));
    $fecha = quitaComillasExteriores($fecha);
    if (!ctype_digit(substr($fecha, 5, 2)) ||!ctype_digit(substr($fecha, 8, 2))
        ||!ctype_digit(substr($fecha, 0, 4))) {
        $fecha = date("Y-m-d");
    } elseif (!checkdate((int)substr($fecha, 5, 2), (int)substr($fecha, 8, 2),
                    (int)substr($fecha, 0, 4))) {
        $fecha = date("Y-m-d");
    }
    return $fecha;
}

function fechaDma($amd)
{
    return substr($amd, 8, 2)."-".substr($amd, 5, 2)."-".substr($amd, 0, 4);
}

function fechaAmd($dma)
{
    return substr($dma, 7, 4)."-".substr($dma, 4, 2)."-".substr($dma, 1, 2);
}

function calendario ($fecha, $enlaces)
{
    global $db, $dbEntradas;

    date_default_timezone_set(ZONA_HORARIA);
    if (!ctype_digit(substr($fecha, 5, 2)) || !ctype_digit(substr($fecha, 8, 2))
            || !ctype_digit(substr($fecha, 0, 4))) {
        $fecha = date("Y-m-d");
    } elseif (!checkdate((int)substr($fecha, 5, 2), (int)substr($fecha, 8, 2),
            (int)substr($fecha, 0, 4))) {
        $fecha = date("Y-m-d");
    }
    $diaInicial = substr($fecha, 8, 2);
    $mes        = substr($fecha, 5, 2);
    $anyo       = substr($fecha, 0, 4);

    $esBisiesto = ($anyo%400 == 0 || ($anyo%100 != 0 && $anyo%4 == 0))
                    ? "1" : "0";
    $duraMeses = ($esBisiesto) ?
        [0, 31, 29, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31, 31] :
        [0, 31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31, 31];
    $meses = ["", "Enero", "Febrero", "Marzo", "Abril", "Mayo",
        "Junio", "Julio", "Agosto", "Septiembre", "Octubre",
        "Noviembre", "Diciembre"
    ];

    if ($diaInicial>$duraMeses[(int)($mes)-1]) {
        $fechaAnt = date("Y-m-d", mktime(0, 0, 0, $mes-1, $duraMeses[(int)($mes)-1], $anyo));
    } else {
        $fechaAnt = date("Y-m-d", mktime(0, 0, 0, $mes-1, $diaInicial, $anyo));
    }
    $diaAnt  = substr($fechaAnt, 8, 2);
    $mesAnt  = substr($fechaAnt, 5, 2);
    $anyoAnt = substr($fechaAnt, 0, 4);

    if ($diaInicial>$duraMeses[(int)($mes)+1]) {
        $fechaSig = date("Y-m-d", mktime(0, 0, 0, $mes+1, $duraMeses[(int)($mes)+1], $anyo));
    } else {
        $fechaSig = date("Y-m-d", mktime(0, 0, 0, $mes+1, $diaInicial, $anyo));
    }
    $diaSig  = substr($fechaSig, 8, 2);
    $mesSig  = substr($fechaSig, 5, 2);
    $anyoSig = substr($fechaSig, 0, 4);

    $jd = gregoriantojd($mes, 1, $anyo);
    $dia = (jddayofweek($jd, 0)+6)%7;
    $dias = ["L", "M", "X", "J", "V", "S", "D"];
    $diaSemana = $dias[$dia];

    print "    <div class=\"calendario\">\n";
    print "      <table border=\"1\" class=\"calendario\" >\n";
    if ($enlaces == "editar") {
        print "        <caption><a href=\"editar.php?fecha=$fechaAnt\">&lt;&lt;</a> "
            . $meses[(int)($mes)] . " de $anyo <a href=\"editar.php?fecha="
            . "$fechaSig\">&gt;&gt;</a></caption>\n";
    } else {
        print "        <caption><a href=\"leer.php?fecha=$fechaAnt\">&lt;&lt;</a> "
            . $meses[(int)($mes)] . " de $anyo <a href=\"leer.php?fecha="
            . "$fechaSig\">&gt;&gt;</a></caption>\n";
    }
    print "        <tr>\n";
    print "          <th>L</th>\n";
    print "          <th>M</th>\n";
    print "          <th>X</th>\n";
    print "          <th>J</th>\n";
    print "          <th>V</th>\n";
    print "          <th>S</th>\n";
    print "          <th>D</th>\n";
    print "        </tr>\n";
    for ($n=0; $n<=5; $n++) {
        $num_inicio = 1-$dia+$n*7;
        if ($num_inicio<=$duraMeses[(int)($mes)]) {
            print "        <tr>\n";
            for ($i=0; $i<7; $i++) {
                $num = $num_inicio + $i;
                if ($num > 0 && $num <= $duraMeses[(int)($mes)]) {
                    if ($enlaces == "editar") {
                        print "          <td class=\"enlace\"><a href=\"editar.php"
                            . "?fecha=$anyo-$mes-".sprintf("%02d", $num)
                            . "\">$num</a></td>\n";
                    } elseif ($enlaces == "leer") {
                        $consulta = "SELECT COUNT(*) FROM $dbEntradas WHERE "
                            . "fecha='$anyo-$mes-".sprintf("%02d", $num)."'";
                        $result = $db->query($consulta);
                        if (!$result) {
                            print "          <td>$num</td>\n";
                        } elseif ($result->fetchColumn()) {
                            print "          <td class=\"enlace\"><a "
                                . "href=\"leer.php?fecha=$anyo-$mes-"
                              .sprintf("%02d", $num)."\">$num</a></td>\n";
                        } else {
                            print "          <td>$num</td>\n";
                        }
                    }
                } else {
                    print "          <td></td>\n";
                }
            }
            print "        </tr>\n";
        }
    }
    print "      </table>\n";
    print "    </div>\n";
    print "\n";
}

function cabecera($texto, $conCursor=CABECERA_SIN_CURSOR, $fecha="")
{
    print "<!DOCTYPE html>\n";
    print "<html lang=\"es\">\n";
    print "<head>\n";
    print "  <meta charset=\"utf-8\" />\n";
    print "  <title>Blog. $texto.\n";
    print "    Ejercicios. Programación web en PHP. Bartolomé Sintes Marco. www.mclibre.org</title>\n";
    print "  <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\" />\n";
    print "  <link rel=\"stylesheet\" type=\"text/css\" href=\"mclibre-php-soluciones-proyectos-blog.css\" title=\"Color\" />\n";
    print "</head>\n";
    print "\n";

    if ($conCursor) {
        print "<body onload=\"document.getElementById('cursor').focus()\">\n";
    } else {
        print "<body>\n";
    }
    print "  <h1>Blog - $texto</h1>\n";
    print "\n";
    print "  <div id=\"menu\">\n";
    print "    <ul>\n";
    print "      <li><a href=\"editar.php?fecha=$fecha\">Editar</a></li>\n";
    print "      <li><a href=\"leer.php?fecha=$fecha\">Leer</a></li>\n";
    print "      <li><a href=\"borrar-todo-1.php\">Borrar todo</a></li>\n";
    print "    </ul>\n";
    print "  </div>\n";
    print "\n";
    print "  <div id=\"contenido\">\n";
}

function pie()
{
    print "  </div>\n";
    print "\n";

    print "  <footer>\n";
    print "    <p class=\"ultmod\">\n";
    print "      Última modificación de esta página:\n";
    print "      <time datetime=\"2009-05-21\">21 de mayo de 2009</time>\n";
    print "    </p>\n";
    print "\n";
    print "    <p class=\"licencia\">\n";
    print "      Este programa forma parte del curso <strong><a href=\"https://www.mclibre.org/consultar/php/\">Programación \n";
    print "      web en PHP</a></strong> de <a href=\"https://www.mclibre.org/\" rel=\"author\" >Bartolomé Sintes Marco</a>.<br />\n";
    print "      El programa PHP que genera esta página se distribuye bajo \n";
    print "      <a rel=\"license\" href=\"http://www.gnu.org/licenses/agpl.txt\">licencia AGPL 3 o posterior</a>.\n";
    print "    </p>\n";
    print "  </footer>\n";
    print "</body>\n";
    print "</html>\n";
}
