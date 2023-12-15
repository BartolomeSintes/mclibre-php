<?php
/**
 * @author    Bartolomé Sintes Marco - bartolome.sintes+mclibre@gmail.com
 * @license   https://www.gnu.org/licenses/agpl-3.0.txt AGPL 3 or later
 * @link      https://www.mclibre.org
 */

// OPCIONES RELACIONADAS CON LA ESTRUCTURA DE LA BASE DE DATOS

// Nombres de las tablas

$cfg["tablaUsuarios"]   = "usuarios";       // Nombre de la tabla Usuarios
$cfg["tablaCategorias"] = "categorias";     // Nombre de la tabla Categorías
$cfg["tablaNoticias"]   = "noticias";       // Nombre de la tabla Noticias

$cfg["dbTablas"] = [
    $cfg["tablaUsuarios"],
    $cfg["tablaCategorias"],
    $cfg["tablaNoticias"],
];

// Valores de ordenación de las tablas

$cfg["tablaUsuariosColumnasOrden"] = [
    "usuario ASC", "usuario DESC",
    "password ASC", "password DESC",
    "nivel ASC", "nivel DESC",
];

$cfg["tablaCategoriasColumnasOrden"] = [
    "categoria ASC", "categoria DESC",
];

$cfg["tablaNoticiasColumnasOrden"] = [
    "categoria ASC", "categoria DESC",
    "titulo ASC", "titulo DESC",
    "cuerpo ASC", "cuerpo DESC",
    "creado ASC", "creado DESC",
];

// Tabla Usuarios

// Tamaño de los campos en la tabla Usuarios

$cfg["tablaUsuariosTamUsuario"]  = 20;                      // Tamaño de la columna Usuarios > Nombre de usuario
$cfg["tablaUsuariosTamPassword"] = 64;                      // Tamaño de la columna Usuarios > Contraseña de usuario (cifrada)

// Tamaño de los controles en los formularios

$cfg["formUsuariosTamUsuario"]  = $cfg["tablaUsuariosTamUsuario"];  // Tamaño de la caja de texto Usuario > Nombre de usuario
$cfg["formUsuariosTamPassword"] = 20;                               // Tamaño de la caja de texto Usuario > Contraseña

// Tabla Categoría

// Tamaño de los campos en la tabla Categorías

$cfg["tablaCategoriasTamCategoria"] = 40;                   // Tamaño de la columna Categorías > Categoría

// Tamaño de los controles en los formularios

$cfg["formCategoriasTamCategoria"] = $cfg["tablaCategoriasTamCategoria"];   // Tamaño de la caja de texto Categorías > Categoría

// Tabla Noticias

// Tamaño de los campos en la tabla Noticias

$cfg["tablaNoticiasTamTitulo"] = 60;                     // Tamaño de la columna Noticias > Título
$cfg["tablaNoticiasTamCuerpo"] = 200;                    // Tamaño de la columna Noticias > Cuerpo

// Tamaño de los controles en los formularios

$cfg["formNoticiasTamTitulo"]  = $cfg["tablaNoticiasTamTitulo"];  // Tamaño de la caja de texto Personas > Título
$cfg["formNoticiasTamCuerpoX"] = 60;                              // Tamaño X del área de texto Noticias > Cuerpo
$cfg["formNoticiasTamCuerpoY"] = 5;                               // Tamaño Y del área de texto Noticias > Cuerpo
