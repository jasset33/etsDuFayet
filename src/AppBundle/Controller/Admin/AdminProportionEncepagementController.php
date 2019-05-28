<?php

namespace AppBundle\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Advice;
use AppBundle\Form\AdviceType;


class AdminAdviceController extends Controller
{
    /**
     * Création d'une route pour afficher mes éléments  de l'entité 'Advice'
     * qui est un miroir de notre base de donnée mysaql
     *
     * @Route("/admin/advice", name="admin_advice_list")
     *
     */
    public function adviceListAction()
    {
        //je veux fécuperer le contenu de la table awardguide, je récupère tous les éléments
        $advices = $this
            ->getDoctrine()//on appelle la méthode Doctrine
            ->getRepository(Advice::class)//on récupère le répertoire où on lui a indiqué le nom de l'entité
            ->findAll();//méthode pour chercher tous les éléments

        return $this->render(
            'admin/advice_list.html.twig',//on renvoie sur la vue twig désiré
            ['advices' => $advices]//et on y injecte le résultat de la requête
        );
    }

    /**
     * @Route("/admin/advice_create_form", name="admin_advice_create_form")
     */
    public function adviceCreateFormAction(Request $request)
        {
        $advice = new Advice();
        // création du gabarit de formulaire en utilisant la classe AdviceType
        // générée par la ligne de commande generate:doctrine:form AppBundle:Advice
        $adviceForm = $this->createForm(AdviceType::class, $advice );
        // utilisation du gabarit de formulaire pour créer une vue du formulaire
        // à envoyer dans le fichier twig

        $adviceForm->handleRequest($request);

    if ($adviceForm->isSubmitted() && $adviceForm->isValid()){

        $advice = $adviceForm->getData();  // non indispensable, symfony le fait automatiquement mais mieux pour la lisibilité
        $entityManager=$this->getDoctrine()->getManager();
        $entityManager->persist($advice);
        $entityManager->flush();

        $this->addFlash(
            'notice',
            'Conseil créé!'
        );

        return $this -> redirectToRoute(
            'admin_advice_list');
    }

    return $this->render(
        'admin/advice_create_form.html.twig',
        [
            'adviceFormView' => $adviceForm->createView()
        ]
        );
    }
    /**
     *  UPDATE d'un advice déja créé
     * @Route("/admin/advice_update_form/{id}", name="admin_advice_update_form")
     */
    public function adviceUpdateFormAction(Request $request, $id)
    {
        $advice = new Advice;
        //d'abord je récupère l'élément que nous voulons dans l'entité
        $guideRepository = $this->getDoctrine()->getRepository(Advice::Class);
        $advice = $guideRepository->find($id);


        $adviceForm = $this->createForm(AdviceType::class, $advice);

        $adviceForm->handleRequest($request);

        if ($adviceForm->isSubmitted() && $adviceForm->isValid()) {

            $advice = $adviceForm->getData();  // non indispensable, symfony le fait automatiquement mais mieux pour la lisibilité
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($advice);
            $entityManager->flush();

            $this->addFlash(
                'notice',
                'Conseil modifié!'
            );

            return $this->redirectToRoute(
                'admin_advice_list');
        }
        return $this->render(
            'admin/advice_create_form.html.twig',
            [
                'adviceFormView' => $adviceForm->createView()
            ]
        );
    }

    /**
     * route pour suppression d'un Advice
     * @Route("/admin/advice/delete/{id}", name="admin_advice_delete")
     */
    public function adviceDeleteAction($id){
        $advice = $this
            ->getDoctrine()
            ->getRepository(Advice::Class)
            ->find($id);        //find ne cherche que par les id.

        $entityManager=$this->getDoctrine()->getManager();
        $entityManager->remove($advice);
        $entityManager->flush();



        // Message indiquant que le changement a été effectué
        $this->addFlash(
            'notice',
            'Conseil effacée!'
        );

        return $this->redirectToRoute('admin_advice_list');
    }

    /**
     *  UPDATE de l'affichage d'un conseil pour le rendre visible (modification du display, 1 pour visible, 0 pour masquer)
     * @Route("/admin/advice/advice_update_visible/{id}", name="admin_advice_update_visible")
     */
    public function adviceUpdateVisibleAction(Request $request, $id)
    {
        // On récupère le conseil cliqué qui a été envoyé dans la wildcard par son id.
        $advice = $this
            ->getDoctrine()
            ->getRepository(Advice::Class)
            ->find($id);        //find ne cherche que par les id.

        //On modifie la valeur du champ display en le mettant en true pour qu'il s'affiche
        $advice->setDisplay(true);
        // On récupère l'EntityManager
        $em = $this->getDoctrine()->getManager();
        // On « persiste » l'entité
        $em->persist($advice);
        //On « flush » tout ce qui a été persisté avant
        $em->flush();

        // Message indiquant que le changement a été effectué

        $this->addFlash(
            'notice',
            'Conseil rendu visible!'
        );

        return $this->redirectToRoute('admin_advice_list');
    }
    /**
     *  UPDATE de l'affichage d'un conseil pour le rendre invisible (modification du display, 1 pour visible, 0 pour masquer)
     * @Route("/admin/advice/advice_update_invisible/{id}", name="admin_advice_update_invisible")
     */
    public function adviceUpdateInvisibleAction(Request $request, $id)
    {
        // On récupère le conseil cliqué qui a été envoyé dans la wildcard par son id.
        $advice = $this
            ->getDoctrine()
            ->getRepository(Advice::Class)
            ->find($id);        //find ne cherche que par les id.

        //On modifie la valeur du champ display en le mettant en true pour qu'il s'affiche
        $advice->setDisplay(false);
        // On récupère l'EntityManager
        $em = $this->getDoctrine()->getManager();
        // On « persiste » l'entité
        $em->persist($advice);
        //On « flush » tout ce qui a été persisté avant
        $em->flush();

        // Message indiquant que le changement a été effectué

        $this->addFlash(
            'notice',
            'Conseil masqué!'
        );

        return $this->redirectToRoute('admin_advice_list');
    }

}