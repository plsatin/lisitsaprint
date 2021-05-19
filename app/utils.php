<?php


class Utils {

    function isEmail($email) {
        return(preg_match("/^[-_.[:alnum:]]+@((([[:alnum:]]|[[:alnum:]][[:alnum:]-]*[[:alnum:]])\.)+(ad|ae|aero|af|ag|ai|al|am|an|ao|aq|ar|arpa|as|at|au|aw|az|ba|bb|bd|be|bf|bg|bh|bi|biz|bj|bm|bn|bo|br|bs|bt|bv|bw|by|bz|ca|cc|cd|cf|cg|ch|ci|ck|cl|cm|cn|co|com|coop|cr|cs|cu|cv|cx|cy|cz|de|dj|dk|dm|do|dz|ec|edu|ee|eg|eh|er|es|et|eu|fi|fj|fk|fm|fo|fr|ga|gb|gd|ge|gf|gh|gi|gl|gm|gn|gov|gp|gq|gr|gs|gt|gu|gw|gy|hk|hm|hn|hr|ht|hu|id|ie|il|in|info|int|io|iq|ir|is|it|jm|jo|jp|ke|kg|kh|ki|km|kn|kp|kr|kw|ky|kz|la|lb|lc|li|lk|lr|ls|lt|lu|lv|ly|ma|mc|md|mg|mh|mil|mk|ml|mm|mn|mo|mp|mq|mr|ms|mt|mu|museum|mv|mw|mx|my|mz|na|name|nc|ne|net|nf|ng|ni|nl|no|np|nr|nt|nu|nz|om|org|pa|pe|pf|pg|ph|pk|pl|pm|pn|pr|pro|ps|pt|pw|py|qa|re|ro|ru|rw|sa|sb|sc|sd|se|sg|sh|si|sj|sk|sl|sm|sn|so|sr|st|su|sv|sy|sz|tc|td|tf|tg|th|tj|tk|tm|tn|to|tp|tr|tt|tv|tw|tz|ua|ug|uk|um|us|uy|uz|va|vc|ve|vg|vi|vn|vu|wf|ws|ye|yt|yu|za|zm|zw)$|(([0-9][0-9]?|[0-1][0-9][0-9]|[2][0-4][0-9]|[2][5][0-5])\.){3}([0-9][0-9]?|[0-1][0-9][0-9]|[2][0-4][0-9]|[2][5][0-5]))$/i", $email));
    }

    function sendEmail($f3) {
        
        if($_POST) {

            $db=$this->db;

            // Переменная emailTo перенесена в config.ini
            $emailTo = $f3->get('emailTo');
            // $emailTo = 'pslater.ru@gmail.com';
        
            $clientName = trim($_POST['contactName']);
            $clientEmail = trim($_POST['contactEmail']);
            $subject = trim($_POST['contactSubject']);
            $message = trim($_POST['contactMessage']);
        
            $array = array();
            $array['name'] = $clientName;
            $array['email'] = $clientEmail;
            $array['subject'] = $subject;
            $array['message'] = $message;
            $array['result'] = 'success';


            if($clientName == '') {
                $array['name'] = 'Пожалуйста введите свое имя.';
                $array['result'] = 'failure';

            }
            if(!Utils::isEmail($clientEmail)) {
                $array['email'] = 'Пожалуйста укажите правильный адрес электронной почты.';
                $array['result'] = 'failure';
            }
            if($message == '') {
                $array['message'] = 'Пожалуйста введите текст сообщения.';
                $array['result'] = 'failure';
            }
            if($clientName != '' && Utils::isEmail($clientEmail) && $message != '') {
                // Send email
                $headers = "From: " . $clientName . " <" . $clientEmail . ">" . "\r\n";
                $headers .= "Reply-To: ". $clientEmail . "\r\n";
                $headers .= "MIME-Version: 1.0\r\n";
                $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

                $mailSendOK = mail($emailTo, $subject, $message, $headers);

                if ($mailSendOK) {
                    $array['result'] = 'success';

                } else {
                    $array['message'] = 'Ошибка отправки сообщения, попробуйте еще раз через некоторое время';
                    $array['result'] = 'failure';

                }

                $db=new DB\SQL($f3->get('db'), $f3->get('dbuser'), $f3->get('dbpassword'));
                $db->begin();
                $db->exec('INSERT INTO messages (msg_date, msg_email, msg_name, msg_message, msg_title) VALUES ("'. date("Y-m-d H:i:s") .'","' . $clientEmail .'","' . $clientName .'","' . $message .'","' . $subject . '")');
                $db->commit();

            }

            echo json_encode($array);

        }
    }



}