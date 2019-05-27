<?php

namespace AppBundle\Entity;
/*chemin permettant d'identifier cette classe et permet de l'utiliser plus tard*/

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
/* utilisation dans le fichier de la classe mapping
'as' permet d'utiliser @ORM au lieu d'@Mapping, le nom de la classe*/


/**
 * @ORM\Entity(repositoryClass="AppBundle\Repository\YearRepository")
 * @ORM\Table(name="year")
 *
 * !!!!!!!voir l'appel au repository pour les fcts en read supplémentaires (ex:recherche d'un nom  !!!!!
 *
 */

/* la classe article est une entité qui vient travailler avec la table de la bdd identifié YearOld (son miroir)*/
class YearOld{

    public function __construct()
    {
        $this->wineCastle = new ArrayCollection();
        $this->awardGuide = new ArrayCollection();
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
     * @ORM\ManyToOne(targetEntity="WineCastle")
     */
    private $wineCastle;

    /**
     * @ORM\Column(type="integer", length=2, nullable=true)
     * @Assert\Range(
     *      min = 0,
     *      max = 50,
     *      minMessage = "minimum {{ limit }} années",
     *      maxMessage = "maximum {{ limit }} années",
     *      invalidMessage = "Number doit être entre 0 et 50 années"
     * )
     */
    private $cellaringPotentialMin;

    /**
     * @ORM\Column(type="integer", length=2, nullable=true)
     * @Assert\Range(
     *      min = 1,
     *      max = 50,
     *      minMessage = "minimum {{ limit }} années",
     *      maxMessage = "maximum {{ limit }} années",
     *      invalidMessage = "Number doit être entre 1 et 50 années"
     * )
     */
    private $cellaringPotentialMax;

    /**
     * @ORM\ManyToOne(targetEntity="AwardGuide")
     */
    private $awardGuide;

    /**
     * @ORM\Column(type="date", length=4)
     */
    private $year;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
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
        return $this->wineCastle;
    }

    /**
     * @param mixed $wineCastle
     */
    public function setWineCastle($wineCastle)
    {
        $this->wineCastle = $wineCastle;
    }

    /**
     * @return mixed
     */
    public function getCellaringPotentialMin()
    {
        return $this->cellaringPotentialMin;
    }

    /**
     * @param mixed $cellaringPotentialMin
     */
    public function setCellaringPotentialMin($cellaringPotentialMin)
    {
        $this->cellaringPotentialMin = $cellaringPotentialMin;
    }

    /**
     * @return mixed
     */
    public function getCellaringPotentialMax()
    {
        return $this->cellaringPotentialMax;
    }

    /**
     * @param mixed $cellaringPotentialMax
     */
    public function setCellaringPotentialMax($cellaringPotentialMax)
    {
        $this->cellaringPotentialMax = $cellaringPotentialMax;
    }

    /**
     * @return mixed
     */
    public function getAwardGuide()
    {
        return $this->awardGuide;
    }

    /**
     * @param mixed $awardGuide
     */
    public function setAwardGuide($awardGuide)
    {
        $this->awardGuide = $awardGuide;
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