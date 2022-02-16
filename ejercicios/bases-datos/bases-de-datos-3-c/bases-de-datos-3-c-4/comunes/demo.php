<?php

// Registros de prueba opcionales

$cfg["registrosDemo"] = [
    [$cfg["dbUsuariosTabla"], [2, "usuario1", encripta("usuario1"), NIVEL_USUARIO_BASICO]],
    [$cfg["dbUsuariosTabla"], [3, "usuario2", encripta("usuario2"), NIVEL_USUARIO_BASICO]],
    [$cfg["dbUsuariosTabla"], [4, "admin1", encripta("admin1"), NIVEL_ADMINISTRADOR]],
    [$cfg["dbCategoriasTabla"], [1, "phpMyAdmin"]],
    [$cfg["dbCategoriasTabla"], [2, "WordPress"]],
    [$cfg["dbCategoriasTabla"], [3, "VSCode"]],
    [$cfg["dbCategoriasTabla"], [4, "Firefox"]],
    [$cfg["dbCategoriasTabla"], [5, "Chrome"]],
    [$cfg["dbNoticiasTabla"], [1, 5, "Publicado Chrome 97", "El nuevo Google Chrome 97 incluye WebTransport, una nueva API de comunicación con  servidores HTTP/3.",  "2022-01-04"]],
    [$cfg["dbNoticiasTabla"], [2, 4, "Publicado Firefox 96", "La nueva versión de Firefox admite el formato de color CSS hwb() y la propiedad color-scheme, que facilita la adaptación a los modos claros y oscuros del sistema operativo.",  "2022-01-11"]],
    [$cfg["dbNoticiasTabla"], [3, 1, "Publicado phpMyAdmin 5.1.2", "Se ha publicado phpMyAdmin 5.1.2, una versión menor que incorpora 4 correcciones de seguridad y 7 correcciones de errores.",  "2022-01-22"]],
    [$cfg["dbNoticiasTabla"], [4, 2, "Publicado WordPress 5.9", "WordPress 5.9 estrena el nuevo tema Twenty Twenty-two, el primer tema de bloques predeterminado, que marca la dirección futura de los temas de WordPress. Continuando el proceso de implantación del diseño de bloques, también estrena el bloque de Navegación, nuevos controles de bloques y un directorio de patrones de bloques.",  "2022-01-25"]],
    [$cfg["dbNoticiasTabla"], [5, 5, "Publicado Chrome 98", "El nuevo Google Chrome 98 admite el formato de fuentes COLRv1, que permite añadir efectos de gradientes, composiciones y mezclas en las fuentes, además de reducir su tamaño.",  "2022-02-01"]],
    [$cfg["dbNoticiasTabla"], [6, 3, "Publicado Visual Studio Code 1.64", "Ya está disponible la primera versión de 2022 de Visual Studio Code. Sin novedades realmente importantes, esta versión incluye como siempre muchos detalles y mejoras como un segundo panel lateral, mejoras de las búsquedas en el editor de configuraciones o nuevos sonidos asociados a acciones, etc.",  "2022-02-03"]],
    [$cfg["dbNoticiasTabla"], [7, 1, "Publicado phpMyAdmin 5.1.3", "Se ha publicado phpMyAdmin 5.1.3, una versión menor que corrige una regresión que impedía el correcto funcionamiento del navel de navigación y una mejora de seguridad que evita un error que podría revelar en ciertas situaciones el directorio de instalación de phpMyAdmin.",  "2022-02-11"]],
    [$cfg["dbNoticiasTabla"], [8, 4, "Publicado Firefox 97", "La nueva versión de Firefox admite el nuevo mecanismo de las capas CSS (@layer), que facilitan la organización de las hojas de estilo.",  "2022-02-08"]],
];

function insertaDemo()
{
    global $cfg, $pdo;

    print "    <p>Insertando registros de prueba ...</p>\n";
    print "\n";
    foreach ($cfg["registrosDemo"] as $registro) {
        if ($registro[0] == $cfg["dbUsuariosTabla"]) {
            $consulta = "INSERT INTO $cfg[dbUsuariosTabla]
                         (id, usuario, password, nivel)
                         VALUES ({$registro[1][0]}, '{$registro[1][1]}', '{$registro[1][2]}',  {$registro[1][3]})";
        } elseif ($registro[0] == $cfg["dbCategoriasTabla"]) {
            $consulta = "INSERT INTO $cfg[dbCategoriasTabla]
                         (id, categoria)
                         VALUES ({$registro[1][0]}, '{$registro[1][1]}')";
        } elseif ($registro[0] == $cfg["dbNoticiasTabla"]) {
            $consulta = "INSERT INTO $cfg[dbNoticiasTabla]
                         (id, id_categoria, titulo, cuerpo, creado)
                         VALUES ({$registro[1][0]}, {$registro[1][1]}, '{$registro[1][2]}', '{$registro[1][3]}', '{$registro[1][4]}')";
        }

        if (!$pdo->query($consulta)) {
            print "    <p class=\"aviso\">Error al preparar la consulta. SQLSTATE[{$pdo->errorCode()}]: {$pdo->errorInfo()[2]}</p>\n";
        } else {
            print "    <p>Registro creado correctamente.</p>\n";
        }
        print "\n";
    }
}
