<?php
/**
 * @author    Bartolomé Sintes Marco - bartolome.sintes+mclibre@gmail.com
 * @license   https://www.gnu.org/licenses/agpl-3.0.txt AGPL 3 or later
 * @link      https://www.mclibre.org
 */
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <title>SQLite (2). PDO. Ejercicios (bases de datos). PHP. Bartolomé Sintes Marco. www.mclibre.org</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="mclibre-php-proyectos.css" title="Color">
</head>

<body>
  <h1>PDO 2 - SQLite: programa con funciones</h1>

  <main>
<?php

// SQLITE: FUNCIÓN DE CONEXIÓN CON LA BASE DE DATOS

function conectaDb()
{
    global $cfg;

    try {
        $tmp = new PDO("sqlite:$cfg[sqliteDatabase]");
        $tmp->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_SILENT);
        $tmp->query("PRAGMA foreign_keys = ON");
        $tmp->query("PRAGMA encoding = 'UTF-8'");
        return $tmp;
    } catch (PDOException $e) {
        print "    <p class=\"aviso\">Error: No puede conectarse con la base de datos. {$e->getMessage()}</p>\n";
        exit;
    }
}

// SQLITE: FUNCIÓN DE BORRADO Y CREACIÓN DE TABLA

function borraTodo()
{
    global $pdo, $cfg;

    $consulta = "DROP TABLE IF EXISTS $cfg[tablaPersonas]";

    if (!$pdo->query($consulta)) {
        print "    <p class=\"aviso\">Error al borrar la tabla. SQLSTATE[{$pdo->errorCode()}]: {$pdo->errorInfo()[2]}</p>\n";
    } else {
        print "    <p>Tabla borrada correctamente (si existía).</p>\n";
    }
    print "\n";

    $consulta = "CREATE TABLE $cfg[tablaPersonas] (
                 id INTEGER PRIMARY KEY,
                 nombre VARCHAR($cfg[tablaPersonasTamNombre]) COLLATE NOCASE,
                 apellidos VARCHAR($cfg[tablaPersonasTamApellidos]) COLLATE NOCASE
                 )";

    if (!$pdo->query($consulta)) {
        print "    <p class=\"aviso\">Error al crear la tabla. SQLSTATE[{$pdo->errorCode()}]: {$pdo->errorInfo()[2]}</p>\n";
    } else {
        print "    <p>Tabla creada correctamente.</p>\n";
    }
    print "\n";
}

// FUNCIÓN DE INSERCIÓN DE REGISTRO

function insertaRegistro($nombre, $apellidos)
{
    global $pdo, $cfg;

    $consulta = "INSERT INTO $cfg[tablaPersonas]
                 (nombre, apellidos)
                 VALUES (:nombre, :apellidos)";

    $resultado = $pdo->prepare($consulta);
    if (!$resultado) {
        print "    <p class=\"aviso\">Error al preparar la consulta. SQLSTATE[{$pdo->errorCode()}]: {$pdo->errorInfo()[2]}</p>\n";
    } elseif (!$resultado->execute([":nombre" => $nombre, ":apellidos" => $apellidos])) {
        print "    <p class=\"aviso\">Error al ejecutar la consulta. SQLSTATE[{$pdo->errorCode()}]: {$pdo->errorInfo()[2]}</p>\n";
    } else {
        print "    <p>Registro creado correctamente.</p>\n";
        print "\n";
    }
}

// FUNCIÓN DE CONTEO DE REGISTROS

function cuentaRegistros()
{
    global $pdo, $cfg;

    $consulta = "SELECT COUNT(*) FROM $cfg[tablaPersonas]";

    $resultado = $pdo->query($consulta);
    if (!$resultado) {
        print "    <p class=\"aviso\">Error en la consulta. SQLSTATE[{$pdo->errorCode()}]: {$pdo->errorInfo()[2]}</p>\n";
    } else {
        print "    <p>La tabla contiene {$resultado->fetchColumn()} registro(s).</p>\n";
        print "\n";
    }
}

// FUNCIÓN DE SELECCIÓN DE TODOS LOS REGISTROS

function muestraRegistros()
{
    global $pdo, $cfg;

    $consulta = "SELECT * FROM $cfg[tablaPersonas]";

    $resultado = $pdo->query($consulta);
    if (!$resultado) {
        print "    <p class=\"aviso\">Error en la consulta. SQLSTATE[{$pdo->errorCode()}]: {$pdo->errorInfo()[2]}</p>\n";
    } else {
        print "    <p><strong>Registro(s) obtenido(s):</strong></p>\n";
        print "    <ul>\n";
        foreach ($resultado as $registro) {
            print "      <li>$registro[id] - $registro[nombre] - $registro[apellidos]</li>\n";
        }
        print "    </ul>\n";
        print "\n";
    }
}

// FUNCIÓN DE MODIFICACIÓN DE REGISTRO

function modificaRegistro($id, $nombre, $apellidos)
{
    global $pdo, $cfg;

    $consulta = "UPDATE $cfg[tablaPersonas]
                 SET nombre = :nombre, apellidos = :apellidos
                 WHERE id = :id";

    $resultado = $pdo->prepare($consulta);
    if (!$resultado) {
        print "    <p class=\"aviso\">Error al preparar la consulta. SQLSTATE[{$pdo->errorCode()}]: {$pdo->errorInfo()[2]}</p>\n";
    } elseif (!$resultado->execute([":nombre" => $nombre, ":apellidos" => $apellidos, ":id" => $id])) {
        print "    <p class=\"aviso\">Error al ejecutar la consulta. SQLSTATE[{$pdo->errorCode()}]: {$pdo->errorInfo()[2]}</p>\n";
    } else {
        print "    <p>Registro modificado correctamente.</p>\n";
        print "\n";
    }
}

// FUNCIÓN DE BORRADO DE REGISTROS

function borraRegistros($id)
{
    global $pdo, $cfg;

    foreach ($id as $indice => $valor) {
        $consulta = "DELETE FROM $cfg[tablaPersonas]
                     WHERE id = :indice";

        $resultado = $pdo->prepare($consulta);
        if (!$resultado) {
            print "    <p class=\"aviso\">Error al preparar la consulta. SQLSTATE[{$pdo->errorCode()}]: {$pdo->errorInfo()[2]}</p>\n";
        } elseif (!$resultado->execute([":indice" => $indice])) {
            print "    <p class=\"aviso\">Error al ejecutar la consulta. SQLSTATE[{$pdo->errorCode()}]: {$pdo->errorInfo()[2]}</p>\n";
        } else {
            print "    <p>Registro borrado correctamente (si existía).</p>\n";
            print "\n";
        }
    }
}

// Variables configurables por el administrador de la aplicación

// Configuración para SQLite

$cfg["sqliteDatabase"] = "/tmp/pdo-2.sqlite";           // Ubicación de la base de datos

// Tamaño de los campos en la tabla Personas

$cfg["tablaPersonasTamNombre"]    = 40;                 // Tamaño de la columna Personas > Nombre
$cfg["tablaPersonasTamApellidos"] = 60;                 // Tamaño de la columna Personas > Apellidos

// Variables configurables por el programador de la aplicación

// Nombres de las tablas

$cfg["tablaPersonas"] = "personas";                     // Nombre de la tabla Personas

$pdo = conectaDb();

borraTodo();

insertaRegistro("Pepito", "Conejo");

cuentaRegistros();

muestraRegistros();

modificaRegistro(1, "Pepita", "Conejo");

muestraRegistros();

insertaRegistro("Numa", "Nigerio");

cuentaRegistros();

muestraRegistros();

borraRegistros([1 => "on"]);

muestraRegistros();

print "  </main>\n";
print "\n";
print "  <footer>\n";
print "    <p class=\"ultmod\">\n";
print "      Última modificación de esta página:\n";
print "      <time datetime=\"2024-01-09\">9 de enero de 2024</time>\n";
print "    </p>\n";
print "\n";
print "    <p class=\"licencia\">\n";
print "      Este programa forma parte del curso <strong><a href=\"https://www.mclibre.org/consultar/php/\">Programación \n";
print "      web en PHP</a></strong> de <a href=\"https://www.mclibre.org/\" rel=\"author\">Bartolomé Sintes Marco</a>.<br>\n";
print "      El programa PHP que genera esta página se distribuye bajo \n";
print "      <a rel=\"license\" href=\"https://www.gnu.org/licenses/agpl-3.0.txt\">licencia AGPL 3 o posterior</a>.\n";
print "    </p>\n";
print "  </footer>\n";
print "</body>\n";
print "</html>\n";
