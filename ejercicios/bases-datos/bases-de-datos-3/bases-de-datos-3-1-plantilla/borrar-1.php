<?php
/**
 * Bases de datos 3-1 - borrar-1.php
 *
 * @author    Escriba su nombre
 *
 */

require_once "biblioteca.php";

$db = conectaDb();
cabecera("Borrar 1", MENU_VOLVER);

$columna = recogeColumna("columna", "apellidos");
$orden   = recogeOrden("orden", "ASC");

$consulta = "SELECT COUNT(*) FROM $dbTabla
    ORDER BY $columna $orden";
$result = $db->query($consulta);
if (!$result) {
    print "    <p>Error en la consulta.</p>\n";
} elseif ($result->fetchColumn() == 0) {
    print "    <p>No se ha creado todavía ningún registro.</p>\n";
} else {
    $consulta = "SELECT * FROM $dbTabla
        ORDER BY $columna $orden";
    $result = $db->query($consulta);
    if (!$result) {
        print "    <p>Error en la consulta.</p>\n";
    } else {
        print "    <form action=\"borrar-2.php\" method=\"" . FORM_METHOD . "\">\n";
        print "      <p>Marque los registros que quiera borrar:</p>\n";
        print "\n";
        print "      <table class=\"conborde franjas\">\n";
        print "        <thead>\n";
        print "          <tr>\n";
        print "            <th>Borrar</th>\n";
        print "            <th>\n";
        print "              <a href=\"$_SERVER[PHP_SELF]?columna=nombre&amp;orden=ASC\">\n";
        print "                <img src=\"abajo.svg\" alt=\"A-Z\" title=\"A-Z\" width=\"15\" height=\"12\" /></a>\n";
        print "              Nombre\n";
        print "              <a href=\"$_SERVER[PHP_SELF]?columna=nombre&amp;orden=DESC\">\n";
        print "                <img src=\"arriba.svg\" alt=\"Z-A\" title=\"Z-A\" width=\"15\" height=\"12\" /></a>\n";
        print "            </th>\n";
        print "            <th>\n";
        print "              <a href=\"$_SERVER[PHP_SELF]?columna=apellidos&amp;orden=ASC\">\n";
        print "                <img src=\"abajo.svg\" alt=\"A-Z\" title=\"A-Z\" width=\"15\" height=\"12\" /></a>\n";
        print "              Apellidos\n";
        print "              <a href=\"$_SERVER[PHP_SELF]?columna=apellidos&amp;orden=DESC\">\n";
        print "                <img src=\"arriba.svg\" alt=\"Z-A\" title=\"Z-A\" width=\"15\" height=\"12\" /></a>\n";
        print "            </th>\n";
        print "          </tr>\n";
        print "        </thead>\n";
        print "        <tbody>\n";
        foreach ($result as $valor) {
            print "          <tr>\n";
            print "            <td class=\"centrado\"><input type=\"checkbox\" name=\"id[$valor[id]]\" /></td>\n";
            print "            <td>$valor[nombre]</td>\n";
            print "            <td>$valor[apellidos]</td>\n";
            print "          </tr>\n";
        }
        print "        </tbody>\n";
        print "      </table>\n";
        print "\n";
        print "      <p>\n";
        print "        <input type=\"submit\" value=\"Borrar registro\" />\n";
        print "        <input type=\"reset\" value=\"Reiniciar formulario\" />\n";
        print "      </p>\n";
        print "    </form>\n";
    }
}

$db = null;
pie();
