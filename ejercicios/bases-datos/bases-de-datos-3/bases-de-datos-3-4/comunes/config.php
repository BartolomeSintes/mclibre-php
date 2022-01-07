<?php
/**
 * @author    Bartolomé Sintes Marco - bartolome.sintes+mclibre@gmail.com
 * @license   https://www.gnu.org/licenses/agpl-3.0.txt AGPL 3 or later
 * @link      https://www.mclibre.org
 */

// OPCIONES DISPONIBLES PARA EL ADMINISTRADOR DE LA APLICACIÓN

// Base de datos utilizada por la aplicación

$cfg["dbMotor"] = SQLITE;                                   // Valores posibles: MYSQL o SQLITE

// Configuración para SQLite

$cfg["sqliteDatabase"] = "/tmp/mclibre-base-datos-3-4.sqlite";  // Ubicación de la base de datos

// Configuración para MySQL

$cfg["mysqlHost"]     = "mysql:host=localhost";             // Nombre de host
$cfg["mysqlUser"]     = "mclibre_base_datos_3_4";           // Nombre de usuario
$cfg["mysqlPassword"] = "";                                 // Contraseña de usuario
$cfg["mysqlDatabase"] = "mclibre_base_datos_3_4";           // Nombre de la base de datos

// Usuario de la aplicación

$cfg["rootName"]      = "root";                             // Nombre del Usuario Administrador de la aplicación
$cfg["rootPassword"]  = "4813494d137e1631bba301d5acab6e7bb7aa74ce1185d456565ef51d737677b2";  // Contraseña encriptada del Usuario Administrador de la aplicación
$cfg["hashAlgorithm"] = "sha256";                           // Algoritmo hash para encriptar la contraseña de usuario
                                                            // Los posibles algoritmos son https://www.php.net/manual/en/function.hash-algos.php
$cfg["rootPasswordModificable"] = true;                    // Contraseña del usuario Administrador se puede cambiar o no

// Método de envío de formularios

$cfg["formMethod"] = GET;                                   // Valores posibles: GET o POST

// Otras configuraciones

$cfg["dbUsuariosmaxReg"] = 20;                              // Número máximo de registros en la tabla Usuarios
$cfg["dbPersonasmaxReg"] = 20;                              // Número máximo de registros en la tabla Personas
$cfg["sessionName"]      = "mclibre-bases-de-datos-3-4";    // Nombre de sesión
