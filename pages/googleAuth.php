<html>
<?php
            require_once('../classes/dbHandler.php');
            require_once('../vendor/autoload.php');
            session_start();
    
            $dotenv = new Dotenv\Dotenv('../');
            $dotenv->load();
            
            // Google Client info
            $client_id = getenv('CLIENT_ID');
            $client_secret = getenv('CLIENT_SECRET');
            $redirect = getenv('REDIRECT_URI');

            $client = new Google_Client();
            $client->setClientId($client_id);
            $client->setClientSecret($client_secret);
            $client->setRedirectUri($redirect);
            $client->setScopes('email');
            $plus = new Google_Service_Plus($client);
            //wraps into GPlus library, for extraction of data

        if (isset($_GET['code'])) {
            // die('here');
            $client->authenticate($_GET['code']);
            $_SESSION['access_token'] = $client->getAccessToken();
        }

        if (isset($_SESSION['access_token']) && $_SESSION['access_token']) {

              $client->setAccessToken($_SESSION['access_token']);
              $me = $plus->people->get('me');
              //check db here for matching id, if hit, we don't insert, but maybe pull data
              //var_dump($me);

                  $_SESSION['id'] = $me['id'];
                  $_SESSION['displayName'] =  $me['displayName'];
                  $_SESSION['emails'] =  $me['emails'][0]['value'];
                  $_SESSION['profile_image_url'] = $me['image']['url'];
                  $_SESSION['cover_image_url'] = $me['cover']['coverPhoto']['url'];
                  $_SESSION['profile_url'] = $me['url'];

                  if(emailExists($_SESSION['emails'])){
                      header('Location: ../index.php');
                  }
                  else{
                      //insertUser($_SESSION['id'],$_SESSION['emails'],$_SESSION['displayName']);
                      //make a page to handle rest of info we need! Then make the insertFunction
                      header('Location: complete-reg.php');
                  }
                  //die($me['id']);
                  //header('Location: index.php');

        } else {
              $authUrl = $client->createAuthUrl();
              header('Location: ' . $authUrl );
        }
?>
</html>
