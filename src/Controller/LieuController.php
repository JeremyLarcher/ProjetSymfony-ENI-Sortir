<?php

namespace App\Controller;

use App\Entity\Lieu;
use App\Form\LieuType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/lieu", name="lieu_")
 */
class LieuController extends AbstractController
{
    /**
     * @Route("/creer", name="creer")
     */
    public function creerLieu(Request $request, EntityManagerInterface $entityManager): Response
    {
        $lieu = new Lieu();
        $form = $this->createForm(LieuType::class, $lieu);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($lieu);
            $entityManager->flush();

            $this->addFlash('success','Lieu créé avec succès');

            return $this->redirectToRoute('sortie_creer');
        }


        return $this->render('lieu/creer.html.twig', [
            'lieuForm' => $form->createView(),
        ]);
    }
}
