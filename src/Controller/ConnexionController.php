<?php

namespace App\Controller;

use PDO;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ConnexionController extends AbstractController
{
    #[Route('/connexion', name: 'connexion')]
    public function connexion(): Response
    {
        return $this->render('tp1_ex1_q1/connexion.html.twig');
    }

    #[Route('/verification', name: 'verification', methods: ['POST'])]
    public function verification(Request $request): Response
    {
        $login = $request->request->get('login');
        $motDePasse = $request->request->get('motDePasse');

        try {
            $bd = new PDO("mysql:host=127.0.0.1;dbname=bdd;charset=utf8", "root", "");
        } catch (\Exception $e) {
            die("Erreur : Connexion à la base impossible");
        }

        $sql = "SELECT * FROM informations_connexions 
                WHERE login = '$login' AND mot_de_passe = '$motDePasse'";

        $reponse = $bd->query($sql);
        $resultat = $reponse->fetchAll();

        if (count($resultat) > 0) {
            return $this->render('tp1_ex1_q1/bonjour.html.twig', [
                'login' => $login,
            ]);
        }

        return new Response("Identifiants incorrects");
    }
}