<?php


namespace App\Controller;


use App\Service\GameService;
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

    public function __construct(GameService $gameService)
    {
        $this->gameService = $gameService;
    }

    /**
     * @Route("/test", name="game_test")
     */
    public function indexAction(Request $request){
        [$json, $tab] = $this->gameService->boardGenerate();
        //return new Response($this->Serialize($json, "json"));
        return new Response("<style>*{font-family: monospace;}</style>".$this->gameService->displayBoard($tab));
    }

    /**
     * @Route("/map", name="game_map")
     */
    public function mapAction(){
        [$json, $tab] = $this->gameService->boardGenerate();
        return new Response($this->Serialize($json, "json"));
    }
}