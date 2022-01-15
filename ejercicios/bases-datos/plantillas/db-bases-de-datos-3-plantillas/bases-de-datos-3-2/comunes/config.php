<?php
/**
 * @author Escriba aquí su nombre
 */

// OPCIONES DISPONIBLES PARA EL ADMINISTRADOR DE LA APLICACIÓN

// Base de datos utilizada por la aplicación

$cfg["dbMotor"] = SQLITE;                                   // Valores posibles: MYSQL o SQLITE

// Configuración para SQLite

$cfg["sqliteDatabase"] = "/tmp/iaw-base-datos-3-2.sqlite";  // Ubicación de la base de datos

// Configuración para MySQL

$cfg["mysqlHost"]     = "mysql:host=localhost";             // Nombre de host
$cfg["mysqlUser"]     = "iaw_base_datos_3_2";           // Nombre de usuario
$cfg["mysqlPassword"] = "";                                 // Contraseña de usuario
$cfg["mysqlDatabase"] = "iaw_base_datos_3_2";           // Nombre de la base de datos

// Método de envío de formularios

$cfg["formMethod"] = "get";                                 // Valores posibles: get o post

// Otras configuraciones

$cfg["dbPersonasmaxReg"] = 20;                              // Número máximo de registros en la tabla Personas
$cfg["sessionName"]      = "iaw-bases-de-datos-3-2";    // Nombre de sesión
