<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use DateTime;

class DSA1exQ3Controller extends AbstractController
{
    #[Route('/dsa1ex/q3', name: 'app_dsa1ex_q3')]
    public function index(Request $request): Response
    {
        $submitted = false;
        $civilite = '';
        $nom = '';
        $prenom = '';
        $dateInscription = '';
        $message = '';
        $annees = 0;
        $reduction = 0;
        
        // Traitement du formulaire si soumis
        if ($request->isMethod('POST')) {
            $submitted = true;
            $civilite = $request->request->get('civilite');
            $nom = $request->request->get('nom');
            $prenom = $request->request->get('prenom');
            $dateInscription = $request->request->get('dateInscription');
            
            // Calculer le nombre d'années depuis l'inscription
            $dateInsc = new DateTime($dateInscription);
            $dateActuelle = new DateTime();
            $diff = $dateActuelle->diff($dateInsc);
            $annees = $diff->y;
            
            // Déterminer la réduction en fonction de l'ancienneté
            if ($annees >= 8) {
                $reduction = 20;
            } else {
                $reduction = 5;
            }
            
            // Construire le message personnalisé avec la civilité
            $message = "Vous êtes $civilite $nom $prenom, bienvenu" . ($civilite === 'Mme' ? 'e' : '') . ", ";
            $message .= "vous êtes inscrit" . ($civilite === 'Mme' ? 'e' : '') . " depuis $annees années, ";
            $message .= "vous aurez droit le mois prochain à une réduction de votre abonnement ($reduction% !!!!)";
        }
        
        return $this->render('dsa1ex_q3/index.html.twig', [
            'submitted' => $submitted,
            'civilite' => $civilite,
            'nom' => $nom,
            'prenom' => $prenom,
            'dateInscription' => $dateInscription,
            'message' => $message,
            'annees' => $annees,
            'reduction' => $reduction,
        ]);
    }
}
