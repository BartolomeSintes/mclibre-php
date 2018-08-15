<?php
/**
 * Compraventa - biblioteca.php
 *
 * @author    Bartolomé Sintes Marco <bartolome.sintes+mclibre@gmail.com>
 * @copyright 2008 Bartolomé Sintes Marco
 * @license   http://www.gnu.org/licenses/agpl.txt AGPL 3 or later
 * @version   2008-02-27
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

define ("MYSQL", "MySQL");
define ("SQLITE", "SQLite");
$dbMotor = SQLITE;                         // Base de datos empleada
if ($dbMotor == MYSQL) {
    define('MYSQL_HOST', 'mysql:host=localhost'); // Nombre de host MYSQL
    define('MYSQL_USUARIO', 'root');       // Nombre de usuario de MySQL
    define('MYSQL_PASSWORD', '');          // Contraseña de usuario de MySQL
    $dbDb        = 'mclibre_compraventa';  // Nombre de la base de datos
    $dbUsuarios  = $dbDb . '.usuarios';      // Nombre de la tabla de Usuarios
    $dbArticulos = $dbDb . '.articulos';     // Nombre de la tabla de Artículos
    $consultaExisteTabla = "SELECT COUNT(*) as existe_db
        FROM INFORMATION_SCHEMA.SCHEMATA WHERE SCHEMA_NAME='$dbDb'";
} elseif ($dbMotor == SQLITE) {
    $dbDb        = '/home/barto/mclibre/tmp/mclibre/mclibre_compraventa.sqlite3';  // Nombre de la base de datos
    $dbUsuarios  = 'usuarios';             // Nombre de la tabla de Usuarios
    $dbArticulos = 'articulos';            // Nombre de la tabla de Agendas
    $consultaExisteTabla = "SELECT COUNT(*) as existe_db
        FROM sqlite_master WHERE type='table' AND name='$dbUsuarios'";
}

$administradorNombre   = 'root';  // Nombre del usuario Administrador
$administradorPassword = 'root';  // Password del usuario Administrador
// Si $administradorPassword != "", al crearse las tablas, se crea el usuario
// Si $administradorPassword = '', no se crea el usuario
// Lo he hecho para que en el ejemplo colgado en la web la gente pueda entrar
// como Administrador
$tamUsuario      = 20;  // Tamaño del campo Usuario
$tamPassword     = 20;  // Tamaño del campo Contraseña
$tamCifrado      = 32;  // Tamaño del campo contraseña en MD5
$tamArticulo     = 40;  // Tamaño del campo Artículo
$tamPrecio       = 10;  // Tamaño del campo precio
$tamIdComprador  = 10;  // Tamaño del campo id Comprador
$tamIdVendedor   = 10;  // Tamaño del campo id Vendedor
$tamFechaCompra  = 10;
$maxRegUsuarios  = 20;  // Número máximo de registros en la tabla Usuarios
$maxRegArticulos = 20;  // Número máximo de registros por usuario en la tabla Artículos
$recorta = [
    'usuario'     => $tamUsuario,
    'password'    => $tamCifrado,
    'articulo'    => $tamArticulo,
    'precio'      => $tamPrecio,
    'idComprador' => $tamIdComprador,
    'idVendedor'  => $tamIdVendedor,
    'fechaCompra' => $tamFechaCompra
];

function conectaDb()
{
    global $dbMotor, $dbDb;

    try {
        if ($dbMotor == MYSQL) {
            $db = new PDO(MYSQL_HOST, MYSQL_USUARIO, MYSQL_PASSWORD);
            $db->setAttribute(PDO::MYSQL_ATTR_USE_BUFFERED_QUERY, true);
        } elseif ($dbMotor == SQLITE) {
            $db = new PDO("sqlite:" . $dbDb);
        }
        return($db);
    } catch (PDOException $e) {
        cabecera("Error grave");
        print "    <p>Error: No puede conectarse con la base de datos.</p>\n";
        print "\n";
//        print "    <p>Error: " . $e->getMessage() . "</p>\n";
//        print "\n";
        pie();
        exit();
    }
}

function borraTodoMySQL($db)
{
    global $dbDb, $dbArticulos, $dbUsuarios, $tamUsuario, $tamCifrado, $tamArticulo,
        $tamPrecio, $tamIdComprador, $tamIdVendedor, $tamFechaCompra,
        $administradorNombre, $administradorPassword;

    $consulta = "DROP DATABASE $dbDb";
    if ($db->query($consulta)) {
        print "    <p>Base de datos borrada correctamente.</p>\n";
        print "\n";
    } else {
        print "    <p>Error al borrar la base de datos.</p>\n";
        print "\n";
    }
    $consulta = "CREATE DATABASE $dbDb";
    if ($db->query($consulta)) {
        print "    <p>Base de datos creada correctamente.</p>\n";
        print "\n";
        $consulta_creatabla_usuarios = "CREATE TABLE $dbUsuarios (
            id INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
            usuario VARCHAR($tamUsuario),
            password VARCHAR($tamCifrado),
            PRIMARY KEY(id) )";
        if ($db->query($consulta_creatabla_usuarios)) {
            print "    <p>Tabla de Usuarios creada correctamente.</p>\n";
            print "\n";
        } else {
            print "    <p>Error al crear la tabla de Usuarios.</p>\n";
            print "\n";
        }
        if ($administradorPassword != "") {
            $consulta = "INSERT INTO $dbUsuarios
                VALUES (NULL, '$administradorNombre', '"
                .md5($administradorPassword)."')";
            if ($db->query($consulta)) {
                print "    <p>Registro de Usuario Administrador creado correctamente.</p>\n";
                print "\n";
            } else {
                print "    <p>Error al crear el registro de Usuario Administrador.</p>\n";
                print "\n";
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
            print "    <p>Tabla de Artículos creada correctamente.</p>\n";
            print "\n";
        } else {
            print "    <p>Error al crear la tabla de Artículos.</p>\n";
            print "\n";
        }
    } else {
        print "    <p>Error al crear la base de datos.</p>\n";
        print "\n";
    }
}

function borraTodoSqlite($db)
{
    global $dbArticulos, $dbUsuarios, $tamUsuario, $tamCifrado,$tamArticulo,
        $tamPrecio, $tamIdComprador, $tamIdVendedor, $tamFechaCompra,
        $administradorNombre, $administradorPassword;

    $consulta = "DROP TABLE $dbUsuarios";
    if ($db->query($consulta)) {
        print "    <p>Tabla de Usuarios borrada correctamente.</p>\n";
        print "\n";
    } else {
        print "    <p>Error al borrar la tabla de Usuarios.</p>\n";
        print "\n";
    }
    $consulta = "DROP TABLE $dbArticulos";
    if ($db->query($consulta)) {
        print "    <p>Tabla de Articulos borrada correctamente.</p>\n";
        print "\n";
    } else {
        print "    <p>Error al borrar la tabla de Articulos.</p>\n";
        print "\n";
    }
    $consulta_creatabla_usuarios = "CREATE TABLE $dbUsuarios (
        id INTEGER PRIMARY KEY,
        usuario VARCHAR($tamUsuario),
        password VARCHAR($tamCifrado)
        )";
    if ($db->query($consulta_creatabla_usuarios)) {
        print "    <p>Tabla de Usuarios creada correctamente.</p>\n";
        print "\n";
    } else {
        print "    <p>Error al crear la tabla de Usuarios.</p>\n";
        print "\n";
    }
    if ($administradorPassword != "") {
        $consulta = "INSERT INTO $dbUsuarios
            VALUES (NULL, '$administradorNombre', '".md5($administradorPassword)."')";
        if ($db->query($consulta)) {
            print "    <p>Registro de Usuario Administrador creado correctamente.</p>\n";
            print "\n";
        } else {
            print "    <p>Error al crear el registro de Usuario Administrador.</p>\n";
            print "\n";
        }
    }
    $consulta_creatabla_articulos = "CREATE TABLE $dbArticulos (
        id INTEGER PRIMARY KEY,
        articulo VARCHAR($tamArticulo),
        precio FLOAT,
        id_vendedor INTEGER,
        id_comprador INTEGER,
        reservado BOOLEAN,
        fecha_reserva DATETIME,
        comprado BOOLEAN,
        fecha_compra DATE
        )";
    if ($db->query($consulta_creatabla_articulos)) {
       print "    <p>Tabla de Artículos creada correctamente.</p>\n";
       print "\n";
    } else {
        print "    <p>Error al crear la tabla de Artículos.</p>\n";
        print "\n";
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
    $tmp = (isset($_REQUEST[$var])&&($_REQUEST[$var] != "")) ?
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
        if (isset($var[0])&&($var[0] == "'")) {
            $var = substr($var, 1, strlen($var)-1);
        }
        if (isset($var[strlen($var)-1])&&($var[strlen($var)-1] == "'")) {
            $var = substr($var, 0, strlen($var)-1);
        }
    }
    return $var;
}

function cabecera($texto, $menu="menu_principal")
{
    global $administradorNombre;

    print "<!DOCTYPE html>\n";
    print "<html lang=\"es\">\n";
    print "<head>\n";
    print "  <meta charset=\"utf-8\" />\n";
    print "  <title>Compraventa. $texto.\n";
    print "    Ejercicios. Programación web en PHP. Bartolomé Sintes Marco</title>\n";
    print "  <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\" />\n";
    print "  <link href=\"mclibre-php-soluciones-proyectos.css\" rel=\"stylesheet\" type=\"text/css\" title=\"Color\" />\n";
    print "</head>\n";
    print "\n";

    print "<body onload=\"document.getElementById('cursor').focus()\">\n";
    print "  <h1>Compraventa - $texto</h1>\n";
    print "\n";
    print "  <div id=\"menu\">\n";
    print "    <ul>\n";
    if ($menu == "menu_principal") {
        print "      <li><a href=\"index.php\">Conectar</a></li>\n";
        print "      <li><a href=\"listar.php\">Ver artículos</a></li>\n";
    } elseif ($menu==$administradorNombre) {
        print "      <li><a href=\"adm-borrar-todo-1.php\">Borrar todo</a></li>\n";
        print "      <li><a href=\"salir.php\">Desconectar</a></li>\n";
    } elseif ($menu == 'compra') {
        print "      <li><a href=\"index.php\">Inicio</a></li>\n";
        print "      <li><a href=\"listar.php?compraventa=compra\">Artículos en venta</a></li>\n";
        print "      <li><a href=\"com-reservar-1.php\">Reservar</a></li>\n";
        print "      <li><a href=\"com-anular-reserva-1.php\">Anular</a></li>\n";
        print "      <li><a href=\"com-comprar-1.php\">Comprar</a></li>\n";
    } elseif ($menu == 'venta') {
        print "      <li><a href=\"index.php\">Inicio</a></li>\n";
        print "      <li><a href=\"ven-insertar-1.php\">Añadir</a></li>\n";
        print "      <li><a href=\"listar.php?compraventa=venta\">Ver</a></li>\n";
        print "      <li><a href=\"ven-modificar-1.php\">Modificar</a></li>\n";
        print "      <li><a href=\"ven-borrar-1.php\">Borrar</a></li>\n";
    } else {
        print "      <li><a href=\"com-index.php\">Comprar</a></li>\n";
        print "      <li><a href=\"ven-index.php\">Vender</a></li>\n";
        print "      <li><a href=\"es-compras.php\">Compras realizadas</a></li>\n";
        print "      <li><a href=\"es-ventas.php\">Ventas realizadas</a></li>\n";
        print "      <li><a href=\"salir.php\">Desconectar</a></li>\n";
    }
    print "    </ul>\n";
    print "  </div>\n";
    print "\n";
    print "  <div id=\"contenido\">\n";
}

function pie()
{
    global $administradorPassword, $_SESSION;

    if ($administradorPassword != "" && !isset($_SESSION["compraventaUsuario"])) {
        print "    <p><strong>Nota</strong>: El usuario Administrador se llama "
            . "<strong>root</strong> y su contraseña es también <strong>root</strong>.</p>\n";
        print "\n";
    }

    print "  </div>\n";
    print "\n";

    print "  <footer>\n";
    print "    <p class=\"ultmod\">\n";
    print "      Última modificación de esta página:\n";
    print "      <time datetime=\"2008-02-27\">27 de febrero de 2008</time>\n";
    print "    </p>\n";
    print "\n";
    print "    <p class=\"licencia\">\n";
    print "      Este programa forma parte del curso <strong><a href=\"http://www.mclibre.org/consultar/php/\">Programación \n";
    print "      web en PHP</a></strong> de <a href=\"http://www.mclibre.org/\" rel=\"author\" >Bartolomé Sintes Marco</a>.<br />\n";
    print "      El programa PHP que genera esta página se distribuye bajo \n";
    print "      <a rel=\"license\" href=\"http://www.gnu.org/licenses/agpl.txt\">licencia AGPL 3 o posterior</a>.\n";
    print "    </p>\n";
    print "  </footer>\n";
    print "</body>\n";
    print "</html>\n";
}
