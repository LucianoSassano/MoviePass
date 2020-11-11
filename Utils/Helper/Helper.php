<?php 

    namespace Utils\Helper;

    use Utils\PHPMailer\Mailer;
    use Utils\QR\QR_BarCode;

    use Models\Purchase;

    define('QR_SIZE', 300);

    abstract class Helper{ 

        static function sendMail(Purchase $purchase){
            Mailer::send($purchase);
        }

        static function generateQR($data){

            $qr = new QR_BarCode();

            $qr->text($data['text']);       // Utilizar si se quiere mostrar un texto al escanear el QR
            //$qr->url($data['url']);       // Utilizar si se quiere mostrar una url al escanear el QR

            $qr->qrCode(QR_SIZE, ROOT."Utils\QR\assets\\".$data['id'].".png");
        }

        static function facebookAPI($signUpMode = false){

            require_once ROOT . '/vendor/autoload.php';

            // session_start();

            // Creacion de la app
            $fb = new \Facebook\Facebook([
                'app_id' => '3079459188747276',
                'app_secret' => '788d5c6d6ed5b9f8105698cddbf7cbc3',
                'default_graph_version' => 'v8.0',
                //'default_access_token' => '', // optional
            ]);

            $helper = $fb->getRedirectLoginHelper();

            // URL de redireccion al login de fb
            //$loginUrl = $helper->getLoginUrl("http://localhost/MoviePass/fb-Login.php");
            if(!$signUpMode){
                $loginUrl = $helper->getLoginUrl("http://localhost/MoviePass/Login/FacebookLogin");
                // URL a la que el usuario accede para loguear desde facebook
                echo '<a href="' . $loginUrl . '"> Log in with Facebook ! </a>';
            }else {
                $loginUrl = $helper->getLoginUrl("http://localhost/MoviePass/User/FacebookSignup");
                // URL a la que el usuario accede para registrarse desde facebook
                echo '<a href="' . $loginUrl . '"> Sign in with Facebook ! </a>';
            }

            // La URL generada tiene un parametro 'state' que lo guarda getRedirectLoginHelper() en la session
            if(isset($_GET["state"])){
                
                $_SESSION['FBRLH_state'] = $_GET['state'];
            }

            


            // Traigo el token del helper
            $accessToken = $helper->getAccessToken();

            $user = null;
            //Si tengo el token, accedo al usuario y ejecuto lo que quiera
            if($accessToken != null){
                try{
                    $response = $fb->get('/me?fields=id,email,first_name,last_name', $accessToken);
                    $user = $response->getGraphUser();
                    
                    // $_SESSION['user-facebook'] = $user;


                } catch(\Facebook\Exceptions\FacebookResponseException $e) {
                    echo 'Graph returned an error: ' . $e->getMessage();
                    exit;
                } catch(\Facebook\Exceptions\FacebookSDKException $e){
                    echo 'Facebook SDK returned an error: ' . $e->getMessage();
                    exit;
                }
            }
            return $user;
        }
    }

?>