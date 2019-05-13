<?php

namespace AppBundle\Entity;
/*chemin permettant d'identifier cette classe et permet de l'utiliser plus tard*/

use Doctrine\ORM\Mapping as ORM;
/* utilisation dans le fichier de la classe mapping
'as' permet d'utiliser @ORM au lieu d'@Mapping, le nom de la classe*/


    /**
     * @ORM\Entity
     * @ORM\Table(name="wine_castle")
     *
     * !!!!!!!voir l'appel au repository pour les fcts en read supplémentaires (ex:recherche d'un nom  !!!!!
     */

/* la classe article est une entité qui vient travailler avec la table de la bdd identifié Wine_castle (son miroir)*/
class Wine_castle
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
    private $name_castle;

    /**
     * @ORM\Column(type="string", length=150)
     */
    private $address1_castle;

    /**
     * @ORM\Column(type="string", length=150)
     */
    private $address2_castle;


    /**
     * @ORM\Column(type="integer", length=5)
     */
    private $cp_castle;

    /**
     * @ORM\Column(type="string", length=150)
     */
    private $town_castle;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $phone_castle;

    /**
     * @ORM\Column(type="string", length=150)
     */
    private $mail_castle;

    /**
     * @ORM\Column(type="string", length=150)
     */
    private $aoc_castle;

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
    public function getNameCastle()
    {
        return $this->name_castle;
    }

    /**
     * @param mixed $name_castle
     */
    public function setNameCastle($name_castle)
    {
        $this->name_castle = $name_castle;
    }

    /**
     * @return mixed
     */
    public function getAddress1Castle()
    {
        return $this->address1_castle;
    }

    /**
     * @param mixed $address1_castle
     */
    public function setAddress1Castle($address1_castle)
    {
        $this->address1_castle = $address1_castle;
    }

    /**
     * @return mixed
     */
    public function getAddress2Castle()
    {
        return $this->address2_castle;
    }

    /**
     * @param mixed $address2_castle
     */
    public function setAddress2Castle($address2_castle)
    {
        $this->address2_castle = $address2_castle;
    }

    /**
     * @return mixed
     */
    public function getCpCastle()
    {
        return $this->cp_castle;
    }

    /**
     * @param mixed $cp_castle
     */
    public function setCpCastle($cp_castle)
    {
        $this->cp_castle = $cp_castle;
    }

    /**
     * @return mixed
     */
    public function getTownCastle()
    {
        return $this->town_castle;
    }

    /**
     * @param mixed $town_castle
     */
    public function setTownCastle($town_castle)
    {
        $this->town_castle = $town_castle;
    }

    /**
     * @return mixed
     */
    public function getPhoneCastle()
    {
        return $this->phone_castle;
    }

    /**
     * @param mixed $phone_castle
     */
    public function setPhoneCastle($phone_castle)
    {
        $this->phone_castle = $phone_castle;
    }

    /**
     * @return mixed
     */
    public function getMailCastle()
    {
        return $this->mail_castle;
    }

    /**
     * @param mixed $mail_castle
     */
    public function setMailCastle($mail_castle)
    {
        $this->mail_castle = $mail_castle;
    }

    /**
     * @return mixed
     */
    public function getAocCastle()
    {
        return $this->aoc_castle;
    }

    /**
     * @param mixed $aoc_castle
     */
    public function setAocCastle($aoc_castle)
    {
        $this->aoc_castle = $aoc_castle;
    }



}