<?php
/**
 * Created by PhpStorm.
 * User: neboj
 * Date: 26/3/2018
 * Time: 22:45
 */

namespace AppBundle\Controller;


use AppBundle\Entity\Player;
use AppBundle\Entity\PlayerTeam;
use AppBundle\Entity\Team;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Validator\Constraints\Date;
use Symfony\Component\Validator\Constraints\DateTime;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\Range;

class ManagerController extends Controller
{
    /**
     * @Route("/", name="chooseTeam")
     */
    public function indexAction(Request $request)
    {
        $em=$this->getDoctrine()->getManager();
        $teams=$em->getRepository(Team::class)->findAll();
        $session=new Session();

        if($request->isXmlHttpRequest()){
            if($request->request->get('chooseTeam')==true) {
                
                $session->set('teamId',$request->request->get('teamId'));
                $session->set('teamName',$request->request->get('teamName'));
                $session->set('matchCount',0);

                $session->set('match1PlayerGoals',0);
                $session->set('match1BotGoals',0);
                $session->set('firstInjuredId',0);
                $session->set('firstInjuredName','');
                $session->set('match1BotId',0);
                $session->set('match1BotName','');

                $session->set('match2PlayerGoals',0);
                $session->set('match2BotGoals',0);
                $session->set('secondInjuredId',0);
                $session->set('secondInjuredName','');
                $session->set('match2BotId',0);
                $session->set('match2BotName','');

                $session->set('match3PlayerGoals',0);
                $session->set('match3BotGoals',0);
                $session->set('thirdInjuredId',0);
                $session->set('thirdInjuredName','');
                $session->set('match3BotId',0);
                $session->set('match3BotName','');

                $response =  new JsonResponse();
                $response->setData($session->get('teamId'));
                return $response;
            }
        }



        return $this->render('default/chooseTeam.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
            'teams'=>$teams
        ]);
    }

    /**
     * @Route("/main", name="homepage")
     */
    public function mainAction(Request $request)
    {
        if(!$this->container->get('session')->isStarted()){
            return $this->redirectToRoute('chooseTeam');
        }
        $txt="from controller";

        return $this->render('default/index.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
            'txt'=>$txt
        ]);
    }


    /**
     * @Route("/create-team", name="createTeam")
     */
    public function createTeamAction(Request $request){
        if(!$this->container->get('session')->isStarted()){
            return $this->redirectToRoute('chooseTeam');
        }
        $team = new Team();
        $team->setName('Dummy'.rand(1,5000));
        $team->setRank(0);



        //DEBUG
        //echo $team->getName();
        //echo $team->getName();die;
        //dump($team);die;

        $form = $this->createFormBuilder($team)
            ->add('name',TextType::class,array(
                'constraints'=>new Length(array('min'=>1,'max'=>255))
            ))
            ->add('rank',NumberType::class,array('disabled'=>true))
            ->add('save',SubmitType::class, array('label'=>'Create team'))
            ->getForm();


        $form -> handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $team = $form->getData();

            $em = $this->getDoctrine()->getManager();
            $em->persist($team);
            $em->flush();
            return $this->redirect($request->getUri());

        }

        $txt="helloooooooo from controller";

        return $this->render('default/newTeam.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
            'txt'=>$txt,
            'form'=>$form->createView(),
        ]);
    }


    /**
     * @Route("/add-player", name="addPlayer")
     */
    public function addPlayerAction(Request $request){
        if(!$this->container->get('session')->isStarted()){
            return $this->redirectToRoute('chooseTeam');
        }
        $player = new Player();
        $first_names = array(
            'Allison',
            'Arthur',
            'Ana',
            'Alex',
            'Arlene',
            'Alberto',
            'Barry',
            'Bertha',
            'Bill',
            'Bonnie',
            'Bret',
            'Beryl',
            'Chantal',
            'Cristobal',
            'Claudette',
            'Charley',
            'Cindy',
            'Chris',
            'Dean',
            'Dolly',
            'Danny',
            'Danielle',
            'Dennis',
            'Debby',
            'Erin',
            'Edouard',
            'Erika',
            'Earl',
            'Emily',
            'Ernesto',
            'Felix',
            'Fay',
            'Fabian',
            'Isidore',
            'Isabel',
            'Ivan',
            'Irene',
            'Isaac',
            'Jerry',
            'Josephine',
            'Juan',
            'Jeanne',
            'Jose',
            'Joyce',
            'Karen',
            'Kyle',
            'Kate',
            'Karl',
            'Katrina',
            'Kirk',
            'Lorenzo',
            'Lili',
            'Larry',
            'Lisa',
            'Lee',
            'Leslie',
            'Michelle',
            'Marco',
            'Mindy',
            'Maria',
            'Michael',
            'Noel',
            'Nana',
            'Nicholas',
            'Nicole',
            'Nate',
            'Nadine',
            'Olga',
            'Omar',
            'Odette',
            'Otto',
            'Ophelia',
            'Oscar',
            'Pablo',
            'Paloma',
            'Peter',
            'Paula',
            'Philippe',
            'Patty',
            'Rebekah',
            'Rene',
            'Rose',
            'Richard',
            'Rita',
            'Rafael',
            'Sebastien',
            'Sally',
            'Sam',
            'Shary',
            'Stan',
            'Sandy',
            'Tanya',
            'Teddy',
            'Teresa',
            'Tomas',
            'Tammy',
            'Tony',
            'Van',
            'Vicky',
            'Victor',
            'Virginie',
            'Vince',
            'Valerie',
            'Wendy',
            'Wilfred',
            'Wanda',
            'Walter',
            'Wilma',
            'William',
            'Kumiko',
            'Aki',
            'Miharu',
            'Chiaki',
            'Michiyo',
            'Itoe',
            'Nanaho',
            'Reina',
            'Emi',
            'Yumi',
            'Ayumi',
            'Kaori',
            'Sayuri',
            'Rie',
            'Miyuki',
            'Hitomi',
            'Naoko',
            'Miwa',
            'Etsuko',
            'Akane',
            'Kazuko',
            'Miyako',
            'Youko',
            'Sachiko',
            'Mieko',
            'Toshie',
            'Junko');

        $last_names = array(
            'Abbott',
            'Acevedo',
            'Acosta',
            'Adams',
            'Adkins',
            'Aguilar',
            'Aguirre',
            'Albert',
            'Alexander',
            'Alford');

        $random_key = array_rand($last_names);
        $random_key2 = array_rand($last_names);

        $player->setName($first_names[$random_key2]." ".$last_names[$random_key]);
        $player->setPosition(Player::GOALIE);
        $player->setQuality(rand(1,100));
        $player->setSpeed(rand(1,100));
        //dump($player);die;

        $form=$this->createFormBuilder($player)
            ->add('name',TextType::class,array(
                'constraints' => new Length(array('min' => 3)),
            ))
            ->add('position',ChoiceType::class, array(
                'choices' => array(
                    'Goalie'=>Player::GOALIE,
                    'Defender'=>Player::DEFENDER,
                    'Midfielder'=>Player::MIDFIELDER,
                    'Striker'=>Player::STRIKER),))
            ->add('quality',NumberType::class,array(
                'constraints' => new Range(array('min' => 1,'max'=>100)),
            ))
            ->add('speed',NumberType::class,array(
                'constraints' => new Range(array('min' => 1,'max'=>100)),
            ))
            ->add('save',SubmitType::class,array('label'=>'Add player'))
            ->getForm();



        $form -> handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $player = $form->getData();

            $em = $this->getDoctrine()->getManager();
            $em->persist($player);
            $em->flush();
            return $this->redirect($request->getUri());

        }

        $txt="helloooooooo from controller";

        return $this->render('default/newTeam.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
            'txt'=>$txt,
            'form'=>$form->createView(),
        ]);
    }



    /**
     * @Route("/transfer-players", name="transferPlayers")
     */
    public function transferPLayersAction(Request $request){
        if(!$this->container->get('session')->isStarted()){
            return $this->redirectToRoute('chooseTeam');
        }

        $txt="helloooooooo from controller";
        $em = $this->getDoctrine()->getManager();
        $availablePlayers=$em->getRepository(PlayerTeam::class)->availablePlayers();

        $teams=$em->getRepository(Team::class)->findAll();


        if($request->isXmlHttpRequest()){
            if($request->request->get('selectTeam')==true){
                $playersFromTeam = $em->getRepository(PlayerTeam::class)->playersFromTeam($request->request->get('teamId'));

                $response=new JsonResponse();
                $response->setData($playersFromTeam);
                return $response;
            }

            if($request->request->get('transferIn')==true){
                    $playerTeam = new PlayerTeam();
                    $playerTeam->setPlayerId($request->request->get('id'));
                    $playerTeam->setDateOfContract(new \Datetime());
                    $playerTeam->setTeamId($request->request->get('teamid'));
                    $playerTeam->setIsValid(true);


                    $em->persist($playerTeam);
                    $em->flush();
                    return new JsonResponse('ok');
            }

            if($request->request->get('transferOut')==true){
                $ugovor = $em->getRepository(PlayerTeam::class)->findOneBy([
                    'player_id'=>$request->request->get('id'),
                    'is_valid'=>true
                ]);
                $ugovor->setIsValid(false);
                $em->persist($ugovor);
                $em->flush();
                return new JsonResponse('ok');
            }
        }
        return $this->render('default/transferPlayers.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
            'txt'=>$txt,
            'availablePlayers'=>$availablePlayers,
            'teams'=>$teams
        ]);
    }

    /**
     * @Route("/play", name="playMatch")
     */
    public function playMatchAction(Request $request){
        if(!$this->container->get('session')->isStarted()){
            return $this->redirectToRoute('chooseTeam');
        }

        return $this->render('default/leagueWindow.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
            'status'=>0
        ]);
    }

    /**
     * @Route("/play/{status}/formation", name="changeFormation")
     */
    public function formationAction(Request $request,$status){

        if(!$this->container->get('session')->isStarted()){
            return $this->redirectToRoute('chooseTeam');
        }
        if($request->getSession()->get('matchCount')>2){
            $request->getSession()->set('matchCount',0);
        }
        $matchCounter = $request->getSession()->get('matchCount');
        if ($status==='new'){
            $request->getSession()->set('matchCount',0);
        }

        $em=$this->getDoctrine()->getManager();
        $teams=$em->getRepository(Team::class)->findAll();
        $playersFromTeam = $em->getRepository(PlayerTeam::class)->playersFromTeam($request->getSession()->get('teamId'));
        foreach ($teams as $t) {
            $ply = $em->getRepository(PlayerTeam::class)->playersFromTeam($t->getId());

            $sumRank=0;
            $counter=0;
            foreach ($ply as $p){
                $counter++;
                $sumRank+=$p['quality'];
            }
            if($counter==0){
                $t->setRank(1);
                $em->persist($t);
            }else{
                $updateRank = ceil($sumRank/$counter);
                $t->setRank($updateRank);
                $em->persist($t);
            }


        }
        $em->flush();

        if($matchCounter==0){
                    $request->getSession()->set('match1PlayerGoals',0);
                    $request->getSession()->set('match1BotGoals',0);
                    $request->getSession()->set('firstInjuredId',0);
                    $request->getSession()->set('firstInjuredName','');
                    $request->getSession()->set('match1BotId',0);
                    $request->getSession()->set('match1BotName','');

                    $request->getSession()->set('match2PlayerGoals',0);
                    $request->getSession()->set('match2BotGoals',0);
                    $request->getSession()->set('secondInjuredId',0);
                    $request->getSession()->set('secondInjuredName','');
                    $request->getSession()->set('match2BotId',0);
                    $request->getSession()->set('match2BotName','');

                    $request->getSession()->set('match3PlayerGoals',0);
                    $request->getSession()->set('match3BotGoals',0);
                    $request->getSession()->set('thirdInjuredId',0);
                    $request->getSession()->set('thirdInjuredName','');
                    $request->getSession()->set('match1BotId',0);
                    $request->getSession()->set('match3BotName','');
         }

        if($request->isXmlHttpRequest()){
            if($request->request->get('simulate')==true){

                $matchCounter++;
                $request->getSession()->set('matchCount',$matchCounter);
                

                $formation = $request->request->get('formation');
                $teamPlayerId=$request->request->get('teamPlayerId');
                $teamBotId=$request->request->get('teamBotId');
                $teamBotName=$request->request->get('teamBotName');


                $goalsPlayer=0;
                $goalsBot=0;
                $rankPlayer=0;
                $rankBot=0;
                foreach ($teams as $t){
                    if($t->getId()==$teamPlayerId){
                        $rankPlayer=$t->getRank();
                    }
                    if($t->getId()==$teamBotId){
                        $rankBot=$t->getRank();
                    }
                }
                $diff = $rankPlayer-$rankBot;
                if($diff>=0 && $diff<20){
                    if($formation=='f343'){//offensive
                        $arr1=[0,0,1,1,2,2,2,2,3,3,4,5,6];
                        $arr2=[0,0,1,1,1,1,2,2,2,3,4,5,6];
                        $goalsPlayer=$arr1[array_rand($arr1)];
                        $goalsBot=$arr2[array_rand($arr2)];
                    }
                    if($formation=='f541'){//defensive
                        $arr1=[0,0,0,0,0,1,1,1,2,2,2,3,4];
                        $arr2=[0,0,0,0,0,0,1,1,1,2,2,3,4];
                        $goalsPlayer=$arr1[array_rand($arr1)];
                        $goalsBot=$arr2[array_rand($arr2)];
                    }
                    if($formation=='f442'){//hug the touchline
                        $arr1=[0,0,0,1,1,1,1,1,2,2,2,3,4];
                        $arr2=[0,0,0,0,0,1,1,1,1,2,2,3,4];
                        $goalsPlayer=$arr1[array_rand($arr1)];
                        $goalsBot=$arr2[array_rand($arr2)];
                    }
                }
                if($diff>=20 && $diff<40){
                    if($formation=='f343'){//offensive
                        $arr1=[0,0,1,1,2,2,2,2,3,3,4,5,6];
                        $arr2=[0,0,0,1,1,1,1,2,2,2,3,3,4];
                        $goalsPlayer=$arr1[array_rand($arr1)];
                        $goalsBot=$arr2[array_rand($arr2)];
                    }
                    if($formation=='f541'){//defensive
                        $arr1=[0,0,0,1,1,1,1,1,2,2,2,3,4];
                        $arr2=[0,0,0,0,0,0,0,1,1,1,2,2,2];
                        $goalsPlayer=$arr1[array_rand($arr1)];
                        $goalsBot=$arr2[array_rand($arr2)];
                    }
                    if($formation=='f442'){//hug the touchline
                        $arr1=[0,0,0,1,1,1,1,2,2,2,3,3,4];
                        $arr2=[0,0,0,0,1,1,1,2,2,2,2,3,4];
                        $goalsPlayer=$arr1[array_rand($arr1)];
                        $goalsBot=$arr2[array_rand($arr2)];
                    }
                }
                if($diff>=40){
                    if($formation=='f343'){//offensive
                        $arr1=[0,1,1,2,2,2,3,3,3,3,4,5,6];
                        $arr2=[0,0,0,0,0,0,0,1,1,1,1,2,2];
                        $goalsPlayer=$arr1[array_rand($arr1)];
                        $goalsBot=$arr2[array_rand($arr2)];
                    }
                    if($formation=='f541'){//defensive
                        $arr1=[0,1,1,2,2,2,2,3,3,3,3,4,5];
                        $arr2=[0,0,0,0,0,0,0,0,0,0,1,1,2];
                        $goalsPlayer=$arr1[array_rand($arr1)];
                        $goalsBot=$arr2[array_rand($arr2)];
                    }
                    if($formation=='f442'){//hug the touchline
                        $arr1=[0,0,1,1,2,2,2,3,3,3,4,5,6];
                        $arr2=[0,0,0,0,0,0,0,0,1,1,2,2,2];
                        $goalsPlayer=$arr1[array_rand($arr1)];
                        $goalsBot=$arr2[array_rand($arr2)];
                    }
                }
                if($diff>=-20 && $diff<0){
                    if($formation=='f343'){//offensive
                        $arr1=[0,0,1,1,2,2,2,2,3,3,4,5,6];
                        $arr2=[0,0,1,1,1,1,2,2,2,3,4,5,6];
                        $goalsBot=$arr1[array_rand($arr1)];
                        $goalsPlayer=$arr2[array_rand($arr2)];
                    }
                    if($formation=='f541'){//defensive
                        $arr1=[0,0,0,0,0,1,1,1,2,2,2,3,4];
                        $arr2=[0,0,0,0,0,0,1,1,1,2,2,3,4];
                        $goalsBot=$arr1[array_rand($arr1)];
                        $goalsPlayer=$arr2[array_rand($arr2)];
                    }
                    if($formation=='f442'){//hug the touchline
                        $arr1=[0,0,0,1,1,1,1,1,2,2,2,3,4];
                        $arr2=[0,0,0,0,0,1,1,1,1,2,2,3,4];
                        $goalsBot=$arr1[array_rand($arr1)];
                        $goalsPlayer=$arr2[array_rand($arr2)];
                    }
                }
                if($diff>=-40 && $diff<-20){
                    if($formation=='f343'){//offensive
                        $arr1=[0,0,1,1,2,2,2,2,3,3,4,5,6];
                        $arr2=[0,0,0,1,1,1,1,2,2,2,3,3,4];
                        $goalsBot=$arr1[array_rand($arr1)];
                        $goalsPlayer=$arr2[array_rand($arr2)];
                    }
                    if($formation=='f541'){//defensive
                        $arr1=[0,0,0,1,1,1,1,1,2,2,2,3,4];
                        $arr2=[0,0,0,0,0,0,0,1,1,1,2,2,2];
                        $goalsBot=$arr1[array_rand($arr1)];
                        $goalsPlayer=$arr2[array_rand($arr2)];
                    }
                    if($formation=='f442'){//hug the touchline
                        $arr1=[0,0,0,1,1,1,1,2,2,2,3,3,4];
                        $arr2=[0,0,0,0,1,1,1,2,2,2,2,3,4];
                        $goalsBot=$arr1[array_rand($arr1)];
                        $goalsPlayer=$arr2[array_rand($arr2)];
                    }
                }
                if($diff<-40){
                    if($formation=='f343'){//offensive
                        $arr1=[0,1,1,2,2,2,3,3,3,3,4,5,6];
                        $arr2=[0,0,0,0,0,0,0,1,1,1,1,2,2];
                        $goalsBot=$arr1[array_rand($arr1)];
                        $goalsPlayer=$arr2[array_rand($arr2)];
                    }
                    if($formation=='f541'){//defensive
                        $arr1=[0,1,1,2,2,2,2,3,3,3,3,4,5];
                        $arr2=[0,0,0,0,0,0,0,0,0,0,1,1,2];
                        $goalsBot=$arr1[array_rand($arr1)];
                        $goalsPlayer=$arr2[array_rand($arr2)];
                    }
                    if($formation=='f442'){//hug the touchline
                        $arr1=[0,0,1,1,2,2,2,3,3,3,4,5,6];
                        $arr2=[0,0,0,0,0,0,0,0,1,1,2,2,2];
                        $goalsBot=$arr1[array_rand($arr1)];
                        $goalsPlayer=$arr2[array_rand($arr2)];
                    }
                }

                $injuredCurrentName='';
                if($matchCounter==1){
                    $randomK=array_rand($playersFromTeam);
                    $firstInjuredId=$playersFromTeam[$randomK]['id'];
                    $firstInjuredName=$playersFromTeam[$randomK]['name'];
                    $injuredCurrentName=$firstInjuredName;
                    unset($playersFromTeam[$randomK]);
                    array_values($playersFromTeam);
                    $request->getSession()->set('firstInjuredId',$firstInjuredId);    
                    $request->getSession()->set('firstInjuredName',$firstInjuredName);   
                    $request->getSession()->set('match1PlayerGoals',$goalsPlayer);
                    $request->getSession()->set('match1BotId',$teamBotId); 
                    $request->getSession()->set('match1BotName',$teamBotName); 

                }
                if($matchCounter==2){
                    $randomK=array_rand($playersFromTeam);
                    $secondInjuredId=$playersFromTeam[$randomK]['id'];
                    $secondInjuredName=$playersFromTeam[$randomK]['name'];
                    $injuredCurrentName=$secondInjuredName;
                    unset($playersFromTeam[$randomK]);
                    array_values($playersFromTeam);
                    $request->getSession()->set('secondInjuredId',$secondInjuredId);    
                    $request->getSession()->set('secondInjuredName',$secondInjuredName); 
                    $request->getSession()->set('match2PlayerGoals',$goalsPlayer);
                    $request->getSession()->set('match2BotGoals',$goalsBot);   
                    $request->getSession()->set('match2BotId',$teamBotId); 
                    $request->getSession()->set('match2BotName',$teamBotName); 
                }
                if($matchCounter==3){
                    $randomK=array_rand($playersFromTeam);
                    $thirdInjuredId=$playersFromTeam[$randomK]['id'];
                    $thirdInjuredName=$playersFromTeam[$randomK]['name'];
                    $injuredCurrentName=$thirdInjuredName;
                    unset($playersFromTeam[$randomK]);
                    array_values($playersFromTeam);
                    $request->getSession()->set('thirdInjuredId',$thirdInjuredId);    
                    $request->getSession()->set('thirdInjuredName',$thirdInjuredName); 
                    $request->getSession()->set('match3PlayerGoals',$goalsPlayer);
                    $request->getSession()->set('match3BotGoals',$goalsBot); 
                    $request->getSession()->set('match3BotId',$teamBotId); 
                    $request->getSession()->set('match3BotName',$teamBotName);  
                }


                
                return new Response($goalsPlayer.'-'.$goalsBot.'_-_-'.$matchCounter.'_-_-'.$injuredCurrentName);
            }



            function checkPlayersCount($playersArray,$formation){
                $strikers=0;
                $goalies=0;
                $midfielders=0;
                $defenders=0;
                $enoughPlayers=false;
                foreach ($playersArray as $p) {
                    if($p['position']=='striker'){
                        $strikers++;
                    }
                    if($p['position']=='midfielder'){
                        $midfielders++;
                    }
                    if($p['position']=='defender'){
                        $defenders++;
                    }
                    if($p['position']=='goalie'){
                        $goalies++;
                    }
                }
                if($formation==='f442'){
                    if($goalies>0 && $defenders>=4 && $midfielders>=4 && $strikers>=2){
                        $enoughPlayers=true;
                    }
                }
                if($formation==='f343'){
                    if($goalies>0 && $defenders>=3 && $midfielders>=4 && $strikers>=3){
                        $enoughPlayers=true;
                    }
                }
                if($formation==='f541'){
                    if($goalies>0 && $defenders>=5 && $midfielders>=4 && $strikers>=1){
                        $enoughPlayers=true;
                    }
                }

                return $enoughPlayers;

            }


            function getPlayers($playersArray,$position,$size,$sort){
                $players=array();
                $speed=array();
                $quality=array();
                foreach ($playersArray as $p) {
                    if ($p['position'] == $position) {
                        array_push($players,$p);
                    }
                }
                if($sort=='quality'){
                    foreach ($players as $bs) {
                        array_push($quality,$bs['quality']);
                    }
                    array_multisort($quality,SORT_DESC,$players);
                }
                if($sort=='speed'){
                    foreach ($players as $bs) {
                        array_push($speed,$bs['speed']);
                    }
                    array_multisort($speed,SORT_DESC,$players);
                }
                if($sort=='best'){
                    foreach ($players as $bs) {
                        array_push($speed,$bs['speed']);
                        array_push($quality,$bs['quality']);
                    }
                    array_multisort($quality,SORT_DESC,SORT_NUMERIC,
                        $speed,SORT_DESC,SORT_NUMERIC,
                        $players);
                }
                $players=array_slice($players,0,$size);
                return $players;
            }


            if($request->request->get('changeFormation')==true){
                $formation = $request->request->get('formation');

                $enoughPlayers=checkPlayersCount($playersFromTeam,$formation);

                if($enoughPlayers===false){
                    return new Response(123);
                }
                $startingTeam=array();
                if($formation=='f442'){
                    $s=getPlayers($playersFromTeam,'striker',2,'speed');
                    $m=getPlayers($playersFromTeam,'midfielder',4,'best');
                    $d=getPlayers($playersFromTeam,'defender',4,'best');
                    $g=getPlayers($playersFromTeam,'goalie',1,'best');
                    $startingTeam =array_merge($s,$m,$d,$g);
                }
                if($formation=='f343'){
                    $s=getPlayers($playersFromTeam,'striker',3,'quality');
                    $m=getPlayers($playersFromTeam,'midfielder',4,'quality');
                    $d=getPlayers($playersFromTeam,'defender',3,'quality');
                    $g=getPlayers($playersFromTeam,'goalie',1,'best');
                    $startingTeam =array_merge($s,$m,$d,$g);
                }
                if($formation=='f541'){
                    $s=getPlayers($playersFromTeam,'striker',3,'quality');
                    $m=getPlayers($playersFromTeam,'midfielder',4,'quality');
                    $d=getPlayers($playersFromTeam,'defender',4,'quality');
                    $g=getPlayers($playersFromTeam,'goalie',1,'best');
                    $startingTeam =array_merge($s,$m,$d,$g);
                }
                return new JsonResponse(json_encode($startingTeam));

            }

        }


        return $this->render('default/formation.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
            'teams'=>$teams,
            'players'=>$playersFromTeam
        ]);
    }


}
