<?php
namespace Controllers;

use User;

class UserController extends Controller
{

    public function one($params)
    {
        $entityManager=$params["em"];
        $connectUser="Autre";
        
        $user = new User();
        $user->setName ("GAVERIAUX");
        $user->setFirstName ("Mathéa");
        $entityManager->persist($user);
        $entityManager->flush();
        echo $this->twig->render('data.html',['connectUser'=> $connectUser]);
    }
    public function list($params)
    {
        $em=$params["em"];
        $qb = $em->createQueryBuilder();
        $qb ->select('u')
            ->from('User', 'u');

        $query = $qb->getQuery();
        $users = $query->getResult();

        
        echo $this->twig->render('users.html', ['users' => $users]);

    }

    public function create($params){
        $em=$params["em"];
        
        echo $this->twig->render('create.html', ['users' => $em]);
    }

    public function insert($params){

	    if ($_SERVER["REQUEST_METHOD"] == "POST") {
		
            $nom = $_POST["user_nom"]; 
            $prenom = $_POST["user_prenom"];
            $motdepasse = $_POST["user_password"];

            $em=$params["em"];

            
            $newUser = new User($nom,$prenom,$motdepasse);  
           

            $em->persist($newUser);
            $em->flush();

            $result = $em->execute() ? "Le formulaire a bien été envoyé" : "Échec de l'envoi du formulaire";
            echo $result;
        }
    }

    public function edit($params){
        $id=$params["getParams"]["id"];
        $em=$params["em"];

        $user = $em->find('User', $id);
        echo $this->twig->render('edit.html', ['user' => $user]);
        
    }

    public function delete($params){
        $id=$params["getParams"]["id"];
        $em=$params["em"];

        $user = $em->find('User', $id);
        $em->remove($user);
        $em->flush();
    }
}
