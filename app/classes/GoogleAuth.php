<?php 
    // die(getcwd());
    require_once(getcwd() . '/vendor/autoload.php');
    $dotenv = new Dotenv\Dotenv(getcwd());
    $dotenv->load();
    
    // Google Client info
    $client_id = getenv('CLIENT_ID');
    $client_secret = getenv('CLIENT_SECRET');
    $redirect = getenv('REDIRECT_URI');
class GoogleAuth{

    protected $client;
    public $account;
    public function __construct(Google_Client $googleClient = null){
        $this->client = $googleClient;
        if($this->client){
            //echo "Triple Test";
            $this->client->setClientId($client_id);
            $this->client->setClientSecret($client_secret);
            $this->client->setRedirectUri($redirect);
            $this->client->setScopes('email');//can change this to profile as well
            //$plus = new Google_Service_Plus($this->client);
        }
    }
    public function isSignedIn(){
        return isset($_SESSION['access_token']);
    }
    public function getAuthURL(){
       return $this->client->createAuthUrl();
    }
    public function checkRedirectCode(){
        if(isset($_GET['code'])){
            $this->client->authenticate($_GET['code']);
            $this->setToken($this->client->getAccessToken());
            if(!isset($_SESSION['email'])){
                $account = $this->getPayLoad();
                $_SESSION['email'] = $account; 
            }
            //die($account);
            //so this does hold the email, which is all we really need, for now at least.
            //we will try to use the Google_Plus wrapper function next time 
            //echo print_r($attrs);
            return true;
        }
        return false;
    }
    public function setToken($tok){
        $_SESSION['access_token'] = $tok;
        $this->client->setAccessToken($tok);//essentially the login method
        
    }
    public function logout(){
        unset($_SESSION['access_token']);
        unset($_SESSION['email']);
    }
    public function getPayLoad(){
        
        //die($this->client->verifyIdToken()['email']);//actually contains info...weird
        //$payload = $this->client->verifyIdToken()->getAttributes();
        //die(var_dump($this->client->verifyIdToken()));
        $payload = $this->client->verifyIdToken()['email'];
        return $payload;
        
    }
}
?>
