<?php
// Registros de prueba opcionales

$cfg["registrosDemo"] = [
    [$cfg["tablaUsuarios"], [2, "usuario1", encripta("usuario1"), NIVEL_USUARIO_BASICO]],
    [$cfg["tablaUsuarios"], [3, "usuario2", encripta("usuario2"), NIVEL_USUARIO_BASICO]],
    [$cfg["tablaUsuarios"], [4, "admin1", encripta("admin1"), NIVEL_ADMINISTRADOR]],
    [$cfg["tablaNoticias"], [1, "phpMyAdmin", "Publicado phpMyAdmin 5.1.2", "Se ha publicado bla bla bla ...", "2022-01-22"]],
    [$cfg["tablaNoticias"], [2, "WordPress", "Publicado WordPress 5.9", "Se ha publicado bla bla bla ...", "2022-01-25"]],
    [$cfg["tablaNoticias"], [3, "VSCode", "Publicado Visual Studio Code 1.64", "Se ha publicado bla bla bla ...", "2022-02-03"]],
];

$cfg["registrosDemo"] = [
    [$cfg["tablaUsuarios"], [2, "usuario1", encripta("usuario1"), NIVEL_USUARIO_BASICO]],
    [$cfg["tablaUsuarios"], [3, "usuario2", encripta("usuario2"), NIVEL_USUARIO_BASICO]],
    [$cfg["tablaUsuarios"], [4, "admin1", encripta("admin1"), NIVEL_ADMINISTRADOR]],
    [$cfg["tablaNoticias"], [1, "Chrome", "Publicado Chrome 97", "El nuevo Google Chrome 97 incluye WebTransport, una nueva API de comunicación con  servidores HTTP/3.", "2022-01-04"]],
    [$cfg["tablaNoticias"], [2, "Firefox", "Publicado Firefox 96", "La nueva versión de Firefox admite el formato de color CSS hwb() y la propiedad color-scheme, que facilita la adaptación a los modos claros y oscuros del sistema operativo.", "2022-01-11"]],
    [$cfg["tablaNoticias"], [3, "phpMyAdmin", "Publicado phpMyAdmin 5.1.2", "Se ha publicado phpMyAdmin 5.1.2, una versión menor que incorpora 4 correcciones de seguridad y 7 correcciones de errores.", "2022-01-22"]],
    [$cfg["tablaNoticias"], [4, "WordPress", "Publicado WordPress 5.9", "WordPress 5.9 estrena el nuevo tema Twenty Twenty-two, el primer tema de bloques predeterminado, que marca la dirección futura de los temas de WordPress. Continuando el proceso de implantación del diseño de bloques, también estrena el bloque de Navegación, nuevos controles de bloques y un directorio de patrones de bloques.", "2022-01-25"]],
    [$cfg["tablaNoticias"], [5, "Chrome", "Publicado Chrome 98", "El nuevo Google Chrome 98 admite el formato de fuentes COLRv1, que permite añadir efectos de gradientes, composiciones y mezclas en las fuentes, además de reducir su tamaño.", "2022-02-01"]],
    [$cfg["tablaNoticias"], [6, "VSCode", "Publicado Visual Studio Code 1.64", "Ya está disponible la primera versión de 2022 de Visual Studio Code. Sin novedades realmente importantes, esta versión incluye como siempre muchos detalles y mejoras como un segundo panel lateral, mejoras de las búsquedas en el editor de configuraciones o nuevos sonidos asociados a acciones, etc.", "2022-02-03"]],
    [$cfg["tablaNoticias"], [7, "phpMyAdmin", "Publicado phpMyAdmin 5.1.3", "Se ha publicado phpMyAdmin 5.1.3, una versión menor que corrige una regresión que impedía el correcto funcionamiento del navel de navigación y una mejora de seguridad que evita un error que podría revelar en ciertas situaciones el directorio de instalación de phpMyAdmin.", "2022-02-11"]],
    [$cfg["tablaNoticias"], [8, "Firefox", "Publicado Firefox 97", "La nueva versión de Firefox admite el nuevo mecanismo de las capas CSS (@layer), que facilitan la organización de las hojas de estilo.", "2022-02-08"]],
];

function insertaDemo()
{
    global $cfg, $pdo;

    print "    <p>Insertando registros de prueba ...</p>\n";
    print "\n";
    foreach ($cfg["registrosDemo"] as $registro) {
        if ($registro[0] == $cfg["tablaUsuarios"]) {
            $consulta = "INSERT INTO $cfg[tablaUsuarios]
                         (id, usuario, password, nivel)
                         VALUES ({$registro[1][0]}, '{$registro[1][1]}', '{$registro[1][2]}', {$registro[1][3]})";
        } elseif ($registro[0] == $cfg["tablaNoticias"]) {
            $consulta = "INSERT INTO $cfg[tablaNoticias]
                         (id, categoria, titulo, cuerpo, creado)
                         VALUES ({$registro[1][0]}, '{$registro[1][1]}', '{$registro[1][2]}', '{$registro[1][3]}', '{$registro[1][4]}')";
        }

        if (!$pdo->query($consulta)) {
            print "    <p class=\"aviso\">Error al preparar la consulta. SQLSTATE[{$pdo->errorCode()}]: {$pdo->errorInfo()[2]}</p>\n";
        } else {
            print "    <p>Registro creado correctamente.</p>\n";
        }
        print "\n";
    }
}
