<?php
/**
 * @author    Bartolomé Sintes Marco - bartolome.sintes+mclibre@gmail.com
 * @license   https://www.gnu.org/licenses/agpl-3.0.txt AGPL 3 or later
 * @link      https://www.mclibre.org
 */

// OPCIONES RELACIONADAS CON LA ESTRUCTURA DE LA BASE DE DATOS

// Tablas

$cfg["dbTablas"] = [
    $cfg["dbUsuariosTabla"],
    $cfg["dbCategoriasTabla"],
    $cfg["dbNoticiasTabla"],
];

// Valores de ordenación de las tablas

$cfg["dbUsuariosColumnasOrden"] = [
    "usuario ASC", "usuario DESC",
    "password ASC", "password DESC",
    "nivel ASC", "nivel DESC",
];

$cfg["dbCategoriasColumnasOrden"] = [
    "categoria ASC", "categoria DESC",
];

$cfg["dbNoticiasColumnasOrden"] = [
    "categoria ASC", "categoria DESC",
    "titulo ASC", "titulo DESC",
    "cuerpo ASC", "cuerpo DESC",
    "creado ASC", "creado DESC",
];

// Tabla Usuarios

// Tamaño de los campos en la tabla Usuarios

$cfg["dbUsuariosTamUsuario"]  = 20;                         // Tamaño de la columna Usuarios > Nombre de usuario
$cfg["dbUsuariosTamPassword"] = 64;                         // Tamaño de la columna Usuarios > Contraseña de usuario (cifrada)

// Tamaño de los controles en los formularios

$cfg["formUsuariosTamUsuario"]  = $cfg["dbUsuariosTamUsuario"];     // Tamaño de la caja de texto Usuario > Nombre de usuario
$cfg["formUsuariosTamPassword"] = 20;                               // Tamaño de la caja de texto Usuario > Contraseña

// Tabla Categoría

// Tamaño de los campos en la tabla Categorías

$cfg["dbCategoriasTamCategoria"] = 40;                      // Tamaño de la columna Categorías > Categoría

// Tamaño de los controles en los formularios

$cfg["formCategoriasTamCategoria"] = $cfg["dbCategoriasTamCategoria"];  // Tamaño de la caja de texto Categorías > Categoría

// Tabla Noticias

// Tamaño de los campos en la tabla Noticias

$cfg["dbNoticiasTamTitulo"] = 60;                        // Tamaño de la columna Noticias > Título
$cfg["dbNoticiasTamCuerpo"] = 200;                       // Tamaño de la columna Noticias > Cuerpo

// Tamaño de los controles en los formularios

$cfg["formNoticiasTamTitulo"]  = $cfg["dbNoticiasTamTitulo"];     // Tamaño de la caja de texto Personas > Título
$cfg["formNoticiasTamCuerpoX"] = 60;                              // Tamaño X del área de texto Noticias > Cuerpo
$cfg["formNoticiasTamCuerpoY"] = 5;                               // Tamaño Y del área de texto Noticias > Cuerpo
