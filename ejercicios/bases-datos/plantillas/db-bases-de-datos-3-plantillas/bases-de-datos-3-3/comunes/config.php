<?php
/**
 * @author Escriba aquí su nombre
 */

// OPCIONES DISPONIBLES PARA EL ADMINISTRADOR DE LA APLICACIÓN

// Base de datos utilizada por la aplicación

$cfg["dbMotor"] = SQLITE;                                   // Valores posibles: MYSQL o SQLITE

// Configuración para SQLite

$cfg["sqliteDatabase"] = "/tmp/iaw-base-datos-3-3.sqlite";  // Ubicación de la base de datos

// Configuración para MySQL

$cfg["mysqlHost"]     = "mysql:host=localhost";             // Nombre de host
$cfg["mysqlUser"]     = "iaw_base_datos_3_3";           // Nombre de usuario
$cfg["mysqlPassword"] = "";                                 // Contraseña de usuario
$cfg["mysqlDatabase"] = "iaw_base_datos_3_3";           // Nombre de la base de datos

// Usuario de la aplicación

$cfg["rootName"]      = "root";                             // Nombre del Usuario Administrador de la aplicación
$cfg["rootPassword"]  = "4813494d137e1631bba301d5acab6e7bb7aa74ce1185d456565ef51d737677b2";  // Contraseña encriptada del Usuario Administrador de la aplicación
$cfg["hashAlgorithm"] = "sha256";                           // Algoritmo hash para encriptar la contraseña de usuario
                                                            // Los posibles algoritmos son https://www.php.net/manual/en/function.hash-algos.php

// Método de envío de formularios

$cfg["formMethod"] = "get";                                 // Valores posibles: get o post

// Otras configuraciones

$cfg["dbPersonasmaxReg"] = 20;                              // Número máximo de registros en la tabla Personas
$cfg["sessionName"]      = "iaw-bases-de-datos-3-3";    // Nombre de sesión
