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


class AdminGuideAwardController extends Controller
{
    /**
     * Création d'une route pour afficher mes éléments  de l'entité 'AwardGuide'
     * qui est un miroir de notre base de donnée mysaql
     *
     * @Route("/admin/guideaward", name="admin_guide_award_list")
     *
     */
    public function awardGuideListAction()
    {
        //je veux fécuperer le contenu de la table awardguide, je récupère tous les éléments
        $guideAwards = $this
            ->getDoctrine()//on appelle la méthode Doctrine
            ->getRepository(AwardGuide::class)//on récupère le répertoire où on lui a indiqué le nom de l'entité
            ->findAll();//méthode pour chercher tous les éléments

        return $this->render(
            'admin/guide_award_list.html.twig',//on renvoie sur la vue twig désiré
            ['guideAwards' => $guideAwards]//et on y injecte le résultat de la requête
        );
    }

    /**
     * @Route("/admin/guide_award_create_form", name="admin_guide_award_create_form")
     */
    public function guideAwardCreateFormAction(Request $request)
        {
        $guideAward = new AwardGuide();
        // création du gabarit de formulaire en utilisant la classe AwardGuideType
        // générée par la ligne de commande generate:doctrine:form AppBundle:AwardGuide
        $guideAwardForm = $this->createForm(AwardGuideType::class, $guideAward );
        // utilisation du gabarit de formulaire pour créer une vue du formulaire
        // à envoyer dans le fichier twig

        $guideAwardForm->handleRequest($request);

    if ($guideAwardForm->isSubmitted() && $guideAwardForm->isValid()){

        //On veut récupérer un fichier et enregistré l'indexation dans la bdd
        //je récupère l'image uploadé par l'utilisateur
        $guideAdwardLogo=$guideAward->getguideAwardLogo();
        if ($guideAdwardLogo ==! null ){
            // Je génère un nom unique, suivi de l'extension de mon image
            $guideAdwardLogoName=md5(uniqid()).'.'.$guideAdwardLogo->guessExtension();
            // Je déplace mon image dans un dossier en lui donnant
            // le nom unique que j'ai créé

            try {
                $guideAdwardLogo->move(
                    $this->getParameter('upload_guide_award_logo'), //sorte de variable globale à définir dans l'yml et disponible partout sinon on aurait mis '/assets/img/uploads/book/' pour les enregistrer dans web.
                    $guideAdwardLogoName
                );
                //s'il y a une erreur dans l'upload, j'affiche l'erreur
            } catch(FileException $e){
                throw new \Exception($e->getMessage());
            }
            //Je remets dans mon identité (qui sera sauvegardée en BDD).
            // Le nom de l'image qu'on a créée.
            $guideAward->setguideAwardLogo($guideAdwardLogoName);
        } else {
            $guideAward->setguideAwardLogo(null);
        }

        $guideAward = $guideAwardForm->getData();  // non indispensable, symfony le fait automatiquement mais mieux pour la lisibilité
        $entityManager=$this->getDoctrine()->getManager();
        $entityManager->persist($guideAward);
        $entityManager->flush();

        $this->addFlash(
            'notice',
            'Notation créé!'
        );

        return $this -> redirectToRoute(
            'admin_guide_award_list');
    }

    return $this->render(
        'admin/guide_award_create_form.html.twig',
        [
            'guideAwardFormView' => $guideAwardForm->createView()
        ]
        );
    }
    /**
     *  UPDATE d'un guideaward déja créé
     * @Route("/admin/guide_award_update_form/{id}", name="admin_guide_award_update_form")
     */
    public function guideAwardUpdateFormAction(Request $request, $id)
    {
        $guideAward = $guideAwardValue = new AwardGuide;
        //d'abord je récupère l'élément que nous voulons dans l'entité
        $guideRepository = $this->getDoctrine()->getRepository(AwardGuide::Class);
        $guideAward = $guideRepository->find($id);

//        Récupération de la valeur ajouté à $GuideAwardLogo et la rendre null si elle vaut 'no logo'
        $guideAwardValue = $guideAward->getGuideAwardLogo();

        if ($guideAwardValue ==! null){
            $oldguideAwardLogo = new File($this->getParameter('upload_guide_award_logo').$guideAward->getGuideAwardLogo());
            $guideAward->setGuideAwardLogo($oldguideAwardLogo);
           };


        $guideAwardForm = $this->createForm(AwardGuideType::class, $guideAward);

        $guideAwardForm->handleRequest($request);

        if ($guideAwardForm->isSubmitted() && $guideAwardForm->isValid()) {

            //On veut récupérer un fichier et enregistré l'indexation dans la bdd
            //je récupère l'image uploadé par l'utilisateur
            $guideAwardLogo=$guideAward->getGuideAwardLogo();
            if ($guideAwardLogo ==! null ){
                // Je génère un nom unique, suivi de l'extension de mon image
                $guideAwardLogoName=md5(uniqid()).'.'.$guideAwardLogo->guessExtension();
                // Je déplace mon image dans un dossier en lui donnant
                // le nom unique que j'ai créé

                try {
                    $guideAwardLogo->move(
                        $this->getParameter('upload_guide_award_logo'), //sorte de variable globale à définir dans l'yml et disponible partout sinon on aurait mis '/assets/img/uploads/book/' pour les enregistrer dans web.
                        $guideAwardLogoName
                    );
                    //s'il y a une erreur dans l'upload, j'affiche l'erreur
                } catch(FileException $e){
                    throw new \Exception($e->getMessage());
                }
                //Je remets dans mon identité (qui sera sauvegardée en BDD).
                // Le nom de l'image qu'on a créée.
                $guideAward->setGuideAwardLogo($guideAwardLogoName);
            } else {
                $guideAward->setGuideAwardLogo(NULL);
            }



            $guideAward = $guideAwardForm->getData();  // non indispensable, symfony le fait automatiquement mais mieux pour la lisibilité
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($guideAward);
            $entityManager->flush();

            $this->addFlash(
                'notice',
                'Notation modifiée!'
            );

            return $this->redirectToRoute(
                'admin_guide_award_list');
        }
        return $this->render(
            'admin/guide_award_create_form.html.twig',
            [
                'guideAwardFormView' => $guideAwardForm->createView()
            ]
        );
    }

    /**
     * route pour suppression d'un guide award
     * @Route("/admin/guideAward/delete/{id}", name="admin_guide_award_delete")
     */
    public function guideAwardDeleteAction($id){
        $guideAward = $this
            ->getDoctrine()
            ->getRepository(AwardGuide::Class)
            ->find($id);        //find ne cherche que par les id.

        $entityManager=$this->getDoctrine()->getManager();
        $entityManager->remove($guideAward);
        $entityManager->flush();



        // Message indiquant que le changement a été effectué
        $this->addFlash(
            'notice',
            'Notation effacée!'
        );

        return $this->redirectToRoute('admin_guide_award_list');
    }

    /**
     *  UPDATE de l'affichage d'une récompense pour le rendre visible (modification du display, 1 pour visible, 0 pour masquer)
     * @Route("/admin/guideAward/guide_award_update_visible/{id}", name="admin_guide_award_update_visible")
     */
    public function guideAwardUpdateVisibleAction(Request $request, $id)
    {
        // On récupère l'event cliqué qui a été envoyé dans la wildcard par son id.
        $guideAward = $this
            ->getDoctrine()
            ->getRepository(AwardGuide::Class)
            ->find($id);        //find ne cherche que par les id.

        //On modifie la valeur du champ display en le mettant en true pour qu'il s'affiche
        $guideAward->setDisplay(true);
        // On récupère l'EntityManager
        $em = $this->getDoctrine()->getManager();
        // On « persiste » l'entité
        $em->persist($guideAward);
        //On « flush » tout ce qui a été persisté avant
        $em->flush();

        // Message indiquant que le changement a été effectué

        $this->addFlash(
            'notice',
            'Notation rendue visible!'
        );

        return $this->redirectToRoute('admin_guide_award_list');
    }
    /**
     *  UPDATE de l'affichage d'une récompense pour le rendre invisible (modification du display, 1 pour visible, 0 pour masquer)
     * @Route("/admin/guideAward/guide_award_update_invisible/{id}", name="admin_guide_award_update_invisible")
     */
    public function guideAwardUpdateInvisibleAction(Request $request, $id)
    {
        // On récupère l'event cliqué qui a été envoyé dans la wildcard par son id.
        $guideAward = $this
            ->getDoctrine()
            ->getRepository(AwardGuide::Class)
            ->find($id);        //find ne cherche que par les id.

        //On modifie la valeur du champ display en le mettant en true pour qu'il s'affiche
        $guideAward->setDisplay(false);
        // On récupère l'EntityManager
        $em = $this->getDoctrine()->getManager();
        // On « persiste » l'entité
        $em->persist($guideAward);
        //On « flush » tout ce qui a été persisté avant
        $em->flush();

        // Message indiquant que le changement a été effectué

        $this->addFlash(
            'notice',
            'Notation masquée!'
        );

        return $this->redirectToRoute('admin_guide_award_list');
    }

}