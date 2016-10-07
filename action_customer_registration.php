<?php
require 'http_status_handling.php';

session_start();

function create_tpaga_customer() {
    $customer_data = [
        'firstName' => ($_POST["firstName"]),
        'lastName'  => ($_POST["lastName"]),
        'gender'    => ($_POST["gender"]),
        'email'     => ($_POST["email"]),
        'phone'     => ($_POST["phone"]),
    ];

    $json_response = tpaga_api_post(
        '/api/customer',
        $customer_data,
        [ 201 ]
    );

    $_SESSION["tpaga_customer_token"] = $json_response["id"];
}

create_tpaga_customer();
header("Location: http://" . $_SERVER[HTTP_HOST] . "/form_cc_data.php");
