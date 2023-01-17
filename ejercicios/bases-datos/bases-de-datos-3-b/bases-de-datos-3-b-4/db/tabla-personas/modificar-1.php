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

cabecera("Personas - Modificar 1", MENU_PERSONAS, PROFUNDIDAD_2);

$ordena = recogeValores("ordena", $cfg["tablaPersonasColumnasOrden"], "nombre ASC");
$id     = recoge("id");
if ($_SESSION["nivel"] == NIVEL_ADMINISTRADOR) {
    $consulta = "SELECT
                     personas.id,
                     personas.nombre,
                     personas.apellidos,
                     personas.correo,
                     personas.telefono,
                     usuarios.usuario
                 FROM $cfg[tablaPersonas] as personas
                 JOIN $cfg[tablaUsuarios] as usuarios
                 ON personas.id_usuario = usuarios.id
                 ORDER BY $ordena";
} else {
    $consulta = "SELECT * FROM $cfg[tablaPersonas]
                 WHERE id_usuario = $_SESSION[id_usuario]
                 ORDER BY $ordena";
}
$resultado = $pdo->query($consulta);
if (!$resultado) {
    print "    <p class=\"aviso\">Error en la consulta. SQLSTATE[{$pdo->errorCode()}]: {$pdo->errorInfo()[2]}</p>\n";
} elseif (count($registros = $resultado->fetchAll()) == 0) {
    print "    <p class=\"aviso\">No se ha creado todavía ningún registro.</p>\n";
} else {
    print "    <form action=\"$_SERVER[PHP_SELF]\" method=\"$cfg[formMethod]\">\n";
    print "      <p>Indique el registro que quiera modificar:</p>\n";
    print "\n";
    print "      <table class=\"conborde franjas\">\n";
    print "        <thead>\n";
    print "          <tr>\n";
    print "            <th>Modificar</th>\n";
    print "            <th>\n";
    print "              <button name=\"ordena\" value=\"nombre ASC\" class=\"boton-invisible\">\n";
    print "                <img src=\"../../img/abajo.svg\" alt=\"A-Z\" title=\"A-Z\" width=\"15\" height=\"12\">\n";
    print "              </button>\n";
    print "              Nombre\n";
    print "              <button name=\"ordena\" value=\"nombre DESC\" class=\"boton-invisible\">\n";
    print "                <img src=\"../../img/arriba.svg\" alt=\"Z-A\" title=\"Z-A\" width=\"15\" height=\"12\">\n";
    print "              </button>\n";
    print "            </th>\n";
    print "            <th>\n";
    print "              <button name=\"ordena\" value=\"apellidos ASC\" class=\"boton-invisible\">\n";
    print "                <img src=\"../../img/abajo.svg\" alt=\"A-Z\" title=\"A-Z\" width=\"15\" height=\"12\">\n";
    print "              </button>\n";
    print "              Apellidos\n";
    print "              <button name=\"ordena\" value=\"apellidos DESC\" class=\"boton-invisible\">\n";
    print "                <img src=\"../../img/arriba.svg\" alt=\"Z-A\" title=\"Z-A\" width=\"15\" height=\"12\">\n";
    print "              </button>\n";
    print "            </th>\n";
    print "            <th>\n";
    print "              <button name=\"ordena\" value=\"telefono ASC\" class=\"boton-invisible\">\n";
    print "                <img src=\"../../img/abajo.svg\" alt=\"A-Z\" title=\"A-Z\" width=\"15\" height=\"12\">\n";
    print "              </button>\n";
    print "              Teléfono\n";
    print "              <button name=\"ordena\" value=\"telefono DESC\" class=\"boton-invisible\">\n";
    print "                <img src=\"../../img/arriba.svg\" alt=\"Z-A\" title=\"Z-A\" width=\"15\" height=\"12\">\n";
    print "              </button>\n";
    print "            </th>\n";
    print "            <th>\n";
    print "              <button name=\"ordena\" value=\"correo ASC\" class=\"boton-invisible\">\n";
    print "                <img src=\"../../img/abajo.svg\" alt=\"A-Z\" title=\"A-Z\" width=\"15\" height=\"12\">\n";
    print "              </button>\n";
    print "              Correo\n";
    print "              <button name=\"ordena\" value=\"correo DESC\" class=\"boton-invisible\">\n";
    print "                <img src=\"../../img/arriba.svg\" alt=\"Z-A\" title=\"Z-A\" width=\"15\" height=\"12\">\n";
    print "              </button>\n";
    print "            </th>\n";
    if ($_SESSION["nivel"] == NIVEL_ADMINISTRADOR) {
        print "            <th>\n";
        print "              <button name=\"ordena\" value=\"usuario ASC\" class=\"boton-invisible\">\n";
        print "                <img src=\"../../img/abajo.svg\" alt=\"A-Z\" title=\"A-Z\" width=\"15\" height=\"12\">\n";
        print "              </button>\n";
        print "              Usuario\n";
        print "              <button name=\"ordena\" value=\"usuario DESC\" class=\"boton-invisible\">\n";
        print "                <img src=\"../../img/arriba.svg\" alt=\"Z-A\" title=\"Z-A\" width=\"15\" height=\"12\">\n";
        print "              </button>\n";
        print "            </th>\n";
    }
    print "          </tr>\n";
    print "        </thead>\n";
    foreach ($registros as $registro) {
        print "        <tr>\n";
        if ($id == $registro["id"]) {
            print "          <td class=\"centrado\"><input type=\"radio\" name=\"id\" value=\"$registro[id]\" checked></td>\n";
        } else {
            print "          <td class=\"centrado\"><input type=\"radio\" name=\"id\" value=\"$registro[id]\"></td>\n";
        }
        print "          <td>$registro[nombre]</td>\n";
        print "          <td>$registro[apellidos]</td>\n";
        print "          <td>$registro[telefono]</td>\n";
        print "          <td>$registro[correo]</td>\n";
        if ($_SESSION["nivel"] == NIVEL_ADMINISTRADOR) {
            print "          <td>$registro[usuario]</td>\n";
        }
        print "        </tr>\n";
    }
    print "      </table>\n";
    print "\n";
    print "      <p>\n";
    print "        <input type=\"submit\" value=\"Modificar registro\" formaction=\"modificar-2.php\">\n";
    print "        <input type=\"reset\" value=\"Reiniciar formulario\">\n";
    print "      </p>\n";
    print "    </form>\n";
}

pie();
