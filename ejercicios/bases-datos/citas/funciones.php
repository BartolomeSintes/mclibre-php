<?php
/**
 * Citas -  funciones.php
 *
 * @author    Bartolom� Sintes Marco <bartolome.sintes+mclibre@gmail.com>
 * @copyright 2008 Bartolom� Sintes Marco
 * @license   http://www.gnu.org/licenses/agpl.txt AGPL 3 or later
 * @version   2008-06-06
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
    // NO HE PROBADO EL PROGRAMA CON MYSQL
    define('MYSQL_HOST', 'mysql:host=localhost'); // Nombre de host MYSQL
    define('MYSQL_USUARIO', 'root');       // Nombre de usuario de MySQL
    define('MYSQL_PASSWORD', '');          // Contrase�a de usuario de MySQL
    $dbDb        = 'mclibre_etiquetas';    // Nombre de la base de datos
    $dbUsuarios  = $dbDb.'.usuarios';      // Nombre de la tabla de Usuarios
    $dbEtiquetas = $dbDb.'.etiquetas';     // Nombre de la tabla de Etiquetas
    $dbElegidas  = $dbDb.'.elegidas';      // Nombre de la tabla de etiquetas elegidas
    $consultaExisteTabla = "SELECT COUNT(*) as existe_db
        FROM INFORMATION_SCHEMA.SCHEMATA WHERE SCHEMA_NAME='$dbDb'";
} elseif ($dbMotor==SQLITE) {
    $dbDb        = '/home/barto/mclibre/tmp/mclibre/mclibre_citas.sqlite3';  // Nombre de la base de datos
    $dbUsuarios  = 'usuarios';   // Nombre de la tabla de Usuarios
    $dbCitas     = 'citas';      // Nombre de la tabla de Citas
    $dbAutores   = 'autores';    // Nombre de la tabla de Autores
    $dbEtiquetas = 'etiquetas';  // Nombre de la tabla de Etiquetas
    $dbEtiCitas  = 'eticitas';   // Nombre de la tabla de Etiquetas por cita
    $consultaExisteTabla = "SELECT COUNT(*) as existe_db
        FROM sqlite_master WHERE type='table' AND name='$dbUsuarios'";
}

$administradorNombre   = 'root';  // Nombre del usuario Administrador
$administradorPassword = 'root';  // Password del usuario Administrador
// Si $administradorPassword != '', al crearse las tablas, se crea el usuario
// Si $administradorPassword = '', no se crea el usuario
// Lo he hecho para que en el ejemplo colgado en la web la gente pueda entrar
// como Administrador
$tamUsuario      = 20;   // Tama�o del campo Usuarios > Usuario
$tamPassword     = 20;   // Tama�o del campo Usuarios > Contrase�a
$tamCifrado      = 32;   // Tama�o del campo Usuarios > Contrase�a en MD5
$tamCita         = 255;  // Tama�o del campo Citas > Cita
$tamEtiqueta     = 30;   // Tama�o del campo Etiquetas > Etiqueta
$tamNombre       = 30;   // Tama�o del campo Autores > Nombre
$tamApellidos    = 30;   // Tama�o del campo Autores > Apellidos
$tamIdUsuario    = 10;   // Tama�o del campo id Usuario
$tamIdCita       = 10;   // Tama�o del campo id Cita
$tamIdEtiqueta   = 10;   // Tama�o del campo id Etiqueta
$minFontSize     = 80;   // Porcentaje m�nimo de tipo de letra
$maxFontSize     = 400;  // Porcentaje m�nimo de tipo de letra
$maxRegUsuarios  = 30;   // N�mero m�ximo de registros en la tabla Usuarios
$maxRegAutores   = 30;   // N�mero m�ximo de registros en la tabla Autores
$maxRegCitas     = 30;   // N�mero m�ximo de registros en la tabla Citas
$maxRegEtiquetas = 30;   // N�mero m�ximo de registros en la tabla Etiquetas
$recorta = [
    'usuario'    => $tamUsuario,
    'password'   => $tamCifrado,
    'etiqueta'   => $tamEtiqueta,
    'idUsuario'  => $tamIdUsuario,
    'idEtiqueta' => $tamIdEtiqueta
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
        cabecera('Error grave');
        print "<p>Error: No puede conectarse con la base de datos.</p>\n";
//        print "<p>Error: " . $e->getMessage() . "</p>\n";
        pie();
        exit();
    }
}

function borraTodoMySQL($db)
{
    global $dbDb, $dbArticulos, $dbUsuarios, $tamUsuario, $tamCifrado, $tamArticulo,
        $tamPrecio, $tamFechaCompra, $administradorNombre, $administradorPassword;

    $consulta = "DROP DATABASE $dbDb";
    if ($db->query($consulta)) {
        print "<p>Base de datos borrada correctamente.</p>\n";
    } else {
        print "<p>Error al borrar la base de datos.</p>\n";
    }
    $consulta = "CREATE DATABASE $dbDb";
    if ($db->query($consulta)) {
        print "<p>Base de datos creada correctamente.</p>\n";
        $consulta_creatabla_usuarios = "CREATE TABLE $dbUsuarios (
            id INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
            usuario VARCHAR($tamUsuario),
            password VARCHAR($tamCifrado),
            PRIMARY KEY(id) )";
        if ($db->query($consulta_creatabla_usuarios)) {
            print "<p>Tabla de Usuarios creada correctamente.</p>\n";
        } else {
            print "<p>Error al crear la tabla de Usuarios.</p>\n";
        }
        if ($administradorPassword!='') {
            $consulta = "INSERT INTO $dbUsuarios
                VALUES (NULL, '$administradorNombre', '"
                .md5($administradorPassword)."')";
            if ($db->query($consulta)) {
                print "<p>Registro de Usuario Administrador creado correctamente.</p>\n";
            } else {
                print "<p>Error al crear el registro de Usuario Administrador.</p>\n";
            }
        }
        $consulta_creatabla_articulos = "CREATE TABLE $dbArticulos (
            id INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
            articulo VARCHAR($tamArticulo),
            precio FLOAT,
            id_vendedor INTEGER,
            id_comprador INTEGER,
            reservado BOOLEAN,
            fecha_reserva DATETIME,
            comprado BOOLEAN,
            fecha_compra DATE,
            PRIMARY KEY(id) )";
        if ($db->query($consulta_creatabla_articulos)) {
            print "<p>Tabla de Art�culos creada correctamente.</p>\n";
        } else {
            print "<p>Error al crear la tabla de Art�culos.</p>\n";
        }
    } else {
        print "<p>Error al crear la base de datos.</p>\n";
    }
}

function borraTodoSqlite($db)
{
    global $dbUsuarios, $tamUsuario, $tamCifrado, $dbCitas, $tamCita,
        $dbAutores, $tamNombre, $tamApellidos, $dbEtiquetas, $tamEtiqueta,
        $dbEtiCitas, $administradorNombre, $administradorPassword;

    $consulta = "DROP TABLE $dbUsuarios";
    if ($db->query($consulta)) {
       print "<p>Tabla de Usuarios borrada correctamente.</p>\n";
    } else {
        print "<p>Error al borrar la tabla de Usuarios.</p>\n";
    }
    $consulta = "DROP TABLE $dbCitas";
    if ($db->query($consulta)) {
       print "<p>Tabla de Citas borrada correctamente.</p>\n";
    } else {
        print "<p>Error al borrar la tabla de Citas.</p>\n";
    }
    $consulta = "DROP TABLE $dbAutores";
    if ($db->query($consulta)) {
       print "<p>Tabla de Autores borrada correctamente.</p>\n";
    } else {
        print "<p>Error al borrar la tabla de Autores.</p>\n";
    }
    $consulta = "DROP TABLE $dbEtiquetas";
    if ($db->query($consulta)) {
       print "<p>Tabla de Etiquetas borrada correctamente.</p>\n";
    } else {
        print "<p>Error al borrar la tabla de Etiquetas.</p>\n";
    }
    $consulta = "DROP TABLE $dbEtiCitas";
    if ($db->query($consulta)) {
       print "<p>Tabla de Etiquetas de Citas borrada correctamente.</p>\n";
    } else {
        print "<p>Error al borrar la tabla de Etiquetas de Citas.</p>\n";
    }
    $consultaCreatablaUsuarios = "CREATE TABLE $dbUsuarios (
        id INTEGER PRIMARY KEY,
        usuario VARCHAR($tamUsuario),
        password VARCHAR($tamCifrado)
        )";
    if ($db->query($consultaCreatablaUsuarios)) {
        print "<p>Tabla de Usuarios creada correctamente.</p>\n";
    } else {
        print "<p>Error al crear la tabla de Usuarios.</p>\n";
    }
    if ($administradorPassword!='') {
        $consulta = "INSERT INTO $dbUsuarios
            VALUES (NULL, '$administradorNombre', '".md5($administradorPassword)."')";
        if ($db->query($consulta)) {
            print "<p>Registro de Usuario Administrador creado correctamente.</p>\n";
        } else {
            print "<p>Error al crear el registro de Usuario Administrador.</p>\n";
        }
    }
    $consultaCreatablaCitas = "CREATE TABLE $dbCitas (
        id INTEGER PRIMARY KEY,
        cita VARCHAR($tamCita),
        id_autor INTEGER UNSIGNED
        )";
    if ($db->query($consultaCreatablaCitas)) {
       print "<p>Tabla de Citas creada correctamente.</p>\n";
    } else {
        print "<p>Error al crear la tabla de Citas.</p>\n";
    }
    $consultaCreatablaAutores = "CREATE TABLE $dbAutores (
        id INTEGER PRIMARY KEY,
        nombre VARCHAR($tamNombre),
        apellidos VARCHAR($tamApellidos)
        )";
    if ($db->query($consultaCreatablaAutores)) {
       print "<p>Tabla de Autores creada correctamente.</p>\n";
    } else {
        print "<p>Error al crear la tabla de Autores.</p>\n";
    }
    $consultaCreatablaEtiquetas = "CREATE TABLE $dbEtiquetas (
        id INTEGER PRIMARY KEY,
        etiqueta VARCHAR($tamEtiqueta)
        )";
    if ($db->query($consultaCreatablaEtiquetas)) {
       print "<p>Tabla de Etiquetas creada correctamente.</p>\n";
    } else {
        print "<p>Error al crear la tabla de Etiquetas.</p>\n";
    }
    $consultaCreatablaEticitas = "CREATE TABLE $dbEtiCitas (
        id INTEGER PRIMARY KEY,
        id_cita INTEGER UNSIGNED,
        id_etiqueta INTEGER UNSIGNED
        )";
    if ($db->query($consultaCreatablaEticitas)) {
       print "<p>Tabla de Etiquetas de Citas creada correctamente.</p>\n";
    } else {
        print "<p>Error al crear la tabla de Etiquetas de Citas.</p>\n";
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

function cabecera($texto, $menu='menu_principal')
{
    global $administradorNombre;

    print "<?xml version=\"1.0\" encoding=\"iso-8859-1\"?".">
<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Strict//EN\"
       \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd\">
<html xmlns=\"http://www.w3.org/1999/xhtml\">
<head>
  <meta http-equiv=\"Content-Type\" content=\"text/html; charset=iso-8859-1\" />
  <title>www.mclibre.org - Citas - $texto</title>
  <link href=\"mclibre-soluciones.css\" rel=\"stylesheet\" type=\"text/css\" />
</head>

<body onload=\"document.getElementById('cursor').focus()\">
<h1>Citas - $texto</h1>
<div id=\"menu\">
<ul>";
    if ($menu=='menu_principal') {
        print "
  <li><a href=\"cit-listar.php\">Ver citas</a></li>
  <li><a href=\"aut-listar.php\">Ver autores</a></li>
  <li><a href=\"eti-listar.php\">Ver etiquetas</a></li>
  <li><a href=\"index.php\">Conectar</a></li>";
    } elseif ($menu=='menu_autores') {
        print "
  <li><a href=\"index.php\">Inicio</a></li>
  <li><a href=\"aut-listar.php\">Listar</a></li>
  <li><a href=\"aut-anyadir-1.php\">A�adir</a></li>
  <li><a href=\"aut-borrar-1.php\">Borrar</a></li>";
      } elseif ($menu=='menu_etiquetas') {
        print "
  <li><a href=\"index.php\">Inicio</a></li>
  <li><a href=\"eti-listar.php\">Listar</a></li>
  <li><a href=\"eti-anyadir-1.php\">A�adir</a></li>
  <li><a href=\"eti-borrar-1.php\">Borrar</a></li>";
      } elseif ($menu=='menu_citas') {
        print "
  <li><a href=\"index.php\">Inicio</a></li>
  <li><a href=\"cit-listar.php\">Listar</a></li>
  <li><a href=\"cit-anyadir-1.php\">A�adir</a></li>
  <li><a href=\"cit-borrar-1.php\">Borrar</a></li>
  <li><a href=\"cit-etiquetas-1.php\">Asignar etiquetas</a></li>
  <li><a href=\"cit-eti-borrar-1.php\">Borrar etiquetas</a></li>";
      } elseif ($menu==$administradorNombre) {
        print "
  <li><a href=\"adm-borrar-todo-1.php\">Borrar todo</a></li>
  <li><a href=\"adm-borrar-eti-1.php\">Borrar etiquetas</a></li>
  <li><a href=\"eti-listar.php\">Ver etiquetas</a></li>
  <li><a href=\"salir.php\">Desconectar</a></li>";
    } else {
        print "
  <li><a href=\"cit-index.php\">Citas</a></li>
  <li><a href=\"aut-index.php\">Autores</a></li>
  <li><a href=\"eti-index.php\">Etiquetas</a></li>
  <li><a href=\"salir.php\">Desconectar</a></li>";
    }
    print "\n</ul>\n</div>\n\n<div id=\"contenido\">\n";
}

function pie()
{
    global $administradorPassword, $_SESSION;

    if (($administradorPassword!='')&&!isset($_SESSION['citasUsuario'])) {
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
  �ltima modificaci�n de este programa: 6 de junio de 2008
</address>
<p class="licencia">El programa PHP que genera esta p�gina est� bajo
<a rel="license" href="http://www.gnu.org/licenses/agpl.txt">licencia AGPL 3 o
posterior</a>.</p>
</div>
</body>
</html>';
}
