<?php
/**
 * Bases de datos 3-1 - listar.php
 *
 * @author    Escriba su nombre
 *
 */

require_once "biblioteca.php";

$db = conectaDb();
cabecera("Listar", MENU_VOLVER);

$columna = recogeValores("columna", $columnas, "apellidos");
$orden   = recogeValores("orden", $orden, "ASC");

$consulta = "SELECT COUNT(*) FROM $dbTabla";
$result = $db->query($consulta);
if (!$result) {
    print "    <p>Error en la consulta.</p>\n";
} elseif ($result->fetchColumn() == 0 ) {
    print "    <p>No se ha creado todavía ningún registro.</p>\n";
} else {
    $consulta = "SELECT * FROM $dbTabla
        ORDER BY $columna $orden";
    $result = $db->query($consulta);
    if (!$result) {
        print "    <p>Error en la consulta.</p>\n";
    } else {
        print "    <p>Listado completo de registros:</p>\n";
        print "\n";
        print "    <table class=\"conborde franjas\">\n";
        print "      <thead>\n";
        print "        <tr>\n";
        print "          <th>\n";
        print "            <a href=\"$_SERVER[PHP_SELF]?columna=nombre&amp;orden=ASC\">\n";
        print "              <img src=\"abajo.svg\" alt=\"A-Z\" title=\"A-Z\" width=\"15\" height=\"12\" /></a>\n";
        print "            Nombre\n";
        print "            <a href=\"$_SERVER[PHP_SELF]?columna=nombre&amp;orden=DESC\">\n";
        print "              <img src=\"arriba.svg\" alt=\"Z-A\" title=\"Z-A\" width=\"15\" height=\"12\" /></a>\n";
        print "          </th>\n";
        print "          <th>\n";
        print "            <a href=\"$_SERVER[PHP_SELF]?columna=apellidos&amp;orden=ASC\">\n";
        print "              <img src=\"abajo.svg\" alt=\"A-Z\" title=\"A-Z\" width=\"15\" height=\"12\" /></a>\n";
        print "            Apellidos\n";
        print "            <a href=\"$_SERVER[PHP_SELF]?columna=apellidos&amp;orden=DESC\">\n";
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
