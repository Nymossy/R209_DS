<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DSA1exQ2Controller extends AbstractController
{
    #[Route('/dsa1ex/q2', name: 'app_dsa1ex_q2')]
    public function index(): Response
    {
        $date = new \DateTime();
        $formatter = new \IntlDateFormatter('fr_FR', 
            \IntlDateFormatter::FULL, 
            \IntlDateFormatter::NONE,
            null,
            null,
            'EEEE d MMMM yyyy'
        );
        $formattedDate = $formatter->format($date);
        
        return $this->render('dsa1ex_q2/index.html.twig', [
            'date' => $formattedDate,
        ]);
    }
}
