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
  <title>SQLite (1). PDO. Ejercicios (bases de datos). PHP. Bartolomé Sintes Marco. www.mclibre.org</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="mclibre-php-proyectos.css" title="Color">
</head>

<body>
  <h1>PDO 1 - SQLite: programa único</h1>

  <main>
<?php
//
//
// PASO 1: Definir las opciones del programa

// SQLITE: OPCIONES DE CONFIGURACIÓN DEL PROGRAMA

// OPCIONES DISPONIBLES PARA EL ADMINISTRADOR DE LA APLICACIÓN
// Configuración para SQLite
$cfg["sqliteDatabase"] = "/tmp/pdo-1.sqlite";                             // Ubicación de la base de datos

// Tamaño de los campos en la tabla Personas
$cfg["dbPersonasTamNombre"]    = 40;                              // Tamaño de la columna Personas > Nombre
$cfg["dbPersonasTamApellidos"] = 60;                              // Tamaño de la columna Personas > Apellidos

// OPCIONES DISPONIBLES PARA EL PROGRAMADOR DE LA APLICACIÓN
// Base de datos
$cfg["dbPersonasTabla"] = "personas";                      // Nombre de la tabla Personas

//
//
// PASO 2: Crear el objeto PDO de conexión con la base de datos.

// SQLITE: Conexión con la base de datos

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

// CONEXIÓN CON LA BASE DE DATOS
// La conexión se debe realizar en cada página que acceda a la base de datos
$pdo = conectaDb();

//
//
// PASO 3: Borrar la tabla.

// CONSULTA DE BORRADO DE TABLA
$consulta = "DROP TABLE IF EXISTS $cfg[dbPersonasTabla]";

if (!$pdo->query($consulta)) {
    print "    <p class=\"aviso\">Error al borrar la tabla. SQLSTATE[{$pdo->errorCode()}]: {$pdo->errorInfo()[2]}</p>\n";
} else {
    print "    <p>Tabla borrada correctamente (si existía).</p>\n";
}
print "\n";

//
//
// PASO 4: Borrar la tabla.

// SQLITE: CONSULTA DE CREACIÓN DE TABLA
$consulta = "CREATE TABLE $cfg[dbPersonasTabla]  (
             id INTEGER PRIMARY KEY,
             nombre VARCHAR($cfg[dbPersonasTamNombre]) COLLATE NOCASE,
             apellidos VARCHAR($cfg[dbPersonasTamApellidos]) COLLATE NOCASE
             )";

if (!$pdo->query($consulta)) {
    print "    <p class=\"aviso\">Error al crear la tabla. SQLSTATE[{$pdo->errorCode()}]: {$pdo->errorInfo()[2]}</p>\n";
} else {
    print "    <p>Tabla creada correctamente.</p>\n";
}
print "\n";

//
//
// PASO 5: Insertar un registro en la tabla.

// CONSULTA DE INSERCIÓN DE REGISTRO
$nombre    = "Pepito";            // Normalmente estos valores vendrán de un formulario
$apellidos = "Conejo";

$consulta = "INSERT INTO $cfg[dbPersonasTabla]
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

//
//
// PASO 6: Mostrar cuántos registros hay en la tabla.

// CONSULTA DE SELECCIÓN DE REGISTROS QUE DEVUELVE UN ÚNICO REGISTRO DE UNA COLUMNA
$consulta = "SELECT COUNT(*) FROM $cfg[dbPersonasTabla]";

$resultado = $pdo->query($consulta);
if (!$resultado) {
    print "    <p class=\"aviso\">Error en la consulta. SQLSTATE[{$pdo->errorCode()}]: {$pdo->errorInfo()[2]}</p>\n";
} else {
    print "    <p>La tabla contiene {$resultado->fetchColumn()} registro(s).</p>\n";
    print "\n";
}

//
//
// PASO 7: Mostrar los valores del registro guardado en la tabla.

// CONSULTA DE SELECCIÓN DE REGISTROS QUE PUEDE DEVOLVER VARIOS REGISTROS (O UNO O NINGUNO)
$consulta = "SELECT * FROM $cfg[dbPersonasTabla]";

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

//
//
// PASO 8: Modificar el registro guardado en la tabla.

// CONSULTA DE MODIFICACIÓN DE REGISTRO
$id        = "1";                 // Normalmente estos valores vendrán de un formulario
$nombre    = "Pepita";
$apellidos = "Conejo";

$consulta = "UPDATE $cfg[dbPersonasTabla]
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

//
//
// PASO 9: Mostrar los valores del registro guardado en la tabla.

// CONSULTA DE SELECCIÓN DE REGISTROS QUE PUEDE DEVOLVER VARIOS REGISTROS (O UNO O NINGUNO)
$consulta = "SELECT * FROM $cfg[dbPersonasTabla]";

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

//
//
// PASO 10: Insertar un segundo registro en la tabla.

// CONSULTA DE INSERCIÓN DE REGISTRO
$nombre    = "Numa";            // Normalmente estos valores vendrán de un formulario
$apellidos = "Nigerio";

$consulta = "INSERT INTO $cfg[dbPersonasTabla]
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

//
//
// PASO 11: Mostrar cuántos registros hay en la tabla.

// CONSULTA DE SELECCIÓN DE REGISTROS QUE DEVUELVE UN ÚNICO REGISTRO DE UNA COLUMNA
$consulta = "SELECT COUNT(*) FROM $cfg[dbPersonasTabla]";

$resultado = $pdo->query($consulta);
if (!$resultado) {
    print "    <p class=\"aviso\">Error en la consulta. SQLSTATE[{$pdo->errorCode()}]: {$pdo->errorInfo()[2]}</p>\n";
} else {
    print "    <p>La tabla contiene {$resultado->fetchColumn()} registro(s).</p>\n";
    print "\n";
}

//
//
// PASO 12: Mostrar los valores de los dos registros guardados en la tabla.

// CONSULTA DE SELECCIÓN DE REGISTROS QUE PUEDE DEVOLVER VARIOS REGISTROS (O UNO O NINGUNO)
$consulta = "SELECT * FROM $cfg[dbPersonasTabla]";

$resultado = $pdo->query($consulta);
if (!$resultado) {
    print "    <p class=\"aviso\">Error en la consulta. SQLSTATE[{$pdo->errorCode()}]: {$pdo->errorInfo()[2]}</p>\n";
} else {
    print "    <p><strong>Registro(s) obtenido(s):</strong></p>\n";
    print "    <ul>\n";
    foreach ($resultado as $registro) {
        print "        <li>$registro[id] - $registro[nombre] - $registro[apellidos]</li>\n";
    }
    print "    </ul>\n";
    print "\n";
}

//
//
// PASO 13: Borrar el primer registro guardado en la tabla.

// CONSULTA DE BORRADO DE REGISTROS
$id = [1 => "on"];     // Normalmente este valor vendrá de un formulario (en este caso, como matriz).

foreach ($id as $indice => $valor) {
    $consulta = "DELETE FROM $cfg[dbPersonasTabla]
                 WHERE id = :indice";

    $resultado = $pdo->prepare($consulta);
    if (!$resultado) {
        print "    <p class=\"aviso\">Error al preparar la consulta. SQLSTATE[{$pdo->errorCode()}]: {$pdo->errorInfo()[2]}</p>\n";
    } elseif (!$resultado->execute([":indice" => $indice])) {
        print "    <p class=\"aviso\">Error al ejecutar la consulta. SQLSTATE[{$pdo->errorCode()}]: {$pdo->errorInfo()[2]}</p>\n";
    } else {
        print "    <p>Registro borrado correctamente.</p>\n";
        print "\n";
    }
}

//
//
// PASO 14: Mostrar los valores del registro guardado en la tabla.

// CONSULTA DE SELECCIÓN DE REGISTROS QUE PUEDE DEVOLVER VARIOS REGISTROS (O UNO O NINGUNO)
$consulta = "SELECT * FROM $cfg[dbPersonasTabla]";

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

print "  </main>\n";
print "\n";
print "  <footer>\n";
print "    <p class=\"ultmod\">\n";
print "      Última modificación de esta página:\n";
print "      <time datetime=\"2022-01-21\">21 de enero de 2022</time>\n";
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
