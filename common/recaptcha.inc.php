<?php
    function check_recaptcha($g_recaptcha_response, $remote_addr){
        $recaptcha_res = file_get_contents('https://www.google.com/recaptcha/api/siteverify', false, stream_context_create([
            'http' => [
                'header' => "Content-type: application/x-www-form-urlencoded\r\n",
                'method' => 'POST',
                'content' => http_build_query([
                    'secret' => '6LeNvGkUAAAAAIwPWAO5RLzlth9ObLNCKhnlgIHA',
                    'response' => $g_recaptcha_response,
                    'remoteip' => $remote_addr,
                ]),
            ],
        ]));
        if( $recaptcha_res === false )
            return false;

        $recaptcha_res = json_decode($recaptcha_res, true);
        return $recaptcha_res['success'];
    }
?>
