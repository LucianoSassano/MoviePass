<?php 

    namespace Utils\PHPMailer;

    use Utils\PHPMailer\PHPMailer;
    use Utils\PHPMailer\Exception;

    use Utils\Helper\Helper;

    class Mailer{

        static function send($purchase){

            require 'Utils/PHPMailer/Exception.php';
            require 'Utils/PHPMailer/PHPMailer.php';
            require 'Utils/PHPMailer/SMTP.php';

            $mail = new PHPMailer(true);

            try {
                $msg = "";
                //Server settings
                $mail->SMTPDebug = 0; //SMTP::DEBUG_SERVER;                 // Enable verbose debug output
                $mail->isSMTP();                                            // Send using SMTP
                $mail->Host       = 'smtp.gmail.com';                    // Set the SMTP server to send through
                $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
                $mail->Username   = 'moviepassmessageservice@gmail.com';                     // SMTP username
                $mail->Password   = 'moviepass123';                               // SMTP password
                $mail->SMTPSecure =  'tls'; //PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` also accepted
                $mail->Port       = 587;                                    // TCP port to connect to
            
                //Recipients
                $mail->setFrom('moviepassmessageservice@gmail.com', 'Movie Pass Support');      // Mail del que envia el msj
                
                $mail->addAddress($purchase->getUserEmail());   // Mail del que recibe el msj
            
                foreach ($purchase->getTickets() as $ticket){
    
                    $data['id'] = $ticket->getSeat_number();
                    $data['text'] = "Seat number: " . $ticket->getSeat_number();
                    // $data['url'] = "URL del QR";

                    Helper::generateQR($data);
            
                    $msg.="<h5><span> Theater: </span>" . $purchase->getTheater()->getName() . "</h5>
                    <h5><span> Fecha: </span> " . $ticket->getDate() . " </h5>
                    <h5><span> Seat: </span> ".  $ticket->getSeat_number() ." </h5>
                    <h5><span> Price: $</span> ".  $ticket->getCost() ." </h5> <br><br>";

              
                    $mail->addAttachment(ROOT."Utils\QR\assets\\".$ticket->getSeat_number().".png", "Seat ". $ticket->getSeat_number());
            
                }
            
                // Attachments
                // Add attachments
            
            
                // Content
                $mail->isHTML(true);                                  // Set email format to HTML
                $mail->Subject = 'Gracias por realizar su compra en MoviePass';
                $mail->Body    = '<br>Datos de su compra: <br><br><br>'.$msg;
            
            
                $mail->send();
                // echo 'Message has been sent';
            
            } catch (Exception $e) {
                echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            }
        }
    }
?>