<?php
/**
 * @author    Bartolomé Sintes Marco - bartolome.sintes+mclibre@gmail.com
 * @license   https://www.gnu.org/licenses/agpl-3.0.txt AGPL 3 or later
 * @link      https://www.mclibre.org
 */

require_once "../../comunes/biblioteca.php";

session_name($cfg["sessionName"]);
session_start();

if (!isset($_SESSION["conectado"]) || $_SESSION["nivel"] < NIVEL_USUARIO_BASICO) {
    header("Location:../../index.php");
    exit;
}

$pdo = conectaDb();

cabecera("Personas - Añadir 2", MENU_PERSONAS, PROFUNDIDAD_2);

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

// Comprobamos que no se intenta crear un registro vacío
$registroNoVacioOk = false;

if ($nombreOk && $apellidosOk && $telefonoOk && $correoOk) {
    if ($nombre == "" && $apellidos == "" && $telefono == "" && $correo == "") {
        print "    <p class=\"aviso\">Hay que rellenar al menos uno de los campos. No se ha guardado el registro.</p>\n";
        print "\n";
    } else {
        $registroNoVacioOk = true;
    }
}

// Comprobamos que no se intenta crear un registro idéntico a uno que ya existe
$registroDistintoOk = false;

if ($nombreOk && $apellidosOk && $telefonoOk && $correoOk && $registroNoVacioOk) {
    $consulta = "SELECT COUNT(*) FROM $cfg[tablaPersonas]
                 WHERE nombre = :nombre
                 AND apellidos = :apellidos
                 AND telefono = :telefono
                 AND correo = :correo";

    $resultado = $pdo->prepare($consulta);
    if (!$resultado) {
        print "    <p class=\"aviso\">Error al preparar la consulta. SQLSTATE[{$pdo->errorCode()}]: {$pdo->errorInfo()[2]}</p>\n";
    } elseif (!$resultado->execute([":nombre" => $nombre, ":apellidos" => $apellidos, ":telefono" => $telefono, ":correo" => $correo])) {
        print "    <p class=\"aviso\">Error al ejecutar la consulta. SQLSTATE[{$pdo->errorCode()}]: {$pdo->errorInfo()[2]}</p>\n";
    } elseif ($resultado->fetchColumn() > 0) {
        print "    <p class=\"aviso\">El registro ya existe.</p>\n";
    } else {
        $registroDistintoOk = true;
    }
}

// Comprobamos si se ha alcanzado el número máximo de registros en la tabla
$limiteRegistrosOk = false;

if ($nombreOk && $apellidosOk && $telefonoOk && $correoOk && $registroNoVacioOk && $registroDistintoOk) {
    $consulta = "SELECT COUNT(*) FROM $cfg[tablaPersonas]";

    $resultado = $pdo->query($consulta);
    if (!$resultado) {
        print "    <p class=\"aviso\">Error en la consulta. SQLSTATE[{$pdo->errorCode()}]: {$pdo->errorInfo()[2]}</p>\n";
    } elseif ($resultado->fetchColumn() >= $cfg["tablaPersonasMaxReg"] && $cfg["tablaPersonasMaxReg"] > 0) {
        print "    <p class=\"aviso\">Se ha alcanzado el número máximo de registros que se pueden guardar.</p>\n";
        print "\n";
        print "    <p class=\"aviso\">Por favor, borre algún registro antes de insertar un nuevo registro.</p>\n";
    } else {
        $limiteRegistrosOk = true;
    }
}

$registrosSimilaresOk = false;

if ($nombreOk && $apellidosOk && $telefonoOk && $correoOk && $registroNoVacioOk && $registroDistintoOk && $limiteRegistrosOk) {
    $consulta = "SELECT COUNT(*) FROM $cfg[tablaPersonas]
                 WHERE (nombre = :nombre
                 AND apellidos = :apellidos)
                 OR telefono = :telefono
                 OR correo = :correo";

    $resultado = $pdo->prepare($consulta);
    if (!$resultado) {
        print "    <p class=\"aviso\">Error al preparar la consulta. SQLSTATE[{$pdo->errorCode()}]: {$pdo->errorInfo()[2]}</p>\n";
    } elseif (!$resultado->execute([":nombre" => $nombre, ":apellidos" => $apellidos, ":telefono" => $telefono, ":correo" => $correo])) {
        print "    <p class=\"aviso\">Error al ejecutar la consulta. SQLSTATE[{$pdo->errorCode()}]: {$pdo->errorInfo()[2]}</p>\n";
    } elseif ($resultado->fetchColumn() > 0) {
        print "    <p class=\"aviso\">Existe un registro con datos similares.</p>\n";
        print "\n";
        print "    <form action=\"insertar-3.php\" method=\"$cfg[formMethod]\">\n";
        print "      <p>Por favor, confirme que desea insertar el registro.</p>\n";
        print "\n";
        print "      <p>\n";
        print "        <input type=\"hidden\" name=\"nombre\" value=\"$nombre\">\n";
        print "        <input type=\"hidden\" name=\"apellidos\" value=\"$apellidos\">\n";
        print "        <input type=\"hidden\" name=\"telefono\" value=\"$telefono\">\n";
        print "        <input type=\"hidden\" name=\"correo\" value=\"$correo\">\n";
        print "        <input type=\"submit\" name=\"insertar\" value=\"Sí\">\n";
        print "        <input type=\"submit\" name=\"insertar\" value=\"No\">\n";
        print "      </p>\n";
        print "    </form>\n";
    } else {
        $registrosSimilaresOk = true;
    }
}

// Si todas las comprobaciones han tenido éxito ...
if ($nombreOk && $apellidosOk && $telefonoOk && $correoOk && $registroNoVacioOk && $registroDistintoOk && $limiteRegistrosOk && $registrosSimilaresOk) {
    // Insertamos el registro en la tabla
    $consulta = "INSERT INTO $cfg[tablaPersonas]
                 (nombre, apellidos, telefono, correo)
                 VALUES (:nombre, :apellidos, :telefono, :correo)";

    $resultado = $pdo->prepare($consulta);
    if (!$resultado) {
        print "    <p class=\"aviso\">Error al preparar la consulta. SQLSTATE[{$pdo->errorCode()}]: {$pdo->errorInfo()[2]}</p>\n";
    } elseif (!$resultado->execute([":nombre" => $nombre, ":apellidos" => $apellidos, ":telefono" => $telefono, ":correo" => $correo])) {
        print "    <p class=\"aviso\">Error al ejecutar la consulta. SQLSTATE[{$pdo->errorCode()}]: {$pdo->errorInfo()[2]}</p>\n";
    } else {
        print "    <p>Registro creado correctamente.</p>\n";
    }
}

pie();
