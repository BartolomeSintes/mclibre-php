<?php
/**
 * @author Escriba aquí su nombre
 */

require_once "biblioteca.php";

$pdo = conectaDb();

cabecera("Borrar 2", MENU_VOLVER);

$id = recoge("id", []);

foreach ($id as $indice => $valor) {
    $consulta = "DELETE FROM $cfg[dbPersonasTabla]
                 WHERE id=:indice";
    $resultado = $pdo->prepare($consulta);

    if (!$resultado->execute([":indice" => $indice])) {
        print "    <p class=\"aviso\">Error al borrar el registro. SQLSTATE[{$pdo->errorCode()}]: {$pdo->errorInfo()[2]}</p>\n";
        print "\n";
    } else {
        print "    <p>Registro borrado correctamente (si existía).</p>\n";
        print "\n";
    }
}

$pdo = null;

pie();
