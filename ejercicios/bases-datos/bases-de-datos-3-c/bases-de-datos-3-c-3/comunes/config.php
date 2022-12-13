<?php
/**
 * @author    Bartolomé Sintes Marco - bartolome.sintes+mclibre@gmail.com
 * @license   https://www.gnu.org/licenses/agpl-3.0.txt AGPL 3 or later
 * @link      https://www.mclibre.org
 */

// OPCIONES DISPONIBLES PARA EL ADMINISTRADOR DE LA APLICACIÓN

// Nombre de sesión

$cfg["sessionName"] = "mclibre-bases-de-datos-3-c-3";       // Nombre de sesión

// Base de datos utilizada por la aplicación

$cfg["dbMotor"] = SQLITE;                                   // Valores posibles: MYSQL o SQLITE

// Configuración para SQLite

$cfg["sqliteDatabase"] = "/tmp/mclibre-base-datos-3-c-3.sqlite";    // Ubicación de la base de datos

// Configuración para MySQL

$cfg["mysqlHost"]     = "mysql:host=localhost";             // Nombre de host
$cfg["mysqlUser"]     = "mclibre_base_datos_3_c_2";         // Nombre de usuario
$cfg["mysqlPassword"] = "";                                 // Contraseña de usuario
$cfg["mysqlDatabase"] = "mclibre_base_datos_3_c_2";         // Nombre de la base de datos
$cfg["mysqlUser"]     = "iaw_tmp";         // Nombre de usuario
$cfg["mysqlPassword"] = "iaw_tmp";                                 // Contraseña de usuario
$cfg["mysqlDatabase"] = "iaw_tmp";         // Nombre de la base de datos

// Tamaño de los campos en la tabla Usuarios

$cfg["tablaUsuariosTamUsuario"]  = 20;                      // Tamaño de la columna Usuarios > Nombre de usuario
$cfg["tablaUsuariosTamPassword"] = 64;                      // Tamaño de la columna Usuarios > Contraseña de usuario (cifrada)

// Tamaño de los controles en los formularios

$cfg["formUsuariosTamUsuario"]  = $cfg["tablaUsuariosTamUsuario"];  // Tamaño de la caja de texto Usuario > Nombre de usuario
$cfg["formUsuariosTamPassword"] = 20;                               // Tamaño de la caja de texto Usuario > Contraseña

// Tamaño de los campos en la tabla Categorías

$cfg["tablaCategoriasTamCategoria"] = 40;                   // Tamaño de la columna Categorías > Categoría

// Tamaño de los controles en los formularios

$cfg["formCategoriasTamCategoria"] = $cfg["tablaCategoriasTamCategoria"];   // Tamaño de la caja de texto Categorías > Categoría

// Tamaño de los campos en la tabla Noticias

$cfg["tablaNoticiasTamTitulo"]    = 60;                     // Tamaño de la columna Noticias > Título
$cfg["tablaNoticiasTamCuerpo"]    = 200;                    // Tamaño de la columna Noticias > Cuerpo

// Tamaño de los controles en los formularios

$cfg["formNoticiasTamTitulo"]    = $cfg["tablaNoticiasTamTitulo"];  // Tamaño de la caja de texto Personas > Título
$cfg["formNoticiasTamCuerpoX"]   = 60;                              // Tamaño X del área de texto Noticias > Cuerpo
$cfg["formNoticiasTamCuerpoY"]   = 5;                               // Tamaño Y del área de texto Noticias > Cuerpo

// Número máximo de registros en las tablas (el valor 0 o negativo indica que no hay límite)

$cfg["tablaUsuariosMaxReg"]   = 20;                         // Número máximo de registros en la tabla Usuarios
$cfg["tablaCategoriasMaxReg"] = 20;                         // Número máximo de registros en la tabla Categorías
$cfg["tablaNoticiasMaxReg"]   = 20;                         // Número máximo de registros en la tabla Noticias

// Usuario Administrador de la aplicación

$cfg["rootName"]      = "root";                             // Nombre del Usuario Administrador de la aplicación
$cfg["rootPassword"]  = "4813494d137e1631bba301d5acab6e7bb7aa74ce1185d456565ef51d737677b2";  // Contraseña encriptada del Usuario Administrador de la aplicación
$cfg["hashAlgorithm"] = "sha256";                           // Algoritmo hash para encriptar la contraseña de usuario
                                                            // Los posibles algoritmos son https://www.php.net/manual/en/function.hash-algos.php
$cfg["rootPasswordModificable"] = false;                    // Contraseña del usuario Administrador se puede cambiar o no

// Portada

$cfg["portadaNumeroNoticias"] = 5;                          // Número de noticias que se muestran en la portada

// Método de envío de formularios

$cfg["formMethod"] = "get";                                 // Valores posibles: get o post
