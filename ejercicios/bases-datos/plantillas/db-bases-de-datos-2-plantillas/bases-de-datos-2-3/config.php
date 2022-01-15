<?php
/**
 * @author Escriba aquí su nombre
 */

// OPCIONES DISPONIBLES PARA EL ADMINISTRADOR DE LA APLICACIÓN

// Base de datos utilizada por la aplicación

$cfg["dbMotor"] = SQLITE;                                   // Valores posibles: MYSQL o SQLITE

// Configuración para SQLite

$cfg["sqliteDatabase"] = "/tmp/iaw-base-datos-2-3.sqlite";  // Ubicación de la base de datos

// Configuración para MySQL

$cfg["mysqlHost"]     = "mysql:host=localhost";             // Nombre de host
$cfg["mysqlUser"]     = "iaw_base_datos_2_3";           // Nombre de usuario
$cfg["mysqlPassword"] = "";                                 // Contraseña de usuario
$cfg["mysqlDatabase"] = "iaw_base_datos_2_3";           // Nombre de la base de datos

// Método de envío de formularios

$cfg["formMethod"] = "get";                                 // Valores posibles: get o post

// Otras configuraciones

$cfg["dbPersonasmaxReg"] = 20;                              // Número máximo de registros en la tabla Personas
