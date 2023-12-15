<?php
/**
 * @author    Bartolomé Sintes Marco - bartolome.sintes+mclibre@gmail.com
 * @license   https://www.gnu.org/licenses/agpl-3.0.txt AGPL 3 or later
 * @link      https://www.mclibre.org
 */

// MYSQL: OPCIONES DE CONFIGURACIÓN DEL PROGRAMA

// OPCIONES DISPONIBLES PARA EL ADMINISTRADOR DE LA APLICACIÓN

// Configuración para MySQL

$cfg["mysqlHost"]     = "localhost";           // Nombre de host
$cfg["mysqlUser"]     = "";                    // Nombre de usuario
$cfg["mysqlPassword"] = "";                    // Contraseña de usuario
$cfg["mysqlDatabase"] = "";                    // Nombre de la base de datos

// Configuración de la tabla Personas

$cfg["tablaPersonasTamNombre"]    = 40;        // Tamaño de la columna Personas > Nombre
$cfg["tablaPersonasTamApellidos"] = 60;        // Tamaño de la columna Personas > Apellidos

// OPCIONES DISPONIBLES PARA EL PROGRAMADOR DE LA APLICACIÓN

// Nombre de las tablas

$cfg["tablaPersonas"] = ".personas";           // Nombre de la tabla Personas
