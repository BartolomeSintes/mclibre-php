<?php
/**
 * Menús 1 - biblioteca.php
 *
 * @author    Escriba su nombre
 *
 */

function cabecera($texto)
{
    print "<!DOCTYPE html>\n";
    print "<html lang=\"es\">\n";
    print "<head>\n";
    print "  <meta charset=\"utf-8\" />\n";
    print "  <title>Ejercicio incompleto. Menús 1. Menús. \n";
    print "    Escriba su nombre</title>\n";
    print "  <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\" />\n";
    print "  <link href=\"mclibre-php-soluciones-proyectos.css\" rel=\"stylesheet\" type=\"text/css\" />\n";
    print "</head>\n";
    print "\n";
    print "<body>\n";
    print "  <header>\n";
    print "    <p class=\"aviso\">Ejercicio incompleto</p>\n";
    print "\n";
    print "    <nav>\n";
    print "      <ul>\n";
    print "        <li><a href=\"index.php\">Página inicial</a></li>\n";
    print "        <li><a href=\"pagina-2.php\">Segunda página</a></li>\n";
    print "        <li><a href=\"pagina-3.php\">Tercera página</a></li>\n";
    print "      </ul>\n";
    print "    </nav>\n";
    print "  </header>\n";
    print "\n";
    print "  <main>\n";
}

function pie()
{
    print "  </main>\n";
    print "\n";
    print "  <footer>\n";
    print "    <p>Escriba su nombre</p>\n";
    print "  </footer>\n";
    print " </body>\n";
    print "</html>";
}
