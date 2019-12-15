<?php
/**
 * Minijuegos: Tragaperras (5) - tragaperras-5-2.php
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
session_name("tragaperras-5");
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
    || !isset($_SESSION["apuesta"])  || !isset($_SESSION["premio"])
    || !isset($_SESSION["cara"])) {
    $_SESSION["monedas"] = 0;
    $_SESSION["fruta1"] = rand(1, $simbolosNumero);
    $_SESSION["fruta2"] = rand(1, $simbolosNumero);
    $_SESSION["fruta3"] = rand(1, $simbolosNumero);
    $_SESSION["apuesta"] = 0;
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

// Si se ha apostado una moneda, se aumenta la cantidad apostada y se disminuye las monedas
if ($accion == "apostar" && $_SESSION["monedas"] > 0) {
    $_SESSION["apuesta"] += 1;
    $_SESSION["monedas"] -= 1;
    $_SESSION["premio"] = 0;
    $_SESSION["cara"] = "plain";
}

// Si se ha jugado, se genera una nueva combinación, se pierde la apuesta y se comprueba el premio
if ($accion == "jugar" && $_SESSION["apuesta"] > 0) {
    $_SESSION["fruta1"] = rand(1, $simbolosNumero);
    $_SESSION["fruta2"] = rand(1, $simbolosNumero);
    $_SESSION["fruta3"] = rand(1, $simbolosNumero);

    // Se comprueba cuál es el premio
    $cereza = 1;   // Número de imagen de la cereza (1.svg)

    // Si han salido tres cerezas
    if ($_SESSION["fruta1"] == $cereza &&
        $_SESSION["fruta2"] == $cereza &&
        $_SESSION["fruta3"] == $cereza) {
        $_SESSION["premio"] = 10 * $_SESSION["apuesta"];
    // Si han salido dos cerezas
    } elseif (($_SESSION["fruta1"] == $cereza && $_SESSION["fruta2"] == $cereza) ||
        ($_SESSION["fruta2"] == $cereza && $_SESSION["fruta3"] == $cereza) ||
        ($_SESSION["fruta1"] == $cereza && $_SESSION["fruta3"] == $cereza)) {
        $_SESSION["premio"] = 4 * $_SESSION["apuesta"];
    // Si ha salido una cereza
    } elseif ($_SESSION["fruta1"] == $cereza ||
        $_SESSION["fruta2"] == $cereza ||
        $_SESSION["fruta3"] == $cereza) {
        $_SESSION["premio"] = 1 * $_SESSION["apuesta"];
        // Si además de una cereza hay dos frutas iguales
        if ($_SESSION["fruta1"] == $_SESSION["fruta2"] ||
            $_SESSION["fruta2"] == $_SESSION["fruta3"] ||
            $_SESSION["fruta1"] == $_SESSION["fruta3"]) {
            $_SESSION["premio"] = 3 * $_SESSION["apuesta"];
        }
    // Si han salido tres frutas iguales (que no son cerezas)
    } elseif ($_SESSION["fruta1"] == $_SESSION["fruta2"] &&
        $_SESSION["fruta2"] == $_SESSION["fruta3"]) {
        $_SESSION["premio"] = 5 * $_SESSION["apuesta"];
    // Si han salido dos frutas iguales (que no son cerezas)
    } elseif ($_SESSION["fruta1"] == $_SESSION["fruta2"] ||
        $_SESSION["fruta2"] == $_SESSION["fruta3"] ||
        $_SESSION["fruta1"] == $_SESSION["fruta3"]) {
        $_SESSION["premio"] = 2 * $_SESSION["apuesta"];
    // En cualquier otro caso
    } else {
        $_SESSION["premio"] = 0;
    }

    // Se añade el premio a las monedas
    $_SESSION["apuesta"] = 0;
    $_SESSION["monedas"] += $_SESSION["premio"];

    // Se cambia la cara
    if ($_SESSION["premio"] > 0) {
        $_SESSION["cara"] = "smile";
    } else {
        $_SESSION["cara"] = "sad";
    }
}

// Redirección automática
header("Location:tragaperras-5-1.php");
