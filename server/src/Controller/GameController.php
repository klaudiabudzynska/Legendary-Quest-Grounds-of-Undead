<?php


namespace App\Controller;


use App\Entity\Board;
use App\Entity\User;
use App\Repository\BoardRepository;
use App\Repository\UserRepository;
use App\Service\GameService;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Cookie;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/game")
 */
class GameController extends AppController
{
    /**
     * @var GameServices
     */
    private $gameService;

    /**
     * @var BoardRepository
     */
    private $boardRepository;

    /**
     * @var EntityManager
     */
    private $em;

    /**
     * @var UserRepository
     */
    private $userRepository;

    public function __construct(UserRepository $userRepository, EntityManagerInterface $em, GameService $gameService, BoardRepository $boardRepository)
    {
        $this->userRepository = $userRepository;
        $this->em = $em;
        $this->boardRepository = $boardRepository;
        $this->gameService = $gameService;
    }

    /**
     * @Route("/test", name="game_test")
     */
    public function indexAction(Request $request){
        [$json, $tab] = $this->gameService->boardGenerate();
        return new Response($this->Serialize($json, "json"));
        //return new Response("<style>*{font-family: monospace;}</style>".$this->gameService->displayBoard($tab));
    }

    /**
     * @Route("/map", name="game_map")
     */
    public function mapAction(){

        if(count($this->boardRepository->findAll()) == 0){
            [$json, $tab] = $this->gameService->boardGenerate();
            $map = new Board();
            $map->setJson($this->Serialize($json, 'json'));
            $map->setName(time());

            $this->em->persist($map);
            $this->em->flush();
        }
        else{
            $json = $this->boardRepository->last()->getJson();
            return new Response($json);
        }


        return new Response($this->Serialize($json , "json"));
    }

    /**
     * @Route("/user")
     */
    public function userAction()
    {
        $r = rand(1, 99);
        if($r % 3 == 0) $c = 3;
        else if ($r % 2 == 0) $c = 2;
        else $c = 1;

        $user = new User($c, false, "hero".time());

        $this->em->persist($user);
        $this->em->flush();
        
        return new Response($this->Serialize($user, "json"));
    }

    /**
     * @Route("/move/{id}/{X}/{Y}", requirements={"id":"\d+", "X":"\d+", "Y":"\d+"})
     */
    public function moveAction(int $id, int $X, int $Y ){
        return new JsonResponse([["id"=>$id], ["X"=>$X], ["Y"=>$Y]]);
    }



}