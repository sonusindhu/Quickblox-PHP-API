<?php

include 'config.php';

function quickAuth() {
        $nonce = rand();
        $timestamp = time();
        $signature_string = "application_id=" . APPLICATION_ID . "&auth_key=" . AUTH_KEY . "&nonce=" . $nonce . "&timestamp=" . $timestamp . "&user[login]=" . USER_LOGIN . "&user[password]=" . USER_PASSWORD;

        $signature = hash_hmac('sha1', $signature_string, AUTH_SECRET);

        // Build post body
        $post_body = http_build_query(array(
            'application_id' => APPLICATION_ID,
            'auth_key' => AUTH_KEY,
            'timestamp' => $timestamp,
            'nonce' => $nonce,
            'signature' => $signature,
            'user[login]' => USER_LOGIN,
            'user[password]' => USER_PASSWORD
        ));

        // Configure cURL
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, QB_API_ENDPOINT . '/' . QB_PATH_SESSION);
        curl_setopt($curl, CURLOPT_POST, true); // Use POST
        curl_setopt($curl, CURLOPT_POSTFIELDS, $post_body); // Setup post body
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true); // Receive server response
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false); // Receive server response
        // Execute request and read response
        $response = curl_exec($curl);
        // Close connection
        curl_close($curl);
        // Check errors
        if ($response) {
                return json_decode($response);
                //pr($data->session->token);
        } else {
                return false;
        }
}

function quickAddUsers($token,$username,$password,$email) {
        $post_body = http_build_query(array(
            'user[login]' => $username,
            'user[password]' => $password,
            'user[email]' => $email
        ));
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, QB_API_ENDPOINT.'users.json');
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $post_body);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array(
            'Accept: application/json',
            'Content-Type: application/x-www-form-urlencoded',
            'QuickBlox-REST-API-Version: 0.1.0',
            'QB-Token: ' . $token
        ));
        $response = curl_exec($curl);
        if ($response) {
                return $response;
        } else {
                return false;
        }
        curl_close($curl);
}

function quickGetUsers($token) {
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, QB_API_ENDPOINT.'users.json?per_page=20');
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array(
            'QuickBlox-REST-API-Version: 0.1.0',
            'QB-Token: ' . $token
        ));
        $response = curl_exec($curl);
        if ($response) {
                return json_decode($response);
        } else {
                echo false;
        }
        curl_close($curl);
}

function quickGetDialog($token) {
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, QB_API_ENDPOINT.'chat/Dialog.json');
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array(
            'QuickBlox-REST-API-Version: 0.1.0',
            'QB-Token: ' . $token
        ));
        $response = curl_exec($curl);
        if ($response) {
                return json_decode($response);
        } else {
                echo false;
        }
        curl_close($curl);
}

function quickGetMessage($token, $dialogId) {
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, QB_API_ENDPOINT.'chat/Message.json?chat_dialog_id=' . $dialogId);

        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array(
            'QuickBlox-REST-API-Version: 0.1.0',
            'QB-Token: ' . $token
        ));
        $response = curl_exec($curl);

        if ($response) {
                return json_decode($response);
        } else {
                echo false;
        }
        curl_close($curl);
}

?>
