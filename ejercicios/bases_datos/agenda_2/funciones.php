<?php
/**
 * Multiagenda -  funciones.php
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

define('CABECERA_CON_CURSOR',    TRUE);   // Para funci�n cabecera()
define('CABECERA_SIN_CURSOR',    FALSE);  // Para funci�n cabecera()
define('FORM_METHOD',            'get');  // Formularios se env�an con GET
//define('FORM_METHOD',            'post'); // Formularios se env�an con POST
define('MYSQL',          'MySQL');
define('SQLITE',         'SQLite');
define('TAM_USUARIO',      20);  // Tama�o del campo Usuarios > Usuario
define('TAM_PASSWORD',     20);  // Tama�o del campo Usuarios > Contrase�a
define('TAM_CIFRADO',      32);  // Tama�o del campo Usuarios > Contrase�a en MD5
define('TAM_NOMBRE',       40);  // Tama�o del campo Agenda > Nombre
define('TAM_APELLIDOS',    60);  // Tama�o del campo Agenda > Apellidos
define('TAM_TELEFONO',     10);  // Tama�o del campo Agenda > Tel�fono
define('TAM_CORREO',       50);  // Tama�o del campo Agenda > Correo
define('MAX_REG_USUARIOS', 20);  // N�mero m�ximo de registros en la tabla Usuarios
define('MAX_REG_AGENDA',   20);  // N�mero m�ximo de registros en la tabla Agenda

$dbMotor = SQLITE;                         // Base de datos empleada
if ($dbMotor==MYSQL) {
    define('MYSQL_HOST', 'mysql:host=localhost'); // Nombre de host MYSQL
    define('MYSQL_USUARIO', 'root');      // Nombre de usuario de MySQL
    define('MYSQL_PASSWORD', '');         // Contrase�a de usuario de MySQL
    $dbDb       = 'mclibre_multiagenda';  // Nombre de la base de datos
    $dbUsuarios = $dbDb.'.usuarios';      // Nombre de la tabla de Usuarios
    $dbAgenda   = $dbDb.'.agenda';        // Nombre de la tabla de Agendas
    $consultaExisteTabla = "SELECT COUNT(*) as existe_db
        FROM INFORMATION_SCHEMA.SCHEMATA WHERE SCHEMA_NAME='$dbDb'";
} elseif ($dbMotor==SQLITE) {
    $dbDb       = '/home/barto/mclibre/tmp/mclibre/mclibre_multiagenda.sqlite';  // Nombre de la base de datos
    $dbUsuarios = 'usuarios';             // Nombre de la tabla de Usuarios
    $dbAgenda   = 'agenda';               // Nombre de la tabla de Agendas
    $consultaExisteTabla = "SELECT COUNT(*) as existe_db
        FROM sqlite_master WHERE type='table' AND name='$dbUsuarios'";
}

$administradorNombre   = 'root';  // Nombre del usuario Administrador
$administradorPassword = 'root';  // Password del usuario Administrador
// Si $administradorPassword!='', al crearse las tablas, se crea el usuario
// Si $administradorPassword=='', no se crea el usuario
// Lo he hecho para que en el ejemplo colgado en la web la gente pueda entrar
// como Administrador

$recorta = array(
    'usuario'   => TAM_USUARIO,
    'password'  => TAM_CIFRADO,
    'nombre'    => TAM_NOMBRE,
    'apellidos' => TAM_APELLIDOS,
    'telefono'  => TAM_TELEFONO,
    'correo'    => TAM_CORREO);

ini_set('session.save_handler', 'files'); // Por si session.save_handler = user en php.ini

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
        cabecera('Error grave', CABECERA_SIN_CURSOR, 'menu_principal');
        print "<p>Error: No puede conectarse con la base de datos.</p>\n";
//        print "<p>Error: " . $e->getMessage() . "</p>\n";
        pie();
        exit();
    }
}

function borraTodoMySQL($db)
{
    global $dbDb, $dbAgenda, $dbUsuarios, $administradorNombre,
        $administradorPassword;

    $consulta = "DROP DATABASE $dbDb";
    if ($db->query($consulta)) {
        print "<p>Base de datos borrada correctamente.</p>\n";
    } else {
        print "<p>Error al borrar la base de datos.</p>\n";
    }
    $consulta = "CREATE DATABASE $dbDb";
    if ($db->query($consulta)) {
        print "<p>Base de datos creada correctamente.</p>\n";
        $consultaCreaTablaUsuarios = "CREATE TABLE $dbUsuarios (
            id INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
            usuario VARCHAR(".TAM_USUARIO."),
            password VARCHAR(".TAM_CIFRADO."),
            PRIMARY KEY(id) )";
        if ($db->query($consultaCreaTablaUsuarios)) {
            print "<p>Tabla de Usuarios creada correctamente.</p>\n";
        } else {
            print "<p>Error al crear la tabla de Usuarios.</p>\n";
        }
        if ($administradorPassword!='') {
            $consulta = "INSERT INTO $dbUsuarios VALUES (NULL,
                '$administradorNombre', '".md5($administradorPassword)."')";
            if ($db->query($consulta)) {
                print "<p>Registro de Usuario Administrador creado correctamente.</p>\n";
            } else {
                print "<p>Error al crear el registro de Usuario Administrador.</p>\n";
            }
        }
        $consultaCreaTablaAgenda = "CREATE TABLE $dbAgenda (
            id INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
            id_usuario INTEGER UNSIGNED,
            nombre VARCHAR(".TAM_NOMBRE."),
            apellidos VARCHAR(".TAM_APELLIDOS."),
            telefono VARCHAR(".TAM_TELEFONO."),
            correo VARCHAR(".TAM_CORREO."),
            PRIMARY KEY(id) )";
        if ($db->query($consultaCreaTablaAgenda)) {
            print "<p>Tabla de Agenda creada correctamente.</p>\n";
        } else {
            print "<p>Error al crear la tabla de Agenda.</p>\n";
        }
    } else {
        print "<p>Error al crear la base de datos.</p>\n";
    }
}

function borraTodoSqlite($db)
{
    global $dbAgenda, $dbUsuarios, $administradorNombre,
        $administradorPassword;

    $consulta = "DROP TABLE $dbAgenda";
    if ($db->query($consulta)) {
       print "<p>Tabla de Agenda borrada correctamente.</p>\n";
    } else {
        print "<p>Error al borrar la tabla de Agenda.</p>\n";
    }
    $consulta = "DROP TABLE $dbUsuarios";
    if ($db->query($consulta)) {
       print "<p>Tabla de Usuarios borrada correctamente.</p>\n";
    } else {
        print "<p>Error al borrar la tabla de Usuarios.</p>\n";
    }
    $consultaCreaTablaUsuarios = "CREATE TABLE $dbUsuarios (
        id INTEGER PRIMARY KEY,
        usuario VARCHAR(".TAM_USUARIO."),
        password VARCHAR(".TAM_CIFRADO.")
        )";
    if ($db->query($consultaCreaTablaUsuarios)) {
        print "<p>Tabla de Usuarios creada correctamente.</p>\n";
    } else {
        print "<p>Error al crear la tabla de Usuarios.</p>\n";
    }
    if ($administradorPassword!='') {
        $consulta = "INSERT INTO $dbUsuarios VALUES (NULL,
                '$administradorNombre', '".md5($administradorPassword)."')";
        if ($db->query($consulta)) {
            print "<p>Registro de Usuario Administrador creado correctamente.</p>\n";
        } else {
            print "<p>Error al crear el registro de Usuario Administrador.</p>\n";
        }
    }
    $consultaCreaTablaAgenda = "CREATE TABLE $dbAgenda (
        id INTEGER PRIMARY KEY,
        id_usuario INTEGER,
        nombre VARCHAR(".TAM_NOMBRE."),
        apellidos VARCHAR(".TAM_APELLIDOS."),
        telefono VARCHAR(".TAM_TELEFONO."),
        correo VARCHAR(".TAM_CORREO.")
        )";
    if ($db->query($consultaCreaTablaAgenda)) {
       print "<p>Tabla de Agenda creada correctamente.</p>\n";
    } else {
        print "<p>Error al crear la tabla de Agenda.</p>\n";
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
    $tmpMatriz = array();
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

function cabecera($texto, $conCursor=CABECERA_SIN_CURSOR, $menu='menu_principal')
{
    global $administradorNombre;

    print "<?xml version=\"1.0\" encoding=\"iso-8859-1\"?".">
<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Strict//EN\"
       \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd\">
<html xmlns=\"http://www.w3.org/1999/xhtml\">
<head>
  <meta http-equiv=\"Content-Type\" content=\"text/html; charset=iso-8859-1\" />
  <title>www.mclibre.org - Agenda multiusuario - $texto</title>
  <link href=\"mclibre-php-soluciones-proyectos-comun.css\" rel=\"stylesheet\" type=\"text/css\" />
</head>\n\n";
    if ($conCursor) {
        print "<body onload=\"document.getElementById('cursor').focus()\">\n";
    } else {
        print "<body>\n";
    }
    print "<h1>Agenda ";
    if ($menu=='menu_principal') {
        print "multiusuario";
    } else {
        print "de $menu";
    }
    print " - $texto</h1>
<div id=\"menu\">
<ul>\n";
    if ($menu=='menu_principal') {
        print "  <li><a href=\"index.php\">Conectar</a></li>";
    } elseif ($menu==$administradorNombre) {
        print "  <li><a href=\"borrartodo1.php\">Borrar todo</a></li>
  <li><a href=\"salir.php\">Desconectar</a></li>";
    } else {
        print "  <li><a href=\"anyadir1.php\">A�adir</a></li>
  <li><a href=\"listar.php\">Listar</a></li>
  <li><a href=\"modificar1.php\">Modificar</a></li>
  <li><a href=\"buscar1.php\">Buscar</a></li>
  <li><a href=\"borrar1.php\">Borrar</a></li>
  <li><a href=\"salir.php\">Desconectar</a></li>";
    }
    print "</ul>\n</div>\n\n<div id=\"contenido\">\n";
}

function pie()
{
    global $administradorPassword, $_SESSION;

    if (($administradorPassword!='') &&!isset($_SESSION['multiagendaUsuario'])) {
        print "<p><strong>Nota</strong>: El usuario Administrador "
            ."se llama <strong>root</strong> y su contrase�a es\ntambi�n "
            ."<strong>root</strong>.</p>\n";
    }
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
