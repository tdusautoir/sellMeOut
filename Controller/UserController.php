<?php 
namespace Controller;

class UserController extends Controller {
    protected $userManager;

    function UpdateUser()
    {
        $user = new \stdClass();
        $user->id = 3;
        $user->mail = "test2@test2.fr";
        $user->password = password_hash("imverysecure",PASSWORD_DEFAULT);
        $user->pseudo = "test2";
        if ($this->userManager->update($user)) {
            echo "Utilisateur modifié !";
        }
    }

    function DeleteUser()
    {
        if ($this->userManager->delete("3")) {
            echo "Utilisateur supprimé !";
        }
    }

    function SigninView() 
    {
        $this->view("signin");
    }

    function LoginView($error = null) 
    {
        if(isset($error)) {
            $this->compact("error", $error);
        }
        $this->view("login");
    }

    function Signin($mail, $password) 
    {
        $user = new \stdClass();
        $user->pseudo = 'test';
        $user->mail = $mail;
        $user->password = password_hash($password, PASSWORD_DEFAULT);
        if ($this->userManager->create($user)) {
            echo "Utilisateur créé !";
        }
    }

    function Login($mail, $password) 
    {
        $user = $this->userManager->getByMail($mail);
        if($user) {
            if (password_verify($password, $user->password)) {
                unset($user->password);
                $_SESSION["user"] = $user;
                header("Location: /User");
            } else {
                $this->LoginView("Mauvais mot de passe !");
            }
        } else {
            $this->LoginView("Utilisateur non trouvé !");
        }
    }

    function Logout()
    {
        session_unset();
        session_destroy();
        header("Location: /User/login");
    }
}
