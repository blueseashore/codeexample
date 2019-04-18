<?php
/**
 * User: kendo    Date: 2018/2/27
 */
try {

    $ssl_option = [
        "ssl" => [
            "verify_peer" => false,
            "verify_peer_name" => false,
            'crypto_method' => STREAM_CRYPTO_METHOD_TLS_CLIENT
        ]
    ];
    $options = [
        'location' => 'https://cicms.com/test.php',
        'uri' => 'abc',
        'soap_version' => SOAP_1_2,
        'exceptions' => true,
        'trace' => 1,
        'cache_wsdl' => WSDL_CACHE_NONE,
        'stream_context' => stream_context_create($ssl_option)
    ];
    $soap = new SoapClient(null, $options);
    echo $soap->say() . "<br>";//调用方法一
    echo $soap->__soapcall("tell", ['a' => 111]);//调用方法二
} catch (SoapFault $e) {
    echo "Soap error " . $e->getMessage();
} catch (Throwable $e) {
    echo "Exception error " . $e->getMessage();
}
echo PHP_EOL;

