<?php


namespace AppBundle\Entity;

/*chemin permettant d'identifier cette classe et permet de l'utiliser plus tard*/

use Doctrine\ORM\Mapping as ORM;
/* utilisation dans le fichier de la classe mapping
'as' permet d'utiliser @ORM au lieu d'@Mapping, le nom de la classe*/


/**
 * @ORM\Entity
 * @ORM\Table(name="Cellaring_potential")
 *
 * !!!!!!!voir l'appel au repository pour les fcts en read supplémentaires (ex:recherche d'un nom  !!!!!
 */

/* la classe article est une entité qui vient travailler avec la table de la bdd identifié Cellaring_potential (son miroir)*/
class Cellaring_potential{

    /**
     * Ce bout de code sera toujours le même pour chaque entité
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(type="integer", length=3, nullable=true)
     */
    private $cellaring_potential_min;

    /**
     * @ORM\Column(type="integer", length=3, nullable=true)
     */
    private $cellaring_potential_max;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getCellaringPotentialMin()
    {
        return $this->cellaring_potential_min;
    }

    /**
     * @param mixed $cellaring_potential_min
     */
    public function setCellaringPotentialMin($cellaring_potential_min)
    {
        $this->cellaring_potential_min = $cellaring_potential_min;
    }

    /**
     * @return mixed
     */
    public function getCellaringPotentialMax()
    {
        return $this->cellaring_potential_max;
    }

    /**
     * @param mixed $cellaring_potential_max
     */
    public function setCellaringPotentialMax($cellaring_potential_max)
    {
        $this->cellaring_potential_max = $cellaring_potential_max;
    }



}