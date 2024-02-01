<?php
/**
 * @author    Bartolomé Sintes Marco - bartolome.sintes+mclibre@gmail.com
 * @license   https://www.gnu.org/licenses/agpl-3.0.txt AGPL 3 or later
 * @link      https://www.mclibre.org
 */

require_once "biblioteca.php";

$pdo = conectaDb();

cabecera("Buscar 2", MENU_VOLVER);

$nombre    = recoge("nombre");
$apellidos = recoge("apellidos");
$telefono  = recoge("telefono");
$correo    = recoge("correo");

// Comprobamos los datos recibidos procedentes de un formulario
$nombreOk    = false;
$apellidosOk = false;
$telefonoOk  = false;
$correoOk    = false;

if (mb_strlen($nombre, "UTF-8") > $cfg["formPersonasMaxNombre"]) {
    print "    <p class=\"aviso\">El nombre no puede tener más de $cfg[formPersonasMaxNombre] caracteres.</p>\n";
    print "\n";
} else {
    $nombreOk = true;
}

if (mb_strlen($apellidos, "UTF-8") > $cfg["formPersonasMaxApellidos"]) {
    print "    <p class=\"aviso\">Los apellidos no pueden tener más de $cfg[formPersonasMaxApellidos] caracteres.</p>\n";
    print "\n";
} else {
    $apellidosOk = true;
}

if (mb_strlen($telefono, "UTF-8") > $cfg["formPersonasMaxTelefono"]) {
    print "    <p class=\"aviso\">El teléfono no puede tener más de $cfg[formPersonasMaxTelefono] caracteres.</p>\n";
    print "\n";
} else {
    $telefonoOk = true;
}

if (mb_strlen($correo, "UTF-8") > $cfg["formPersonasMaxCorreo"]) {
    print "    <p class=\"aviso\">El correo no puede tener más de $cfg[formPersonasMaxCorreo] caracteres.</p>\n";
    print "\n";
} else {
    $correoOk = true;
}

// Si todas las comprobaciones han tenido éxito ...
if ($nombreOk && $apellidosOk && $telefonoOk && $correoOk) {
    $consulta = "SELECT * FROM $cfg[tablaPersonas]
                 WHERE nombre LIKE :nombre
                 AND apellidos LIKE :apellidos
                 AND telefono LIKE :telefono
                 AND correo LIKE :correo";

    $resultado = $pdo->prepare($consulta);
    if (!$resultado) {
        print "    <p class=\"aviso\">Error al preparar la consulta. SQLSTATE[{$pdo->errorCode()}]: {$pdo->errorInfo()[2]}</p>\n";
    } elseif (!$resultado->execute([":nombre" => "%$nombre%", ":apellidos" => "%$apellidos%", ":telefono" => "%$telefono%", ":correo" => "%$correo%"])) {
        print "    <p class=\"aviso\">Error al ejecutar la consulta. SQLSTATE[{$pdo->errorCode()}]: {$pdo->errorInfo()[2]}</p>\n";
    } else {
        print "    <p>Registros encontrados:</p>\n";
        print "\n";
        print "    <table class=\"conborde franjas\">\n";
        print "      <thead>\n";
        print "        <tr>\n";
        print "          <th>Nombre</th>\n";
        print "          <th>Apellidos</th>\n";
        print "          <th>Teléfono</th>\n";
        print "          <th>Correo</th>\n";
        print "        </tr>\n";
        print "      </thead>\n";
        foreach ($resultado as $registro) {
            print "      <tr>\n";
            print "        <td>$registro[nombre]</td>\n";
            print "        <td>$registro[apellidos]</td>\n";
            print "        <td>$registro[telefono]</td>\n";
            print "        <td>$registro[correo]</td>\n";
            print "      </tr>\n";
        }
        print "    </table>\n";
    }
}
pie();
