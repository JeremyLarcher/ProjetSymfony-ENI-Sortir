<?php

namespace App\Controller;

use App\Entity\Sortie;
use App\Form\SortiesType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SortieController extends AbstractController
{
    /**
     * @Route("/sortie/creer", name="sortie_creer")
     */
    public function creersortie(Request $request, EntityManagerInterface $entityManager):Response
    {

        $sortie = new Sortie();

        $SortiesType = $this->createForm(SortiesType::class, $sortie);

        $SortiesType->handleRequest($request);
        
        if ($SortiesType->isSubmitted()) { 
            $sortie->setEtat("en cours");
          /*  $sortie->setEtatSortie(0);*/
            $sortie->setMotifAnnulation("neant");
         /*   $sortie->setparticipants("néant");*/
            $sortie->setOrganisateur($user= $this->getUser());
      /*      $sortie->setCampusOrganisateur(1);*/ /*RECUP CODE CAMPUS A AJOUTER*/

            $entityManager->persist($sortie);
            $entityManager->flush();

            $this->addFlash('success', 'Sortie ajoutée avec succès !');
            return $this->redirectToRoute('sortie_affichersortie');
        }


        return $this->render('creersortie.html.twig',[
            'SortiesType'=>$SortiesType->createView()
        ]);
    }


    /**
     * @Route("/sortie/affichersortie", name="sortie_affichersortie")
     */
    public function affichersortie(): Response
    {
        return $this->render('sortie/affichersortie.html.twig', [

        ]);
    }



}


/* to do:   ajouter l'enregistrement des données de sortie créé en BDD
            Le campus organisateur s'ajoute automatiquement en fonction du campus associé à l'utilisateur et s'affiche dans un champ sans pouvoir être changé, j'ai passé 2h dessus trop chaud
            C'est fait : la sélection du lieu se fait sous forme d'un menu déroulant en fonction de ce qui est dans la BDD,
            Rue et code postal vienne s'insérer automatiquement suite au choix fait
            C'est fait : Ajouter la possibilité de créé un nouveau lieu si celui souhaité n'est pas dans la liste.
            Ajouter le status "crée" automatiquement à la création d'une sortie (il sera modifiable plus tard par l'organisateur)
            Ajouter automatiquement à la création de la sortie l'id de l'organisateur dans le champ organisateur id
            C'est fait : La durée se donne en minute sous forme de chiffre (pas de string)
            C'est fait : La description de sortie et sous forme de textarea pour voir ce que l'on écrit dedans.
            Le fichier twig lié au sortie doit être dans le dossier sortie dans template
*/