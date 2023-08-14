<?php 

class API {
    protected $_ci;

    function __construct() {
        $this->_ci = &get_instance();
    }
    
    function CallAPI($method, $url, $data = false, $header=false) {
        $curl = curl_init();

        switch ($method) {
            case "POST":
                curl_setopt($curl, CURLOPT_POST, 1);

                if ($data) {
                    curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data));
                    curl_setopt($curl, CURLOPT_HTTPHEADER, array(
                        'Content-Type: application/json',
                        'Content-Length: ' . strlen(json_encode($data)),
                        $header
                    ));

                }
                else {
                    curl_setopt($curl, CURLOPT_POSTFIELDS, "");
                    if ($header) {
                        curl_setopt($curl, CURLOPT_HTTPHEADER, array(
                            'Content-Type: application/json',
                            $header
                        ));
                    }
                }
                break;
            case "PUT":
                // curl_setopt($curl, CURLOPT_PUT, 1);
                curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "PUT");

                if ($data) {
                    curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($data));
                    curl_setopt($curl, CURLOPT_HTTPHEADER, array(
                        'Content-Type: application/x-www-form-urlencoded',
                        'Content-Length: ' . strlen(http_build_query($data)),
                        $header
                    ));

                }
                else {
                    curl_setopt($curl, CURLOPT_POSTFIELDS, "");
                    if ($header) {
                        curl_setopt($curl, CURLOPT_HTTPHEADER, $header);
                    }
                }
                break;
            case "PATCH":
                // curl_setopt($curl, CURLOPT_PUT, 1);
                curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "PATCH");

                if ($data) {
                    curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($data));
                    curl_setopt($curl, CURLOPT_HTTPHEADER, array(
                        'Content-Type: application/x-www-form-urlencoded',
                        'Content-Length: ' . strlen(http_build_query($data)),
                        $header
                    ));

                }
                else {
                    curl_setopt($curl, CURLOPT_POSTFIELDS, "");
                    if ($header) {
                        curl_setopt($curl, CURLOPT_HTTPHEADER, $header);
                    }
                }
                break;
            case "DELETE":
                // curl_setopt($curl, CURLOPT_PUT, 1);
                curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "DELETE");

                if ($data) {
                    curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($data));
                    curl_setopt($curl, CURLOPT_HTTPHEADER, array(
                        'Content-Type: application/x-www-form-urlencoded',
                        'Content-Length: ' . strlen(http_build_query($data)),
                        $header
                    ));

                }
                else {
                    curl_setopt($curl, CURLOPT_POSTFIELDS, "");
                    if ($header) {
                        curl_setopt($curl, CURLOPT_HTTPHEADER, $header);
                    }
                }
                break;
            default:
                if ($data)
                    $url = sprintf("%s?%s", $url, http_build_query($data));
        }

        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);


        $result = curl_exec($curl);

        curl_close($curl);

        return $result;
    }	

    
    function CallAPI_THIRD($method, $url, $data = false, $header=false) {
        $curl = curl_init();

        switch ($method) {
            case "GET":
                break;
            case "POST":
                curl_setopt($curl, CURLOPT_POST, 1);

                if ($data) {
                    curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
                    curl_setopt($curl, CURLOPT_HTTPHEADER, array(
                        'Content-Type: multipart/form-data',
                        $header
                    ));

                }
                else {
                    curl_setopt($curl, CURLOPT_POSTFIELDS, "");
                    if ($header) {
                        curl_setopt($curl, CURLOPT_HTTPHEADER, array(
                            'Content-Type: application/json',
                            $header
                        ));
                    }
                }
                break;
            case "PUT":
                // curl_setopt($curl, CURLOPT_PUT, 1);
                curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "PUT");

                if ($data) {
                    curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($data));
                    curl_setopt($curl, CURLOPT_HTTPHEADER, array(
                        'Content-Type: application/x-www-form-urlencoded',
                        'Content-Length: ' . strlen(http_build_query($data)),
                        $header
                    ));

                }
                else {
                    curl_setopt($curl, CURLOPT_POSTFIELDS, "");
                    if ($header) {
                        curl_setopt($curl, CURLOPT_HTTPHEADER, $header);
                    }
                }
                break;
            case "PATCH":
                // curl_setopt($curl, CURLOPT_PUT, 1);
                curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "PATCH");

                if ($data) {
                    curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($data));
                    curl_setopt($curl, CURLOPT_HTTPHEADER, array(
                        'Content-Type: application/x-www-form-urlencoded',
                        'Content-Length: ' . strlen(http_build_query($data)),
                        $header
                    ));

                }
                else {
                    curl_setopt($curl, CURLOPT_POSTFIELDS, "");
                    if ($header) {
                        curl_setopt($curl, CURLOPT_HTTPHEADER, $header);
                    }
                }
                break;
            case "DELETE":
                // curl_setopt($curl, CURLOPT_PUT, 1);
                curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "DELETE");

                if ($data) {
                    curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($data));
                    curl_setopt($curl, CURLOPT_HTTPHEADER, array(
                        'Content-Type: application/x-www-form-urlencoded',
                        'Content-Length: ' . strlen(http_build_query($data)),
                        $header
                    ));

                }
                else {
                    curl_setopt($curl, CURLOPT_POSTFIELDS, "");
                    if ($header) {
                        curl_setopt($curl, CURLOPT_HTTPHEADER, $header);
                    }
                }
                break;
            default:
                if ($data)
                    $url = sprintf("%s?%s", $url, http_build_query($data));
        }

        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);


        $result = curl_exec($curl);

        curl_close($curl);

        return $result;
    }		
}
?>