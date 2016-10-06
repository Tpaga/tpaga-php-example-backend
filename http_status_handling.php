<?php
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
