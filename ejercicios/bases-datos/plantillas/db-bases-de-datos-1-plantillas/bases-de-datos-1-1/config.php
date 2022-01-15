<?php
/**
 * @author Escriba aquí su nombre
 */

// OPCIONES DISPONIBLES PARA EL ADMINISTRADOR DE LA APLICACIÓN

// Base de datos utilizada por la aplicación

$cfg["dbMotor"] = SQLITE;               // Valores posibles: MYSQL o SQLITE

// Configuración para SQLite

$cfg["sqliteDatabase"] = "";            // Ubicación de la base de datos

// Configuración para MySQL

$cfg["mysqlHost"]     = "";             // Nombre de host
$cfg["mysqlUser"]     = "";             // Nombre de usuario
$cfg["mysqlPassword"] = "";             // Contraseña de usuario
$cfg["mysqlDatabase"] = "";             // Nombre de la base de datos

// Método de envío de formularios

$cfg["formMethod"] = "get";             // Valores posibles: get o post
