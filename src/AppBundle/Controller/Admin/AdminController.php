<?php

namespace AppBundle\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Events;
use AppBundle\Form\EventsType;


class AdminEventsController extends Controller
{
    /**
     * Création d'une route pour afficher mes évenements  de l'entité 'events'
     * qui est un miroir de notre base de donnée mysaql
     *
     * @Route("/admin/events", name="admin_events_list")
     *
     */
    public function eventsListAction()
    {
        //je veux fécuperer le contenu de la table events, je récupèretous les éléments
        $events = $this
            -> getDoctrine()//on appelle la méthode Doctrine
            ->getRepository(Events::class)//on récupère le répertoire où on lui a indiqué le nom de l'entité
            ->findAll();//méthode pour chercher tous les éléments

        return $this->render(
            'admin/events_list.html.twig',//on renvoie sur la vue twig désiré
            ['events' => $events]//et on y injecte le résultat de la requête
        );
    }

    /**
     * route pour suppression d'un events
     * @Route("/admin/events/delete/{id}", name="admin_events_delete")
     */
    public function libraryEventsDeleteAction($id){
        $eventtxt = $event = $this
            ->getDoctrine()
            ->getRepository(Events::Class)
            ->find($id);        //find ne cherche que par les id.
        /*var_dump($event);die;*/

        $entityManager=$this->getDoctrine()->getManager();
        $entityManager->remove($event);
        $entityManager->flush();

        $eventtxt = $eventtxt->getalias();

        // Message indiquant que le changement a été effectué
        $this->addFlash(
            'notice',
            'Evênement '.$eventtxt. ' effacé!'
        );

        return $this->redirectToRoute('admin_events_list');
    }

    /**
     *  UPDATE de l'affichage de l'events pour le rendre visible (modification du display, 1 pour visible, 0 pour masquer)
     * @Route("/admin/events/event_update_visible/{id}", name="admin_event_update_visible")
     */
    public function eventUpdateVisibleAction(Request $request, $id)
    {
    // On récupère l'event cliqué qui a été envoyé dans la wildcard par son id.
        $eventtxt = $event = $this
            ->getDoctrine()
            ->getRepository(Events::Class)
            ->find($id);        //find ne cherche que par les id.
        //var_dump($event);die;

        //On modifie la valeur du champ display en le mettant en true pour qu'il s'affiche
        $event->setDisplay(true);
        // On récupère l'EntityManager
        $em = $this->getDoctrine()->getManager();
        // On « persiste » l'entité
        $em->persist($event);
        //On « flush » tout ce qui a été persisté avant
        $em->flush();

        // Message indiquant que le changement a été effectué
        $eventtxt = $eventtxt->getalias();
        $this->addFlash(
            'notice',
            'Evênement '.$eventtxt. ' rendu visible!'
        );

            return $this->redirectToRoute('admin_events_list');
    }
    /**
     *  UPDATE de l'affichage de l'events pour le rendre invisible (modification du display, 1 pour visible, 0 pour masquer)
     * @Route("/admin/events/event_update_invisible/{id}", name="admin_event_update_invisible")
     */
    public function eventUpdateInvisibleAction(Request $request, $id)
    {
        // On récupère l'event cliqué qui a été envoyé dans la wildcard par son id.
        $eventtxt = $event = $this
            ->getDoctrine()
            ->getRepository(Events::Class)
            ->find($id);        //find ne cherche que par les id.
        //var_dump($event);die;

        //On modifie la valeur du champ display en le mettant en true pour qu'il s'affiche
        $event->setDisplay(false);
        // On récupère l'EntityManager
        $em = $this->getDoctrine()->getManager();
        // On « persiste » l'entité
        $em->persist($event);
        //On « flush » tout ce qui a été persisté avant
        $em->flush();

        // Message indiquant que le changement a été effectué
        $eventtxt = $eventtxt->getalias();
        $this->addFlash(
            'notice',
            'Evênement ' .$eventtxt.  ' masqué!'
        );

        return $this->redirectToRoute('admin_events_list');
    }

    /**
     * @Route("/admin/event_create_form", name="admin_event_create_form")
     */
    public function eventCreateFormAction(Request $request){
        $eventtxt = $event = new Events;
        // création du gabarit de formulaire en utilisant la classe AuteurType
        // générée par la ligne de commande generate:doctrine:form AppBundle:Auteur
        $eventForm = $this->createForm(EventsType::class, $event );
        // utilisation du gabarit de formulaire pour créer une vue du formulaire
        // à envoyer dans le fichier twig
        //$auteurFormView = $auteurForm->createView();

        $eventForm->handleRequest($request);

        if ($eventForm->isSubmitted() && $eventForm->isValid()){

            $event=$eventForm->getData();  // non indispensable, symfony le fait automatiquement mais mieux pour la lisibilité
            $entityManager=$this->getDoctrine()->getManager();
            $entityManager->persist($event);
            $entityManager->flush();

            $eventtxt = $eventtxt->getalias();
            $this->addFlash(
                'notice',
                'Nouvel Evênement ' .$eventtxt.  ' créé!'
            );

            return $this -> redirectToRoute(
                'admin_events_list');
        }

        return $this->render(
            'admin/events_create_form.html.twig',
            [
                'eventsFormView' => $eventForm->createView()
            ]
        );
    }

    /**
     *  UPDATE d'un evenement déja créé
     * @Route("/admin/event_update_form/{id}", name="admin_event_update_form")
     */
    public function eventUpdateFormAction(Request $request, $id)
    {
        $eventtxt = $event = new Events;
        //d'abord je récupère l'élément que nous voulons dans l'entité
        $eventRepository = $this->getDoctrine()->getRepository(Events::Class);
        $event = $eventRepository->find($id);


        $eventForm = $this->createForm(EventsType::class, $event);

        $eventForm->handleRequest($request);

        if ($eventForm->isSubmitted() && $eventForm->isValid()) {


            $event = $eventForm->getData();  // non indispensable, symfony le fait automatiquement mais mieux pour la lisibilité
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($event);
            $entityManager->flush();

            $eventtxt = $eventtxt->getalias();
            $this->addFlash(
                'notice',
                'Evênement ' . $eventtxt . ' modifié!'
            );

            return $this->redirectToRoute(
                'admin_events_list');
        }
        return $this->render(
            'admin/events_create_form.html.twig',
            [
                'eventsFormView' => $eventForm->createView()
            ]
        );
    }




}