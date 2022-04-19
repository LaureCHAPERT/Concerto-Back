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
            'Variété Française' => 'https://cdn.pixabay.com/photo/2021/06/29/21/20/music-6375279_960_720.jpg'
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

        $users = 
        [
            [
                'username' => 'Jérémy',
                'email' => 'jeremy@gmail.com',
                'password' => '$2y$13$xCL5wNQ8w.BkoLAH0vFYyeshwHBMMUzRU6XDnHahwpP5ZFJ.j6NWu',
                'role' => 'ROLE_ADMIN',
                'region' => 'Occitanie',
            ],
            [
                'username' => 'Victor',
                'email' => 'victor@gmail.com',
                'password' => '$2y$13$1Rg8jg47s472FGxlHIStTetpBZ8TuA9ldbPI3RC/mgjSISt.V794m',
                'role' => 'ROLE_ADMIN',
                'region' => 'Nouvelle-Aquitaine',
            ],
            [
                'username' => 'Laure',
                'email' => 'laure@gmail.com',
                'password' => '$2y$13$of8gfOL3EqhDmVdDiCMwG.HwMcy7zd6Qi2jNKuKmteJoX2BTPsaLu',
                'role' => 'ROLE_MODERATOR',
                'region' => 'Bretagne',
            ],
            [
                'username' => 'Elise',
                'email' => 'elise@gmail.com',
                'password' => '$2y$13$.xZhEJKdROnOXlJRcUJTaeDA373ioYvy1.rHFLBQPDYJpUmBGNzLm',
                'role' => 'ROLE_MODERATOR',
                'region' => 'Corse',
            ],
            [
                'username' => 'Organisme région Corse',
                'email' => 'corse@gmail.com',
                'password' => '$2y$13$Hrdm0zPHpsdCy/AVGds1MOcNDrEnqq391euPfla9J9AxTrH3G2Qi.',
                'role' => 'ROLE_MANAGER',
                'region' => 'Corse',
            ],
            [
                'username' => 'Organisme région Ile-De-France',
                'email' => 'paris@gmail.com',
                'password' => '$2y$13$HM55z0rrfMwTDWhPzksS3exO33dGjaoTHcZkLvPKOfw1BH69jfWwC',
                'role' => 'ROLE_MANAGER',
                'region' => 'Ile-De-France',
            ],
            [
                'username' => 'Organisme région Bretagne',
                'email' => 'bretagne@gmail.com',
                'password' => '$2y$13$fA0T1sWJGdnKwcXrlh2yoelGpA/ZJ9s6TdS2DQ3xMHgGmYolZ9JaC',
                'role' => 'ROLE_MANAGER',
                'region' => 'Bretagne',
            ],
            [
                'username' => 'Organisme région Auvergne-Rhônes-Alpes',
                'email' => 'auvergne@gmail.com',
                'password' => '$2y$13$UnMRtLyqk4SjoxN7/pXhquxsV2uSNN9gj22sbgTAJzUJphf62taEG',
                'role' => 'ROLE_MANAGER',
                'region' => 'Auvergne-Rhônes-Alpes',
            ],
            [
                'username' => 'Organisme région Bourgogne-Franche-Comté',
                'email' => 'bourgogne@gmail.com',
                'password' => '$2y$13$HvmUbjUpDM.yOPtKqZwBbuhNLSxgze2F96/InMI.KtE8VOnJfACJW',
                'role' => 'ROLE_MANAGER',
                'region' => 'Bourgogne-Franche-Comté',
            ],
            [
                'username' => 'Organisme région Centre-Val De Loire',
                'email' => 'centre@gmail.com',
                'password' => '$2y$13$mDte2yH9o/chkeNMzjSGOumkn7PUDDet/n06SA/Fe9Ffa6LOS12Me',
                'role' => 'ROLE_MANAGER',
                'region' => 'Centre-Val De Loire',
            ],
            [
                'username' => 'Organisme région Grand-Est',
                'email' => 'est@gmail.com',
                'password' => '$2y$13$mtGdfXxUYToB.ERkH90f4upNnYn7e6tnIRshcxHnkgA1YgKftBk/6',
                'role' => 'ROLE_MANAGER',
                'region' => 'Grand-Est',
            ],
            [
                'username' => 'Organisme région Hauts-De-France',
                'email' => 'hauts@gmail.com',
                'password' => '$2y$13$3fsR0x.xkqYg5Hxfzm/DW.gGmIKwwerK3Le5P5iXcNvcLWLNejPpq',
                'role' => 'ROLE_MANAGER',
                'region' => 'Hauts-De-France',
            ],
            [
                'username' => 'Organisme région Normandie',
                'email' => 'normandie@gmail.com',
                'password' => '$2y$13$mr3yohToDrg3sXSLKwTEnetnpgXbH8CFpFnRBweY7JzNBgtWWAnNu',
                'role' => 'ROLE_MANAGER',
                'region' => 'Normandie',
            ],
            [
                'username' => 'Organisme région Nouvelle-Aquitaine',
                'email' => 'aquitaine@gmail.com',
                'password' => '$2y$13$BslG6pXzYnqSkQm5iIyAwe3OFFVjZO0IWH7k0GFQzBJ1yUrQ6.nqm',
                'role' => 'ROLE_MANAGER',
                'region' => 'Nouvelle-Aquitaine',
            ],
            [
                'username' => 'Organisme région Occitanie',
                'email' => 'occitanie@gmail.com',
                'password' => '$2y$13$0lANZ3xIrsPuRzK0nhutPuRnJxxUTxyucoMbucRVq4Tm1e6EDD5jS',
                'role' => 'ROLE_MANAGER',
                'region' => 'Occitanie',
            ],
            [
                'username' => 'Organisme région Pays de la Loire',
                'email' => 'loire@gmail.com',
                'password' => '$2y$13$C3E.VZxk57cSWsQAI0ggEOSASaUF4VFdUbjQME4j6UE0UsX7NKLOi',
                'role' => 'ROLE_MANAGER',
                'region' => 'Pays de la Loire',
            ],
            [
                'username' => 'Organisme région Provence-Alpes-Côte-D’Azur',
                'email' => 'paca@gmail.com',
                'password' => '$2y$13$Eu6U0.sVe9TKGTXNYI6Nk.J5a1.hrHcjp.PoPntQYbeutz7vpOYci',
                'role' => 'ROLE_MANAGER',
                'region' => 'Provence-Alpes-Côte-D’Azur',
            ],
        ];

        $userObjects = [];
        for ($u = 0; $u <= 16; $u++)
        {
            $user = new User;
            $user->setUsername($users[$u]['username']);
            $user->setEmail($users[$u]['email']);
            $user->setPassword($users[$u]['password']);
            $user->setRoles([$users[$u]['role']]);
            $user->setActive(1);
            foreach ($regionObjects as $region)
            {
                if($region->getName() == $users[$u]['region'])
                {
                    $user->setRegions($region);
                }
            }
            $user->setCreatedAt(new DateTimeImmutable());
            $userObjects[] = $user;
            $manager->persist($user);
        }


        $events = 
        [
            [
                'name' => 'André Rieur',
                'description' => 'Ce musicien de talent est parvenu à rendre populaire la musique classique en reprenant les thèmes les plus marquants',
                'image' => 'https://cdn.pixabay.com/photo/2016/11/19/09/57/violins-1838390_960_720.jpg',
                'genre' => 'Classique',
            ],
            [
                'name' => 'Burin Rouge',
                'description' => 'Ce groupe phare de la scène des années 80 est enfin de retour pour une toute nouvelle tournée!',
                'image' => 'https://cdn.pixabay.com/photo/2020/05/11/09/03/conductor-5157153_960_720.jpg',
                'genre' => 'Classique',
            ],
            [
                'name' => 'Les noces de Libé',
                'description' => 'Cet ensemble de musique classique revisite les grands thèmes du cinéma pour notre plus grand plaisir',
                'image' => 'https://cdn.pixabay.com/photo/2013/02/26/01/10/auditorium-86197_960_720.jpg',
                'genre' => 'Classique',
            ],
            [
                'name' => 'Le vol du moustique',
                'description' => 'Une des mélodies les plus célèbres de la musique classique revisitée par ce très bel orchestre',
                'image' => 'https://cdn.pixabay.com/photo/2017/08/10/02/23/music-2617224_960_720.jpg',
                'genre' => 'Classique',
            ],
            [
                'name' => 'Damien Marlé',
                'description' => 'Sublime combo entre reggae coloré et bonnes vibrations. Efficace et coloré!!',
                'image' => 'https://cdn.pixabay.com/photo/2016/01/31/18/06/man-1171806_960_720.jpg',
                'genre' => 'Reggae',
            ],
            [
                'name' => 'Donakil',
                'description' => 'Activiste du reggae et de la musique indépendante depuis les années 2000, Donakil nous délivre des lives brûlants imprégnés de tous ces voyages',
                'image' => 'https://cdn.pixabay.com/photo/2017/03/27/15/13/man-2179313_960_720.jpg',
                'genre' => 'Reggae',
            ],
            [
                'name' => 'Michel Palnoref',
                'description' => 'Compositeur de talent et icône de la variété française, Michel Palnoref revient avec des mélodies classiques teintées de  pop',
                'image' => 'https://cdn.pixabay.com/photo/2015/03/08/17/25/musician-664432_960_720.jpg',
                'genre' => 'Variété Française',
            ],
            [
                'name' => 'Patrick Truel',
                'description' => 'Le voilà de retour avec une tournée 100% acoustique reprenant ses plus grands classiques. Fans, soyez au rendez-vous!',
                'image' => 'https://cdn.pixabay.com/photo/2016/11/23/15/48/adult-1853663_960_720.jpg',
                'genre' => 'Variété Française',
            ],
            [
                'name' => 'Mariah C. Carré',
                'description' => 'Cette jeune niçoise débarque avec son tout nouvel album et des toutes nouvelles chansons pop  ',
                'image' => 'https://cdn.pixabay.com/photo/2013/10/04/21/13/woman-190897_960_720.jpg',
                'genre' => 'Pop',
            ],
            [
                'name' => 'Julien  Gold',
                'description' => 'Quatre ans après sa tournée sold out qui avait réuni plus de 500 000 spectateurs, Julien Gold revient pour une tournée de plus de 50 zéniths à partir de février 2022 dont quatre concerts évènements dans les plus gros zéniths de France',
                'image' => 'https://cdn.pixabay.com/photo/2017/08/01/12/42/concert-2565099_960_720.jpg',
                'genre' => 'Pop',
            ],    
            [
                'name' => 'Justin Biberon',
                'description' => 'Repéré sur Internet, ce jeune canadien est devenu en un rien de temps un phénomène médiatique. Douze ans après la sortie de son premier album, Justin Biberon est de retour cette année',
                'image' => 'https://cdn.pixabay.com/photo/2013/03/24/16/03/justin-bieber-96403_960_720.jpg',
                'genre' => 'Pop',
            ], 
            [
                'name' => 'Bob Saintclair',
                'description' => 'L\'un des plus grands DJ de tous les temps fais son come-back pour une tournée teintée de house, disco et hip-hop',
                'image' => 'https://cdn.pixabay.com/photo/2016/11/22/19/15/hand-1850120_960_720.jpg',
                'genre' => 'Electro',
            ],
            [
                'name' => 'King Alasko',
                'description' => 'Entre rêve et réalité, plongez dans l\'univers magique de King Alasko qui nous présente son tout dernier album à travers des flows aériens. ',
                'image' => 'https://cdn.pixabay.com/photo/2016/11/21/14/30/man-1845715_960_720.jpg',
                'genre' => 'Hip-Hop',
            ],
            [
                'name' => 'EtMesNems',
                'description' => 'EtMesNems se balade dans toutes les catégories : compositeur, interprète, acteur et rappeur. Il signe son retour sur la scène mondiale, préparez-vous!',
                'image' => 'https://cdn.pixabay.com/photo/2016/11/21/13/36/man-1845432_960_720.jpg',
                'genre' => 'Hip-Hop',
            ],
            [
                'name' => 'Ruby’s',
                'description' => 'Rappeur belge,Ruby’s rencontre le succès en évoluant dans un style mêlant hip-hop et house. Le tout porté par de multiples influences ',
                'image' => 'https://cdn.pixabay.com/photo/2017/03/20/18/22/hip-hop-2159913_960_720.jpg',
                'genre' => 'Hip-Hop',
            ],
            [
                'name' => 'Antarctic Monkeys',
                'description' => '4 jeunes partis pour conquérir la planète rock avec des chansons très engagées : c\'est maintenant dispo!',
                'image' => 'https://cdn.pixabay.com/photo/2018/06/30/09/29/monkey-3507317_960_720.jpg',
                'genre' => 'Alternatif',
            ],
            [
                'name' => 'Bob Harley',
                'description' => 'Bob Harley sort son nouvel album dans un style inqualifiable mais très élaboré. On aime la sauce roots teintée de hip-hop et de reggae',
                'image' => 'https://cdn.pixabay.com/photo/2017/08/02/17/38/biker-2572582_960_720.jpg',
                'genre' => 'Alternatif',
            ],
            [
                'name' => 'Skaka Punk',
                'description' => 'Ces fous furieux de la scène annoncent leur concert du futur : un punk numérique et des effets scéniques poussés à l\'extrême!! On attend de pied ferme leur premier concert de l\'année',
                'image' => 'https://cdn.pixabay.com/photo/2016/03/04/00/25/monkey-1235299_960_720.jpg',
                'genre' => 'Alternatif',
            ],
            [
                'name' => 'Couine',
                'description' => 'Le plus grand groupe des années 70 annoncent leur tournée d\'adieu aux fans et ça va être mémorable..  ',
                'image' => 'https://cdn.pixabay.com/photo/2016/10/25/13/57/watercolour-1768925_960_720.jpg',
                'genre' => 'Rock',
            ],
            [
                'name' => 'Iggy FOF',
                'description' => 'Dans son nouvel album, Iggy FOF s\'aventure entre rock,jazz et musiques africaines  et nous présnete des textes co-écrits avec les plus grandes plumes du rock international. ',
                'image' => 'https://cdn.pixabay.com/photo/2016/08/01/11/28/rock-1560867_960_720.jpg',
                'genre' => 'Rock',
            ],
            [
                'name' => 'Assez d’Essais',
                'description' => 'Identité forte et longévité ont fait d\'eux un des groupes essentiels du siècle dernier. Leur son hard rock blues est désormais intemporel.',
                'image' => 'https://cdn.pixabay.com/photo/2017/03/23/02/54/band-2167175_960_720.jpg',
                'genre' => 'Rock',
            ],
            [
                'name' => 'Purple Floyd',
                'description' => 'Le plus grand groupe de rock psychédélique des années 70 fait son grand retour sur la scène internationale, faîtes vite, c\'est bientôt complet!!',
                'image' => 'https://cdn.pixabay.com/photo/2016/08/01/11/33/live-bands-1560878_960_720.jpg',
                'genre' => 'Rock',
            ],
            [
                'name' => 'Jason Khey',
                'description' => 'Jason Khey nous présente son nouvel album à travers une tournée annoncée très colorée et très bien entourée puisqu\'il sera accompagné d\'une chorale gospel : on attend ça impatiemment',
                'image' => 'https://cdn.pixabay.com/photo/2015/09/08/17/35/man-930397_960_720.jpg',
                'genre' => 'Funk',
            ],
            [
                'name' => 'Duluxe',
                'description' => 'S\'inspirant librement des grands maitres du hip hop, du jazz et de la funk, Duluxe crée sa propre recette musicale, unique en son genre avec une seule constante : le groove ! Autant vous dire qu\'en concert Duluxe, ça remue.',
                'image' => 'https://cdn.pixabay.com/photo/2015/09/08/17/35/man-930397_960_720.jpg',
                'genre' => 'Pop',
            ],
            [
                'name' => 'JAVA',
                'description' => 'Ce quatuor parisien  qui mélange rap et accordéon, cartonne avec des textes passés au vitriol. ',
                'image' => 'https://cdn.pixabay.com/photo/2015/09/08/17/35/man-930397_960_720.jpg',
                'genre' => 'Variété Française',
            ],
            [
                'name' => 'Ninha',
                'description' => 'Ninha annonce la sortie d\'un nouvel album le 3 décembre. Des nouveaux titres que l\'on pourra découvrir en live à partir du mois prochain. Prêt à prendre votre billet ?  ',
                'image' => 'https://cdn.pixabay.com/photo/2015/09/08/17/35/man-930397_960_720.jpg',
                'genre' => 'Hip-Hop',
            ],
        ];

        for ($i = 0; $i <= 24; $i++)
        {
            $event = new Event;
            $divider = '-';
            $event->setName($events[$i]['name']);
            $event->setDescription($events[$i]['description']);
            $event->setDate($faker->dateTimeBetween('now', '+1 year'));
            $event->setPrice($faker->numberBetween(0, 200));
            $event->setImage($events[$i]['image']);
            $event->setLinkTicketing('https://www.fnac.com/');
            $text = preg_replace('~[^\pL\d]+~u', $divider, $events[$i]['name']);
            $slug = strtolower($text);
            $event->setSlug($slug);
            $event->setHour($faker->time('H:i'));
            $randomIndex = array_rand($regionObjects);
            $event->setRegion($regionObjects[$randomIndex]);
            foreach ($genreObjects as $genre)
                if($genre->getName() == $events[$i]['genre'])
                {
                    $event->addGenre($genre);
                }
            foreach ($userObjects as $user)
                if($user->getRegions() == $event->getRegion())
                {
                    $event->setUser($user);
                }
            $event->setCreatedAt(new DateTimeImmutable());
            $manager->persist($event);
        }
        
        $manager->flush();
    }
}
