<?php

namespace App\Controller;

use App\Form\ModifierProfilType;
use App\Form\ParticipantType;
use App\Repository\ParticipantRepository;
use App\Entity\Participant;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;




/**
 * @Route("/participant", name="profil_")
 */



    class ProfilController extends AbstractController

    {
        /**
         * @Route("/detail", name="detail")
         */
        public function profil(): Response
        {
            //*       $participant = $participantRepository->findOneBy($this->getUser()->getId());
            $user = $this->getUser();

            return $this->render('main/profil/profil.html.twig', [
                "participant" => $user
            ]);
        }

        /**
         * @Route("/modifier", name="modifier"), methods={"GET", "POST"})
         */
        public function modifier(Request $request, EntityManagerInterface $entityManager, ParticipantRepository $participantRepository): Response

            {
                $user = $this->getUser(); // Obtient l'utilisateur connecté

            // Crée un formulaire en utilisant le FormBuilder

            $form = $this->createForm(ModifierProfilType::class, $user);

            // Traite la soumission du formulaire

            $form->handleRequest($request);
            if ($form->isSubmitted() && $form->isValid())
            {
                // Enregistre les modifications dans la base de données
                $entityManager->flush();

                // Redirige vers une page de confirmation ou ailleurs
                return $this->redirectToRoute('profil_detail');
            }

            return $this->render('main/profil/editprofil.html.twig', [
                'ModifierProfil' => $form->createView(),
            ]);

        }


        /**
         * @Route("/{id}/delete", name="delete", methods={"GET"})
         */
        public function delete(Request $request, int $id, ParticipantRepository $participantRepository): Response
        {
            $participant = $participantRepository->find($id);

            $participantRepository->remove($participant, true);

            $this->addFlash('sup', 'Votre compte a bien été supprimée');

            return $this->render('main/accueil.html.twig', [

            ]);
        }
    }








