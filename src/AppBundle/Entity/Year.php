<?php

namespace AppBundle\Entity;
/*chemin permettant d'identifier cette classe et permet de l'utiliser plus tard*/

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
/* utilisation dans le fichier de la classe mapping
'as' permet d'utiliser @ORM au lieu d'@Mapping, le nom de la classe*/


/**
 * @ORM\Entity
 * @ORM\Table(name="year")
 *
 * !!!!!!!voir l'appel au repository pour les fcts en read supplémentaires (ex:recherche d'un nom  !!!!!
 *
 */

/* la classe article est une entité qui vient travailler avec la table de la bdd identifié Year (son miroir)*/
class Year{

    public function __construct()
    {
        $this->wine_castle = new ArrayCollection();
        $this->cellaring_potential = new ArrayCollection();
        $this->advice_guide = new ArrayCollection();
    }

    /**
     * @var int
     *
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
     * @ORM\ManyToOne(targetEntity="cellaring_potential")
     */
    private $cellaring_potential;

    /**
     * @ORM\ManyToOne(targetEntity="advice_guide")
     */
    private $advice_guide;


    /**
     * @ORM\Column(type="string", length=4)
     */
    private $year;

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
    public function getWineCastle()
    {
        return $this->wine_castle;
    }

    /**
     * @param mixed $wine_castle
     */
    public function setWineCastle($wine_castle)
    {
        $this->wine_castle = $wine_castle;
    }

    /**
     * @return mixed
     */
    public function getCellaringPotential()
    {
        return $this->cellaring_potential;
    }

    /**
     * @param mixed $cellaring_potential
     */
    public function setCellaringPotential($cellaring_potential)
    {
        $this->cellaring_potential = $cellaring_potential;
    }

    /**
     * @return mixed
     */
    public function getAdviceGuide()
    {
        return $this->advice_guide;
    }

    /**
     * @param mixed $advice_guide
     */
    public function setAdviceGuide($advice_guide)
    {
        $this->advice_guide = $advice_guide;
    }

    /**
     * @return mixed
     */
    public function getYear()
    {
        return $this->year;
    }

    /**
     * @param mixed $year
     */
    public function setYear($year)
    {
        $this->year = $year;
    }

}