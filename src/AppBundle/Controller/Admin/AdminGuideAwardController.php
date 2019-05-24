<?php

namespace AppBundle\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\AwardGuide;
use AppBundle\Form\AwardGuideType;


class AdminAwardGuideController extends Controller
{
    /**
     * Création d'une route pour afficher mes évenements  de l'entité 'Guide'
     * qui est un miroir de notre base de donnée mysaql
     *
     * @Route("/admin/awardguide", name="admin_award_guide_list")
     *
     */
    public function awardGuideListAction()
    {
        //je veux fécuperer le contenu de la table awardguide, je récupère tous les éléments
        $awardguides = $this
            -> getDoctrine()//on appelle la méthode Doctrine
            ->getRepository(AwardGuide::class)//on récupère le répertoire où on lui a indiqué le nom de l'entité
            ->findAll();//méthode pour chercher tous les éléments

        return $this->render(
            'admin/award_guide_list.html.twig',//on renvoie sur la vue twig désiré
            ['awardguides' => $awardguides]//et on y injecte le résultat de la requête
        );

        /**
         * @Route("/admin/awardguide_create_form", name="admin_award_guide_create_form")
         */
        public function awardGuideCreateFormAction(Request $request){
        $awardGuidetxt = $awardGuide = new AwardGuide();
        // création du gabarit de formulaire en utilisant la classe AwardGuideType
        // générée par la ligne de commande generate:doctrine:form AppBundle:AwardGuide
        $awardGuideForm = $this->createForm(AwardGuideType::class, $awardGuide );
        // utilisation du gabarit de formulaire pour créer une vue du formulaire
        // à envoyer dans le fichier twig

        $awardGuideForm->handleRequest($request);

        if ($guideForm->isSubmitted() && $guideForm->isValid()){

            //On veut récupérer un fichier et enregistré l'indexation dans la bdd
            //je récupère l'image uploadé par l'utilisateur
            $guideLogo=$guide->getguideLogo();
            if ($guideLogo ==! null ){
                // Je génère un nom unique, suivi de l'extension de mon image
                $guideLogoName=md5(uniqid()).'.'.$guideLogo->guessExtension();
                // Je déplace mon image dans un dossier en lui donnant
                // le nom unique que j'ai créé

                try {
                    $guideLogo->move(
                        $this->getParameter('upload_guide_logo'), //sorte de variable globale à définir dans l'yml et disponible partout sinon on aurait mis '/assets/img/uploads/book/' pour les enregistrer dans web.
                        $guideLogoName
                    );
                    //s'il y a une erreur dans l'upload, j'affiche l'erreur
                } catch(FileException $e){
                    throw new \Exception($e->getMessage());
                }
                //Je remets dans mon identité (qui sera sauvegardée en BDD).
                // Le nom de l'image qu'on a créée.
                $guide->setguideLogo($guideLogoName);
            } else {
                $guide->setguideLogo('no logo');
            }

            $guidetxt = $guide = $guideForm->getData();  // non indispensable, symfony le fait automatiquement mais mieux pour la lisibilité
            $entityManager=$this->getDoctrine()->getManager();
            $entityManager->persist($guide);
            $entityManager->flush();

            $guidetxt = $guidetxt->getguideName();
            $this->addFlash(
                'notice',
                'Guide "' .$guidetxt. '" créé!'
            );

            return $this -> redirectToRoute(
                'admin_guide_list');
        }

        return $this->render(
            'admin/guide_create_form.html.twig',
            [
                'guideFormView' => $guideForm->createView()
            ]
        );
    }

    }

}