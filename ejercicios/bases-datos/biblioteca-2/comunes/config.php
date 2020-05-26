<?php
/**
 * @author    Bartolomé Sintes Marco - bartolome.sintes+mclibre@gmail.com
 * @license   http://www.gnu.org/licenses/agpl.txt AGPL 3 or later
 * @link      https://www.mclibre.org
 */

// Base de datos utilizada por la aplicación: MYSQL o SQLITE

$dbMotor = SQLITE;                        // Valores posibles: MYSQL o SQLITE

// Algoritmo hash para encriptar la contraseña de usuario

define("HASH_ALGORITHM", "sha256");       // Algoritmo hash: Nombre
define("HASH_SIZE", 64);                  // Algoritmo hash: Longitud

// Configuración Tabla Usuarios

define("MAX_REG_TABLE_USUARIOS", 20);     // Número máximo de registros en la tabla Usuarios
$tamUsuariosUsuario         = 20;         // Tamaño de la columna Usuarios > Nombre de Usuario
$tamUsuariosPasswordCifrado = HASH_SIZE;  // Tamaño de la columna Usuarios > Contraseña de Usuario cifrada
$tamUsuariosPassword        = 20;         // Tamaño de la Contraseña de Usuario en el formulario

// Configuración Tabla Personas

define("MAX_REG_TABLE_PERSONAS", 20);     // Número máximo de registros en la tabla Personas
$tamPersonasNombre    = 40;               // Tamaño de la columna Personas > Nombre
$tamPersonasApellidos = 60;               // Tamaño de la columna Personas > Apellidos
$tamPersonasDni       = 9;                // Tamaño de la columna Personas > DNI

// Configuración Tabla Obras

define("MAX_REG_TABLE_OBRAS", 20);        // Número máximo de registros en la tabla Obras
$tamObrasAutor     = 60;                  // Tamaño de la columna Obras > Autor
$tamObrasTitulo    = 60;                  // Tamaño de la columna Obras > Titulo
$tamObrasEditorial = 20;                  // Tamaño de la columna Obras > Editorial

// Configuración Tabla Préstamos

define("MAX_REG_TABLE_PRESTAMOS", 20);    // Número máximo de registros en la tabla Préstamos
$tamPrestamosPersona  = 60;               // Tamaño de la columna Préstamos > Persona
$tamPrestamosObra     = 60;               // Tamaño de la columna Préstamos > Obra
$tamPrestamosPrestado = 20;               // Tamaño de la columna Préstamos > Fecha de Préstamo
$tamPrestamosDevuelto = 20;               // Tamaño de la columna Préstamos > Fecha de Devolución
$tamFecha             = 10;               // Longitud de una cadena de fecha (AAAA-MM-DD)

// Usuario inicial

define("ROOT_NAME", "root");                                                                  // Usuario inicial: Nombre
define("ROOT_PASSWORD", "4813494d137e1631bba301d5acab6e7bb7aa74ce1185d456565ef51d737677b2");  // Usuario inicial: Contraseña

// Método de envío de formularios

define("FORM_METHOD", GET);               // Valores posibles: GET o POST

// Hoja de estilo

define("COLOR", 27);                      // Color básico de la aplicación (0 - 360)

// Nombre de sesión

define("SESSION_NAME", "biblioteca");       // Nombre de sesión

// Zona horaria

define("ZONA_HORARIA",        "Europe/Madrid");  // Zona horaria del servidor