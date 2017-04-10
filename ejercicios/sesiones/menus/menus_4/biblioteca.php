<?php
/**
 * Menús 4 - biblioteca.php
 *
 * @author    Bartolomé Sintes Marco <bartolome.sintes+mclibre@gmail.com>
 * @copyright 2016 Bartolomé Sintes Marco
 * @license   http://www.gnu.org/licenses/agpl.txt AGPL 3 or later
 * @version   2016-11-21
 * @link      http://www.mclibre.org
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

ini_set("session.save_handler", "files"); // Por si session.save_handler = user en php.ini

function cabecera($texto)
{
    print "<!DOCTYPE html>\n";
    print "  <html lang=\"es\">\n";
    print "  <head>\n";
    print "    <meta charset=\"utf-8\" />\n";
    print "    <title>$texto. Menús 4. Menús. \n";
    print "    Ejercicios. PHP. Bartolomé Sintes Marco</title>\n";
    print "    <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\" />\n";
    print "    <link href=\"mclibre_php_soluciones_proyectos.css\" rel=\"stylesheet\" type=\"text/css\" />\n";
    print "  </head>\n";
    print "\n";
    print "  <body>\n";
    print "    <header>\n";
    print "      <h1>Menús 4 - $texto</h1>\n";
    print "\n";
    print "      <nav>\n";
    print "        <ul>\n";
    print "          <li><a href=\"index.php\">Inicio</a></li>\n";
    print "          <li><a href=\"conectar.php\">Conectar</a></li>\n";
    print "          <li><a href=\"desconectar.php\">Desconectar</a></li>\n";
    print "          <li><a href=\"comprobar.php\">Comprobar</a></li>\n";
    print "        </ul>\n";
    print "      </nav>\n";
    print "    </header>\n";
    print "\n";
    print "    <main>\n";
}

function pie()
{
    print "    </main>\n";
    print "\n";
    print "    <footer>\n";
    print "      <p class=\"ultmod\">\n";
    print "        Última modificación de esta página:\n";
    print "        <time datetime=\"2016-11-21\">21 de noviembre de 2016</time></p>\n";
    print "\n";
    print "      <p class=\"licencia\">\n";
    print "        Este programa forma parte del curso <a href=\"http://www.mclibre.org/consultar/php/\">\n";
    print "        Programación web en PHP</a> por <a href=\"http://www.mclibre.org/\">Bartolomé\n";
    print "        Sintes Marco</a>.<br />\n";
    print "        El programa PHP que genera esta página está bajo\n";
    print "        <a rel=\"license\" href=\"http://www.gnu.org/licenses/agpl.txt\">licencia AGPL 3 o posterior</a></p>\n";
    print "    </footer>\n";
    print "  </body>\n";
    print "</html>";
}
