<?php

namespace AppBundle\Controller\User;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\XXX;   //à faire
use AppBundle\Form\XXX; //à faire


class UserController extends Controller
{
    /**
     * Création d'une route pour afficher mes évenements  de l'entité 'events'
     * qui est un miroir de notre base de donnée mysaql
     *
     * @Route("/events", name="events_list")
     *
     */
    public function eventsListAction()
    {
        $events = $this
            -> getDoctrine()//on appelle la méthode Doctrine
            ->getRepository(Events::class)//on récupère le répertoire où on lui a indiqué le nom de l'entité
            ->findAll();//méthode pour chercher tous les éléments

        return $this->render(
            'admin/events_list.twig',//on renvoie sur la vue twig désiré
            ['events' => $events]//et on y injecte le résultat de la requête
        );
    }

}