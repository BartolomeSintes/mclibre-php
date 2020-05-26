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

if (!isset($_SESSION["anyo"])) {
    $fecha            = date("Y-m-j");
    $mes              = substr($fecha, 5, 2);
    $anyo             = substr($fecha, 0, 4);
    $dia              = substr($fecha, 8, 2);
    $_SESSION["mes"]  = $mes;
    $_SESSION["anyo"] = $anyo;
    $_SESSION["dia"]  = $dia;
}

function calendario($db, $anyo, $mes, $diaMostrado, $consultaPlantilla)
{
    date_default_timezone_set(ZONA_HORARIA);

    $esBisiesto = ($anyo % 400 == 0 || ($anyo % 100 != 0 && $anyo % 4 == 0))
                    ? "1" : "0";
    $duraMeses = ($esBisiesto) ?
        [0, 31, 29, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31, 31] :
        [0, 31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31, 31];
    $meses = ["", "Enero", "Febrero", "Marzo", "Abril", "Mayo",
        "Junio", "Julio", "Agosto", "Septiembre", "Octubre",
        "Noviembre", "Diciembre",
    ];

    $mesAnt  = $mes - 1;
    $anyoAnt = $anyo;
    if ($mesAnt == 0) {
        $mesAnt = 12;
        $anyoAnt -= 1;
    }
    $mesSig  = $mes + 1;
    $anyoSig = $anyo;
    if ($mesSig == 13) {
        $mesSig = 1;
        $anyoSig += 1;
    }

    $jd        = gregoriantojd($mes, 1, $anyo);
    $dia       = (jddayofweek($jd, 0) + 6) % 7;
    $dias      = ["L", "M", "X", "J", "V", "S", "D"];
    $diaSemana = $dias[$dia];

    print "    <div class=\"calendario\">\n";
    print "      <table border=\"1\" class=\"calendario\" >\n";
    print "        <tr>\n";
    print "          <th><a href=\"$_SERVER[PHP_SELF]?fecha=$anyoAnt-" . sprintf("%02d", $mesAnt) . "-" . sprintf("%02d", $diaMostrado) . "\">&lt;&lt;</a></th>\n";
    print "          <th colspan=\"5\">{$meses[(int)$mes]} de $anyo</th>\n";
    print "          <th><a href=\"$_SERVER[PHP_SELF]?fecha=$anyoSig-" . sprintf("%02d", $mesSig) . "-" . sprintf("%02d", $diaMostrado) . "\">&gt;&gt;</a></th>\n";
    print "        </tr>\n";
    print "        <tr>\n";
    print "          <th>L</th>\n";
    print "          <th>M</th>\n";
    print "          <th>X</th>\n";
    print "          <th>J</th>\n";
    print "          <th>V</th>\n";
    print "          <th>S</th>\n";
    print "          <th>D</th>\n";
    print "        </tr>\n";
    for ($n = 0; $n <= 5; $n++) {
        $num_inicio = 1 - $dia + $n * 7;
        if ($num_inicio <= $duraMeses[(int)($mes)]) {
            print "        <tr>\n";
            for ($i = 0; $i < 7; $i++) {
                $num = $num_inicio + $i;
                if ($num > 0 && $num <= $duraMeses[(int)($mes)]) {
                    $consulta = $consultaPlantilla . ":fecha";
                    $result   = $db->prepare($consulta);
                    $result->execute([":fecha" => "$anyo-$mes-" . sprintf("%02d", $num)]);
                    if (!$result) {
                        print "          <td>$num</td>\n";
                    } elseif ($result->fetchColumn() > 0) {
                        print "          <td class=\"enlace\"><a "
                            . "href=\"$_SERVER[PHP_SELF]?fecha=$anyo-$mes-"
                            . sprintf("%02d", $num) . "\">$num</a></td>\n";
                    } else {
                        print "          <td>$num</td>\n";
                    }
                } else {
                    print "          <td></td>\n";
                }
            }
            print "        </tr>\n";
        }
    }
    print "      </table>\n";
    print "    </div>\n";
    print "\n";
}

$db = conectaDb();
cabecera("Calendario", MENU_ADMINISTRADOR, 1);

$fecha  = recoge("fecha");
$ordena = recogeValores("ordena", $columnasPrestamosOrden, "apellidos ASC");

if ($fecha == "") {
    $fecha = $_SESSION["anyo"] . "-" . $_SESSION["mes"] . "-" . $_SESSION["dia"];
}

$mes  = substr($fecha, 5, 2);
$anyo = substr($fecha, 0, 4);
$dia  = substr($fecha, 8, 2);

if (!checkdate($mes, $dia, $anyo)) {
    $fecha = date("Y-m-j");
    $mes   = substr($fecha, 5, 2);
    $anyo  = substr($fecha, 0, 4);
    $dia   = substr($fecha, 8, 2);
}

$_SESSION["mes"]  = $mes;
$_SESSION["anyo"] = $anyo;
$_SESSION["dia"]  = $dia;

calendario($db, $_SESSION["anyo"], $_SESSION["mes"], $_SESSION["dia"], "SELECT COUNT(*) FROM $tablaPrestamos WHERE prestado=");

$consulta = "SELECT COUNT(*) FROM $tablaPrestamos
    WHERE prestado=:prestado";
$result = $db->prepare($consulta);
$result->execute([":prestado" => $fecha]);
if (!$result) {
    print "    <p class=\"aviso\">Error en la consulta.</p>\n";
} elseif ($result->fetchColumn() == 0) {
    print "    <p>Haga clic en los días del mes con enlaces para ver los préstamos realizados en ese día.</p>\n";
} else {
    $consulta = "SELECT $tablaPrestamos.id as id,
            $tablaPersonas.nombre as nombre,
            $tablaPersonas.apellidos as apellidos,
            $tablaObras.titulo as titulo,
            $tablaObras.autor as autor,
            $tablaPrestamos.prestado as prestado,
            $tablaPrestamos.devuelto as devuelto
        FROM $tablaPersonas, $tablaObras, $tablaPrestamos
        WHERE $tablaPrestamos.id_persona=$tablaPersonas.id
        AND $tablaPrestamos.id_obra=$tablaObras.id
        AND prestado=:prestado
        ORDER BY $ordena";
    $result = $db->prepare($consulta);
    $result->execute([":prestado" => $fecha]);
    if (!$result) {
        print "    <p class=\"aviso\">Error en la consulta.</p>\n";
    } else {
        print "    <p>Listado completo de registros:</p>\n";
        print "\n";
        print "    <form action=\"$_SERVER[PHP_SELF]\" method=\"" . FORM_METHOD . "\">\n";
        print "      <table class=\"conborde franjas\">\n";
        print "        <thead>\n";
        print "          <tr>\n";
        print "            <th>\n";
        print "              <button name=\"ordena\" value=\"apellidos ASC\" class=\"boton-invisible\">\n";
        print "                <img src=\"../img/abajo.svg\" alt=\"A-Z\" title=\"A-Z\" width=\"15\" height=\"12\">\n";
        print "              </button>\n";
        print "              Persona\n";
        print "              <button name=\"ordena\" value=\"apellidos DESC\" class=\"boton-invisible\">\n";
        print "                <img src=\"../img/arriba.svg\" alt=\"Z-A\" title=\"Z-A\" width=\"15\" height=\"12\">\n";
        print "              </button>\n";
        print "            </th>\n";
        print "            <th>\n";
        print "              <button name=\"ordena\" value=\"autor ASC\" class=\"boton-invisible\">\n";
        print "                <img src=\"../img/abajo.svg\" alt=\"A-Z\" title=\"A-Z\" width=\"15\" height=\"12\">\n";
        print "              </button>\n";
        print "              Obra\n";
        print "              <button name=\"ordena\" value=\"autor DESC\" class=\"boton-invisible\">\n";
        print "                <img src=\"../img/arriba.svg\" alt=\"Z-A\" title=\"Z-A\" width=\"15\" height=\"12\">\n";
        print "              </button>\n";
        print "            </th>\n";
        print "            <th>\n";
        print "              <button name=\"ordena\" value=\"prestado ASC\" class=\"boton-invisible\">\n";
        print "                <img src=\"../img/abajo.svg\" alt=\"A-Z\" title=\"A-Z\" width=\"15\" height=\"12\">\n";
        print "              </button>\n";
        print "              Préstamo\n";
        print "              <button name=\"ordena\" value=\"prestado DESC\" class=\"boton-invisible\">\n";
        print "                <img src=\"../img/arriba.svg\" alt=\"Z-A\" title=\"Z-A\" width=\"15\" height=\"12\">\n";
        print "              </button>\n";
        print "            </th>\n";
        print "            <th>\n";
        print "              <button name=\"ordena\" value=\"devuelto ASC\" class=\"boton-invisible\">\n";
        print "                <img src=\"../img/abajo.svg\" alt=\"A-Z\" title=\"A-Z\" width=\"15\" height=\"12\">\n";
        print "              </button>\n";
        print "              Devolución\n";
        print "              <button name=\"ordena\" value=\"devuelto DESC\" class=\"boton-invisible\">\n";
        print "                <img src=\"../img/arriba.svg\" alt=\"Z-A\" title=\"Z-A\" width=\"15\" height=\"12\">\n";
        print "              </button>\n";
        print "            </th>\n";
        print "          </tr>\n";
        print "        </thead>\n";
        print "        <tbody>\n";
        foreach ($result as $valor) {
            print "          <tr>\n";
            print "            <td>$valor[nombre] $valor[apellidos]</td>\n";
            print "            <td>$valor[autor] - $valor[titulo]</td>\n";
            print "            <td>";
            if ($valor["prestado"] != "0000-00-00") {
                print $valor["prestado"];
            }
            print "</td>\n";
            print "            <td>";
            if ($valor["devuelto"] != "0000-00-00") {
                print $valor["devuelto"];
            }
            print "</td>\n";
            print "          </tr>\n";
        }
        print "        </tbody>\n";
        print "      </table>\n";
        print "    </form>\n";
    }
}

$db = null;
pie();
