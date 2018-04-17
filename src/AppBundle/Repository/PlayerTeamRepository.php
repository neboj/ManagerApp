<?php
/**
 * Created by PhpStorm.
 * User: neboj
 * Date: 6/4/2018
 * Time: 11:05
 */

namespace AppBundle\Repository;


use Doctrine\ORM\EntityRepository;

class PlayerTeamRepository extends EntityRepository
{
    public function playersFromTeam($teamId){
        $em=$this->getEntityManager();
        $RAW_QUERY='select p.id,p.name,p.speed,p.quality,p.position,pt.date_of_contract,pt.team_id FROM player p join player_team pt on p.id=pt.player_id WHERE pt.is_valid AND pt.team_id='.$teamId;
        $statement=$em->getConnection()->prepare($RAW_QUERY);
        $statement->execute();

        $result=$statement->fetchAll();
        /*var_dump($result);
        exit;*/

        return $result;
    }
    /*select * from player_team pt JOIN player p on pt.player_id=p.id WHERE p.available=1 AND pt.team_id=1*/
    /*select DISTINCT p.id,p.name,p.position,p.quality,p.speed,p.available,pt.team_id from player_team pt JOIN player p on pt.player_id=p.id WHERE p.available=1 AND pt.team_id=1 */


    /*info o igracu GDE IGRA*/
    /*select p.id,p.name,p.quality,p.speed,p.available,pt.date_of_contract,t.id as team_id,t.name as team_name,t.rank as team_rank from player p left join player_team pt on p.id=pt.player_id join team t on pt.team_id=t.id WHERE p.available=1 ORDER BY pt.date_of_contract DESC LIMIT 1 */


    public function availablePlayers(){
        $em=$this->getEntityManager();

        $RAW_QUERY='SELECT * FROM `player` WHERE id NOT IN (select player_id from player_team)
UNION
SELECT p.* FROM (SELECT * FROM ( SELECT * FROM player_team ORDER BY date_of_contract DESC ) AS sub GROUP BY player_id ) as sub1 JOIN player p ON p.id=sub1.player_id WHERE is_valid=0';
        $statement=$em->getConnection()->prepare($RAW_QUERY);
        $statement->execute();

        $result=$statement->fetchAll();
        /*var_dump($result);
        exit;*/

        return $result;
    }
    /*final unija ovih upita*/
    /*SELECT * FROM `player` WHERE id NOT IN (select player_id from player_team)
    UNION
    SELECT p.* FROM (SELECT * FROM ( SELECT * FROM player_team ORDER BY date_of_contract DESC ) AS sub GROUP BY player_id ) as sub1 JOIN player p ON p.id=sub1.player_id WHERE is_valid=0*/


    /*novi igraci*/
    /*SELECT * FROM `player` WHERE id NOT IN (select player_id from player_team) */

    /*trenutno nezaposleni*/
    /*SELECT p.* FROM (SELECT * FROM ( SELECT * FROM player_team ORDER BY date_of_contract DESC ) AS sub GROUP BY player_id ) as sub1 JOIN player p ON p.id=sub1.player_id WHERE is_valid=0 */
    /*SELECT * FROM (SELECT * FROM ( SELECT * FROM player_team ORDER BY date_of_contract DESC ) AS sub GROUP BY player_id ) as sub1 WHERE is_valid=0 */
    /* SELECT * FROM ( SELECT * FROM player_team ORDER BY date_of_contract DESC ) AS sub GROUP BY player_id */
}