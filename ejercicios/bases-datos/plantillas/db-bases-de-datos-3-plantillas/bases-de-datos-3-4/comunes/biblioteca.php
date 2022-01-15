<?php
/**
 * @author Escriba aquí su nombre
 */

// Constantes y variables configurables por el programador de la aplicación

define("MYSQL", 1);                         // Base de datos MySQL
define("SQLITE", 2);                        // Base de datos SQLITE

define("MENU_PRINCIPAL", 1);                // Menú principal sin conectar
define("MENU_PRINCIPAL_CONECTADO", 2);      // Menú principal conectado
define("MENU_VOLVER", 3);                   // Menú Volver a inicio
define("MENU_ADMINISTRADOR", 4);            // Menú Administrador
define("MENU_USUARIOS", 5);                 // Menú Usuarios
define("MENU_PERSONAS", 6);                 // Menú Personas

define("PROFUNDIDAD_0", 0);                 // Profundidad de nivel de la página: directorio raíz
define("PROFUNDIDAD_1", 1);                 // Profundidad de nivel de la página: subdirectorio
define("PROFUNDIDAD_2", 2);                 // Profundidad de nivel de la página: sub-subdirectorio

// Variables configurables por el administrador de la aplicación

require_once "config.php";

// Configuración Usuario

$cfg["usuariosTamPassword"] = 20;           // Tamaño de la Contraseña de Usuario

// Configuración Tabla Personas

$cfg["dbPersonasTamNombre"]    = 40;        // Tamaño de la columna Personas > Nombre
$cfg["dbPersonasTamApellidos"] = 60;        // Tamaño de la columna Personas > Apellidos
$cfg["dbPersonasTamTelefono"]  = 10;        // Tamaño de la columna Personas > Teléfono
$cfg["dbPersonasTamCorreo"]    = 50;        // Tamaño de la columna Personas > Correo

// Configuración Tabla Usuarios

$cfg["dbUsuariosTamUsuario"]  = 20;         // Tamaño de la columna Usuarios > Nombre de Usuario
$cfg["dbUsuariosTamPassword"] = 64;         // Tamaño de la columna Usuarios > Contraseña de Usuario (cifrada)

// Valores de ordenación de la tabla

$cfg["dbPersonasColumnasOrden"] = [
    "nombre ASC", "nombre DESC",
    "apellidos ASC", "apellidos DESC",
    "telefono ASC", "telefono DESC",
    "correo ASC", "correo DESC",
];

$cfg["dbUsuariosColumnasOrden"] = [
    "usuario ASC", "usuario DESC",
    "password ASC", "password DESC",
];

// Carga Biblioteca específica de la base de datos utilizada

if ($cfg["dbMotor"] == MYSQL) {
    require_once "biblioteca-mysql.php";
} elseif ($cfg["dbMotor"] == SQLITE) {
    require_once "biblioteca-sqlite.php";
}

// Tablas

$cfg["dbTablas"] = [
    $cfg["dbUsuariosTabla"],
    $cfg["dbPersonasTabla"],
];

// Funciones comunes

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

function cabecera($texto, $menu, $profundidadDirectorio)
{
    print "<!DOCTYPE html>\n";
    print "<html lang=\"es\">\n";
    print "<head>\n";
    print "  <meta charset=\"utf-8\">\n";
    print "  <title>$texto. Escriba aquí su nombre</title>\n";
    print "  <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">\n";
    if ($profundidadDirectorio == PROFUNDIDAD_0) {
        print "  <link rel=\"stylesheet\" href=\"comunes/mclibre-php-proyectos.css\" title=\"Color\" />\n";
    } elseif ($profundidadDirectorio == PROFUNDIDAD_1) {
        print "  <link rel=\"stylesheet\" href=\"../comunes/mclibre-php-proyectos.css\" title=\"Color\" />\n";
    } elseif ($profundidadDirectorio == PROFUNDIDAD_2) {
        print "  <link rel=\"stylesheet\" href=\"../../comunes/mclibre-php-proyectos.css\" title=\"Color\" />\n";
    }
    print "</head>\n";
    print "\n";
    print "<body>\n";
    print "  <header>\n";
    print "    <h1>Bases de datos (3) 4 - $texto</h1>\n";
    print "\n";
    print "    <nav>\n";
    print "      <ul>\n";
    if ($menu == MENU_PRINCIPAL) {
        print "        <li><a href=\"acceso/login-1.php\">Conectarse</a></li>\n";
    } elseif ($menu == MENU_PRINCIPAL_CONECTADO) {
        print "        <li><a href=\"db/tabla-personas/index.php\">Personas</a></li>\n";
        print "        <li><a href=\"db/tabla-usuarios/index.php\">Usuarios</a></li>\n";
        print "        <li><a href=\"administrador/index.php\">Administrador</a></li>\n";
        print "        <li><a href=\"acceso/logout.php\">Desconectarse</a></li>\n";
    } elseif ($menu == MENU_VOLVER) {
        print "        <li><a href=\"../index.php\">Volver</a></li>\n";
    } elseif ($menu == MENU_ADMINISTRADOR) {
        print "        <li><a href=\"../index.php\">Volver</a></li>\n";
        print "        <li><a href=\"borrar-todo-1.php\">Borrar todo</a></li>\n";
    } elseif ($menu == MENU_USUARIOS) {
        print "        <li><a href=\"../../index.php\">Volver</a></li>\n";
        print "        <li><a href=\"insertar-1.php\">Añadir registro</a></li>\n";
        print "        <li><a href=\"listar.php\">Listar</a></li>\n";
        print "        <li><a href=\"borrar-1.php\">Borrar</a></li>\n";
        print "        <li><a href=\"buscar-1.php\">Buscar</a></li>\n";
        print "        <li><a href=\"modificar-1.php\">Modificar</a></li>\n";
    } elseif ($menu == MENU_PERSONAS) {
        print "        <li><a href=\"../../index.php\">Volver</a></li>\n";
        print "        <li><a href=\"insertar-1.php\">Añadir registro</a></li>\n";
        print "        <li><a href=\"listar.php\">Listar</a></li>\n";
        print "        <li><a href=\"borrar-1.php\">Borrar</a></li>\n";
        print "        <li><a href=\"buscar-1.php\">Buscar</a></li>\n";
        print "        <li><a href=\"modificar-1.php\">Modificar</a></li>\n";
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
    print "    <p>Escriba aquí su nombre</p>\n";
    print "  </footer>\n";
    print "</body>\n";
    print "</html>";
}

function encripta($cadena)
{
    global $cfg;

    return hash($cfg["hashAlgorithm"], $cadena);
}
