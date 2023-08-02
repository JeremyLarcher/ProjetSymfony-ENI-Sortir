<?php

namespace App\Controller;

use App\Repository\ParticipantRepository;
use App\Entity\Participant;
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
     * @Route("/modifier", name="modifier")
     */
    public function modifier(): Response
    {
        //*       $participant = $participantRepository->findOneBy($this->getUser()->getId());
        $user = $this->getUser();

        return $this->render('main/profil/profil.html.twig', [
            "participant" => $user
        ]);
    }

    /**
     * @Route("/{id}/delete", name="delete", methods={"GET"})
     */
    public function delete(Request $request, int $id, ParticipantRepository $participantRepository): Response
    {
            $participant=$participantRepository->find($id);

            $participantRepository->remove($participant, true);

            $this->addFlash('sup', 'Votre compte a bien été supprimée');




        return $this->render('main/accueil.html.twig', [

        ]);
    }
}


