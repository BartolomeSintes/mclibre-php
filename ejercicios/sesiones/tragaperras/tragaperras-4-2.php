<?php
/**
 * Minijuegos: Tragaperras (4) - tragaperras-4-2.php
 *
 * @author    Bartolomé Sintes Marco <bartolome.sintes+mclibre@gmail.com>
 * @copyright 2018 Bartolomé Sintes Marco
 * @license   http://www.gnu.org/licenses/agpl.txt AGPL 3 or later
 * @version   2018-10-31
 * @link      https://www.mclibre.org
 *
 *  This program is free software: you can redistribute it and/or modify
 *  it under the terms of the GNU Affero General Public License as published by
 *  the Free Software Foundation, either version 3 of the License, or
 *  any later version.
 *
 *  This program is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU Affero General Public License for more details.
 *
 *  You should have received a copy of the GNU Affero General Public License
 *  along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */
session_name("tragaperras-4");
session_start();

// Funciones auxiliares
function recoge($var, $m = "")
{
    if (!isset($_REQUEST[$var])) {
        $tmp = (is_array($m)) ? [] : "";
    } elseif (!is_array($_REQUEST[$var])) {
        $tmp = trim(htmlspecialchars($_REQUEST[$var], ENT_QUOTES, "UTF-8"));
    } else {
        $tmp = $_REQUEST[$var];
        array_walk_recursive($tmp, function (&$valor) {
            $valor = trim(htmlspecialchars($valor, ENT_QUOTES, "UTF-8"));
        });
    }
    return $tmp;
}

$simbolosNumero = 8;   // Número de frutas

// Valores iniciales variables sesión
if (!isset($_SESSION["monedas"]) || !isset($_SESSION["fruta1"])
    || !isset($_SESSION["fruta2"]) || !isset($_SESSION["fruta3"])
    || !isset($_SESSION["premio"]) || !isset($_SESSION["cara"])) {
    $_SESSION["monedas"] = 0;
    $_SESSION["fruta1"] = rand(1, $simbolosNumero);
    $_SESSION["fruta2"] = rand(1, $simbolosNumero);
    $_SESSION["fruta3"] = rand(1, $simbolosNumero);
    $_SESSION["premio"] = 0;
    $_SESSION["cara"] = "plain";
}

// Recogida de datos
$accion  = recoge("accion");

// Si se ha insertado moneda, se aumenta la cantidad de monedas
if ($accion == "moneda") {
    $_SESSION["monedas"] += 1;
    $_SESSION["premio"] = 0;
    $_SESSION["cara"] = "plain";
}

// Si se ha jugado, se genera una nueva combinación, se pierde una moneda y se comprueba el premio
if ($accion == "jugar" && $_SESSION["monedas"] > 0) {
    $_SESSION["fruta1"] = rand(1, $simbolosNumero);
    $_SESSION["fruta2"] = rand(1, $simbolosNumero);
    $_SESSION["fruta3"] = rand(1, $simbolosNumero);

    // Se pierde una moneda
    $_SESSION["monedas"] -= 1;

    // Se comprueba cuál es el premio
    $cereza = 1;   // Número de imagen de la cereza (1.svg)

    // Si han salido tres cerezas
    if ($_SESSION["fruta1"] == $cereza &&
        $_SESSION["fruta2"] == $cereza &&
        $_SESSION["fruta3"] == $cereza) {
        $_SESSION["premio"] = 10;
    // Si han salido dos cerezas
    } elseif (($_SESSION["fruta1"] == $cereza && $_SESSION["fruta2"] == $cereza) ||
        ($_SESSION["fruta2"] == $cereza && $_SESSION["fruta3"] == $cereza) ||
        ($_SESSION["fruta1"] == $cereza && $_SESSION["fruta3"] == $cereza)) {
        $_SESSION["premio"] = 4;
    // Si ha salido una cereza
    } elseif ($_SESSION["fruta1"] == $cereza ||
        $_SESSION["fruta2"] == $cereza ||
        $_SESSION["fruta3"] == $cereza) {
        $_SESSION["premio"] = 1;
        // Si además de una cereza hay dos frutas iguales
        if ($_SESSION["fruta1"] == $_SESSION["fruta2"] ||
            $_SESSION["fruta2"] == $_SESSION["fruta3"] ||
            $_SESSION["fruta1"] == $_SESSION["fruta3"]) {
            $_SESSION["premio"] = 3;
        }
    // Si han salido tres frutas iguales (que no son cerezas)
    } elseif ($_SESSION["fruta1"] == $_SESSION["fruta2"] &&
        $_SESSION["fruta2"] == $_SESSION["fruta3"]) {
        $_SESSION["premio"] = 5;
    // Si han salido dos frutas iguales (que no son cerezas)
    } elseif ($_SESSION["fruta1"] == $_SESSION["fruta2"] ||
        $_SESSION["fruta2"] == $_SESSION["fruta3"] ||
        $_SESSION["fruta1"] == $_SESSION["fruta3"]) {
        $_SESSION["premio"] = 2;
    // En cualquier otro caso
    } else {
        $_SESSION["premio"] = 0;
    }

    // Se añade el premio a las monedas
    $_SESSION["monedas"] += $_SESSION["premio"];

    // Se elige la cara a mostrar
    if ($_SESSION["premio"] > 0) {
        $_SESSION["cara"] = "smile";
    } else {
        $_SESSION["cara"] = "sad";
    }
}

// Redirección automática
header("Location:tragaperras-4-1.php");
