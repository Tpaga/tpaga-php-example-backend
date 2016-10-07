<?php
require 'http_status_handling.php';

session_start();

function create_charge() {

    $json_response = tpaga_api_post(
        "/api/charge/credit_card",
        [
            'taxAmount' => 0,
            'amount' => intval($_POST["amount"]),
            'currency' => "COP",
            'creditCard' => $_POST["creditCard"],
        ],
        [ 201, 402 ]
    );

    $_SESSION["purchase"] = $json_response;
    error_log(print_r($json_response, true));
}

create_charge();

header("Location: http://" . $_SERVER[HTTP_HOST] . "/form_conclusion.php");
