<?php
print "<h1>Pruebas SQLite copiado de apuntes</h1>";
// SQLITE: OPCIONES DE CONFIGURACIÓN DEL PROGRAMA

// OPCIONES DISPONIBLES PARA EL ADMINISTRADOR DE LA APLICACIÓN
// Configuración para SQLite
$cfg["sqliteDatabase"] = "tmp.sqlite";                        // Ubicación de la base de datos

// FUNCIONES ESPECÍFICAS DE LA BASE DE DATOS SQLITE
// Base de datos
$cfg["dbPersonasTabla"]        = "personas";                      // Nombre de la tabla Personas
$cfg["dbPersonasTamNombre"]    = 40;                                          // Tamaño de la columna Personas > Nombre
$cfg["dbPersonasTamApellidos"] = 60;                                          // Tamaño de la columna Personas > Apellidos

// SQLITE: Conexión con la base de datos
function conectaDb()
{
    global $cfg;

    try {
        $tmp = new PDO("sqlite:$cfg[sqliteDatabase]");
        $tmp->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_SILENT);
        $tmp->query("PRAGMA foreign_keys = ON");
        return $tmp;
    } catch (PDOException $e) {
        print "    <p class=\"aviso\">Error: No puede conectarse con la base de datos. {$e->getMessage()}</p>\n";
        exit;
    }
}

// CONEXIÓN CON LA BASE DE DATOS
// La conexión se debe realizar en cada página que acceda a la base de datos
$pdo = conectaDb();

// CONSULTA DE BORRADO DE TABLA
$consulta = "DROP TABLE IF EXISTS $cfg[dbPersonasTabla]";
if (!$pdo->query($consulta)) {
    print "    <p class=\"aviso\">Error al borrar la tabla. SQLSTATE[{$pdo->errorCode()}]: {$pdo->errorInfo()[2]}</p>\n";
    print "\n";
} else {
    print "    <p>Tabla borrada correctamente (si existía).</p>\n";
    print "\n";
}

// SQLITE: CONSULTA DE CREACIÓN DE TABLA
$consulta = "CREATE TABLE $cfg[dbPersonasTabla]  (
             id INTEGER PRIMARY KEY,
             nombre VARCHAR($cfg[dbPersonasTamNombre]),
             apellidos VARCHAR($cfg[dbPersonasTamApellidos])
             )";
if (!$pdo->query($consulta)) {
    print "    <p class=\"aviso\">Error al crear la tabla. SQLSTATE[{$pdo->errorCode()}]: {$pdo->errorInfo()[2]}</p>\n";
    print "\n";
} else {
    print "    <p>Tabla creada correctamente.</p>\n";
    print "\n";
}

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
    print "\n";
} else {
    print "    <p>Registro creado correctamente.</p>\n";
    print "\n";
}

// CONSULTA DE MODIFICACIÓN DE REGISTRO
$id        = 1;                   // Normalmente estos valores vendrán de un formulario
$nombre    = "Pepita";
$apellidos = "Conejo";

$consulta = "UPDATE $cfg[dbPersonasTabla]
             SET nombre=:nombre, apellidos=:apellidos
             WHERE id=:id";

$resultado = $pdo->prepare($consulta);
if (!$resultado) {
    print "    <p class=\"aviso\">Error al preparar la consulta. SQLSTATE[{$pdo->errorCode()}]: {$pdo->errorInfo()[2]}</p>\n";
} elseif (!$resultado->execute([":nombre" => $nombre, ":apellidos" => $apellidos, ":id" => $id])) {
    print "    <p class=\"aviso\">Error al modificar el registro. SQLSTATE[{$pdo->errorCode()}]: {$pdo->errorInfo()[2]}</p>\n";
    print "\n";
} else {
    print "    <p>Registro modificado correctamente.</p>\n";
    print "\n";
}

//  CONSULTA DE SELECCIÓN DE REGISTROS QUE DEVUELVE UN ÚNICO REGISTRO DE UNA COLUMNA
$consulta = "SELECT COUNT(*) FROM $cfg[dbPersonasTabla]";

$resultado = $pdo->query($consulta);if (!$resultado) {
    print "    <p class=\"aviso\">Error en la consulta. SQLSTATE[{$pdo->errorCode()}]: {$pdo->errorInfo()[2]}</p>\n";
    print "\n";
} else {
    print "    <p>La tabla contiene {$resultado->fetchColumn()} registro(s).</p>\n";
    print "\n";
}

//  CONSULTA DE SELECCIÓN DE REGISTROS QUE PUEDE DEVOLVER VARIOS REGISTROS (O UNO O NINGUNO)
$consulta = "SELECT * FROM $cfg[dbPersonasTabla]";

$resultado = $pdo->query($consulta);if (!$resultado) {
    print "    <p class=\"aviso\">Error en la consulta. SQLSTATE[{$pdo->errorCode()}]: {$pdo->errorInfo()[2]}</p>\n";
    print "\n";
} else {
    print "    <p><strong>Registro(s) obtenido(s)</strong></p>";
    print "    <ul>\n";
    foreach ($resultado as $valor) {
        print "      <li>$valor[id] - $valor[nombre] - $valor[apellidos]</li>\n";
    }
    print "    </ul>\n";
}

//  CONSULTA DE SELECCIÓN DE REGISTROS QUE PUEDE DEVOLVER VARIOS REGISTROS (O UNO O NINGUNO) !!!! PREPARADA AUNQUE NO HAGA FALTA

$nombre = "";        // Normalmente estos valores vendrán de un formulario

$consulta = "SELECT * FROM $cfg[dbPersonasTabla]
             WHERE nombre LIKE :nombre";
$resultado = $pdo->prepare($consulta);
if (!$resultado) {
    print "    <p class=\"aviso\">Error al preparar la consulta. SQLSTATE[{$pdo->errorCode()}]: {$pdo->errorInfo()[2]}</p>\n";
} else {
    $resultado->execute([":nombre" => "%$nombre%"]);
    if (!$resultado) {
        print "    <p class=\"aviso\">Error en la consulta. SQLSTATE[{$pdo->errorCode()}]: {$pdo->errorInfo()[2]}</p>\n";
        print "\n";
    } else {
        print "    <p><strong>Registro(s) obtenido(s) (consulta preparada)</strong></p>";
        print "    <ul>\n";
        foreach ($resultado as $valor) {
            print "      <li>$valor[id] - $valor[nombre] - $valor[apellidos]</li>\n";
        }
        print "    </ul>\n";
    }
}

// CONSULTA QUE DEVUELVE UN ÚNICO REGISTRO
$consulta  = "SELECT * FROM $cfg[dbPersonasTabla] WHERE id=1";

$resultado = $pdo->query($consulta);if (!$resultado) {
    print "    <p class=\"aviso\">Error en la consulta. SQLSTATE[{$pdo->errorCode()}]: {$pdo->errorInfo()[2]}</p>\n";
    print "\n";
} else {
    $valor = $resultado->fetch(PDO::FETCH_ASSOC);
    print "    <p>$valor[id] - $valor[nombre] - etc.</p>\n";
    print "\n";
}

// CONSULTA DE BORRADO DE REGISTROS
$id = [1 => "on"];     // Normalmente este valor vendrá de un formulario
                       // en forma de matriz. Por ejemplo, [1 => "on", 3 => "on"]

foreach ($id as $indice => $valor) {
    $consulta = "DELETE FROM $cfg[dbPersonasTabla]
                 WHERE id=:indice";

    $resultado = $pdo->prepare($consulta);
    if (!$resultado) {
        print "    <p class=\"aviso\">Error al preparar la consulta. SQLSTATE[{$pdo->errorCode()}]: {$pdo->errorInfo()[2]}</p>\n";
    } elseif (!$resultado->execute([":indice" => $indice])) {
        print "    <p class=\"aviso\">Error al borrar el registro. SQLSTATE[{$pdo->errorCode()}]: {$pdo->errorInfo()[2]}</p>\n";
        print "\n";
    } else {
        print "    <p>Registro borrado correctamente.</p>\n";
        print "\n";
    }
}
