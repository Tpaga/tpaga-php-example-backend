<?php
require 'vendor/autoload.php';

include 'secrets.php';

use GuzzleHttp\Client;


function tpaga_api_post($url, $data, $expected_http_codes) {
    global $TPAGA_API_PRIVATE_TOKEN;

    $client = new Client([
        'base_uri' => 'https://sandbox.tpaga.co',
        'timeout'  => 30,
        'headers'  => [
            'Content-Type' => 'application/json'
        ],
        'http_errors' => false,
    ]);

    $response = null;

    try {
        $response = $client->post(
            $url,
            [
                'auth' => [ $TPAGA_API_PRIVATE_TOKEN, '' ],
                'json' => $data,
            ]
        );
    } catch (Exception $e) {
        error_log("Caught exception: " . $e->getMessage());
        header("Location: http://" . $_SERVER[HTTP_HOST] . "/");
        die();
    }

    if (!in_array($response->getStatusCode(), $expected_http_codes)) {
        $_SESSION["error_msg"] = message_for_failed_request($response);
        # TODO set proper path for redirect
        header("Location: http://" . $_SERVER[HTTP_HOST] . "/");
        die();
    }

    return json_decode($response->getBody(), true);
}

function unsafe_tpaga_api_post($url, $data, $expected_http_codes) {
    global $TPAGA_API_PRIVATE_TOKEN;

    $client = new Client([
        'base_uri' => 'https://sandbox.tpaga.co',
        'timeout'  => 30,
        'headers'  => [
            'Content-Type' => 'application/json'
        ],
        'http_errors' => false,
    ]);

    $response = $client->post(
        $url,
        [
            'auth' => [ $TPAGA_API_PRIVATE_TOKEN, '' ],
            'json' => $data,
        ]
    );

    // any 5XX HTTP status code will also be handled by the caller
    if (
        !in_array($response->getStatusCode(), $expected_http_codes)
        && $response->getStatusCode() < 500
    ) {
        $_SESSION["error_msg"] = message_for_failed_request($response);
        # TODO set proper path for redirect
        header("Location: http://" . $_SERVER[HTTP_HOST] . "/");
        die();
    }

    return $response;
}

function message_for_failed_request($response) {
    $http_status_code = $response->getStatusCode();

    error_log("TPaga API answered: " . $http_status_code);
    if ($http_status_code == 401) {
        return "Ooops, credentials for Tpaga API are wrong";
    }

    if ($http_status_code == 422) {
        $response_data = json_decode($response->getBody(), true);

        error_log(print_r($response_data, true));
        return "Ooops, we sent wrong data to the Tpaga API: invalid data in field: " . $response_data['errors'][0]['field'];
    }

    if ($http_status_code >= 400 && $http_status_code < 500) {
        return "Ooops, we did something wrong with the Tpaga API";
    }

    if ($http_status_code >= 500) {
        return "Ooops, the Tpaga API failed";
    }
    return "What?! unknown error";
}
?>
