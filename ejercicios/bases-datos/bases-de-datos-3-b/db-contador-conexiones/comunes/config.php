<?php
/**
 * @author    Bartolomé Sintes Marco - bartolome.sintes+mclibre@gmail.com
 * @license   https://www.gnu.org/licenses/agpl-3.0.txt AGPL 3 or later
 * @link      https://www.mclibre.org
 */

// VARIABLES CONFIGURABLES POR EL ADMINISTRADOR DE LA APLICACIÓN

// Nombre de sesión

$cfg["sessionName"] = "mclibre-bases-de-datos-3-b-contador-conexiones"; // Nombre de sesión

// Base de datos utilizada por la aplicación

$cfg["dbMotor"] = SQLITE;                                   // Valores posibles: MYSQL o SQLITE

// Configuración para SQLite

$cfg["sqliteDatabase"] = "/tmp/mclibre-base-datos-3-b-contador-conexiones.sqlite";  // Ubicación de la base de datos

// Configuración para MySQL

$cfg["mysqlHost"]     = "localhost";                                    // Nombre de host
$cfg["mysqlUser"]     = "mclibre_base_datos_3_b_contador_conexiones";   // Nombre de usuario
$cfg["mysqlPassword"] = "";                                             // Contraseña de usuario
$cfg["mysqlDatabase"] = "mclibre_base_datos_3_b_contador_conexiones";   // Nombre de la base de datos

// Tamaño de los campos en la tabla Usuarios

$cfg["tablaUsuariosTamUsuario"]  = 20;                      // Tamaño de la columna Usuarios > Nombre de usuario
$cfg["tablaUsuariosTamPassword"] = 64;                      // Tamaño de la columna Usuarios > Contraseña de usuario (cifrada)

// Tamaño de los controles en los formularios

$cfg["formUsuariosTamUsuario"]  = $cfg["tablaUsuariosTamUsuario"];  // Tamaño de la caja de texto Usuarios > Nombre de usuario
$cfg["formUsuariosTamPassword"] = 20;                               // Tamaño de la caja de texto Usuarios > Contraseña

// Tamaño máximo admitido por los controles en los formularios

$cfg["formUsuariosMaxUsuario"]  = $cfg["tablaUsuariosTamUsuario"];   // Tamaño máximo admitido por la caja de texto Usuarios > Nombre de usuario
$cfg["formUsuariosMaxPassword"] = $cfg["formUsuariosTamPassword"];   // Tamaño máximo admitido por la caja de texto Usuarios > Contraseña

// Tamaño de los campos en la tabla Personas

$cfg["tablaPersonasTamNombre"]    = 40;                     // Tamaño de la columna Personas > Nombre
$cfg["tablaPersonasTamApellidos"] = 60;                     // Tamaño de la columna Personas > Apellidos
$cfg["tablaPersonasTamTelefono"]  = 15;                     // Tamaño de la columna Personas > Teléfono
$cfg["tablaPersonasTamCorreo"]    = 50;                     // Tamaño de la columna Personas > Correo

// Tamaño de los controles en los formularios

$cfg["formPersonasTamNombre"]    = $cfg["tablaPersonasTamNombre"];     // Tamaño de la caja de texto Personas > Nombre
$cfg["formPersonasTamApellidos"] = $cfg["tablaPersonasTamApellidos"];  // Tamaño de la caja de texto Personas > Apellidos
$cfg["formPersonasTamTelefono"]  = $cfg["tablaPersonasTamTelefono"];   // Tamaño de la caja de texto Personas > Teléfono
$cfg["formPersonasTamCorreo"]    = $cfg["tablaPersonasTamCorreo"];     // Tamaño de la caja de texto Personas > Correo

// Tamaño máximo admitido por los controles en los formularios

$cfg["formPersonasMaxNombre"]    = $cfg["tablaPersonasTamNombre"];     // Tamaño máximo admitido por la caja de texto Personas > Nombre
$cfg["formPersonasMaxApellidos"] = $cfg["tablaPersonasTamApellidos"];  // Tamaño máximo admitido por la caja de texto Personas > Apellidos
$cfg["formPersonasMaxTelefono"]  = $cfg["tablaPersonasTamTelefono"];   // Tamaño máximo admitido por la caja de texto Personas > Teléfono
$cfg["formPersonasMaxCorreo"]    = $cfg["tablaPersonasTamCorreo"];     // Tamaño máximo admitido por la caja de texto Personas > Correo

// Número máximo de registros en las tablas (el valor 0 o negativo indica que no hay límite)

$cfg["tablaUsuariosMaxReg"] = 20;                           // Número máximo de registros en la tabla Usuarios
$cfg["tablaPersonasMaxReg"] = 20;                           // Número máximo de registros en la tabla Personas

// Usuario Administrador de la aplicación

$cfg["rootName"]      = "root";                             // Nombre del Usuario Administrador de la aplicación
$cfg["rootPassword"]  = "4813494d137e1631bba301d5acab6e7bb7aa74ce1185d456565ef51d737677b2";  // Contraseña encriptada del Usuario Administrador de la aplicación
$cfg["hashAlgorithm"] = "sha256";                           // Algoritmo hash para encriptar la contraseña de usuario
                                                            // Los posibles algoritmos son https://www.php.net/manual/en/function.hash-algos.php
                                                            // Si se cambia el algoritmo puede ser necesario cambiar $cfg["tablaUsuariosTamPassword"]
$cfg["rootPasswordModificable"] = false;                    // Contraseña del usuario Administrador se puede cambiar o no

// Número de conexiones tras el que se muestra aviso

$cfg["numeroConexionesAviso"] = 3;                          // Número de conexiones tras el que se muestra aviso

// Método de envío de formularios

$cfg["formMethod"] = "get";                                 // Valores posibles: get o post
