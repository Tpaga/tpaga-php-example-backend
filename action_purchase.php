<?php
require 'http_status_handling.php';

session_start();

function create_charge() {

    $response = null;
    try {

        $response = unsafe_tpaga_api_post(
            "/api/charge/credit_card",
            [
                'taxAmount' => 0,
                'amount' => intval($_POST["amount"]),
                'currency' => "COP",
                'creditCard' => $_POST["creditCard"],
                'installments' => $_POST["installments"],
            ],
            [ 201, 402 ]
        );

    } catch (Exception $e) {
        header("Location: http://" . $_SERVER[HTTP_HOST] . "/form_unknown_conclusion.php");
        return;
    }

    // handle Tpaga API failure/gateway errors (502/504)
    if ($response->getStatusCode() >= 500) {
        header("Location: http://" . $_SERVER[HTTP_HOST] . "/form_unknown_conclusion.php");
        return;
    }

    $json_response = json_decode($response->getBody(), true);

    // handle success
    if ($response->getStatusCode() == 201) {
        $_SESSION["purchase"] = $json_response;

        header("Location: http://" . $_SERVER[HTTP_HOST] . "/form_conclusion.php");
        return;
    }

    /////////////////////////////////////////////////
    // HTTP 402 from here onwards - payment failed //
    /////////////////////////////////////////////////

    // handle unknown payment status reported by CC network/Tpaga

    if (in_array($json_response["errorCode"], ["9999", ""])) {
        header("Location: http://" . $_SERVER[HTTP_HOST] . "/form_unknown_conclusion.php");
        return;
    }

    // payment failed because of bank/credit card reasons
    $_SESSION["purchase_failure_message"] = "Tarjeta no aprobada";

    // naughty, naughty person
    if (in_array($json_response["errorCode"], ["41", "43"])) {
        $_SESSION["purchase_failure_message"] = "Por favor devuelve la tarjeta a su legítimo dueño";
    }

    // no funds, charge too large, expired card
    if (in_array($json_response["errorCode"], ["51", "54", "61"])) {
        $_SESSION["purchase_failure_message"] = $json_response["errorMessage"];
    }

    header("Location: http://" . $_SERVER[HTTP_HOST] . "/form_paymentfailed_conclusion.php");
    return;
}

create_charge();
