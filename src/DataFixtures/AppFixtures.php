<?php

namespace App\DataFixtures;

use App\Entity\Event;
use App\Entity\Genre;
use App\Entity\Region;
use App\Entity\User;
use DateTime;
use DateTimeImmutable;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        // $manager->persist($product);
        $faker = Factory::create();
        $genres = [
            'Rock',
            'Pop',
            'Electro',
            'Hip Hop',
            'Reggae',
            'Classique',
            'Alternatif',
            'Funk',
        ];

        $regions = [
            'Auvergne-Rhônes-Alpes',
            'Bourgogne-Franche-Comté',
            'Bretagne',
            'Centre-Val De Loire',
            'Corse',
            'Grand-Est',
            'Hauts-De-France',
            'Ile-De-France',
            'Normandie',
            'Nouvelle-Aquitaine',
            'Occitanie',
            'Pays de la Loire',
            'Provence-Alpes-Côte-D’Azur',
        ];

        $roles = [
            'ROLE_MANAGER',
            'ROLE_MODERATOR',
            'ROLE_ADMIN',
        ];

        $genreObjects = [] ;
        foreach($genres as $currentGenre) 
        {
            $genre = new Genre;
            $genre->setName($currentGenre);
            $genre->setImage('image'.$currentGenre.'.png');
            $genre->setCreatedAt(new DateTimeImmutable());
            $genreObjects[] = $genre;
            $manager->persist($genre);
        }

        $regionObjects = [];
        foreach($regions as $currentRegion) 
        {
            $region = new Region;
            $region->setName($currentRegion);
            $region->setImage('image'.$currentRegion.'.png');
            $region->setCreatedAt(new DateTimeImmutable());
            $regionObjects[] = $region;
            $manager->persist($region);
        }

        $userObjects = [];
        for ($u = 1; $u <= 5; $u++)
        {
            $user = new User;
            $username = $faker->firstName();
            $user->setUsername($username);
            $user->setImage('image'.$username.'.png');
            $user->setEmail($username.'@gmail.com');
            $user->setPassword($username);
            $randomIndex = array_rand($roles);
            $user->setRoles([$roles[$randomIndex]]);
            $user->setActive(1);
            $randomIndex2 = array_rand($regionObjects);
            $user->setRegions($regionObjects[$randomIndex2]);
            $user->setCreatedAt(new DateTimeImmutable());
            $userObjects[] = $user;
            $manager->persist($user);
        }

        for ($i = 1; $i <= 20; $i++)
        {
            $event = new Event;
            $name = $faker->word();
            $divider = '-';
            $event->setName($name);
            $event->setDescription($faker->text());
            $event->setDate($faker->dateTimeBetween('now', '+1 year'));
            $event->setPrice($faker->randomNumber(3, false));
            $event->setImage('https://picsum.photos/id/' . ( $i + 1 ) . '/200/300');
            $event->setLinkTicketing('https://www.fnac.com/');
            $text = preg_replace('~[^\pL\d]+~u', $divider, $name);
            $slug = strtolower($text);
            $event->setSlug($slug);
            $randomIndex = array_rand($regionObjects);
            $event->setRegion($regionObjects[$randomIndex]);
            $randomIndex2 = array_rand($genreObjects);
            $event->addGenre($genreObjects[$randomIndex2]);
            $randomIndex3 = array_rand($userObjects);
            $event->setUser($userObjects[$randomIndex3]);
            $event->setCreatedAt(new DateTimeImmutable());
            $manager->persist($event);
        }
        
        $manager->flush();
    }
}
