<?php
/**
 * @author Escriba aquí su nombre
 */

// FUNCIONES ESPECÍFICAS DE LA BASE DE DATOS MYSQL

// MYSQL: Nombres de las tablas

$cfg["dbPersonasTabla"] = "$cfg[mysqlDatabase].personas";   // Nombre de la tabla Personas

// MYSQL: Conexión con la base de datos

function conectaDb()
{
    global $cfg;

    try {
        $tmp = new PDO($cfg["mysqlHost"], $cfg["mysqlUser"], $cfg["mysqlPassword"]);
        $tmp->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_SILENT);
        $tmp->setAttribute(PDO::MYSQL_ATTR_USE_BUFFERED_QUERY, true);
        $tmp->exec("set names utf8mb4");
        return $tmp;
    } catch (PDOException $e) {
        print "    <p class=\"aviso\">Error: No puede conectarse con la base de datos. {$e->getMessage()}</p>\n";
        exit;
    }
}

// MYSQL: Consultas de borrado y creación de base de datos y tablas

function borraTodo()
{
    global $pdo, $cfg;

    $consulta = ""; // Ejercicio incompleto

    if (!$pdo->query($consulta)) {
        print "    <p class=\"aviso\">Error al borrar la base de datos. SQLSTATE[{$pdo->errorCode()}]: {$pdo->errorInfo()[2]}</p>\n";
    } else {
        print "    <p>Base de datos borrada correctamente (si existía).</p>\n";
    }
    print "\n";

    $consulta = ""; // Ejercicio incompleto
    if (!$pdo->query($consulta)) {
        print "    <p class=\"aviso\">Error al crear la base de datos. SQLSTATE[{$pdo->errorCode()}]: {$pdo->errorInfo()[2]}</p>\n";
    } else {
        print "    <p>Base de datos creada correctamente.</p>\n";
        print "\n";
        $consulta = ""; // Ejercicio incompleto
        if (!$pdo->query($consulta)) {
            print "    <p class=\"aviso\">Error al crear la tabla. SQLSTATE[{$pdo->errorCode()}]: {$pdo->errorInfo()[2]}</p>\n";
        } else {
            print "    <p>Tabla creada correctamente.</p>\n";
        }
    }
}
