<?php
/**
 * Foro - funciones.php
 *
 * @author    Bartolom� Sintes Marco <bartolome.sintes+mclibre@gmail.com>
 * @copyright 2009 Bartolom� Sintes Marco
 * @license   http://www.gnu.org/licenses/agpl.txt AGPL 3 or later
 * @version   2009-05-21
 * @link      http://www.mclibre.org
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

define('ZONA_HORARIA',           'Europe/Madrid');  // Zona horaria del servidor
define('CABECERA_CON_CURSOR',    TRUE);             // Para funci�n cabecera()
define('CABECERA_SIN_CURSOR',    FALSE);            // Para funci�n cabecera()
define('FORM_METHOD',            'get');  // Formularios se env�an con GET
//define('FORM_METHOD',            'post'); // Formularios se env�an con POST
define('MYSQL',                  'MySQL');
define('SQLITE',                 'SQLite');
define('TAM_TITULO',             50);   // Tama�o del campo Discusiones > T�tulo
define('TAM_DESCRIPCION',        50);   // Tama�o del campo Discusiones > Descripci�n
define('TAM_AUTOR',              50);   // Tama�o del campo Discusiones > Autor
define('TAM_INTERVENCION',       255);  // Tama�o del campo Intervenciones > Intervenci�n
define('MAX_REG_DISCUSIONES',    10);   // N�mero m�ximo de registros en la tabla Discusiones
define('MAX_REG_INTERVENCIONES', 20);   // N�mero m�ximo de registros en la tabla Intervenciones
define('ANONIMO_AUTOR',          'Rata cobarde');     // Autor predeterminado
define('ANONIMO_TITULO',         'Sin t�tulo');       // T�tulo predeterminado
define('ANONIMO_DESCRIPCION',    'Sin descripci�n');  // Descripci�n predeterminada
define('ANONIMO_INTERVENCION',   'Sin texto');        // Intervenci�n predeterminada

$dbMotor = SQLITE;                               // Base de datos empleada
if ($dbMotor==MYSQL) {
    define('MYSQL_HOST', 'mysql:host=localhost'); // Nombre de host MYSQL
    define('MYSQL_USUARIO', 'root');             // Nombre de usuario de MySQL
    define('MYSQL_PASSWORD', '');                // Contrase�a de usuario de MySQL
    $dbDb             = 'mclibre_foro';          // Nombre de la base de datos
    $dbDiscusiones    = $dbDb.'.discusiones';    // Nombre de la tabla Discusiones
    $dbIntervenciones = $dbDb.'.intervenciones'; // Nombre de la tabla Intervenciones
} elseif ($dbMotor==SQLITE) {
    $dbDb             = '/home/barto/mclibre/tmp/mclibre/mclibre_foro.sqlite';  // Nombre de la base de datos
    $dbDiscusiones    = 'discusiones';           // Nombre de la tabla Discusiones
    $dbIntervenciones = 'intervenciones';        // Nombre de la tabla Intervenciones
}

$recorta = [
    'titulo'       => TAM_TITULO,
    'descripcion'  => TAM_DESCRIPCION,
    'autor'        => TAM_AUTOR,
    'intervencion' => TAM_INTERVENCION
];

function conectaDb()
{
    global $dbMotor, $dbDb;

    try {
        if ($dbMotor==MYSQL) {
            $db = new PDO(MYSQL_HOST, MYSQL_USUARIO, MYSQL_PASSWORD);
            $db->setAttribute(PDO::MYSQL_ATTR_USE_BUFFERED_QUERY, TRUE);
        } elseif ($dbMotor==SQLITE) {
            $db = new PDO('sqlite:'.$dbDb);
        }
        return($db);
    } catch (PDOException $e) {
        cabecera('Error grave', CABECERA_SIN_CURSOR, 'menuPrincipal', '');
        print "<p>Error: No puede conectarse con la base de datos.</p>\n";
        print "<p>Error: " . $e->getMessage() . "</p>\n";
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

function recogeParaConsulta($db, $var, $var2='')
{
    $tmp = (isset($_REQUEST[$var]) && ($_REQUEST[$var]!='')) ?
        trim(strip_tags($_REQUEST[$var])) : trim(strip_tags($var2));
    if (get_magic_quotes_gpc()) {
        $tmp = stripslashes($tmp);
    }
    $tmp = str_replace('&', '&amp;',  $tmp);
    $tmp = str_replace('"', '&quot;', $tmp);
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
            $tmp = str_replace('&', '&amp;',  $tmp);
            $tmp = str_replace('"', '&quot;', $tmp);
            $tmp = recorta($var, $tmp);
            if (!is_numeric($tmp)) {
                $tmp = $db->quote($tmp);
            }
            $indiceLimpio = $tmp;

            $tmp = trim(strip_tags($valor));
            if (get_magic_quotes_gpc()) {
                $tmp = stripslashes($tmp);
            }
            $tmp = str_replace('&', '&amp;',  $tmp);
            $tmp = str_replace('"', '&quot;', $tmp);
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
        if (isset($var[0]) && ($var[0]=="'")) {
            $var = substr($var, 1, strlen($var)-1);
        }
        if (isset($var[strlen($var)-1]) && ($var[strlen($var)-1]=="'")) {
            $var = substr($var, 0, strlen($var)-1);
        }
    }
    return $var;
}

function fechaDma($amd)
{
    return substr($amd, 8, 2)."-".substr($amd, 5, 2)."-".substr($amd, 0, 4)
        ." a las ".substr($amd, 11, 8);
}

function cabecera($texto, $conCursor=CABECERA_SIN_CURSOR, $menu='menuPrincipal', $id='')
{
    print "<?xml version=\"1.0\" encoding=\"iso-8859-1\"?".">
<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Strict//EN\"
       \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd\">
<html xmlns=\"http://www.w3.org/1999/xhtml\">
<head>
  <meta http-equiv=\"Content-Type\" content=\"text/html; charset=iso-8859-1\" />
  <title>www.mclibre.org - Foro - $texto</title>
  <link href=\"mclibre-php-soluciones-proyectos-foro.css\" rel=\"stylesheet\" type=\"text/css\" />
</head>\n\n";
    if ($conCursor) {
        print "<body onload=\"document.getElementById('cursor').focus()\">\n";
    } else {
        print "<body>\n";
    }
    print "<h1>Foro - $texto</h1>
<div id=\"menu\">
<ul>\n";
    if ($menu=='menuDiscusiones') {
        print "  <li><a href=\"index.php\">Inicio</a></li>";
    } elseif ($menu=='menuHilos') {
        print "  <li><a href=\"index.php\">Inicio</a></li>
  <li><a href=\"hil-anyadir-1.php?hilo=$id\">Intervenir</a></li>
  <li><a href=\"hil-index.php?hilo=$id\">Ver intervenciones</a></li>";
    } elseif ($menu=='menuEditor') {
        print "  <li><a href=\"index.php\">Inicio</a></li>
  <li><a href=\"edi-borrar-disc-1.php\">Borrar discusiones</a></li>
  <li><a href=\"edi-borrar-inte-1.php\">Borrar intervenciones</a></li>
  <li><a href=\"edi-borrar-todo-1.php\">Borrar todo</a></li>";
    } else {
        print "  <li><a href=\"dis-anyadir-1.php\">Nueva discusi�n</a></li>
  <li><a href=\"edi-index.php\">Editor</a></li>";
    }
    print "\n</ul>\n</div>\n\n<div id=\"contenido\">\n";
}

function pie()
{
print '</div>

<div id="pie">
<address>
  Este programa forma parte del curso "P�ginas web con PHP" disponible en <a
  href="http://www.mclibre.org/">http://www.mclibre.org</a><br />
  Autor: Bartolom� Sintes Marco<br />
  �ltima modificaci�n de este programa: 21 de mayo de 2009
</address>
<p class="licencia">El programa PHP que genera esta p�gina est� bajo
<a rel="license" href="http://www.gnu.org/licenses/agpl.txt">licencia AGPL 3 o
posterior</a>.</p>
</div>
</body>
</html>';
}
