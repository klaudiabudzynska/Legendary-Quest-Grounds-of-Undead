<?php


namespace App\Controller;


use App\Entity\Board;
use App\Repository\BoardRepository;
use App\Service\GameService;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
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

    public function __construct(EntityManagerInterface $em, GameService $gameService, BoardRepository $boardRepository)
    {
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
        //$user = new ""
    }

    /**
     * @Route("/move/{id}/{X}/{Y}", requirements={"id":"\d+", "X":"\d+", "Y":"\d+"})
     */
    public function moveAction(int $id, int $X, int $Y ){
        return new JsonResponse([["id"=>$id], ["X"=>$X], ["Y"=>$Y]]);
    }



}