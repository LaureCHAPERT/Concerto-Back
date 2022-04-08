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
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{
    public function __construct(UserPasswordHasherInterface $passwordHasher)
    {
        $this->hasher = $passwordHasher;
    }


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
            'Auvergne-Rhônes-Alpes' => 'https://cdn.pixabay.com/photo/2017/06/20/15/48/mont-blanc-2423512_960_720.jpg',
            'Bourgogne-Franche-Comté' => 'https://images.pexels.com/photos/96633/pexels-photo-96633.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=750&w=1260',
            'Bretagne' => 'https://cdn.pixabay.com/photo/2014/11/10/05/49/carnac-stones-525066__340.jpg',
            'Centre-Val De Loire' => 'https://cdn.pixabay.com/photo/2017/06/19/22/00/loire-2420962_960_720.jpg',
            'Corse' => 'https://cdn.pixabay.com/photo/2018/02/28/18/47/waters-3188723_960_720.jpg',
            'Grand-Est' => 'https://cdn.pixabay.com/photo/2017/07/21/14/24/storks-2525893_960_720.jpg',
            'Hauts-De-France' => 'https://cdn.pixabay.com/photo/2017/08/20/00/16/lille-2660311_960_720.jpg',
            'Ile-De-France' => 'https://cdn.pixabay.com/photo/2018/04/25/09/26/eiffel-tower-3349075_960_720.jpg',
            'Normandie' => 'https://cdn.pixabay.com/photo/2012/08/24/10/48/mont-st-michel-54806_960_720.jpg',
            'Nouvelle-Aquitaine' => 'https://cdn.pixabay.com/photo/2020/02/02/15/07/wine-4813260_960_720.jpg',
            'Occitanie' => 'https://cdn.pixabay.com/photo/2017/10/01/10/43/castres-2804947_960_720.jpg',
            'Pays de la Loire' => 'https://cdn.pixabay.com/photo/2018/03/18/15/14/nantes-3237084_960_720.jpg',
            'Provence-Alpes-Côte-D’Azur' => 'https://cdn.pixabay.com/photo/2020/06/26/21/06/summer-5343970_960_720.jpg',
        ];

        $roles = [
            'ROLE_MANAGER',
            'ROLE_MODERATOR',
            'ROLE_ADMIN',
        ];

        $genres= [
            'Rock' => 'https://cdn.pixabay.com/photo/2017/10/07/00/26/hand-2825166_960_720.jpg',
            'Classique' => 'https://cdn.pixabay.com/photo/2014/05/21/15/47/piano-349928_960_720.jpg',
            'Reggae' => 'https://cdn.pixabay.com/photo/2016/12/18/04/16/rasta-1915004_960_720.jpg',
            'Pop' =>'https://cdn.pixabay.com/photo/2012/12/14/11/36/music-69990_960_720.jpg',
            'Funk' => 'https://cdn.pixabay.com/photo/2022/02/08/09/47/funk-7001092_960_720.png',
            'Hip-Hop' => 'https://cdn.pixabay.com/photo/2014/03/21/10/19/dancers-291958_960_720.jpg',
            'Electro' => 'https://cdn.pixabay.com/photo/2015/04/13/13/37/audio-720589_960_720.jpg',
            'Alternative' => 'https://cdn.pixabay.com/photo/2016/08/15/16/48/vinyl-1595847_960_720.jpg',
        ];
        $genreObjects = [] ;
        foreach($genres as $currentGenre => $currentImage) 
        {
            $genre = new Genre;
            $genre->setName($currentGenre);
            $genre->setImage($currentImage);
            $genre->setCreatedAt(new DateTimeImmutable());
            $genreObjects[] = $genre;
            $manager->persist($genre);
        }

        $regionObjects = [];
        foreach($regions as $currentRegion => $currentImage) 
        {
            $region = new Region;
            $region->setName($currentRegion);
            $region->setImage($currentImage);
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
            $hashedPassword = $this->hasher->hashPassword(
                $user,
                $username,
            );
            $user->setPassword($hashedPassword);
            $randomIndex = array_rand($roles);
            $user->setRoles([$roles[$randomIndex]]);
            $user->setActive(1);
            $randomIndex2 = array_rand($regionObjects);
            $user->setRegions($regionObjects[$randomIndex2]);
            $user->setCreatedAt(new DateTimeImmutable());
            $userObjects[] = $user;
            $manager->persist($user);
        }

        for ($i = 1; $i <= 100; $i++)
        {
            $event = new Event;
            $name = $faker->word();
            $divider = '-';
            $event->setName($name);
            $event->setDescription($faker->text());
            $event->setDate($faker->dateTimeBetween('now', '+1 year'));
            $event->setPrice($faker->randomNumber(3, false));
            $event->setImage('https://cdn.pixabay.com/photo/2022/03/25/19/24/waterfall-7091641_960_720.jpg');
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
