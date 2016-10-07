<?php session_start(); ?>

<html>
    <head>
        <script src="https://code.jquery.com/jquery-3.1.0.min.js"></script>
        <script>
$.fn.serializeObject = function()
{
    var o = {};
    var a = this.serializeArray();
    $.each(a, function() {
        if (o[this.name] !== undefined) {
            if (!o[this.name].push) {
                o[this.name] = [o[this.name]];
            }
            o[this.name].push(this.value || '');
        } else {
            o[this.name] = this.value || '';
        }
    });
    return o;
};

function notify_backend_tempcctoken(jd, text_status, request) {
    console.log(jd);
    $('[name="tmpCcToken"]').val(jd.token);
    $('form#assoc_customer_cc').submit();
}

function handle_request_error(request, text_status, error_thrown) {
    if (request.status == 401) {
        alert("Problema con credenciales de acceso a Tpaga");
        return;
    }
    if (request.status == 422) {
        var jd = JSON.parse(request.responseText);
        alert("Datos erróneos en el campo " + jd.errors[0].field);
        return;
    }
}

function form_submit(evt) {
    var public_token = "pk_test_qvbvuthlvqpijnr0elmtg5jh";

    $.ajax('https://sandbox.tpaga.co/api/tokenize/credit_card', {
        method: 'POST',
        beforeSend: function (xhr) {
            xhr.setRequestHeader("Authorization", "Basic " + btoa("pk_test_qvbvuthlvqpijnr0elmtg5jh" + ":"));
        },
        username: public_token,
        password: '',

        data: JSON.stringify($("form#cc_data").serializeObject()),
        contentType: 'application/json',
        dataType: 'json',

        success: notify_backend_tempcctoken,
        error: handle_request_error,
    });

    return false;
}

$(document).ready(function () {
    $('form#cc_data').on('submit', form_submit);
});

        </script>
    </head>
<body>
    <h1>Paso 2</h1>
    <h2>Datos de tu tarjeta de crédito</h2>
    <form id="cc_data">
        Número de la tarjeta:<br>
        <input type="text" name="primaryAccountNumber" value="4111111111111111"><br>
        Nombre del tarjetahabiente:<br>
        <input type="text" name="cardHolderName" value="Numa Nigerio"><br>
        Fecha de expiración:<br>
        <select name="expirationMonth">
          <option value="01" selected>01</option>
          <option value="02">02</option>
          <option value="03">03</option>
          <option value="04">04</option>
          <option value="05">05</option>
          <option value="06">06</option>
          <option value="07">07</option>
          <option value="08">08</option>
          <option value="09">09</option>
          <option value="10">10</option>
          <option value="11">11</option>
          <option value="12">12</option>
        </select>
        <select name="expirationYear">
          <option value="2016">2016</option>
          <option value="2017" selected>2017</option>
          <option value="2018">2018</option>
          <option value="2019">2019</option>
          <option value="2020">2020</option>
          <option value="2021">2021</option>
          <option value="2022">2022</option>
          <option value="2023">2023</option>
          <option value="2024">2024</option>
          <option value="2025">2025</option>
          <option value="2026">2026</option>
          <option value="2027">2027</option>
          <option value="2028">2028</option>
          <option value="2029">2029</option>
          <option value="2030">2030</option>
        </select><br>
        CVC:<br>
        <input type="password" name="cvc" size="10"><br>
        <br>
        <input type="submit" value="Submit">
    </form>

    <form id="assoc_customer_cc" action="action_assoc_customer_cc.php" method="POST">
        <input type="hidden" name="tmpCcToken">
    </form>
</body>
</html>
