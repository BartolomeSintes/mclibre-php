<?php
/**
 * @author    Bartolomé Sintes Marco - bartolome.sintes+mclibre@gmail.com
 * @license   https://www.gnu.org/licenses/agpl-3.0.txt AGPL 3 or later
 * @link      https://www.mclibre.org
 */

require_once "../../comunes/biblioteca.php";

session_name($cfg["sessionName"]);
session_start();

if (!isset($_SESSION["conectado"]) || $_SESSION["nivel"] < NIVEL_ADMINISTRADOR) {
    header("Location:../../index.php");
    exit;
}

$pdo = conectaDb();

cabecera("Usuarios - Añadir 1", MENU_USUARIOS, PROFUNDIDAD_2);

// Comprobamos si se ha alcanzado el número máximo de registros en la tabla
$limiteRegistrosOk = false;

$consulta = "SELECT COUNT(*) FROM $cfg[tablaUsuarios]";

$resultado = $pdo->query($consulta);
if (!$resultado) {
    print "    <p class=\"aviso\">Error en la consulta. SQLSTATE[{$pdo->errorCode()}]: {$pdo->errorInfo()[2]}</p>\n";
} elseif ($resultado->fetchColumn() >= $cfg["tablaUsuariosMaxReg"] && $cfg["tablaUsuariosMaxReg"] > 0) {
    print "    <p class=\"aviso\">Se ha alcanzado el número máximo de registros que se pueden guardar.</p>\n";
    print "\n";
    print "    <p class=\"aviso\">Por favor, borre algún registro antes de insertar un nuevo registro.</p>\n";
} else {
    $limiteRegistrosOk = true;
}

// Si todas las comprobaciones han tenido éxito ...
if ($limiteRegistrosOk) {
    // Mostramos el formulario
    print "    <form action=\"insertar-2.php\" method=\"$cfg[formMethod]\">\n";
    print "      <p>Escriba los datos del nuevo registro:</p>\n";
    print "\n";
    print "      <table>\n";
    print "        <tr>\n";
    print "          <td>Usuario:</td>\n";
    print "          <td><input type=\"text\" name=\"usuario\" size=\"$cfg[formUsuariosTamUsuario]\" maxlength=\"$cfg[formUsuariosMaxUsuario]\" autofocus></td>\n";
    print "        </tr>\n";
    print "        <tr>\n";
    print "          <td>Contraseña:</td>\n";
    print "          <td><input type=\"text\" name=\"password\" size=\"$cfg[formUsuariosTamPassword]\" maxlength=\"$cfg[formUsuariosMaxPassword]\"></td>\n";
    print "        </tr>\n";
    print "        <tr>\n";
    print "          <td>Nivel:</td>\n";
    print "          <td>\n";
    print "            <select name=\"nivel\">\n";
    foreach ($cfg["usuariosNiveles"] as $indice => $valor) {
        print "              <option value=\"$indice\">$valor</option>\n";
    }
    print "            </select>\n";
    print "          </td>\n";
    print "        </tr>\n";
    print "      </table>\n";
    print "\n";
    print "      <p>\n";
    print "        <input type=\"submit\" value=\"Añadir\">\n";
    print "        <input type=\"reset\" value=\"Reiniciar formulario\">\n";
    print "      </p>\n";
    print "    </form>\n";
}

pie();
