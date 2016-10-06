<?php
require 'vendor/autoload.php';
require 'http_status_handling.php';

include 'secrets.php';

use GuzzleHttp\Client;

session_start();

function create_tpaga_customer() {
    global $TPAGA_API_PRIVATE_TOKEN;

    $client = new Client([
        'base_uri' => 'https://sandbox.tpaga.co',
        'timeout'  => 5,
        'headers'  => [
            'Content-Type' => 'application/json'
        ],
        'http_errors' => false,
    ]);
    $customer_data = [
        'firstName' => ($_POST["firstName"]),
        'lastName'  => ($_POST["lastName"]),
        'gender'    => ($_POST["gender"]),
        'email'     => ($_POST["email"]),
        'phone'     => ($_POST["phone"]),
    ];

    $response = null;
    try {
        $response = $client->post(
            '/api/customer',
            [
                # HTTP Basic Auth
                'auth' => [ $TPAGA_API_PRIVATE_TOKEN, '' ],
                'json' => $customer_data,
            ]
        );
    } catch (Exception $e) {
        error_log("Caught exception: " . $e->getMessage());
        header("Location: http://" . $_SERVER[HTTP_HOST] . "/");
        die();
    }

    if ($response->getStatusCode() != 201) {
        $_SESSION["error_msg"] = message_for_failed_request($response);
        header("Location: http://" . $_SERVER[HTTP_HOST] . "/");
        die();
    }

    $raw_body = $response->getBody();
    $response_data = json_decode($raw_body);
    error_log(print_r($response_data, true));
}

create_tpaga_customer();
?>


<html>
<body>
    <h1>Step 2</h1>
    <h2>Credit Card Details</h2>
    <form>
    <input type="hidden" name="customerId" value="<?php echo $customer_id;?>">
        First name:<br>
        <input type="text" name="firstName" value="Numa"><br>
        Last name:<br>
        <input type="text" name="lastName" value="Nigerio"><br>
        Gender:<br>
        <select name="gender">
          <option value="M">M</option>
          <option value="F">F</option>
          <option value="N/A">N/A</option>
        </select><br>
        Email:<br>
        <input type="email" name="email" value="pericodelospalotes@nowhere.org"><br>
        Phone:<br>
        <input type="text" name="phone" value="304567891"><br>
<br>
        <input type="submit" value="Submit">
    </form>
</body>
</html>
