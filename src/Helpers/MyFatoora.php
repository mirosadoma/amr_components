<?php

if (!function_exists('myfatoorah')) {
    function myfatoorah($InvoiceValue,$CallBackUrl,$ErrorUrl,$CustomerName="",$CustomerMobile="",$CustomerEmail="")
    {
        $apiURL = env('MYFATOORAH_URL');
        $apiKey = env('MYFATOORAH_KEY');
        $postFields = [
            'NotificationOption' => 'Lnk', //'SMS', 'EML', or 'ALL'
            'InvoiceValue'       => $InvoiceValue,
            'CustomerName'       => $CustomerName,
            'DisplayCurrencyIso' => 'SAR',
            'MobileCountryCode'  => '+966',
            'CustomerMobile'     => $CustomerMobile,
            'CustomerEmail'      => $CustomerEmail,
            'CallBackUrl'        => $CallBackUrl,
            'ErrorUrl'           => $ErrorUrl, //or 'https://example.com/error.php'
        ];
        $data = sendPayment($apiURL, $apiKey, $postFields);
        $invoiceId   = $data->InvoiceId;
        $paymentLink = $data->InvoiceURL;
        return ['invoiceId'=>$invoiceId,'paymentLink'=>$paymentLink];
    }
}

if (!function_exists('sendPayment')) {
    function sendPayment($apiURL, $apiKey, $postFields) {
        /* ------------------------ Call SendPayment Endpoint ----------------------- */
        //Fill customer address array
        /* $customerAddress = array(
          'Block'               => 'Blk #', //optional
          'Street'              => 'Str', //optional
          'HouseBuildingNo'     => 'Bldng #', //optional
          'Address'             => 'Addr', //optional
          'AddressInstructions' => 'More Address Instructions', //optional
          ); */
        //Fill invoice item array
        /* $invoiceItems[] = [
          'ItemName'  => 'Item Name', //ISBAN, or SKU
          'Quantity'  => '2', //Item's quantity
          'UnitPrice' => '25', //Price per item
          ]; */
        //Fill POST fields array
        //$postFields = [
            //Fill required data
            //'NotificationOption' => 'Lnk', //'SMS', 'EML', or 'ALL'
            //'InvoiceValue'       => $request->InvoiceValue,
            //'CustomerName'       => $request->storeTitle . ' - ' . $request->storeUser,
            //Fill optional data
            //'DisplayCurrencyIso' => 'KWD',
            //'MobileCountryCode'  => '+965',
            //'CustomerMobile'     =>  $request->storeUserPhone,
            //'CustomerEmail'      => 'email@example.com',
            //'CallBackUrl'        => url('stores/'.$store->slug.'/payment/success?type='.$request->type),
            //'ErrorUrl'           => url('stores/'.$store->slug.'/payment/error?type='.$request->type), //or 'https://example.com/error.php'
            //'Language'           => 'en', //or 'ar'
            //'CustomerReference'  => 'orderId',
            //'CustomerCivilId'    => 'CivilId',
            //'UserDefinedField'   => 'This could be string, number, or array',
            //'ExpiryDate'         => '', //The Invoice expires after 3 days by default. Use 'Y-m-d\TH:i:s' format in the 'Asia/Kuwait' time zone.
            //'SourceInfo'         => 'Pure PHP', //For example: (Laravel/Yii API Ver2.0 integration)
            //'CustomerAddress'    => $customerAddress,
            //'InvoiceItems'       => $invoiceItems,
            //];
        $json = callAPI("$apiURL/v2/SendPayment", $apiKey, $postFields);
        return $json->Data;
    }
}

if (!function_exists('callAPI')) {
    function callAPI($endpointURL, $apiKey, $postFields) {
        $curl = curl_init($endpointURL);
        curl_setopt_array($curl, array(
            CURLOPT_CUSTOMREQUEST  => "POST",
            CURLOPT_POSTFIELDS     => json_encode($postFields),
            CURLOPT_HTTPHEADER     => array("Authorization: Bearer $apiKey", 'Content-Type: application/json'),
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_SSL_VERIFYHOST => false,
            CURLOPT_SSL_VERIFYPEER => false,
        ));
        $response = curl_exec($curl);
        $curlErr  = curl_error($curl);
        curl_close($curl);
        if ($curlErr) {
            //Curl is not working in your server
            die("Curl Error: $curlErr");
        }
        $error = handleError($response);
        if ($error) {
            die("Error: $error");
        }
        return json_decode($response);
    }
}

if (!function_exists('handleError')) {
    function handleError($response) {
        $json = json_decode($response);
        if (isset($json->IsSuccess) && $json->IsSuccess == true) {
            return null;
        }
        //Check for the errors
        if (isset($json->ValidationErrors) || isset($json->FieldsErrors)) {
            $errorsObj = isset($json->ValidationErrors) ? $json->ValidationErrors : $json->FieldsErrors;
            $blogDatas = array_column($errorsObj, 'Error', 'Name');

            $error = implode(', ', array_map(function ($k, $v) {
                return "$k: $v";
            }, array_keys($blogDatas), array_values($blogDatas)));
        } else if (isset($json->Data->ErrorMessage)) {
            $error = $json->Data->ErrorMessage;
        }
        if (empty($error)) {
            $error = (isset($json->Message)) ? $json->Message : (!empty($response) ? $response : 'API key or API URL is not correct');
        }
        return $error;
    }
}