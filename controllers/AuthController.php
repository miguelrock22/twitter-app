<?php

class AuthController{
    /**
     * Show login form
     * 
     * @return void
     */
    public function login(){
        if(isset($_SESSION['user'])){
            header("Location: ". Request::generateUrl('post','list'));
            exit();
        }
        require_once 'views/auth/login.php';
    }

    /**
     * POST login action
     * 
     * @return void
     */
    public function auth(){
        if(isset($_SESSION['user'])){
            header("Location: ". Request::generateUrl('post','list'));
            exit();
        }
        require_once 'models/user.php';
        $req = Request::postRequest();
        $usuario = new User();
        if(isset($req['username']) && isset($req['password'])){
            $log = $usuario->loadLogin($req);
            if($log){
                $user = $log->fetch_assoc();
                $_SESSION['user'] = [
                    $user['id'],
                    $user['username']
                ];
                header("Location: ". Request::generateUrl('post','list'));
                exit();
            }else{
                $_SESSION['error'] = "Error! username or password are incorrect!";
                header("Location: ". Request::generateUrl('auth','login'));
                exit();
            }
        }else{
            $_SESSION['error'] = "There is an error";
            header("Location: ". Request::generateUrl('auth','login'));
            exit();
        }
    }
    /**
     * Log out
     */
    public function logout(){
		if(isset($_SESSION['user'])){
			unset($_SESSION['user']);
			if(session_status() != PHP_SESSION_NONE){ session_destroy(); }
			    header("Location: ". Request::generateUrl('auth','login'));
		}
	}

    /**
     * Show login form
     * 
     * @return void
     */
    public function register(){
        if(isset($_SESSION['user'])){
            header("Location: ". Request::generateUrl('post','list'));
            exit();
        }
        require_once 'views/auth/register.php';
    }

    /**
     * Register the user
     */
    public function create(){
        if(isset($_SESSION['user'])){
            header("Location: ". Request::generateUrl('post','list'));
            exit();
        }
        require_once 'helpers/strings.php';
        require_once 'models/user.php';
        $req = Request::postRequest();
        
        $formError = false;
        
        //Form validation
        if(!isset($req['email']) || !Strings::validateString(Strings::REGEX_EMAIL,$req['email'])){
            $formError = true;
            $_SESSION['formError']['email'] = "Invalid email address. Valid e-mail can contain only latin letters, numbers, '@' and '.";
        }

        if(isset($req['username']) && !Strings::validateString(Strings::REGEX_USERNAME,$req['username'])){
            $formError = true;
            $_SESSION['formError']['username'] = "Invalid username. Valid username must contain at least 4 letters and at least 2 numbers";
        }

        if(isset($req['phone']) && !Strings::validateString(Strings::REGEX_PHONE,$req['phone'])){
            $formError = true;
            $_SESSION['formError']['phone'] = "Invalid phone number. Valid phone number must have 10 digits";
        }
        if(isset($req['password']) && isset($req['confirm_password']) && ($req['password'] === $req['confirm_password'])){
            if(!Strings::validateString(Strings::REGEX_PASSWORD,$req['password'])){
                $formError = true;
                $_SESSION['formError']['password'] = 'Password must contain at least 6 characters, an uppercase letter and a "-"';
            }
        }else{
            $formError = true;
            $_SESSION['formError']['confirm_password'] = "Passwords doesn't match";
        }

        if($formError){
            $_SESSION['registerData'] = array(
                'username' => $req['username'],
                'email' => $req['email'],
                'phone' => $req['phone']
            );
            header("Location: ". Request::generateUrl('auth','register'));
            exit;
        }else {
            $user = new User();
            $user->username = $req['username'];
            $user->email = $req['email'];
            $user->phone = $req['phone'];
            $user->password = $req['password'];

            //check if exists
            if($user->getByUsername() > 0){
                $_SESSION['registerData'] = array(
                    'email' => $req['email'],
                    'phone' => $req['phone']
                );
                $_SESSION['error'] = "This Username already exists, please select another!";
                header("Location: ". Request::generateUrl('auth','register'));
                exit;
            }
            if($user->getByEmail() > 0){
                $_SESSION['registerData'] = array(
                    'username' => $req['username'],
                    'phone' => $req['phone']
                );
                $_SESSION['error'] = "This email already exists, please select another!";
                header("Location: ". Request::generateUrl('auth','register'));
                exit;
            }
            $res = $user->store();
            if($res['ok']){
                $_SESSION['success'] = "Congrats!, you complete the register";
                header("Location: ". Request::generateUrl('auth','login'));
                exit;
            }else{
                $_SESSION['error'] = "An error ocurred! please try later ". $res['msg'];
                header("Location: ". Request::generateUrl('auth','register'));
                exit;
            }
        }
    }

}