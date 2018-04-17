<?php
/**
 * Created by PhpStorm.
 * User: neboj
 * Date: 9/4/2018
 * Time: 11:36
 */

namespace AppBundle\Entity;


use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="match")
 */
class Match
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    private $id;
    /**
     * @ORM\Column(type="integer")
     */
    private $team_player;
    /**
     * @ORM\Column(type="integer")
     */
    private $team_bot;
    /**
     * @ORM\Column(type="integer")
     */
    private $goals_player;
    /**
     * @ORM\Column(type="integer")
     */
    private $goals_bot;
    /**
     * @ORM\Column(type="datetime")
     */
    private $start_time;

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
    public function getTeamPlayer()
    {
        return $this->team_player;
    }

    /**
     * @param mixed $team_player
     */
    public function setTeamPlayer($team_player)
    {
        $this->team_player = $team_player;
    }

    /**
     * @return mixed
     */
    public function getTeamBot()
    {
        return $this->team_bot;
    }

    /**
     * @param mixed $team_bot
     */
    public function setTeamBot($team_bot)
    {
        $this->team_bot = $team_bot;
    }

    /**
     * @return mixed
     */
    public function getGoalsPlayer()
    {
        return $this->goals_player;
    }

    /**
     * @param mixed $goals_player
     */
    public function setGoalsPlayer($goals_player)
    {
        $this->goals_player = $goals_player;
    }

    /**
     * @return mixed
     */
    public function getGoalsBot()
    {
        return $this->goals_bot;
    }

    /**
     * @param mixed $goals_bot
     */
    public function setGoalsBot($goals_bot)
    {
        $this->goals_bot = $goals_bot;
    }

    /**
     * @return mixed
     */
    public function getStartTime()
    {
        return $this->start_time;
    }

    /**
     * @param mixed $start_time
     */
    public function setStartTime($start_time)
    {
        $this->start_time = $start_time;
    }


}