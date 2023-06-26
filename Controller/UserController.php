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
            $this->compact([
                "error" => $error
            ]);
        }

        $this->view("login");
    }

    function Signin($mail, $password) 
    {
        $user = new \stdClass();
        $user->pseudo = 'test';
        $user->mail = $mail;

        if(!(filter_var($mail, FILTER_VALIDATE_EMAIL))) {
            $this->compact([
                "error" => "Mail invalide !",
                "error_mail" => true,

            ]);

            $this->SigninView();
            exit();
        }

        if($this->userManager->getByMail($mail)) {
            $this->compact([
                "error" => "Mail déja utilisé !"
            ]);
            
            $this->SigninView();
            exit();
        }

        if(!(preg_match('/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,}$/', $password))) {
            $this->compact([
                "error" => "Votre mot de passe doit contenir au moins 8 caractères, une lettre majuscule,
                une lette minuscule, un chiffre et un caractère spécial"
            ]);

            $this->SigninView();
            exit();
        }

        $user->password = password_hash($password, PASSWORD_DEFAULT);

        if ($this->userManager->create($user)) {
            $this->compact(["success" => "Votre compte a bien été créé !"]);
            $this->LoginView();
        } else {
            $this->compact(["error" => "Une erreur est survenue !"]);
            $this->SigninView();
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
