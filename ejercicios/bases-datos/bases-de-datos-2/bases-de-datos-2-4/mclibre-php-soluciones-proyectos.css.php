<?php
require_once "biblioteca.php";
header("Content-type: text/css");
?>
@charset "utf-8";

/* Curso "Páginas web con PHP"
   Bartolomé Sintes Marco
   http://www.mclibre.org

   CSS ejercicios proyectos
   12 de diciembre de 2016
*/

/* Esta parte de la hoja de estilo es común a todos los ejercicios */

html, body {
  margin: 0;
  padding: 0;
  background-color: hsl(<?= COLOR ?>, 80%, 95%);
  color: black;
  font-family: sans-serif;
}

h1 {
  margin: 0;
  padding: 5px 20px;
  background-color: hsl(<?= COLOR ?>, 80%, 60%);
  color: white;
  text-transform: uppercase;
}

nav {
  background-color: hsl(<?= COLOR ?>, 80%, 75%);
  color: white;
  margin: 0;
}

nav ul {
  list-style-type: none;
  margin: 0;
  padding: 5px;
}

nav li {
  display: inline;
  padding: 0 15px;
}

nav a {
  background-color: hsl(<?= COLOR ?>, 80%, 75%);
  color: white;
  font-weight: bold;
}

main {
  display: block; /* lo necesita IE9 IE10 IE11 */
  padding: 10px 20px;
}

input {
  font-family: monospace;
}

.aviso {
  color: red;
}

.centrado {
  text-align: center;
}

a img {
  border: none;
}

table.conborde, table.conborde td, table.conborde th {
  border: black 1px solid;
}

thead tr, table.franjas tbody tr:nth-child(even) {
  background-color: hsl(<?= COLOR ?>, 80%, 85%);
  color: black;
}

td, th {
  padding-left: 5px;
  padding-right: 5px;
}

footer {
  clear: both;
  border-top: black solid 1px;
  margin: 30px 20px 0;
}

footer cite {
  font-weight: bold;
}

/* Esta parte de la hoja de estilo es específica de este ejercicio */
