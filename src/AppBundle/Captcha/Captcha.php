<?php

namespace AppBundle\Captcha;

use Symfony\Component\Yaml\Yaml;


class Captcha
{

    public function captchaVerify($recaptcha){
        $dir = __DIR__.'../../../../app/config/parameters.yml';
        $parameters = Yaml::parse(file_get_contents($dir));
        $secret_key = $parameters['parameters']['recaptcha_secret_key'];

        $url = "https://www.google.com/recaptcha/api/siteverify";
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, array(
            "secret"=>".$secret_key","response"=>$recaptcha));
        $response = curl_exec($ch);
        curl_close($ch);
        $data = json_decode($response);

        return $data->success;

    }

}