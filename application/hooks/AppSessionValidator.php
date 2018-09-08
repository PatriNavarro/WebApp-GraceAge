<?php
/**
 * Created by PhpStorm.
 * User: kymeng
 * Date: 20/10/2017
 * Time: 15:58
 */

date_default_timezone_set('UTC');

class AppSessionValidator
{
    private $redirectUrl = "index.php/Account/caregiver";
    private $request;
    private $router;
    private $method;
    private $publicAccessList = array(
        "Account/caregiver" => true,
        "Account/authenticate"=>true,
        "Account/index" => true,
        "Account/create" => true,
        "api/Authentication/index" => true,
    );
    private $caregiverAccessList = array(

    );


    public function __construct()
    {
        $this->router = &load_class('Router', 'core');
        $this->request = $this->router->fetch_directory().$this->router->fetch_class(). "/".$this->router->fetch_method();
        $this->method = $_SERVER['REQUEST_METHOD'];
    }

    public function validate()
    {
        if (isset($this->publicAccessList[$this->request]))
            return;
        $authenticated = false;
        if (isset($_SESSION['authenticated']))
            $authenticated = $_SESSION['authenticated'];
        if(!$authenticated) {
            if (!isset($this->publicAccessList[$this->request]))
                $_SESSION['previous_request'] = $this->request;
            header('Location: '.base_url().$this->redirectUrl);
        }
    }

}