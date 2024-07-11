<?php

namespace App\DataFixtures;

use App\Entity\Pokemon;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class PokemonFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $pokemon1 = new Pokemon();
        $pokemon1->setName('Pikachu')
        ->setImage('https://www.emob-meubles.fr/cdn-cgi/image/quality=90,metadata=none,fit=scale-down,width=2500,format=webp/https://www.emob-meubles.fr/media/catalog/product/cache/47315658861446b438ceea760f29ab26/R/M/RMK2536GM_Pokemon_Pikachu_Giant_Wall_Decals_Assembled_Product_0b96.jpg')
        ->setEvolution(1);
        $manager->persist($pokemon1);

        $pokemon2 = new Pokemon();
        $pokemon2->setName('Raichu')
        ->setImage('https://www.pokemon.com/static-assets/content-assets/cms2/img/pokedex/full/026.png')
        ->setEvolution(2);
        $manager->persist($pokemon2);

        $manager->flush();
    }
}
