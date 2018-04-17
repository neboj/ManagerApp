<?php
/**
 * Created by PhpStorm.
 * User: neboj
 * Date: 28/3/2018
 * Time: 23:29
 */

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;


/**
 * @ORM\Entity(repositoryClass="AppBundle\Repository\PlayerTeamRepository")
 * @ORM\Table(name="player_team")
 */
class PlayerTeam
{
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
     * @return mixed
     */
    public function getDateOfContract()
    {
        return $this->date_of_contract;
    }

    /**
     * @param mixed $date_of_contract
     */
    public function setDateOfContract($date_of_contract)
    {
        $this->date_of_contract = $date_of_contract;
    }

    /**
     * @return mixed
     */
    public function getPlayerId()
    {
        return $this->player_id;
    }

    /**
     * @param mixed $player_id
     */
    public function setPlayerId($player_id)
    {
        $this->player_id = $player_id;
    }

    /**
     * @return mixed
     */
    public function getTeamId()
    {
        return $this->team_id;
    }

    /**
     * @param mixed $team_id
     */
    public function setTeamId($team_id)
    {
        $this->team_id = $team_id;
    }
    /**
     * @ORM\Column(type="datetime")
     */
    private $date_of_contract;
    /**
     * @ORM\Column(type="integer")
     */
    private $player_id;
    /**
     * @ORM\Column(type="integer")
     */
    private $team_id;

    /**
     * @ORM\Column(type="boolean")
     */
    private $is_valid;

    /**
     * @return mixed
     */
    public function getIsValid()
    {
        return $this->is_valid;
    }

    /**
     * @param mixed $is_valid
     */
    public function setIsValid($is_valid)
    {
        $this->is_valid = $is_valid;
    }
}