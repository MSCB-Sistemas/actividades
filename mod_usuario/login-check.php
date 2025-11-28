<?php
// login_helper_mysql.php
// Control de intentos de login con mysql_* (antiguo).


error_reporting(E_ALL & ~E_DEPRECATED & ~E_NOTICE);
ini_set('display_errors', 0);



function loginCheck($username, $passwordInput, $passwordDb) {

     $conn = mysql_connect("localhost", "root", "");
    mysql_select_db("actividades", $conn);



    $userEsc = mysql_real_escape_string($username);

    // Buscar registro de intentos
    $q = "SELECT intentos, ultimo_intento, bloqueado_hasta 
          FROM login_attempts 
          WHERE usuario = '$userEsc' 
          LIMIT 1";
    $res = mysql_query($q);

    if ($res && mysql_num_rows($res) > 0) {
        $row = mysql_fetch_assoc($res);
    }else{
        $row = false;
    }

    // 1) Revisar si está bloqueado
    if ($row && !empty($row['bloqueado_hasta'])) {
        $blocked_ts = strtotime($row['bloqueado_hasta']);
        if ($blocked_ts > time()) {
            return $blocked_ts - time(); // segundos restantes
        } else {
            // Si expiró el bloqueo, limpiar
            mysql_query("UPDATE login_attempts 
                         SET bloqueado_hasta = NULL 
                         WHERE usuario = '$userEsc'");
            $row['bloqueado_hasta'] = null;
        }
    }

    // Si no tiene bloqueado_hasta, revisar reglas de tiempo
    if ($row && empty($row['bloqueado_hasta'])) {
        $attempts = intval($row['intentos']);
        $lastAttempt = $row['ultimo_intento'];
        $waitTime = 0;
        if ($attempts > 5) $waitTime = 120;
        elseif ($attempts > 2) $waitTime = 30;

        if ($waitTime > 0 && !empty($lastAttempt)) {
            $elapsed = time() - strtotime($lastAttempt);
            $remaining = $waitTime - $elapsed;
            if ($remaining > 0) {
                return $remaining;
            }
        }
    }

    // 2) Validar credenciales (tu DB guarda md5)
    $isValid = false;
    if ($passwordDb !== null && $passwordInput === $passwordDb) {
        $isValid = true;
    }

    if ($isValid) {
        // Login correcto: resetear intentos
        mysql_query("DELETE FROM login_attempts WHERE usuario = '$userEsc'");
        return true;
    }

    // 3) Fallo de login: registrar intento
    if ($row) {
        $newAttempts = intval($row['intentos']) + 1;
        mysql_query("UPDATE login_attempts 
                     SET intentos = $newAttempts, ultimo_intento = NOW() 
                     WHERE usuario = '$userEsc'");
    } else {
        $newAttempts = 1;
        mysql_query("INSERT INTO login_attempts (usuario, intentos, ultimo_intento) 
                     VALUES ('$userEsc', 1, NOW())");
        var_dump(mysql_error());
    }

    // 4) Evaluar si corresponde bloquear
    if ($newAttempts > 10) {
        $blockSec = 120;
        mysql_query("UPDATE login_attempts 
                     SET bloqueado_hasta = DATE_ADD(NOW(), INTERVAL $blockSec SECOND) 
                     WHERE usuario = '$userEsc'");
        return $blockSec;
    } elseif ($newAttempts > 7) {
        $blockSec = 30;
        mysql_query("UPDATE login_attempts 
                     SET bloqueado_hasta = DATE_ADD(NOW(), INTERVAL $blockSec SECOND) 
                     WHERE usuario = '$userEsc'");
        return $blockSec;
    }
    mysql_close($conn);
    return false; // fallo normal
}
?>
