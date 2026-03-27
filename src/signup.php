<?php
    //1. recibe metodo de envio por post
    include('../config/database.php');

    //2. Get data
    $f_name  = $_POST ['fname'];
    $l_name  = $_POST ['lname'];
    $e_mail  = $_POST ['email'];
    $m_phone = $_POST ['mphone'];
    $p_sswd  = $_POST ['psswd'];
    $enc_pass = md5($p_sswd);

    //RAMA 1
//email 
$check_email = "SELECT email FROM users_model WHERE email = '$e_mail'";
$res_email = pg_query($local_conn, $check_email);

if (pg_num_rows($res_email) > 0) {
    echo "Error: El correo electrónico '$e_mail' ya está registrado. Por favor, use uno diferente.\n";
    exit();
}

//RAMA 2
//telefono 
$check_phone = "SELECT mobile_phone FROM users_model WHERE mobile_phone = '$m_phone'";
$res_phone = pg_query($local_conn, $check_phone);

if (pg_num_rows($res_phone) > 0) {
    echo "Error: El número de celular '$m_phone' ya está registrado en nuestro sistema."; 
    exit();
}

//RAMA 3
if ($res_local) {
    $res_supa = pg_query($supa_conn, $sql);

    if ($res_supa) {
        echo "¡Listo! Guardado en ambos lados.";
    } else {
        echo "Error: Se guardó en local pero no en la nube.";
    }
} else {
    echo "Error: No se pudo guardar ni en local.";
}



    //Query to insert into SQL
    $sql = "INSERT INTO users (firstname, lastname, email, mobile_phone, psswd)
               
               values('$f_name', '$l_name', '$e_mail','$m_phone','$enc_pass')";  //values('Pablo', 'Tomson', 'tom@mail.com','300777000','123')";
               

               
    //Execute query
    $result = pg_query($local_conn, $sql);

    
    if (!$result) {
        echo "Error al registrar: " . pg_last_error($local_conn);
    } else {
        echo "Usuario registrado exitosamente.";
        // Opcional: redirigir al login
        // header('Location: signin.html');
    }




$res_local = pg_query($local_conn, $sql); 

    //Para comprobar se usa postman

    /*
    ###Endpoint
    http://127.0.0.1:8080/app-beta/src/signup.php → se inserta en la barra (aparece a plena vista) 
    //                                                        de insert de postman y se despliega GET y
    //                                                        selecciona POST
    */
?>