<?php
/**
 * @author    Bartolomé Sintes Marco - bartolome.sintes+mclibre@gmail.com
 * @license   http://www.gnu.org/licenses/agpl.txt AGPL 3 or later
 * @link      https://www.mclibre.org
 */

require_once "../comunes/biblioteca.php";

session_name(SESSION_NAME);
session_start();
if (!isset($_SESSION["conectado"]) || $_SESSION["conectado"] != NIVEL_2) {
    header("Location:../index.php");
    exit;
}

$db = conectaDb();
cabecera("Usuarios - Buscar 2", MENU_USUARIOS, 1);

$usuario  = recoge("usuario");
$password = recoge("password");
$nivel    = recoge("nivel");
$ordena   = recogeValores("ordena", $columnasUsuariosOrden, "password ASC");

$consulta = "SELECT COUNT(*) FROM $tablaUsuarios
    WHERE usuario LIKE :usuario
    AND password LIKE :password
    AND nivel LIKE :nivel";
$result = $db->prepare($consulta);
$result->execute([":usuario" => "%$usuario%", ":password" => "%$password%",
    ":nivel"                 => "%$nivel%", ]);
if (!$result) {
    print "    <p class=\"aviso\">Error en la consulta.</p>\n";
} elseif ($result->fetchColumn() == 0) {
    print "    <p>No se han encontrado registros.</p>\n";
} else {
    $consulta = "SELECT * FROM $tablaUsuarios
        WHERE usuario LIKE :usuario
        AND password LIKE :password
        AND nivel LIKE :nivel
        ORDER BY $ordena";
    $result = $db->prepare($consulta);
    $result->execute([":usuario" => "%$usuario%", ":password" => "%$password%",
        ":nivel"                 => "%$nivel%", ]);
    if (!$result) {
        print "    <p class=\"aviso\">Error en la consulta.</p>\n";
    } else {
        print "    <form action=\"$_SERVER[PHP_SELF]\" method=\"" . FORM_METHOD . "\">\n";
        print "      <p>\n";
        print "        <input type=\"hidden\" name=\"usuario\" value=\"$usuario\">\n";
        print "        <input type=\"hidden\" name=\"password\" value=\"$password\">\n";
        print "        <input type=\"hidden\" name=\"nivel\" value=\"$nivel\">\n";
        print "      </p>\n";
        print "\n";
        print "      <p>Registros encontrados:</p>\n";
        print "\n";
        print "      <table class=\"conborde franjas\">\n";
        print "        <thead>\n";
        print "          <tr>\n";
        print "            <th>\n";
        print "              <button name=\"ordena\" value=\"usuario ASC\" class=\"boton-invisible\">\n";
        print "                <img src=\"../img/abajo.svg\" alt=\"A-Z\" title=\"A-Z\" width=\"15\" height=\"12\">\n";
        print "              </button>\n";
        print "              Usuario\n";
        print "              <button name=\"ordena\" value=\"usuario DESC\" class=\"boton-invisible\">\n";
        print "                <img src=\"../img/arriba.svg\" alt=\"Z-A\" title=\"Z-A\" width=\"15\" height=\"12\">\n";
        print "              </button>\n";
        print "            </th>\n";
        print "            <th>\n";
        print "              <button name=\"ordena\" value=\"password ASC\" class=\"boton-invisible\">\n";
        print "                <img src=\"../img/abajo.svg\" alt=\"A-Z\" title=\"A-Z\" width=\"15\" height=\"12\">\n";
        print "              </button>\n";
        print "              Contraseña\n";
        print "              <button name=\"ordena\" value=\"password DESC\" class=\"boton-invisible\">\n";
        print "                <img src=\"../img/arriba.svg\" alt=\"Z-A\" title=\"Z-A\" width=\"15\" height=\"12\">\n";
        print "              </button>\n";
        print "            </th>\n";
        print "            <th>\n";
        print "              <button name=\"ordena\" value=\"nivel ASC\" class=\"boton-invisible\">\n";
        print "                <img src=\"../img/abajo.svg\" alt=\"A-Z\" title=\"A-Z\" width=\"15\" height=\"12\">\n";
        print "              </button>\n";
        print "              Nivel\n";
        print "              <button name=\"ordena\" value=\"nivel DESC\" class=\"boton-invisible\">\n";
        print "                <img src=\"../img/arriba.svg\" alt=\"Z-A\" title=\"Z-A\" width=\"15\" height=\"12\">\n";
        print "              </button>\n";
        print "            </th>\n";
        print "        </thead>\n";
        print "        <tbody>\n";
        foreach ($result as $valor) {
            print "          <tr>\n";
            print "            <td>$valor[usuario]</td>\n";
            print "            <td>$valor[password]</td>\n";
            print "            <td>" . array_search($valor["nivel"], $usuariosNiveles) . "</td>\n";
            print "          </tr>\n";
        }
        print "        </tbody>\n";
        print "      </table>\n";
        print "    </form>\n";
    }
}

$db = null;
pie();
