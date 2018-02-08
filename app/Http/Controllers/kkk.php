<?php

//send SMS
        public function Submit($phone, $message) {
            $genInfo = new GENERAL();
            $configInfo = $genInfo->configInfo();
            $phone = str_replace('+', '', $phone);
            $strMessageType = 0;
            $strDlr = 0;
            $port = "";
            if($configInfo['sms_port'] == '') {
                $port = ":" . $configInfo['sms_port'];
            }

            $message = urlencode($message);
            try {
                //Smpp http Url to send sms.
                $live_url = "http://yoursite.com:8080/bulksms/bulksms?username=userxxx&password=passxxx&type=0&dlr=0&destination=2348037372777&source=ozitech&message=here is my unique message";
                $parse_url = file($live_url);
                //echo $parse_url[0];
            } catch (Exception $e) {
                echo 'Message:' . $e->getMessage();
            }

            return true;
        }