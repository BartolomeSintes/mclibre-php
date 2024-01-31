<?php
/**
 * @author    Bartolomé Sintes Marco - bartolome.sintes+mclibre@gmail.com
 * @license   https://www.gnu.org/licenses/agpl-3.0.txt AGPL 3 or later
 * @link      https://www.mclibre.org
 */

require_once "../../comunes/biblioteca.php";

session_name($cfg["sessionName"]);
session_start();

if (!isset($_SESSION["conectado"]) || $_SESSION["nivel"] < NIVEL_USUARIO_BASICO) {
    header("Location:../../index.php");
    exit;
}

$pdo = conectaDb();

cabecera("Personas - Incompletos 2", MENU_PERSONAS, PROFUNDIDAD_2);

$id = recoge("id");

$idOk = false;

if ($id == "") {
    print "    <p class=\"aviso\">No se ha seleccionado ningún registro.</p>\n";
} else {
    $idOk = true;
}

$registroEncontradoOk = false;

if ($idOk) {
    $consulta = "SELECT COUNT(*) FROM $cfg[tablaPersonas]
                 WHERE id = :id";

    $resultado = $pdo->prepare($consulta);
    if (!$resultado) {
        print "    <p class=\"aviso\">Error al preparar la consulta. SQLSTATE[{$pdo->errorCode()}]: {$pdo->errorInfo()[2]}</p>\n";
    } elseif (!$resultado->execute([":id" => $id])) {
        print "    <p class=\"aviso\">Error al ejecutar la consulta. SQLSTATE[{$pdo->errorCode()}]: {$pdo->errorInfo()[2]}</p>\n";
    } elseif ($resultado->fetchColumn() == 0) {
        print "    <p class=\"aviso\">Registro no encontrado.</p>\n";
    } else {
        $registroEncontradoOk = true;
    }
}

if ($idOk && $registroEncontradoOk) {
    $consulta = "SELECT * FROM $cfg[tablaPersonas]
                 WHERE id = :id";

    $resultado = $pdo->prepare($consulta);
    if (!$resultado) {
        print "    <p class=\"aviso\">Error al preparar la consulta. SQLSTATE[{$pdo->errorCode()}]: {$pdo->errorInfo()[2]}</p>\n";
    } elseif (!$resultado->execute([":id" => $id])) {
        print "    <p class=\"aviso\">Error al ejecutar la consulta. SQLSTATE[{$pdo->errorCode()}]: {$pdo->errorInfo()[2]}</p>\n";
    } else {
        $registro = $resultado->fetch();
        print "    <form action=\"incompletos-3.php\" method=\"$cfg[formMethod]\">\n";
        print "      <p>Complete los campos que desee:</p>\n";
        print "\n";
        print "      <table>\n";
        print "        <tr>\n";
        print "          <td>Nombre:</td>\n";
        if ($registro["nombre"] == ""){
            print "          <td><input type=\"text\" name=\"nombre\" size=\"$cfg[formPersonasTamNombre]\" maxlength=\"$cfg[formPersonasMaxNombre]\" autofocus></td>\n";
        } else {
            print "          <td>$registro[nombre] <input type=\"hidden\" name=\"nombre\" value=\"$registro[nombre]\"></td>\n";
        }
        print "        </tr>\n";
        print "        <tr>\n";
        print "          <td>Apellidos:</td>\n";
        if ($registro["apellidos"] == ""){
            print "          <td><input type=\"text\" name=\"apellidos\" size=\"$cfg[formPersonasTamApellidos]\" maxlength=\"$cfg[formPersonasMaxApellidos]\"></td>\n";
        } else {
            print "          <td>$registro[apellidos] <input type=\"hidden\" name=\"apellidos\" value=\"$registro[apellidos]\"></td>\n";
        }
        print "        </tr>\n";
        print "        <tr>\n";
        print "          <td>Teléfono:</td>\n";
        if ($registro["telefono"] == ""){
            print "          <td><input type=\"text\" name=\"telefono\" size=\"$cfg[formPersonasTamTelefono]\" maxlength=\"$cfg[formPersonasMaxTelefono]\"></td>\n";
        } else {
            print "          <td>$registro[telefono] <input type=\"hidden\" name=\"telefono\" value=\"$registro[telefono]\"></td>\n";
        }
        print "        </tr>\n";
        print "        <tr>\n";
        print "          <td>Correo:</td>\n";
        if ($registro["correo"] == ""){
            print "          <td><input type=\"text\" name=\"correo\" size=\"$cfg[formPersonasTamCorreo]\" maxlength=\"$cfg[formPersonasMaxCorreo]\"></td>\n";
        } else {
            print "          <td>$registro[correo] <input type=\"hidden\" name=\"correo\" value=\"$registro[correo]\"></td>\n";
        }
        print "        </tr>\n";
        print "      </table>\n";
        print "\n";
        print "      <p>\n";
        print "        <input type=\"hidden\" name=\"id\" value=\"$id\">\n";
        print "        <input type=\"submit\" value=\"Guardar\">\n";
        print "        <input type=\"reset\" value=\"Reiniciar formulario\">\n";
        print "      </p>\n";
        print "    </form>\n";
    }
}

pie();
