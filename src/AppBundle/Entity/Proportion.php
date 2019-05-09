<?php

namespace AppBundle\Entity;
/*chemin permettant d'identifier cette classe et permet de l'utiliser plus tard*/

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
/* utilisation dans le fichier de la classe mapping
'as' permet d'utiliser @ORM au lieu d'@Mapping, le nom de la classe*/


/**
 * @ORM\Entity
 * @ORM\Table(name="proportion")
 * !!!!!!!voir l'appel au repository pour les fcts en read supplémentaires (ex:recherche d'un nom  !!!!!
 */

/* la classe article est une entité qui vient travailler avec la table de la bdd identifié Proportion (son miroir)*/
class Proportion{

    public function __construct()
    {
        $this->wine_castle = new ArrayCollection();
        $this->encepagement = new ArrayCollection();
    }

    /**
     * Ce bout de code sera toujours le même pour chaque entité
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="Wine_castle")
     */
    private $wine_castle;

    /**
     * @ORM\ManyToOne(targetEntity="Encepagement")
     */
    private $encepagement;

    /**
     * @ORM\Column(type="integer", length=3)
     */
    private $percent;

}