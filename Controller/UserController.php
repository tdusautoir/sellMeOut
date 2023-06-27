<?php 
namespace Controller;

class UserController extends Controller {
    protected $userManager;
    protected $allowedRoles = ["buyer", "seller"];

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

    function SignupView() 
    {
        $this->view("signup");
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

    function Signup($mail, $password, $role) 
    {
        $user = new \stdClass();
        $user->pseudo = 'test';
        $user->mail = $mail;

        if(!(filter_var($mail, FILTER_VALIDATE_EMAIL))) {
            $this->compact([
                "error" => "Mail invalide !",
                "error_mail" => true,

            ]);

            $this->SignupView();
            exit();
        }

        if(!(preg_match('/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,}$/', $password))) {
            $this->compact([
                "error" => "Votre mot de passe doit contenir au moins 8 caractères, une lettre majuscule,
                une lette minuscule, un chiffre et un caractère spécial",
                "error_password" => true,
            ]);

            $this->SignupView();
            exit();
        }

        if(!in_array($role, $this->allowedRoles)) {
            $this->compact([
                "error" => "Rôle invalide !",
                "error_role" => true,

            ]);

            $this->SignupView();
            exit();
        } 
            
        $user->role = $role;

        if($this->userManager->getByMail($mail)) {
            $this->compact([
                "error" => "Vous possedez déjà un compte.",
                "error_mail" => true
            ]);
            
            $this->SignupView();
            exit();
        }

        $user->password = password_hash($password, PASSWORD_DEFAULT);

        if ($this->userManager->create($user)) {
            $this->compact(["success" => "Votre compte a bien été créé !"]);
            $this->LoginView();
        } else {
            $this->compact(["error" => "Une erreur est survenue !"]);
            $this->SignupView();
        }
    }

    function Login($mail, $password, $role) 
    {
        if(!in_array($role, $this->allowedRoles)) {
            $this->compact([
                "error" => "Rôle invalide !",
                "error_role" => true,
            ]);

            $this->LoginView();
            exit();
        } 

        $user = $this->userManager->getByMail($mail);

        if($user) {
            if (password_verify($password, $user->password)) {
                unset($user->password);
                $_SESSION["user"] = $user;
                header("Location: /products");
            } else {
                $this->compact([
                    "error" => "Mot de passe incorrect !",
                    "error_password" => true,
                ]);

                $this->LoginView();
            }
        } else {
            $this->compact([
                "error" => "Utilisateur introuvable !",
                "error_mail" => true,
            ]);

            $this->LoginView();
        }
    }

    function Logout()
    {
        session_unset();
        session_destroy();
        header("Location: /login");
    }
}
