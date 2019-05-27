<?php

namespace AppBundle\Entity;
/*chemin permettant d'identifier cette classe et permet de l'utiliser plus tard*/

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
/* utilisation dans le fichier de la classe mapping
'as' permet d'utiliser @ORM au lieu d'@Mapping, le nom de la classe*/


/**
 * @ORM\Entity
 * @ORM\Table(name="award_guide")
 *
 * !!!!!!!voir l'appel au repository pour les fcts en read supplémentaires (ex:recherche d'un nom  !!!!!
 */

/* la classe article est une entité qui vient travailler avec la table de la bdd identifié Award_guide (son miroir)*/
class AwardGuide
{
    public function __construct()
    {
        $this->years = new ArrayCollection();
        $this->wineCastle = new ArrayCollection();
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
     * @ORM\ManyToOne(targetEntity=Years::class)
     */
    private $years;

    /**
     * @ORM\ManyToOne(targetEntity=WineCastle::class, inversedBy="awardGuide")
     */
    private $wineCastle;

    /**
     * @ORM\ManyToOne(targetEntity=Guide::class, inversedBy="awardGuide")
     */
    private $guide;

    /**
     * @ORM\Column(type="string", length=150, nullable=true)
     */
    private $guideNotation;

    /**
     * @ORM\Column(type="string", length=150, nullable=true)
     */
    private $guideAwardLogo;

    /**
     * @ORM\Column(type="string", length=150, nullable=true)
     */
    private $commentAward;

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
    public function getYears()
    {
        return $this->years;
    }

    /**
     * @param mixed $years
     */
    public function setYears($years)
    {
        $this->years = $years;
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
    public function getGuideAwardLogo()
    {
        return $this->guideAwardLogo;
    }

    /**
     * @param mixed $guideAwardLogo
     */
    public function setGuideAwardLogo($guideAwardLogo)
    {
        $this->guideAwardLogo = $guideAwardLogo;
    }

    /**
     * @return mixed
     */
    public function getCommentAward()
    {
        return $this->commentAward;
    }

    /**
     * @param mixed $commentAward
     */
    public function setCommentAward($commentAward)
    {
        $this->commentAward = $commentAward;
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
