<?php
/**
 * @author    Bartolomé Sintes Marco - bartolome.sintes+mclibre@gmail.com
 * @license   https://www.gnu.org/licenses/agpl-3.0.txt AGPL 3 or later
 * @link      https://www.mclibre.org
 */

require_once "../../comunes/biblioteca.php";

session_name($cfg["sessionName"]);
session_start();

if (!isset($_SESSION["conectado"])) {
    header("Location:../../index.php");
    exit;
}

$pdo = conectaDb();

cabecera("Usuarios - Borrar 2", MENU_USUARIOS, PROFUNDIDAD_2);

$id = recoge("id", []);

if (count($id) == 0) {
    print "    <p class=\"aviso\">No se ha seleccionado ningún registro.</p>\n";
} else {
    foreach ($id as $indice => $valor) {
        $consulta = "SELECT * FROM $cfg[dbUsuariosTabla]
                     WHERE id = :indice";

        $resultado = $pdo->prepare($consulta);
        if (!$resultado) {
            print "    <p class=\"aviso\">Error al preparar la consulta. SQLSTATE[{$pdo->errorCode()}]: {$pdo->errorInfo()[2]}</p>\n";
        } elseif (!$resultado->execute([":indice" => $indice])) {
            print "    <p class=\"aviso\">Error al ejecutar la consulta. SQLSTATE[{$pdo->errorCode()}]: {$pdo->errorInfo()[2]}</p>\n";
        } elseif (!($registro = $resultado->fetch())) {
            print "    <p class=\"aviso\">Registro no encontrado.</p>\n";
        } elseif ($registro["usuario"] == $cfg["rootName"]) {
            print "    <p class=\"aviso\">Este usuario no se puede borrar.</p>\n";
        } else {
            $consulta = "DELETE FROM $cfg[dbUsuariosTabla]
                         WHERE id = :indice";

            $resultado = $pdo->prepare($consulta);
            if (!$resultado) {
                print "    <p class=\"aviso\">Error al preparar la consulta. SQLSTATE[{$pdo->errorCode()}]: {$pdo->errorInfo()[2]}</p>\n";
                print "\n";
            } elseif (!$resultado->execute([":indice" => $indice])) {
                print "    <p class=\"aviso\">Error al ejecutar la consulta. SQLSTATE[{$pdo->errorCode()}]: {$pdo->errorInfo()[2]}</p>\n";
                print "\n";
            } else {
                print "    <p>Registro borrado correctamente.</p>\n";
            }
        }
    }
}

$pdo = null;

pie();
