<?php

namespace AppBundle\Entity;
/*chemin permettant d'identifier cette classe et permet de l'utiliser plus tard*/

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
/* utilisation dans le fichier de la classe mapping
'as' permet d'utiliser @ORM au lieu d'@Mapping, le nom de la classe*/


/**
 * @ORM\Entity
 * @ORM\Table(name="advice_guide")
 *
 * !!!!!!!voir l'appel au repository pour les fcts en read supplémentaires (ex:recherche d'un nom  !!!!!
 */

/* la classe article est une entité qui vient travailler avec la table de la bdd identifié Advice_guide (son miroir)*/
class AdviceGuide
{
    public function __construct()
    {
        $this->year = new ArrayCollection();
    }

    /**
     * Ce bout de code sera toujours le même pour chaque entité
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(type="boolean")
     */
    private $display = true;

    /**
     * @ORM\OneToOne(targetEntity=year::class)
     */
    private $year;

    /**
     * @ORM\Column(type="string", length=150)
     */
    private $guideNotation;

    /**
     * @ORM\Column(type="string", length=150)
     */
    private $guideAdwardLogo;

    /**
     * @ORM\Column(type="string", length=150)
     */
    private $commentAdvice;

    /**
     * @ORM\ManyToOne(targetEntity=Guide::class)
     */
    private $guide;

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

    /**
     * @return mixed
     */
    public function getDisplay()
    {
        return $this->display;
    }

    /**
     * @param mixed $display
     */
    public function setDisplay($display)
    {
        $this->display = $display;
    }

    /**
     * @return mixed
     */
    public function getGuideNotation()
    {
        return $this->guideNotation;
    }

    /**
     * @param mixed $guideNotation
     */
    public function setGuideNotation($guideNotation)
    {
        $this->guideNotation = $guideNotation;
    }

    /**
     * @return mixed
     */
    public function getGuideAdwardLogo()
    {
        return $this->guideAdwardLogo;
    }

    /**
     * @param mixed $guideAdwardLogo
     */
    public function setGuideAdwardLogo($guideAdwardLogo)
    {
        $this->guideAdwardLogo = $guideAdwardLogo;
    }

    /**
     * @return mixed
     */
    public function getCommentAdvice()
    {
        return $this->commentAdvice;
    }

    /**
     * @param mixed $commentAdvice
     */
    public function setCommentAdvice($commentAdvice)
    {
        $this->commentAdvice = $commentAdvice;
    }

    /**
     * @return mixed
     */
    public function getGuide()
    {
        return $this->guide;
    }

    /**
     * @param mixed $guide
     */
    public function setGuide($guide)
    {
        $this->guide = $guide;
    }


}
