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
<br>
<br>
<br>
<pre style='color:#000000;background:#ffffff;'>
<span style='color:#800000; font-weight:bold; '>function</span> form_submit<span style='color:#808030; '>(</span>evt<span style='color:#808030; '>)</span> <span style='color:#800080; '>{</span>
    <span style='color:#800000; font-weight:bold; '>var</span> public_token <span style='color:#808030; '>=</span> <span style='color:#800000; '>"</span><span style='color:#0000e6; '>pk_test_qvbvuthlvqpijnr0elmtg5jh</span><span style='color:#800000; '>"</span><span style='color:#800080; '>;</span>

    $<span style='color:#808030; '>.</span>ajax<span style='color:#808030; '>(</span><span style='color:#800000; '>'</span><span style='color:#0000e6; '>https://sandbox.tpaga.co/api/tokenize/credit_card</span><span style='color:#800000; '>'</span><span style='color:#808030; '>,</span> <span style='color:#800080; '>{</span>
        method<span style='color:#800080; '>:</span> <span style='color:#800000; '>'</span><span style='color:#0000e6; '>POST</span><span style='color:#800000; '>'</span><span style='color:#808030; '>,</span>
        beforeSend<span style='color:#800080; '>:</span> <span style='color:#800000; font-weight:bold; '>function</span> <span style='color:#808030; '>(</span>xhr<span style='color:#808030; '>)</span> <span style='color:#800080; '>{</span>
            xhr<span style='color:#808030; '>.</span>setRequestHeader<span style='color:#808030; '>(</span><span style='color:#800000; '>"</span><span style='color:#0000e6; '>Authorization</span><span style='color:#800000; '>"</span><span style='color:#808030; '>,</span> <span style='color:#800000; '>"</span><span style='color:#0000e6; '>Basic </span><span style='color:#800000; '>"</span> <span style='color:#808030; '>+</span> btoa<span style='color:#808030; '>(</span><span style='color:#800000; '>"</span><span style='color:#0000e6; '>pk_test_qvbvuthlvqpijnr0elmtg5jh</span><span style='color:#800000; '>"</span> <span style='color:#808030; '>+</span> <span style='color:#800000; '>"</span><span style='color:#0000e6; '>:</span><span style='color:#800000; '>"</span><span style='color:#808030; '>)</span><span style='color:#808030; '>)</span><span style='color:#800080; '>;</span>
        <span style='color:#800080; '>}</span><span style='color:#808030; '>,</span>
        username<span style='color:#800080; '>:</span> public_token<span style='color:#808030; '>,</span>
        password<span style='color:#800080; '>:</span> <span style='color:#800000; '>'</span><span style='color:#800000; '>'</span><span style='color:#808030; '>,</span>

        data<span style='color:#800080; '>:</span> JSON<span style='color:#808030; '>.</span>stringify<span style='color:#808030; '>(</span>$<span style='color:#808030; '>(</span><span style='color:#800000; '>"</span><span style='color:#0000e6; '>form#cc_data</span><span style='color:#800000; '>"</span><span style='color:#808030; '>)</span><span style='color:#808030; '>.</span>serializeObject<span style='color:#808030; '>(</span><span style='color:#808030; '>)</span><span style='color:#808030; '>)</span><span style='color:#808030; '>,</span>
        contentType<span style='color:#800080; '>:</span> <span style='color:#800000; '>'</span><span style='color:#0000e6; '>application/json</span><span style='color:#800000; '>'</span><span style='color:#808030; '>,</span>
        dataType<span style='color:#800080; '>:</span> <span style='color:#800000; '>'</span><span style='color:#0000e6; '>json</span><span style='color:#800000; '>'</span><span style='color:#808030; '>,</span>

        success<span style='color:#800080; '>:</span> notify_backend_tempcctoken<span style='color:#808030; '>,</span>
        error<span style='color:#800080; '>:</span> handle_request_error<span style='color:#808030; '>,</span>
    <span style='color:#800080; '>}</span><span style='color:#808030; '>)</span><span style='color:#800080; '>;</span>

    <span style='color:#800000; font-weight:bold; '>return</span> <span style='color:#0f4d75; '>false</span><span style='color:#800080; '>;</span>
<span style='color:#800080; '>}</span>

<span style='color:#800000; font-weight:bold; '>function</span> notify_backend_tempcctoken<span style='color:#808030; '>(</span>jd<span style='color:#808030; '>,</span> text_status<span style='color:#808030; '>,</span> request<span style='color:#808030; '>)</span> <span style='color:#800080; '>{</span>
    $<span style='color:#808030; '>(</span><span style='color:#800000; '>'</span><span style='color:#0000e6; '>[name="tmpCcToken"]</span><span style='color:#800000; '>'</span><span style='color:#808030; '>)</span><span style='color:#808030; '>.</span>val<span style='color:#808030; '>(</span>jd<span style='color:#808030; '>.</span>token<span style='color:#808030; '>)</span><span style='color:#800080; '>;</span>
    $<span style='color:#808030; '>(</span><span style='color:#800000; '>'</span><span style='color:#0000e6; '>form#assoc_customer_cc</span><span style='color:#800000; '>'</span><span style='color:#808030; '>)</span><span style='color:#808030; '>.</span>submit<span style='color:#808030; '>(</span><span style='color:#808030; '>)</span><span style='color:#800080; '>;</span>
<span style='color:#800080; '>}</span>

</pre>

<pre style='color:#000000;background:#ffffe8;'><span style='color:#5f5035; background:#ffffe8; '>&lt;?php</span><span style='color:#000000; background:#ffffe8; '></span>
<span style='color:#800000; background:#ffffe8; font-weight:bold; '>require</span><span style='color:#000000; background:#ffffe8; '> </span><span style='color:#0000e6; background:#ffffe8; '>'http_status_handling.php'</span><span style='color:#800080; background:#ffffe8; '>;</span><span style='color:#000000; background:#ffffe8; '></span>
<span style='color:#000000; background:#ffffe8; '></span>
<span style='color:#400000; background:#ffffe8; '>session_start</span><span style='color:#808030; background:#ffffe8; '>(</span><span style='color:#808030; background:#ffffe8; '>)</span><span style='color:#800080; background:#ffffe8; '>;</span><span style='color:#000000; background:#ffffe8; '></span>
<span style='color:#000000; background:#ffffe8; '></span>
<span style='color:#800000; background:#ffffe8; font-weight:bold; '>function</span><span style='color:#000000; background:#ffffe8; '> assoc_cc_customer</span><span style='color:#808030; background:#ffffe8; '>(</span><span style='color:#808030; background:#ffffe8; '>)</span><span style='color:#000000; background:#ffffe8; '> </span><span style='color:#800080; background:#ffffe8; '>{</span><span style='color:#000000; background:#ffffe8; '></span>
<span style='color:#000000; background:#ffffe8; '></span>
<span style='color:#000000; background:#ffffe8; '>&#xa0;&#xa0;&#xa0;&#xa0;</span><span style='color:#797997; background:#ffffe8; '>$json_response</span><span style='color:#000000; background:#ffffe8; '> </span><span style='color:#808030; background:#ffffe8; '>=</span><span style='color:#000000; background:#ffffe8; '> tpaga_api_post</span><span style='color:#808030; background:#ffffe8; '>(</span><span style='color:#000000; background:#ffffe8; '></span>
<span style='color:#000000; background:#ffffe8; '>&#xa0;&#xa0;&#xa0;&#xa0;&#xa0;&#xa0;&#xa0;&#xa0;</span><span style='color:#0000e6; background:#ffffe8; '>"</span><span style='color:#800000; background:#ffffe8; '>/</span><span style='color:#0000e6; background:#ffffe8; '>api/customer</span><span style='color:#800000; background:#ffffe8; '>/</span><span style='color:#0000e6; background:#ffffe8; '>"</span><span style='color:#000000; background:#ffffe8; '> </span><span style='color:#808030; background:#ffffe8; '>.</span><span style='color:#000000; background:#ffffe8; '> </span><span style='color:#797997; background:#ffffe8; '>$_SESSION</span><span style='color:#808030; background:#ffffe8; '>[</span><span style='color:#0000e6; background:#ffffe8; '>"tpaga_customer_token"</span><span style='color:#808030; background:#ffffe8; '>]</span><span style='color:#000000; background:#ffffe8; '> </span><span style='color:#808030; background:#ffffe8; '>.</span><span style='color:#000000; background:#ffffe8; '> </span><span style='color:#0000e6; background:#ffffe8; '>"/credit_card_token"</span><span style='color:#808030; background:#ffffe8; '>,</span><span style='color:#000000; background:#ffffe8; '></span>
<span style='color:#000000; background:#ffffe8; '>&#xa0;&#xa0;&#xa0;&#xa0;&#xa0;&#xa0;&#xa0;&#xa0;</span><span style='color:#808030; background:#ffffe8; '>[</span><span style='color:#000000; background:#ffffe8; '> </span><span style='color:#0000e6; background:#ffffe8; '>'token'</span><span style='color:#000000; background:#ffffe8; '> </span><span style='color:#808030; background:#ffffe8; '>=</span><span style='color:#808030; background:#ffffe8; '>></span><span style='color:#000000; background:#ffffe8; '> </span><span style='color:#808030; background:#ffffe8; '>(</span><span style='color:#797997; background:#ffffe8; '>$_POST</span><span style='color:#808030; background:#ffffe8; '>[</span><span style='color:#0000e6; background:#ffffe8; '>"tmpCcToken"</span><span style='color:#808030; background:#ffffe8; '>]</span><span style='color:#808030; background:#ffffe8; '>)</span><span style='color:#808030; background:#ffffe8; '>,</span><span style='color:#000000; background:#ffffe8; '> </span><span style='color:#808030; background:#ffffe8; '>]</span><span style='color:#808030; background:#ffffe8; '>,</span><span style='color:#000000; background:#ffffe8; '></span>
<span style='color:#000000; background:#ffffe8; '>&#xa0;&#xa0;&#xa0;&#xa0;&#xa0;&#xa0;&#xa0;&#xa0;</span><span style='color:#808030; background:#ffffe8; '>[</span><span style='color:#000000; background:#ffffe8; '> </span><span style='color:#008c00; background:#ffffe8; '>201</span><span style='color:#000000; background:#ffffe8; '> </span><span style='color:#808030; background:#ffffe8; '>]</span><span style='color:#000000; background:#ffffe8; '></span>
<span style='color:#000000; background:#ffffe8; '>&#xa0;&#xa0;&#xa0;&#xa0;</span><span style='color:#808030; background:#ffffe8; '>)</span><span style='color:#800080; background:#ffffe8; '>;</span><span style='color:#000000; background:#ffffe8; '></span>
<span style='color:#000000; background:#ffffe8; '></span>
<span style='color:#000000; background:#ffffe8; '>&#xa0;&#xa0;&#xa0;&#xa0;</span><span style='color:#797997; background:#ffffe8; '>$_SESSION</span><span style='color:#808030; background:#ffffe8; '>[</span><span style='color:#0000e6; background:#ffffe8; '>"tpaga_customer_token"</span><span style='color:#808030; background:#ffffe8; '>]</span><span style='color:#000000; background:#ffffe8; '> </span><span style='color:#808030; background:#ffffe8; '>=</span><span style='color:#000000; background:#ffffe8; '> </span><span style='color:#800000; background:#ffffe8; font-weight:bold; '>null</span><span style='color:#800080; background:#ffffe8; '>;</span><span style='color:#000000; background:#ffffe8; '></span>
<span style='color:#000000; background:#ffffe8; '></span>
<span style='color:#000000; background:#ffffe8; '>&#xa0;&#xa0;&#xa0;&#xa0;</span><span style='color:#797997; background:#ffffe8; '>$_SESSION</span><span style='color:#808030; background:#ffffe8; '>[</span><span style='color:#0000e6; background:#ffffe8; '>"user_cc"</span><span style='color:#808030; background:#ffffe8; '>]</span><span style='color:#000000; background:#ffffe8; '> </span><span style='color:#808030; background:#ffffe8; '>=</span><span style='color:#000000; background:#ffffe8; '> </span><span style='color:#797997; background:#ffffe8; '>$json_response</span><span style='color:#800080; background:#ffffe8; '>;</span><span style='color:#000000; background:#ffffe8; '></span>
<span style='color:#800080; background:#ffffe8; '>}</span><span style='color:#000000; background:#ffffe8; '></span>
<span style='color:#000000; background:#ffffe8; '></span>
<span style='color:#000000; background:#ffffe8; '>assoc_cc_customer</span><span style='color:#808030; background:#ffffe8; '>(</span><span style='color:#808030; background:#ffffe8; '>)</span><span style='color:#800080; background:#ffffe8; '>;</span><span style='color:#000000; background:#ffffe8; '></span>
<span style='color:#400000; background:#ffffe8; '>header</span><span style='color:#808030; background:#ffffe8; '>(</span><span style='color:#0000e6; background:#ffffe8; '>"Location: http://"</span><span style='color:#000000; background:#ffffe8; '> </span><span style='color:#808030; background:#ffffe8; '>.</span><span style='color:#000000; background:#ffffe8; '> </span><span style='color:#797997; background:#ffffe8; '>$_SERVER</span><span style='color:#808030; background:#ffffe8; '>[</span><span style='color:#000000; background:#ffffe8; '>HTTP_HOST</span><span style='color:#808030; background:#ffffe8; '>]</span><span style='color:#000000; background:#ffffe8; '> </span><span style='color:#808030; background:#ffffe8; '>.</span><span style='color:#000000; background:#ffffe8; '> </span><span style='color:#0000e6; background:#ffffe8; '>"/form_charge.php"</span><span style='color:#808030; background:#ffffe8; '>)</span><span style='color:#800080; background:#ffffe8; '>;</span><span style='color:#000000; background:#ffffe8; '></span>
</pre>
</html>
