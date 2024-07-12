<?php

namespace App\Controller;

use App\Entity\Pokemon;
use App\Repository\PokemonRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class DefaultController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(): Response
    {
        return $this->render('default/index.html.twig', [
            'controller_name' => 'DefaultController',
        ]);
    }
    #[Route('/{level}', name: 'app_play')]
    public function play(string $level, PokemonRepository $pokemonRepository): Response
    {
        switch ($level) {
            case 'debutant':
                $nbPokemon = 4;
                break;
            case 'avance':
                $nbPokemon = 16;
                break;
            case 'expert':
                $nbPokemon = 36;
        }

        $pokemons = $pokemonRepository->findLimited($nbPokemon);
        foreach($pokemons as $pokemon) {
            $pokemons[] = $pokemon;
        }

        shuffle($pokemons);



        
        return $this->render('default/play.html.twig', [
            'pokemons' => $pokemons,
            'level' => $level
        ]);
    }
   
}
