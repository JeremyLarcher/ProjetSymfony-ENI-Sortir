<?php

namespace App\Controller;

use App\Repository\ParticipantRepository;
use App\Entity\Participant;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;





/**
 * @Route("/profil", name="profil_")
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
     * @Route("/delete", name="delete", methods={"DELETE"})
     */
    public function delete(): Response
    {
        return $this->render('main/profil/delete.html.twig', [

        ]);
    }
}


