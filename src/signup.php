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

//RAMA 1: VALIDAR EMAIL
$check_email = "SELECT 1 FROM users WHERE email = $1";
$res_email = pg_query_params($local_conn, $check_email, array($e_mail));

if (pg_num_rows($res_email) > 0) {
    echo "El correo ya está registrado.";
    exit();
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