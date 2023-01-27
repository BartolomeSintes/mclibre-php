<?php
/**
 * @author Escriba aquí su nombre
 */

require_once "../../comunes/biblioteca.php";

session_name($cfg["sessionName"]);
session_start();

if (!isset($_SESSION["conectado"]) || $_SESSION["nivel"] < NIVEL_USUARIO_BASICO) {
    header("Location:../../index.php");
    exit;
}

$pdo = conectaDb();

cabecera("Usuarios - Modificar password 1", MENU_USUARIOS, PROFUNDIDAD_2);

$consulta = "SELECT * FROM $cfg[tablaUsuarios]
             WHERE id = $_SESSION[id_usuario]";

$resultado = $pdo->query($consulta);
if (!$resultado) {
    print "    <p class=\"aviso\">Error al ejecutar la consulta. SQLSTATE[{$pdo->errorCode()}]: {$pdo->errorInfo()[2]}</p>\n";
} elseif (!($registro = $resultado->fetch())) {
    print "    <p class=\"aviso\">Registro no encontrado.</p>\n";
} else {
    print "    <form action=\"password-2.php\" method=\"$cfg[formMethod]\">\n";
    print "      <p>Modifique la contraseña:</p>\n";
    print "\n";
    print "      <table>\n";
    print "        <tr>\n";
    print "          <td>Contraseña:</td>\n";
    print "          <td>\n";
    print "            <input type=\"text\" name=\"password\" size=\"$cfg[formUsuariosTamPassword]\" maxlength=\"$cfg[formUsuariosTamPassword]\">\n";
    print "          </td>\n";
    print "        </tr>\n";
    print "      </table>\n";
    print "\n";
    print "      <p>\n";
    print "        <input type=\"submit\" value=\"Actualizar\">\n";
    print "        <input type=\"reset\" value=\"Reiniciar formulario\">\n";
    print "      </p>\n";
    print "    </form>\n";
}

$pdo = null;

pie();
