<?php
require 'http_status_handling.php';

session_start();

function assoc_cc_customer() {

    $json_response = tpaga_api_post(
        "/api/customer/" . $_SESSION["tpaga_customer_token"] . "/credit_card_token",
        [ 'token' => ($_POST["tmpCcToken"]), ],
        [ 201 ]
    );

    $_SESSION["user_cc"] = $json_response;
}

assoc_cc_customer();
header("Location: http://" . $_SERVER[HTTP_HOST] . "/form_charge.php");
