<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Description of GCM
 *
 * @author Ravi Tamada
 */
class GCM {

    protected $CI;

    const GCM_SERVER_URL = 'https://android.googleapis.com/gcm/send';

    //put your code here
    // constructor
    function __construct() {
        $this->CI = & get_instance();
    }

    /**
     * Sending Push Notification
     */
    public function send_notification($registatoin_ids, $message) {
        // include config
        $this->CI->config->load('push_service_configs', TRUE);
        $GOOGLE_API_KEY = $this->CI->config->item('GOOGLE_API_KEY', 'push_service_configs');

        // Set POST variables
        $fields = array(
            'registration_ids' => $registatoin_ids,
            'data' => $message,
        );

        $headers = array(
            'Authorization: key=' . $GOOGLE_API_KEY,
            'Content-Type: application/json'
        );
        // Open connection
        $ch = curl_init();

        // Set the url, number of POST vars, POST data
        curl_setopt($ch, CURLOPT_URL, self::GCM_SERVER_URL);

        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        // Disabling SSL Certificate support temporarly
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));

        // Execute post
        $result = curl_exec($ch);
        if ($result === FALSE) {
            die('Curl failed: ' . curl_error($ch));
        }

        // Close connection
        curl_close($ch);
                //echo $result;
                return json_decode($result);
    }

}