<?php

namespace App\Controller;

use App\Entity\Lieu;
use App\Entity\Ville;
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

            // Récupérer la ville sélectionnée dans le champ EntityType
            $ville = $form->get('ville')->getData();

            // Si une nouvelle ville est saisie dans le champ VilleType imbriqué
            $nouvelleVille = $form->get('nouvelleVille')->getData();
            if ($nouvelleVille !== null && !empty($nouvelleVille->getNom()) && !empty($nouvelleVille->getCodePostal())) {
                // Créer une nouvelle instance de l'entité Ville
                $ville = new Ville();
                $ville->setNom($nouvelleVille->getNom());
                $ville->setCodePostal($nouvelleVille->getCodePostal());

                // Sauvegarder la nouvelle ville dans la base de données

                $entityManager->persist($ville);
                $entityManager->flush();
            }

            // Associer la ville sélectionnée ou nouvellement créée à l'entité Lieu
            $lieu->setVille($ville);

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
