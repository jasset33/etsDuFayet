<?php

namespace AppBundle\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Proportion;
use AppBundle\Form\ProportionType;


class AdminProportionEncepagementController extends Controller
{
    /**
     * Création d'une route pour afficher mes éléments  de l'entité 'Proportion'
     * qui est un miroir de notre base de donnée mysaql
     *
     * @Route("/admin/proportion_encepagement", name="admin_proportion_encepagement_list")
     *
     */
    public function proportionEncepagementListAction()
    {
        //je veux fécuperer le contenu de la table awardguide, je récupère tous les éléments
        $proportionEncepagements = $this
            ->getDoctrine()//on appelle la méthode Doctrine
            ->getRepository(Proportion::class)//on récupère le répertoire où on lui a indiqué le nom de l'entité
            ->findAll();//méthode pour chercher tous les éléments

        return $this->render(
            'admin/proportion_encepagement_list.html.twig',//on renvoie sur la vue twig désiré
            ['proportionEncepagements' => $proportionEncepagements]//et on y injecte le résultat de la requête
        );
    }

    /**
     * @Route("/admin/proportion_encepagement_create_form", name="admin_proportion_encepagement_create_form")
     */
    public function proportionEncepagementCreateFormAction(Request $request)
        {
        $proportionEncepagement = new Proportion();
        // création du gabarit de formulaire en utilisant la classe ProportionType
        // générée par la ligne de commande generate:doctrine:form AppBundle:Proportion
        $proportionEncepagementForm = $this->createForm(ProportionType::class, $proportionEncepagement );
        // utilisation du gabarit de formulaire pour créer une vue du formulaire
        // à envoyer dans le fichier twig

        $proportionEncepagementForm->handleRequest($request);

    if ($proportionEncepagementForm->isSubmitted() && $proportionEncepagementForm->isValid()){

        $proportionEncepagement = $proportionEncepagementForm->getData();  // non indispensable, symfony le fait automatiquement mais mieux pour la lisibilité
        $entityManager=$this->getDoctrine()->getManager();
        $entityManager->persist($proportionEncepagement);
        $entityManager->flush();

        $this->addFlash(
            'notice',
            'Conseil créé!'
        );

        return $this -> redirectToRoute(
            'admin_proportion_encepagement_list');
    }

    return $this->render(
        'admin/proportion_encepagement_create_form.html.twig',
        [
            'proportionEncepagementFormView' => $proportionEncepagementForm->createView()
        ]
        );
    }
    /**
     *  UPDATE d'un proportionEncepagement déja créé
     * @Route("/admin/proportio_encepagement_update_form/{id}", name="admin_proportio_encepagement_update_form")
     */
    public function proportionEncepagementUpdateFormAction(Request $request, $id)
    {
        $proportionEncepagement = new Proportion;
        //d'abord je récupère l'élément que nous voulons dans l'entité
        $guideRepository = $this->getDoctrine()->getRepository(Proportion::Class);
        $proportionEncepagement = $guideRepository->find($id);


        $proportionEncepagementForm = $this->createForm(ProportionType::class, $proportionEncepagement);

        $proportionEncepagementForm->handleRequest($request);

        if ($proportionEncepagementForm->isSubmitted() && $proportionEncepagementForm->isValid()) {

            $proportionEncepagement = $proportionEncepagementForm->getData();  // non indispensable, symfony le fait automatiquement mais mieux pour la lisibilité
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($proportionEncepagement);
            $entityManager->flush();

            $this->addFlash(
                'notice',
                'Conseil modifié!'
            );

            return $this->redirectToRoute(
                'admin_proportion_encepagement_list');
        }
        return $this->render(
            'admin/proportion_encepagement_create_form.html.twig',
            [
                'proportionEncepagementFormView' => $proportionEncepagementForm->createView()
            ]
        );
    }

    /**
     * route pour suppression d'un ProportionEncepagement
     * @Route("/admin/proportion_encepagement/delete/{id}", name="admin_proportion_encepagement_delete")
     */
    public function proportionEncepagementDeleteAction($id){
        $proportionEncepagement = $this
            ->getDoctrine()
            ->getRepository(Proportion::Class)
            ->find($id);        //find ne cherche que par les id.

        $entityManager=$this->getDoctrine()->getManager();
        $entityManager->remove($proportionEncepagement);
        $entityManager->flush();



        // Message indiquant que le changement a été effectué
        $this->addFlash(
            'notice',
            'Conseil effacée!'
        );

        return $this->redirectToRoute('admin_proportion_encepagement_list');
    }

    /**
     *  UPDATE de l'affichage d'un conseil pour le rendre visible (modification du display, 1 pour visible, 0 pour masquer)
     * @Route("/admin/proportion_encepagement/proportion_encepagement_update_visible/{id}", name="admin_proportion_encepagement_update_visible")
     */
    public function proportionEncepagementUpdateVisibleAction(Request $request, $id)
    {
        // On récupère le conseil cliqué qui a été envoyé dans la wildcard par son id.
        $proportionEncepagement = $this
            ->getDoctrine()
            ->getRepository(Proportion::Class)
            ->find($id);        //find ne cherche que par les id.

        //On modifie la valeur du champ display en le mettant en true pour qu'il s'affiche
        $proportionEncepagement->setDisplay(true);
        // On récupère l'EntityManager
        $em = $this->getDoctrine()->getManager();
        // On « persiste » l'entité
        $em->persist($proportionEncepagement);
        //On « flush » tout ce qui a été persisté avant
        $em->flush();

        // Message indiquant que le changement a été effectué

        $this->addFlash(
            'notice',
            'Conseil rendu visible!'
        );

        return $this->redirectToRoute('admin_proportion_encepagement_list');
    }
    /**
     *  UPDATE de l'affichage d'un conseil pour le rendre invisible (modification du display, 1 pour visible, 0 pour masquer)
     * @Route("/admin/proportion_encepagement/proportion_encepagement_update_invisible/{id}", name="admin_proportion_encepagement_update_invisible")
     */
    public function proportionEncepagementUpdateInvisibleAction(Request $request, $id)
    {
        // On récupère le conseil cliqué qui a été envoyé dans la wildcard par son id.
        $proportionEncepagement = $this
            ->getDoctrine()
            ->getRepository(Proportion::Class)
            ->find($id);        //find ne cherche que par les id.

        //On modifie la valeur du champ display en le mettant en true pour qu'il s'affiche
        $proportionEncepagement->setDisplay(false);
        // On récupère l'EntityManager
        $em = $this->getDoctrine()->getManager();
        // On « persiste » l'entité
        $em->persist($proportionEncepagement);
        //On « flush » tout ce qui a été persisté avant
        $em->flush();

        // Message indiquant que le changement a été effectué

        $this->addFlash(
            'notice',
            'Conseil masqué!'
        );

        return $this->redirectToRoute('admin_proportion_encepagement_list');
    }

}