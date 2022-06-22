<?php
declare(strict_types=1);

class MainTask extends \Phalcon\Cli\Task
{

    public function mainAction() {
        echo "Congratulations! You are now flying with Phalcon CLI!";
    }

    public function checkAction($freq){
        $urls = Urls::findByFreq($freq);
        $unavailable = [];
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        foreach($urls as $url) {
            curl_setopt($ch, CURLOPT_URL, $url -> url);
            curl_exec($ch);
            $response = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            $check = new Checks();
            $check -> datetime = date('Y-m-d H:i:s');
            $check -> url_id = $url -> url_id;
            $check -> try_no = 1;
            if($response != 0) {
                $check -> http = $response;
            } else {
                $check -> http = "err";
            }
            $check -> save();
        
        }
        // $optArray = array(
        //     CURLOPT_URL => $url,
        //     CURLOPT_RETURNTRANSFER => true
        // );
        // curl_setopt_array($ch, $optArray);
        // echo $response;
        curl_close($ch);
    }

}
