<?php

namespace App\Controller;

use App\Entity\Sortie;
use App\Form\SortiesType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SortieController extends AbstractController
{
    /**
     * @Route("/creersortie", name="creersortie")
     */
    public function creersortie(Request $request)
    {
        $sortie = new Sortie();
        $SortiesType = $this->createForm(SortiesType::class, $sortie);

        return $this->render('creersortie.html.twig',[
            'SortiesType'=>$SortiesType->createView()
        ]);
    }
}
