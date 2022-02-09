<?php

// Registros de prueba opcionales

$cfg["registrosDemo"] = [
    [$cfg["dbUsuariosTabla"], [2, "usuario1", encripta("usuario1"), NIVEL_USUARIO_BASICO]],
    [$cfg["dbUsuariosTabla"], [3, "usuario2", encripta("usuario2"), NIVEL_USUARIO_BASICO]],
    [$cfg["dbUsuariosTabla"], [4, "admin1", encripta("admin1"), NIVEL_ADMINISTRADOR]],
    [$cfg["dbPersonasTabla"], [1, "Pepito", "Conejo", "271828182", "pepito.conejo@example.com"]],
    [$cfg["dbPersonasTabla"], [2, "Numa", "Nigerio", "161803398", "numa.nigerio@example.com"]],
    [$cfg["dbPersonasTabla"], [3, "Fulanito", "Mengánez", "314159265", "fulanito.menganez@example.com"]],
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
                         (id, nombre, apellidos, telefono, correo)
                         VALUES ({$registro[1][0]}, '{$registro[1][1]}', '{$registro[1][2]}', '{$registro[1][3]}', '{$registro[1][4]}')";
        }

        if (!$pdo->query($consulta)) {
            print "    <p class=\"aviso\">Error al preparar la consulta. SQLSTATE[{$pdo->errorCode()}]: {$pdo->errorInfo()[2]}</p>\n";
        } else {
            print "    <p>Registro creado correctamente.</p>\n";
        }
        print "\n";
    }

    // https://stackoverflow.com/questions/244243/how-to-reset-postgres-primary-key-sequence-when-it-falls-out-of-sync?rq=1
    if ($cfg["dbMotor"] == POSTGRESQL) {
        foreach ($cfg["dbTablas"] as $tabla) {
            $consulta  = "SELECT setval(pg_get_serial_sequence('$tabla', 'id'), max(id)) FROM $tabla";
            $consulta  = "SELECT setval(pg_get_serial_sequence('$tabla', 'id'), coalesce(max(id),0) + 1, false) FROM $tabla";
            $resultado = $pdo->query($consulta);
            if (!$resultado) {
                print "    <p class=\"aviso\">Error al ejecutar la consulta. SQLSTATE[{$pdo->errorCode()}]: {$pdo->errorInfo()[2]}</p>\n";
            } else {
                print "    <p>Contador autonumérico reestablecido.</p>\n";
                print "\n";
            }
        }
    }
}
