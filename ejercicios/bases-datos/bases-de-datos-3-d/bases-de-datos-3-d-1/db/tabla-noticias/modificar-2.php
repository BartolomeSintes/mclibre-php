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

cabecera("Noticias - Modificar 2", MENU_NOTICIAS, PROFUNDIDAD_2);

$id = recoge("id");

if ($id == "") {
    print "    <p class=\"aviso\">No se ha seleccionado ningún registro.</p>\n";
} else {
    $consulta = "SELECT * FROM $cfg[tablaNoticias]
                 WHERE id = :id";

    $resultado = $pdo->prepare($consulta);
    if (!$resultado) {
        print "    <p class=\"aviso\">Error al preparar la consulta. SQLSTATE[{$pdo->errorCode()}]: {$pdo->errorInfo()[2]}</p>\n";
    } elseif (!$resultado->execute([":id" => $id])) {
        print "    <p class=\"aviso\">Error al ejecutar la consulta. SQLSTATE[{$pdo->errorCode()}]: {$pdo->errorInfo()[2]}</p>\n";
    } elseif (!($registro = $resultado->fetch())) {
        print "    <p class=\"aviso\">Registro no encontrado.</p>\n";
    } else {
        print "    <form action=\"modificar-3.php\" method=\"$cfg[formMethod]\">\n";
        print "      <p>Modifique los campos que desee:</p>\n";
        print "\n";
        print "      <table>\n";
        print "        <tr>\n";
        print "          <td>Categoría:</td>\n";
        print "          <td><input type=\"text\" name=\"categoria\" size=\"$cfg[formNoticiasTamCategoria]\" maxlength=\"$cfg[formNoticiasTamCategoria]\" value=\"$registro[categoria]\" autofocus></td>\n";
        print "        </tr>\n";
        print "        <tr>\n";
        print "          <td>Título:</td>\n";
        print "          <td><input type=\"text\" name=\"titulo\" size=\"$cfg[formNoticiasTamTitulo]\" maxlength=\"$cfg[formNoticiasTamTitulo]\" value=\"$registro[titulo]\"></td>\n";
        print "        </tr>\n";
        print "        <tr>\n";
        print "          <td>Cuerpo:</td>\n";
        print "          <td><textarea name=\"cuerpo\" rows=\"$cfg[formNoticiasTamCuerpoY]\" cols=\"$cfg[formNoticiasTamCuerpoX]\">$registro[cuerpo]</textarea></td>\n";
        print "        </tr>\n";
        print "        <tr>\n";
        print "          <td>Creado:</td>\n";
        print "          <td><input type=\"date\" name=\"creado\" value=\"$registro[creado]\"></td>\n";
        print "        </tr>\n";
        print "      </table>\n";
        print "\n";
        print "      <p>\n";
        print "        <input type=\"hidden\" name=\"id\" value=\"$id\">\n";
        print "        <input type=\"submit\" value=\"Actualizar\">\n";
        print "        <input type=\"reset\" value=\"Reiniciar formulario\">\n";
        print "      </p>\n";
        print "    </form>\n";
    }
}

pie();
