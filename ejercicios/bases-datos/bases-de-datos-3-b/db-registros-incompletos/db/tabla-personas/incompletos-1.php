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

cabecera("Personas - Incompletos 1", MENU_PERSONAS, PROFUNDIDAD_2);

$ordena = recoge("ordena", default: "nombre ASC", allowed: $cfg["tablaPersonasColumnasOrden"]);
$id     = recoge("id");

$registrosEncontradosOk = false;

$consulta = "SELECT COUNT(*) FROM $cfg[tablaPersonas]
             WHERE nombre = ''
             OR apellidos = ''
             OR telefono = ''
             OR correo = ''
             ORDER BY $ordena";

$resultado = $pdo->query($consulta);
if (!$resultado) {
    print "    <p class=\"aviso\">Error en la consulta. SQLSTATE[{$pdo->errorCode()}]: {$pdo->errorInfo()[2]}</p>\n";
} elseif ($resultado->fetchColumn() == 0) {
    print "    <p class=\"aviso\">No hay ningún registro incompleto.</p>\n";
} else {
    $registrosEncontradosOk = true;
}

if ($registrosEncontradosOk) {
    // Seleccionamos todos los registros con las condiciones de búsqueda recibidas
    $consulta = "SELECT * FROM $cfg[tablaPersonas]
             WHERE nombre = ''
             OR apellidos = ''
             OR telefono = ''
             OR correo = ''
             ORDER BY $ordena";

    $resultado = $pdo->query($consulta);
    if (!$resultado) {
        print "    <p class=\"aviso\">Error en la consulta. SQLSTATE[{$pdo->errorCode()}]: {$pdo->errorInfo()[2]}</p>\n";
    } else {
        print "    <form action=\"$_SERVER[PHP_SELF]\" method=\"$cfg[formMethod]\">\n";
        print "      <p>Indique el registro incompleto que quiera completar:</p>\n";
        print "\n";
        print "      <table class=\"conborde franjas\">\n";
        print "        <thead>\n";
        print "          <tr>\n";
        print "            <th>Completar</th>\n";
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
        print "          </tr>\n";
        print "        </thead>\n";
        foreach ($resultado as $registro) {
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
            print "        </tr>\n";
        }
        print "      </table>\n";
        print "\n";
        print "      <p>\n";
        print "        <input type=\"submit\" value=\"Completar registro\" formaction=\"incompletos-2.php\">\n";
        print "        <input type=\"reset\" value=\"Reiniciar formulario\">\n";
        print "      </p>\n";
        print "    </form>\n";
    }
}

pie();
