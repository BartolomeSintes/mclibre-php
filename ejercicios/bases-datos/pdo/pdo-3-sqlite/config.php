<?php
/**
 * @author    Bartolomé Sintes Marco - bartolome.sintes+mclibre@gmail.com
 * @license   https://www.gnu.org/licenses/agpl-3.0.txt AGPL 3 or later
 * @link      https://www.mclibre.org
 */

// SQLITE: OPCIONES DE CONFIGURACIÓN DEL PROGRAMA

// OPCIONES DISPONIBLES PARA EL ADMINISTRADOR DE LA APLICACIÓN
// Configuración para SQLite
$cfg["sqliteDatabase"] = "/tmp/pdo-3.sqlite";                             // Ubicación de la base de datos

// Tamaño de los campos en la tabla Personas
$cfg["dbPersonasTamNombre"]    = 40;                              // Tamaño de la columna Personas > Nombre
$cfg["dbPersonasTamApellidos"] = 60;                              // Tamaño de la columna Personas > Apellidos

// OPCIONES DISPONIBLES PARA EL PROGRAMADOR DE LA APLICACIÓN
// Base de datos
$cfg["dbPersonasTabla"] = "personas";                      // Nombre de la tabla Personas
