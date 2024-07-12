<?php

namespace App\Controller;

use GuzzleHttp\Client;
use App\Entity\Pokemon;
use App\Repository\PokemonRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AdminController extends AbstractController
{
    #[Route('/admin', name: 'app_admin')]
    public function index(PokemonRepository $pokemonRepository): Response
    {
        return $this->render('admin/index.html.twig', [
            'pokemons' => $pokemonRepository->findAll(),
        ]);
    }
    #[Route('/admin/update', name: 'app_admin_update')]
    public function update(PokemonRepository $pokemonRepository, EntityManagerInterface $entityManager): Response
    {

        $entityManager->createQuery('DELETE FROM App\Entity\Pokemon')->execute();

        $nameClient = new Client(['verify' => false]);
        $nameResponse = $nameClient->request('GET', 'https://pokeapi.co/api/v2/pokemon?limit=36&offset=0');
        
        $datas = json_decode($nameResponse->getBody(), true);
        $results = $datas['results'];
        foreach($results as $result) {
            $pokemon = new Pokemon();
            $pokemon->setName($result['name']);
            $pokemonUrl = $result['url'];
            $imageClient = new Client(['verify' => false]);
            $imageResponse = $imageClient->request("GET", $pokemonUrl);
            $imageResult = json_decode($imageResponse->getBody(), true);
            $pokemonImg = $imageResult['sprites']['front_default'];
            $pokemon->setImage($pokemonImg);
            $pokemon->setEvolution(1);     
            $entityManager->persist($pokemon);      
        }
        $entityManager->flush();      


        return $this->render('admin/index.html.twig', [
            'pokemons' => $pokemonRepository->findAll(),
        ]);
    }

}
