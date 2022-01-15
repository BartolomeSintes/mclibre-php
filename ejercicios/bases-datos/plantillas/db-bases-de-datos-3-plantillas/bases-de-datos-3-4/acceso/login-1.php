<?php
/**
 * @author Escriba aquí su nombre
 */

require_once "../comunes/biblioteca.php";

session_name($cfg["sessionName"]);
session_start();

if (isset($_SESSION["conectado"])) {
    header("Location:../index.php");
    exit();
}

$pdo = conectaDb();

cabecera("Login 1", MENU_VOLVER, PROFUNDIDAD_1);

if (!existenTablas()) {
    print "<p>La base de datos no está creada. Se creará la base de datos.</p>\n";
    print "\n";
    borraTodo();
}

$aviso = recoge("aviso");
if ($aviso) {
    print "    <p class=\"aviso\">$aviso</p>\n";
    print "\n";
}
print "    <form action=\"login-2.php\" method=\"$cfg[formMethod]\">\n";
print "      <p>Escriba su nombre de usuario y contraseña:</p>\n";
print "\n";
print "      <table>\n";
print "        <tbody>\n";
print "          <tr>\n";
print "            <td>Nombre:</td>\n";
print "            <td><input type=\"text\" name=\"usuario\" size=\"$cfg[dbUsuariosTamUsuario]\" maxlength=\"$cfg[dbUsuariosTamUsuario]\" autofocus/></td>\n";
print "          </tr>\n";
print "          <tr>\n";
print "            <td>Contraseña:</td>\n";
print "            <td><input type=\"password\" name=\"password\" size=\"$cfg[usuariosTamPassword]\" maxlength=\"$cfg[usuariosTamPassword]\"/></td>\n";
print "          </tr>\n";
print "        </tbody>\n";
print "      </table>\n";
print "\n";
print "      <p>\n";
print "        <input type=\"submit\" value=\"Identificar\" />\n";
print "        <input type=\"reset\" value=\"Borrar\" />\n";
print "      </p>\n";
print "    </form>\n";

$pdo = null;

pie();
