<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class TP1Ex1Q1Controller extends AbstractController
{
    #[Route('/', name: 'tp1_ex1_q1')]
    public function index(): Response
    {
        $date = new \DateTime();

        return $this->render('tp1_ex1_q1/index.html.twig', [
            'date' => $date,
        ]);
    }
    #[Route('/tp1/ex1/q1/result', name: 'tp1_ex1_q1_result', methods: ['POST'])]
    public function result(Request $request): Response
    {
        $nom = $request->request->get('nom');
        $prenom = $request->request->get('prenom');
        $date = new \DateTime();

        return $this->render('tp1_ex1_q1/result.html.twig', [
            'nom' => $nom,
            'prenom' => $prenom,
            'date' => $date,
        ]);
    }
}