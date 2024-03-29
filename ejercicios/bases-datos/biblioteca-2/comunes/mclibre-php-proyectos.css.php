<?php
require_once "biblioteca.php";
header("Content-type: text/css");
?>
/* PROGRAMACION WEB EN PHP                  */
/* Bartolome Sintes Marco                   */
/* https://www.mclibre.org                  */
/*                                          */
/* CSS ejercicios proyectos                 */
/*                                          */
/* 27 de septiembre de 2022                 */
/*                                          */

/* Esta parte es comun a todos los ejercicios proyectos */

html,
body {
    margin: 0;
    padding: 0;
    background-color: hwb(<?= COLOR ?>, 90%, 5%);
    color: black;
    font-family: sans-serif;
}

h1 {
    margin: 0;
    padding: 5px 20px;
    background-color: hwb(<?= COLOR ?>, 30%, 5%);
    color: white;
    text-transform: uppercase;
}

nav {
    margin: 0;
    background-color: hwb(<?= COLOR ?>, 50%, 5%);
    color: white;
}

nav ul {
    margin: 0;
    padding: 5px;
    list-style-type: none;
}

nav li {
    display: inline;
    padding: 0 15px;
}

nav a {
    background-color: hwb(<?= COLOR ?>, 50%, 5%);
    color: white;
    font-weight: bold;
}

main {
    padding: 10px 20px;
}

input {
    font-family: monospace;
}

.boton-invisible {
    padding: 0;
    border: none;
    background-color: transparent;
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

table.conborde,
table.conborde td,
table.conborde th {
    border: black 1px solid;
}

thead tr,
table.franjas tbody tr:nth-child(even) {
    background-color: hwb(<?= COLOR ?>, 70%, 5%);
    color: black;
}

td,
th {
    padding-right: 5px;
    padding-left: 5px;
}

footer {
    clear: both;
    margin: 30px 20px 0;
    border-top: black solid 1px;
}

footer cite {
    font-weight: bold;
}

/* Esta parte es especifica de este proyecto */
