<?php
/**
 * Bases de datos 3-1 - buscar-2.php
 *
 * @author    Escriba su nombre
 *
 */

require_once "biblioteca.php";

$db = conectaDb();
cabecera("Buscar 2", MENU_VOLVER);

$nombre    = recoge("nombre");
$apellidos = recoge("apellidos");
$columna   = recogeValores("columna", $columnas, "apellidos");
$orden     = recogeValores("orden", $orden, "ASC");

$consulta = "SELECT COUNT(*) FROM $dbTabla
    WHERE nombre LIKE :nombre
    AND apellidos LIKE :apellidos";
$result = $db->prepare($consulta);
$result->execute([":nombre" => "%$nombre%", ":apellidos" => "%$apellidos%"]);
if (!$result) {
    print "    <p>Error en la consulta.</p>\n";
} elseif ($result->fetchColumn() == 0) {
    print "    <p>No se han encontrado registros.</p>\n";
} else {
    $consulta = "SELECT * FROM $dbTabla
        WHERE nombre LIKE :nombre
        AND apellidos LIKE :apellidos
        ORDER BY $columna $orden";
    $result = $db->prepare($consulta);
    $result->execute([":nombre" => "%$nombre%", ":apellidos" => "%$apellidos%"]);
    if (!$result) {
        print "    <p>Error en la consulta.</p>\n";
    } else {
        $datos = "nombre=$nombre&amp;apellidos=$apellidos&ampcolumna";
        print "    <p>Registros encontrados:</p>\n";
        print "\n";
        print "    <table class=\"conborde franjas\">\n";
        print "      <thead>\n";
        print "        <tr>\n";
        print "          <th>\n";
        print "            <a href=\"$_SERVER[PHP_SELF]?$datos=nombre&amp;orden=ASC\">\n";
        print "              <img src=\"abajo.svg\" alt=\"A-Z\" title=\"A-Z\" width=\"15\" height=\"12\" /></a>\n";
        print "            Nombre\n";
        print "            <a href=\"$_SERVER[PHP_SELF]?$datos=nombre&amp;orden=DESC\">\n";
        print "              <img src=\"arriba.svg\" alt=\"Z-A\" title=\"Z-A\" width=\"15\" height=\"12\" /></a>\n";
        print "          </th>\n";
        print "          <th>\n";
        print "            <a href=\"$_SERVER[PHP_SELF]?$datos=apellidos&amp;orden=ASC\">\n";
        print "              <img src=\"abajo.svg\" alt=\"A-Z\" title=\"A-Z\" width=\"15\" height=\"12\" /></a>\n";
        print "            Apellidos\n";
        print "            <a href=\"$_SERVER[PHP_SELF]?$datos=apellidos&amp;orden=DESC\">\n";
        print "              <img src=\"arriba.svg\" alt=\"Z-A\" title=\"Z-A\" width=\"15\" height=\"12\" /></a>\n";
        print "          </th>\n";
        print "        </tr>\n";
        print "      </thead>\n";
        print "      <tbody>\n";
        foreach ($result as $valor) {
            print "        <tr>\n";
            print "          <td>$valor[nombre]</td>\n";
            print "          <td>$valor[apellidos]</td>\n";
            print "        </tr>\n";
        }
        print "      </tbody>\n";
        print "    </table>\n";
    }
}

$db = null;
pie();
