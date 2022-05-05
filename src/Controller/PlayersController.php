<?php

namespace App\Controller;

use App\Entity\Players;
use App\Form\PlayersType;
use App\Repository\PlayersRepository;
use App\Repository\PlayersStatisticsRepository;
use App\Utils\Telegram;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

#[Route('/players')]
class PlayersController extends AbstractController
{
    #[Route('/{playerName}/{id}', name: 'app_players_show', methods: ['GET'])]
    public function show(Players $player, PlayersRepository $playersRepository): Response
    {
        $prefix = "";
        if ($this->getParameter('app.env') == "dev"){
            $prefix = "*[DEV]*";
        }

        $getPlayer = $playersRepository->findBy(array("id_player" => $player->getIdPlayer()));


        if(!empty($this->getUser())){
            Telegram::sendMessage($prefix." *".$this->getUser()->getPseudo()."* regarde le joueur : ".$getPlayer[0]->getName());
        }else{
            Telegram::sendMessage($prefix." *Un utilisateur* regarde le joueur : ".$getPlayer[0]->getName());
        }

        return $this->render('players/show.html.twig', [
            'player' => $player,
        ]);
    }

    public function getBestPlayers(PlayersStatisticsRepository $playersStatisticsRepository, PlayersRepository $playersRepository): Response
    {
        $getBestPlayers = $playersStatisticsRepository->findBy(array(), array("games_ratings" => "DESC"), 9);
        //dd($getBestPlayers);
        $players = array();
        foreach ($getBestPlayers as $player => $stats) {
            $players[$player]["stats"] = $stats;
            $players[$player]["player"] = $playersRepository->findBy(array("id_player" => $stats->getIdPlayer()));
        }

        //dd($players);
        return $this->render('players/best_players.html.twig', [
            'players' => $players,
        ]);
    }
}
