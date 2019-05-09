<?php

namespace AppBundle\Entity;
/*chemin permettant d'identifier cette classe et permet de l'utiliser plus tard*/

use Doctrine\ORM\Mapping as ORM;
/* utilisation dans le fichier de la classe mapping
'as' permet d'utiliser @ORM au lieu d'@Mapping, le nom de la classe*/


/**
 * @ORM\Entity
 * @ORM\Table(name="events")
 * !!!!!!!voir l'appel au repository pour les fcts en read supplémentaires (ex:recherche d'un nom  !!!!!
 */

/* la classe article est une entité qui vient travailler avec la table de la bdd identifié Events (son miroir)*/
class Events
{
    /**
     * Ce bout de code sera toujours le même pour chaque entité
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=250)
     */
    private $alias;

    /**
     * @ORM\Column(type="boolean")
     */
    private $display;

    /**
     * @ORM\Column(type="date")
     */
    private $strating_date;

    /**
     * @ORM\Column(type="date")
     */
    private $end_date;

    /**
     * @ORM\Column(type="string", length=250)
     */
    private $address1_events;

    /**
     * @ORM\Column(type="string", length=250, nullable=true)
     */
    private $address2_events;


    /**
     * @ORM\Column(type="integer", length=5, nullable=true)
     */
    private $cp_events;

    /**
     * @ORM\Column(type="string", length=150)
     */
    private $town_events;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $phone_events;

    /**
     * @ORM\Column(type="string", length=150, nullable=true)
     */
    private $mail_events;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $comment_events;

}
