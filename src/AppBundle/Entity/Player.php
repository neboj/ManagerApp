<?php
/**
 * Created by PhpStorm.
 * User: neboj
 * Date: 27/3/2018
 * Time: 00:49
 */

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
 * @ORM\Table(name="player")
 */
class Player
{
    const GOALIE='goalie';
    const DEFENDER ='defender';
    const MIDFIELDER = 'midfielder';
    const STRIKER = 'striker';


    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    private $id;

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
     * @ORM\Column(type="string")
     */
    private $name;
    /**
     *@ORM\Column(name="position", type="string", columnDefinition="enum('goalie', 'defender','midfielder','striker')")
     */
    private $position;
    /**
     * @ORM\Column(type="integer")
     */
    private $quality;

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
    public function getPosition()
    {
        return $this->position;
    }

    /**
     * @param mixed $position
     */
    public function setPosition($position)
    {
        if (!in_array($position, array(self::GOALIE, self::DEFENDER, self::MIDFIELDER,self::STRIKER))) {
            throw new \InvalidArgumentException("Invalid position");
        }
        $this->position = $position;
    }

    /**
     * @return mixed
     */
    public function getQuality()
    {
        return $this->quality;
    }

    /**
     * @param mixed $quality
     */
    public function setQuality($quality)
    {
        $this->quality = $quality;
    }

    /**
     * @return mixed
     */
    public function getSpeed()
    {
        return $this->speed;
    }

    /**
     * @param mixed $speed
     */
    public function setSpeed($speed)
    {
        $this->speed = $speed;
    }
    /**
     * @ORM\Column(type="integer")
     */
    private $speed;


}