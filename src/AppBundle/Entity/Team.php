<?php
/**
 * Created by PhpStorm.
 * User: neboj
 * Date: 26/3/2018
 * Time: 23:41
 */

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
 * @ORM\Table(name="team")
 */
class Team
{
    const f442='4-4-2 (Hug the Touchline)';
    const f541 ='5-4-1 (Defensive)';
    const f343 = '3-4-3 (Offensive)';
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    private $id;
    /**
     * @ORM\Column(type="string")
     */
    private $name;
    /**
     * @ORM\Column(type="float")
     */
    private $rank;

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
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getRank()
    {
        return $this->rank;
    }

    /**
     * @param mixed $rank
     */
    public function setRank($rank)
    {
        $this->rank = $rank;
    }

    /**
     *@ORM\Column(name="formation", type="string", columnDefinition="enum('f442','f541','f343')")
     */
    private $formation;

    /**
     * @return mixed
     */
    public function getFormation()
    {
        return $this->formation;
    }

    /**
     * @param mixed $formation
     */
    public function setFormation($formation)
    {
        if (!in_array($formation, array(self::f442,self::f343,self::f541))) {
            throw new \InvalidArgumentException("Invalid formation");
        }
        $this->formation = $formation;
    }

}