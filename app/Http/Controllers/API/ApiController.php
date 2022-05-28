<?php

namespace App\Http\Controllers\API;

// use Aloha\Twilio\Twilio;
use FCM;
use Twilio\Rest\Client;
use Aloha\Twilio\Twilio;
use Illuminate\Support\Facades\Validator;

class ApiController extends \App\Http\Controllers\Controller {

    public static function validateAttributes($request, $formType = 'GET', $attributeValidate = [], $attributes = [], $checkVariableCount = true) {
        $headers = getallheaders();
        if ($request->method() != $formType) {
            return self::error('This method is not allowed.', 409);
        }
        
        $params = [];
        if (isset($headers['client_id']) && isset($headers['client_secret'])):
            $params['client_id'] = $headers['client_id'];
            $params['client_secret'] = $headers['client_secret'];
        endif;
        
        foreach ($attributes as $attribute):
            $params[$attribute] = $request->$attribute;
        endforeach;
        
        if ($checkVariableCount === true):
            if (count($attributes) != count($request->all())):
                return self::error('Please fill required parameters only.', 409);
            endif;
        endif;
        // dd($params,$attributeValidate);
        $validator = Validator::make($params, $attributeValidate);
       
        if ($validator->fails()) {
            $messages = $validator->getMessageBag();
            // dd($messages);
            foreach ($messages->keys() as $k => $key) {
                $errors = $messages->get($key)['0'];
            }
            return self::error($errors, 422, false);
        }
        return false;
    }

    public static function error($message, $errorCode = 422, $messageIndex = false) {
        return response()->json(['status' => false, 'code' => $errorCode, 'data' => (object) [], 'error' => $message], $errorCode);
    }

    public static function success($data, $code = 200, $returnType = 'object') {
        if ($returnType == 'array')
            $data = (array) $data;
        elseif ($returnType == 'data')
            $data = $data;
        else
            $data = (object) $data;
        return response()->json(['status' => true, 'code' => $code, 'data' => $data], $code);
    }
     public static function successCreated($data, $code = 201) {
        if (!is_array($data))
            $data = ['message' => $data];
        return response()->json(['status' => true, 'code' => $code, 'data' => (object) $data], $code);
}

public static function sendOTP($number,$otp) {
        self::sendTextMessage('Your ' . config('app.name') . ' Verification code is ' . $otp, $number);
    return $otp;
}

public static function sendTextMessage($message, $to) {
    try {
        $sid = env('TWILIO_SID');
        $token = env('TWILIO_TOKEN');
        $from = env('TWILIO_PHONE');

        $twilioClass = new Twilio($sid, $token, $from);
        $twilio = $twilioClass->message($to, $message);
        return $twilio;
    } catch (\Twilio\Exceptions\TwilioException $ex) {
        //    dd($ex->getMessage());
        return self::error($ex->getMessage());
    }
}


}
