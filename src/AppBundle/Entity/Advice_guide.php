<?php

namespace AppBundle\Entity;
/*chemin permettant d'identifier cette classe et permet de l'utiliser plus tard*/

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
class Advice_guide
{
    /**
     * Ce bout de code sera toujours le même pour chaque entité
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=150)
     */
    private $guide_notation;

    /**
     * @ORM\Column(type="string", length=150)
     */
    private $guide_adward_logo;

    /**
     * @ORM\Column(type="string", length=150)
     */
    private $comment_advice;

    /**
     * Liaison entre 2 tables unidirectionnelle (depuis les book, on peut récupérer l'auteur).
     * Many to one parce qu'un book peut avoir plusieurs auteurs
     * @ORM\OneToOne(targetEntity="Guide")
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
    public function getGuideNotation()
    {
        return $this->guide_notation;
    }

    /**
     * @param mixed $guide_notation
     */
    public function setGuideNotation($guide_notation)
    {
        $this->guide_notation = $guide_notation;
    }

    /**
     * @return mixed
     */
    public function getGuideAdwardLogo()
    {
        return $this->guide_adward_logo;
    }

    /**
     * @param mixed $guide_adward_logo
     */
    public function setGuideAdwardLogo($guide_adward_logo)
    {
        $this->guide_adward_logo = $guide_adward_logo;
    }

    /**
     * @return mixed
     */
    public function getCommentAdvice()
    {
        return $this->comment_advice;
    }

    /**
     * @param mixed $comment_advice
     */
    public function setCommentAdvice($comment_advice)
    {
        $this->comment_advice = $comment_advice;
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