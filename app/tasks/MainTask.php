<?php
declare(strict_types=1);

class MainTask extends \Phalcon\Cli\Task
{

    public function mainAction() {
        echo "Congratulations! You are now flying with Phalcon CLI!";
    }

    public function repeatAction($url_id, $repeats) {
        $url = Urls::findFirstByUrlId($url_id);
        if($url == null) return;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        for($i = 2; $i < $repeats + 1; $i++) {
            sleep(60);
            $response = $this -> curl($ch, $url);
            $check = new Checks();
            $check -> datetime = date('Y-m-d H:i:s');
            $check -> url_id = $url -> url_id;
            $check -> try_no = $i;
            if($response == 0) {
                $check -> http = "err";
            } else {
                $check -> http = $response;
            }
            $check -> save();
            if($response != 0) break;
        }
        curl_close($ch);
        if(is_file("null"))
            unlink("null");
    }

    private function curl($ch, $url){
        curl_setopt($ch, CURLOPT_URL, $url -> url);
        curl_exec($ch);
        return curl_getinfo($ch, CURLINFO_HTTP_CODE);
    }

    public function checkAction($freq){
        $urls = Urls::findByFreq($freq);
        $unavailable = [];
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        foreach($urls as $url) {
            $response = $this -> curl($ch, $url);
            $check = new Checks();
            $check -> datetime = date('Y-m-d H:i:s');
            $check -> url_id = $url -> url_id;
            $check -> try_no = 1;
            if($response != 0) {
                $check -> http = $response;
            } else {
                $check -> http = "err";
                array_push($unavailable, $url);
            }
            $check -> save();
        }
        foreach($unavailable as $url){
            $url_id = $url -> url_id;
            $url_repeats = $url -> repeats;
            exec("/usr/bin/php /var/www/cli/app/bootstrap.php main repeat $url_id $url_repeats > null &");
        }
        curl_close($ch);
    }

}
