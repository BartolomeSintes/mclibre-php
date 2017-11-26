<?php
/**
 * Poliagenda -  funciones.php
 *
 * @author    Bartolom� Sintes Marco <bartolome.sintes+mclibre@gmail.com>
 * @copyright 2008 Bartolom� Sintes Marco
 * @license   http://www.gnu.org/licenses/agpl.txt AGPL 3 or later
 * @version   2008-03-02
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

define ('MYSQL', 'MySQL');
define ('SQLITE', 'SQLite');
$dbMotor = SQLITE;                         // Base de datos empleada
if ($dbMotor==MYSQL) {
    define('MYSQL_HOST', 'mysql:host=localhost'); // Nombre de host MYSQL
    define('MYSQL_USUARIO', 'root');      // Nombre de usuario de MySQL
    define('MYSQL_PASSWORD', '');         // Contrase�a de usuario de MySQL
    $dbDb       = 'mclibre_poliagenda';  // Nombre de la base de datos
    $dbUsuarios = $dbDb.'.usuarios';      // Nombre de la tabla de Usuarios
    $dbAgenda   = $dbDb.'.agenda';        // Nombre de la tabla de Agendas
    $consultaExisteTabla = "SELECT COUNT(*) as existe_db
        FROM INFORMATION_SCHEMA.SCHEMATA WHERE SCHEMA_NAME='$dbDb'";
} elseif ($dbMotor==SQLITE) {
    $dbDb       = '/home/barto/mclibre/tmp/mclibre/mclibre_poliagenda.sqlite3';  // Nombre de la base de datos
    $dbUsuarios = 'usuarios';             // Nombre de la tabla de Usuarios
    $dbAgenda   = 'agenda';               // Nombre de la tabla de Agendas
    $consultaExisteTabla = "SELECT COUNT(*) as existe_db
        FROM sqlite_master WHERE type='table' AND name='$dbUsuarios'";
}

$administradorNombre   = 'root';   // Nombre del usuario Administrador
$administradorPassword = 'root';   // Password del usuario Administrador
$administradorIdioma   = 'es_ES';  // Idioma del usuario Administrador
$idiomaPredeterminado  = 'es_ES';  // Idioma predeterminado
// Si $administradorPassword != '', al crearse las tablas, se crea el usuario
// Si $administradorPassword == '', no se crea el usuario
// Lo he hecho para que en el ejemplo colgado en la web la gente pueda entrar
// como Administrador
$tamUsuario     = 20;  // Tama�o del campo Usuario
$tamPassword    = 20;  // Tama�o del campo Contrase�a
$tamIdioma      = 5;   // Tama�o del campo Idioma
$tamCifrado     = 32;  // Tama�o del campo contrase�a en MD5
$tamNombre      = 40;  // Tama�o del campo Nombre
$tamApellidos   = 60;  // Tama�o del campo Apellidos
$tamTelefono    = 10;  // Tama�o del campo Tel�fono
$tamCorreo      = 50;  // Tama�o del campo Correo
$maxRegUsuarios = 20;  // N�mero m�ximo de registros en la tabla Usuarios
$maxRegAgenda   = 20;  // N�mero m�ximo de registros por usuario en la tabla Agenda
$recorta = [
    'usuario'   => $tamUsuario,
    'password'  => $tamCifrado,
    'nombre'    => $tamNombre,
    'apellidos' => $tamApellidos,
    'telefono'  => $tamTelefono,
    'correo'    => $tamCorreo
];

if (isset($_SESSION['multiagendaIdioma'])) {
    $language = $_SESSION['multiagendaIdioma'];
} elseif (isset($_REQUEST['idioma'])) {
    $language = recogeIdioma();
} else {
    $language = $idiomaPredeterminado;
}
putenv("LC_ALL=$language");
setlocale(LC_ALL, $language);
bindtextdomain("messages", "./locale");
textdomain("messages");

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
        cabecera(_('Error grave'));
        print "<p>"._('Error: No puede conectarse con la base de datos').".</p>\n";
//        print "<p>Error: " . $e->getMessage() . "</p>\n";
        pie();
        exit();
    }
}

function borraTodoMySQL($db)
{
    global $dbDb, $dbAgenda, $dbUsuarios, $tamUsuario, $tamIdioma, $tamCifrado,
        $tamNombre, $tamApellidos, $tamTelefono, $tamCorreo,
        $administradorNombre, $administradorPassword;

    $consulta = "DROP DATABASE $dbDb";
    if ($db->query($consulta)) {
        print "<p>"._('Base de datos borrada correctamente').".</p>\n";
    } else {
        print "<p>"._('Error al borrar la base de datos').".</p>\n";
    }
    $consulta = "CREATE DATABASE $dbDb";
    if ($db->query($consulta)) {
        print "<p>"._('Base de datos creada correctamente').".</p>\n";
        $consulta_creatabla_usuarios = "CREATE TABLE $dbUsuarios (
            id INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
            usuario VARCHAR($tamUsuario),
            password VARCHAR($tamCifrado),
            idioma VARCHAR($tamIdioma),
            PRIMARY KEY(id) )";
        if ($db->query($consulta_creatabla_usuarios)) {
            print "<p>"._('Tabla de Usuarios creada correctamente').".</p>\n";
        } else {
            print "<p>"._('Error al crear la tabla de Usuarios').".</p>\n";
        }
        if ($administradorPassword!='') {
            $consulta = "INSERT INTO $dbUsuarios VALUES (NULL,
                '$administradorNombre', '".md5($administradorPassword)
                ."', '$tamIdioma')";
            if ($db->query($consulta)) {
                print "<p>"._('Registro de Usuario Administrador creado correctamente').".</p>\n";
            } else {
                print "<p>"._('Error al crear el registro de Usuario Administrador').".</p>\n";
            }
        }
        $consulta_creatabla_agenda = "CREATE TABLE $dbAgenda (
            id INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
            id_usuario INTEGER UNSIGNED,
            nombre VARCHAR($tamNombre),
            apellidos VARCHAR($tamApellidos),
            telefono VARCHAR($tamTelefono),
            correo VARCHAR($tamCorreo),
            PRIMARY KEY(id) )";
        if ($db->query($consulta_creatabla_agenda)) {
            print "<p>"._('Tabla de Agenda creada correctamente').".</p>\n";
        } else {
            print "<p>"._('Error al crear la tabla de Agenda').".</p>\n";
        }
    } else {
        print "<p>"._('Error al crear la base de datos').".</p>\n";
    }
}

function borraTodoSqlite($db)
{
    global $dbAgenda, $dbUsuarios, $tamUsuario, $tamCifrado, $tamIdioma,
        $tamNombre, $tamApellidos, $tamTelefono, $tamCorreo,
        $administradorNombre, $administradorPassword;

    $consulta = "DROP TABLE $dbAgenda";
    if ($db->query($consulta)) {
       print "<p>"._('Tabla de Agenda borrada correctamente').".</p>\n";
    } else {
        print "<p>"._('Error al borrar la tabla de Agenda').".</p>\n";
    }
    $consulta = "DROP TABLE $dbUsuarios";
    if ($db->query($consulta)) {
       print "<p>"._('Tabla de Usuarios borrada correctamente').".</p>\n";
    } else {
        print "<p>"._('Error al borrar la tabla de Usuarios').".</p>\n";
    }
    $consulta_creatabla_usuarios = "CREATE TABLE $dbUsuarios (
        id INTEGER PRIMARY KEY,
        usuario VARCHAR($tamUsuario),
        password VARCHAR($tamCifrado),
        idioma VARCHAR($tamIdioma)
        )";
    if ($db->query($consulta_creatabla_usuarios)) {
        print "<p>"._('Tabla de Usuarios creada correctamente.')."</p>\n";
    } else {
        print "<p>"._('Error al crear la tabla de Usuarios').".</p>\n";
    }
    if ($administradorPassword!='') {
        $consulta = "INSERT INTO $dbUsuarios VALUES (NULL,
            '$administradorNombre', '".md5($administradorPassword)
            ."','$tamIdioma')";
        if ($db->query($consulta)) {
            print "<p>"._('Registro de Usuario Administrador creado correctamente').".</p>\n";
        } else {
            print "<p>"._('Error al crear el registro de Usuario Administrador').".</p>\n";
        }
    }
    $consulta_creatabla_agenda = "CREATE TABLE $dbAgenda (
        id INTEGER PRIMARY KEY,
        id_usuario INTEGER,
        nombre VARCHAR($tamNombre),
        apellidos VARCHAR($tamApellidos),
        telefono VARCHAR($tamTelefono),
        correo VARCHAR($tamCorreo)
        )";
    if ($db->query($consulta_creatabla_agenda)) {
       print "<p>"._('Tabla de Agenda creada correctamente').".</p>\n";
    } else {
        print "<p>"._('Error al crear la tabla de Agenda').".</p>\n";
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
    $tmp = (isset($_REQUEST[$var])&&($_REQUEST[$var]!='')) ?
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
        if (isset($var[0])&&($var[0]=="'")) {
            $var = substr($var, 1, strlen($var)-1);
        }
        if (isset($var[strlen($var)-1])&&($var[strlen($var)-1]=="'")) {
            $var = substr($var, 0, strlen($var)-1);
        }
    }
    return $var;
}

function recogeIdioma()
{
    $tmp=(isset($_REQUEST['idioma']))?trim(strip_tags($_REQUEST['idioma'])):"es_ES";
    if (($tmp!='es_ES')&&($tmp!='en_GB')) {
        $tmp = 'es_ES';
    }
    return $tmp;
}

function menuIdioma()
{
    print   "<ul>
    <li><a href=\"".$_SERVER['PHP_SELF']."?idioma=en_GB\">English</a></li>
    <li><a href=\"".$_SERVER['PHP_SELF']."?idioma=es_ES\">Espa�ol</a></li>
  </ul>\n";
}

function cabecera($texto, $menu='menu_principal')
{
    global $administradorNombre;

    print "<?xml version=\"1.0\" encoding=\"iso-8859-1\"?".">
<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Strict//EN\"
       \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd\">
<html xmlns=\"http://www.w3.org/1999/xhtml\">
<head>
  <meta http-equiv=\"Content-Type\" content=\"text/html; charset=iso-8859-1\" />
  <title>www.mclibre.org - "._("Agenda multiling�e")." - $texto</title>
  <link href=\"mclibre-soluciones.css\" rel=\"stylesheet\" type=\"text/css\" />
</head>

<body onload=\"document.getElementById('cursor').focus()\">\n";
    if ($menu=='menu_principal') {
        print "<h1>"._('Agenda multiling�e');
    } else {
        print "<h1>"._('Agenda de')." $menu";
    }
    print " - "._($texto)."</h1>
<div id=\"menu\">
<ul>\n";
    if ($menu=='menu_principal') {
        print "  <li><a href=\"index.php\">"._('Conectar')."</a></li>";
    } elseif ($menu==$administradorNombre) {
        print "  <li><a href=\"borrartodo1.php\">"._('Borrar todo')."</a></li>
  <li><a href=\"salir.php\">"._("Desconectar")."</a></li>";
    } else {
        print "  <li><a href=\"anyadir1.php\">"._('A�adir')."</a></li>
  <li><a href=\"listar.php\">"._('Listar')."</a></li>
  <li><a href=\"modificar1.php\">"._('Modificar')."</a></li>
  <li><a href=\"buscar1.php\">"._('Buscar')."</a></li>
  <li><a href=\"borrar1.php\">"._('Borrar')."</a></li>
  <li><a href=\"salir.php\">"._('Desconectar')."</a></li>";
    }
    print "</ul>\n</div>\n\n<div id=\"contenido\">\n";
}

function pie()
{
    global $administradorPassword, $_SESSION;

    if (($administradorPassword!='')&&!isset($_SESSION['multiagendaUsuario'])) {
        print "<p><strong>"._('Nota')."</strong>: "
          ._('El usuario Administrador se llama <strong>root</strong> y su contrase�a es tambi�n <strong>root</strong>').".</p>\n";
    }
    print '</div>

<div id="pie">
<address>
  '._('Este programa forma parte del curso "P�ginas web con PHP" disponible en').' <a
  href="http://www.mclibre.org/">http://www.mclibre.org</a><br />
  '._('Autor').': Bartolom� Sintes Marco<br />
  '._('�ltima modificaci�n de este programa: 27 de febrero de 2008').'
</address>
<p class="licencia">'._('El programa PHP que genera esta p�gina est� bajo <a rel="license" href="http://www.gnu.org/licenses/agpl.txt">licencia AGPL 3 o posterior').'</a>.</p>
</div>
</body>
</html>';
}
