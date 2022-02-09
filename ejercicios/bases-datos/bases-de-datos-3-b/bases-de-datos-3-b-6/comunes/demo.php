<?php

// Registros de prueba opcionales

$cfg["registrosDemo"] = [
    [$cfg["dbUsuariosTabla"], [2, "usuario1", encripta("usuario1"), NIVEL_USUARIO_BASICO]],
    [$cfg["dbUsuariosTabla"], [3, "usuario2", encripta("usuario2"), NIVEL_USUARIO_BASICO]],
    [$cfg["dbUsuariosTabla"], [4, "admin1", encripta("admin1"), NIVEL_ADMINISTRADOR]],
    [$cfg["dbPersonasTabla"], [1, "Pepito", "Conejo", "271828182", "pepito.conejo@example.com", "2010-03-19"]],
    [$cfg["dbPersonasTabla"], [2, "Numa", "Nigerio", "161803398", "numa.nigerio@example.com", "1944-03-15"]],
    [$cfg["dbPersonasTabla"], [3, "Fulanito", "Mengánez", "314159265", "fulanito.menganez@example.com", "1989-07-14"]],
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
        } elseif ($registro[0] == $cfg["dbPersonasTabla"]) {
            $consulta = "INSERT INTO $cfg[dbPersonasTabla]
                         (id, nombre, apellidos, telefono, correo, nacido)
                         VALUES ({$registro[1][0]}, '{$registro[1][1]}', '{$registro[1][2]}', '{$registro[1][3]}', '{$registro[1][4]}', '{$registro[1][5]}')";
        }

        if (!$pdo->query($consulta)) {
            print "    <p class=\"aviso\">Error al preparar la consulta. SQLSTATE[{$pdo->errorCode()}]: {$pdo->errorInfo()[2]}</p>\n";
        } else {
            print "    <p>Registro creado correctamente.</p>\n";
        }
        print "\n";
    }
}
