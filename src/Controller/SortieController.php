<?php

namespace App\Controller;

use App\Entity\Sortie;
use App\Form\SortiesType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/sortie", name="sortie_")
 */
class SortieController extends AbstractController
{
    /**
     * @Route("/creer", name="creer")
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


/* to do:   ajouter l'enregistrement des données de sortie créé en BDD
            Le campus organisateur s'ajoute automatiquement en fonction du campus associé à l'utilisateur et s'affiche dans un champ sans pouvoir être changé, j'ai passé 2h dessus trop chaud
            la sélection du lieu se fait sous forme d'un menu déroulant en fonction de ce qui est dans la BDD, rue et code postal vienne s'insérer automatiquement suite au choix fait
            Ajouter la possibilité de créé un nouveau lieu si celui souhaité n'est pas dans la liste.
            Ajouter le status "crée" automatiquement à la création d'une sortie (il sera modifiable plus tard par l'organisateur)
            Ajouter automatiquement à la création de la sortie l'id de l'organisateur dans le champ organisateur id
            C'est fait : La durée se donne en minute sous forme de chiffre (pas de string)
            C'est fait : La description de sortie et sous forme de textarea pour voir ce que l'on écrit dedans.
            Le fichier twig lié au sortie doit être dans le dossier sortie dans template
*/