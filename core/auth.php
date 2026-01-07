<?php
    class auth{
        private User $userModel;

        public function __construct(){
            Session::start();
            $this->userModel= new User();
        }
        
        public function login(string $email , string $psw){
            $user = $this->userModel->findByEmail($email);
            
            if(!$user || !password_verify($psw , $user['mdpss'])){
                throw new Exception("Email ou mot de passe incorect");
            }
    
            Session::set('user',['id'=>$user['id'],'nom'=>$user['nom'],'prenom'=>$user['prenom'],'role'=>$user['roleUser']]);
    
            return true;
        }

        public function register(string $nom , string $prenom , string $email , string $password , string $role){
            $roleAllowed = ['admin', 'chef_projet' , 'membre'];
            if (!in_array($role , $roleAllowed)) {
                throw new Exception("Role invalide");
            }

            if($this->userModel->findByEmail($email)){
                throw new Exception("Email déja utilisé");
            }

            return $this->userModel->create($nom,$prenom,$email,$password,$role);
        }
    
        public static function logout(){
            Session::destroy();
            header("Location: login.php");
            exit;
        }
    
        public static function check(){
            return Session::get('user') !==null;
        }
    
        public static function user(){
            return Session::get('user');
        }
    }


?>