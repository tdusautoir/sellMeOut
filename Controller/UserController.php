<?php 
namespace Controller;

class UserController extends Controller {
    protected $userManager;
    protected $allowedRoles = ["buyer", "seller"];

    // function UpdateUser()
    // {
    //     $user = new \stdClass();
    //     $user->id = 3;
    //     $user->mail = "test2@test2.fr";
    //     $user->password = password_hash("imverysecure",PASSWORD_DEFAULT);
    //     $user->pseudo = "test2";
    //     if ($this->userManager->update($user)) {
    //         echo "Utilisateur modifié !";
    //     }
    // }

    // function DeleteUser()
    // {
    //     if ($this->userManager->delete("3")) {
    //         echo "Utilisateur supprimé !";
    //     }
    // }

    function SignupView() 
    {
        $this->view("signup");
    }

    function LoginView() 
    {
        $this->view("login");
    }

    function Signup($mail, $password, $role) 
    {
        $user = new \stdClass();
        $user->pseudo = 'test';
        $user->mail = $mail;

        if(!(filter_var($mail, FILTER_VALIDATE_EMAIL))) {
            create_flash_message("error", "Email invalide", FLASH_ERROR);

            $this->SignupView();
            exit();
        }

        if(!(preg_match('/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,}$/', $password))) {
            create_flash_message("error", "Votre mot de passe doit contenir au moins 8 caractères, une lettre majuscule,
            une lette minuscule, un chiffre et un caractère spécial", FLASH_ERROR);

            $this->SignupView();
            exit();
        }

        if(!in_array($role, $this->allowedRoles)) {
            create_flash_message("error", "Role invalide", FLASH_ERROR);

            $this->SignupView();
            exit();
        } 
            
        $user->role = $role;

        if($this->userManager->getByMail($mail)) {
            create_flash_message("error", "Vous possédez déjà un compte", FLASH_ERROR);

            $this->SignupView();
            exit();
        }

        $user->password = password_hash($password, PASSWORD_DEFAULT);

        if ($this->userManager->create($user)) {
            create_flash_message("success", "Votre compte a bien été créé !", FLASH_SUCCESS);
            header("Location: /login");
        } else {
            create_flash_message("error", "Une erreur est survenue !", FLASH_ERROR);
            $this->SignupView();
        }
    }

    function Login($mail, $password) 
    {
        $user = $this->userManager->getByMail($mail);

        if($user) {
            if (password_verify($password, $user->password)) {
                unset($user->password);
                $_SESSION["user"] = $user;

                create_flash_message("success", "Connexion réussie !", FLASH_SUCCESS);
                header("Location: /products");
            } else {
                create_flash_message("error", "Mot de passe incorrect !", FLASH_ERROR);
                $this->LoginView();
            }
        } else {
            create_flash_message("error", "Email introuvable !", FLASH_ERROR);

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
