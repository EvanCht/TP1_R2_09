<?php

namespace App\Controller;

use PDO;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ConnexionController extends AbstractController
{
    #[Route('/connexion', name: 'connexion', methods: ['GET'])]
    public function connexion(): Response
    {
        return $this->render('tp1_ex1_q1/connexion.html.twig');
    }

    #[Route('/verification', name: 'verification', methods: ['GET'])]
    public function verification(Request $request): Response
    {
        $login = $request->query->get('login');
        $motDePasse = $request->query->get('motDePasse');

        try {
            $bd = new PDO("mysql:host=127.0.0.1;dbname=bdd;charset=utf8", "root", "");
        } catch (\Exception $e) {
            die("Erreur : Connexion à la base impossible");
        }

        $sql = "SELECT * FROM informations_connexions 
                WHERE login = '$login' AND mot_de_passe = '$motDePasse'";

        $resultat = $bd->query($sql)->fetchAll();

        if (count($resultat) > 0) {
            return $this->render('tp1_ex1_q1/bonjour.html.twig', [
                'login' => $login,
            ]);
        }

        return $this->render('tp1_ex1_q1/connexion.html.twig', [
            'erreur' => 'Identifiants incorrects',
        ]);
    }
}