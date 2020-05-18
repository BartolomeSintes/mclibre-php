<?php
/**
 * @author    Bartolomé Sintes Marco - bartolome.sintes+mclibre@gmail.com
 * @license   http://www.gnu.org/licenses/agpl.txt AGPL 3 or later
 * @link      https://www.mclibre.org
 */

require_once "biblioteca.php";

$db = conectaDb();
cabecera("Añadir 2", MENU_VOLVER);

$nombre    = recoge("nombre");
$apellidos = recoge("apellidos");

$nombreOk    = false;
$apellidosOk = false;

if (mb_strlen($nombre, "UTF-8") > $tamAgendaNombre) {
    print "    <p class=\"aviso\">El nombre no puede tener más de $tamAgendaNombre caracteres.</p>\n";
    print "\n";
} else {
    $nombreOk = true;
}

if (mb_strlen($apellidos, "UTF-8") > $tamAgendaApellidos) {
    print "    <p class=\"aviso\">Los apellidos no pueden tener más de $tamAgendaApellidos caracteres.</p>\n";
    print "\n";
} else {
    $apellidosOk = true;
}

if ($nombreOk && $apellidosOk) {
    if ($nombre == "" && $apellidos == "") {
        print "    <p>Hay que rellenar al menos uno de los campos. No se ha guardado el registro.</p>\n";
    } else {
        $consulta = "SELECT COUNT(*) FROM $tablaAgenda";
        $result = $db->query($consulta);
        if (!$result) {
            print "    <p>Error en la consulta.</p>\n";
        } elseif ($result->fetchColumn() >= MAX_REG_TABLE_AGENDA) {
            print "    <p>Se ha alcanzado el número máximo de registros que se pueden guardar.</p>\n";
            print "\n";
            print "    <p>Por favor, borre algún registro antes.</p>\n";
        } else {
            $consulta = "SELECT COUNT(*) FROM $tablaAgenda
                WHERE nombre=:nombre
                AND apellidos=:apellidos";
            $result = $db->prepare($consulta);
            $result->execute([":nombre" => $nombre, ":apellidos" => $apellidos]);
            if (!$result) {
                print "    <p>Error en la consulta.</p>\n";
            } elseif ($result->fetchColumn() > 0) {
                print "    <p>El registro ya existe.</p>\n";
            } else {
                $consulta = "INSERT INTO $tablaAgenda
                    (nombre, apellidos)
                    VALUES (:nombre, :apellidos)";
                $result = $db->prepare($consulta);
                if ($result->execute([":nombre" => $nombre, ":apellidos" => $apellidos])) {
                    print "    <p>Registro <strong>$nombre $apellidos</strong> creado correctamente.</p>\n";
                } else {
                    print "    <p>Error al crear el registro <strong>$nombre $apellidos</strong>.</p>\n";
                }
            }
        }
    }
}

$db = null;
pie();
