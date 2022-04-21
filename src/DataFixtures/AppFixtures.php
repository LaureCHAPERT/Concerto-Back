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
use Symfony\Component\Validator\Constraints\Length;

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
                'name' => 'Trio',
                'description' => 'Trio repart en campagne avec un nouvel album. Des nouvelles chansons aux allures métissées que l\'on pourra découvrir en concert dans les semaines et les mois à venir.',
                'image' => 'https://images.pexels.com/photos/1427368/pexels-photo-1427368.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=750&w=1260',
                'genre' => 'Variété Française',
            ],
            [
                'name' => 'Maestro',
                'description' => 'Après plusieurs années de silence, le belge est de retour en 2022 avec la sortie en mars de son nouvel album . Côté concerts, Maestro fera la tournée des festivals durant l\'été 2022. Maestro est prêt à nous faire danser à nouveau !',
                'image' => 'https://images.pexels.com/photos/7754770/pexels-photo-7754770.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=750&w=1260',
                'genre' => 'Variété Française',
            ],
            [
                'name' => 'Micro et Oli',
                'description' => 'Rappeurs toulousains, ils sont des références du paysage musicial français. Très complices, les deux frères sont à la fois auteurs et compositeurs, leur musique est acompagnée de textes percutants mais ne se voulant jamais moralisateur.',
                'image' => 'https://images.pexels.com/photos/748838/pexels-photo-748838.jpeg?auto=compress&cs=tinysrgb&dpr=1&w=500',
                'genre' => 'Hip-Hop',
            ],
            [
                'name' => 'Mouse',
                'description' => 'Emmené par le charismatique Mathew, le trio a su s\'imposer entre Nirvana et Radiohead. L\'un des plus grands groupes de rock de la planète.',
                'image' => 'https://images.pexels.com/photos/417473/pexels-photo-417473.jpeg?auto=compress&cs=tinysrgb&dpr=1&w=500',
                'genre' => 'Rock',
            ],
            [
                'name' => 'First Train',
                'description' => 'Les blousons du rock and roll, sans ses clichés. Les slims de la pop, sans sa naïveté. Les boots du blues, sans son prosaïsme. Les jeunes First Train libèrent un rock and roll hypnotique, dans un univers écorché et maîtrisé.
                ',
                'image' => 'https://images.pexels.com/photos/7715766/pexels-photo-7715766.jpeg?auto=compress&cs=tinysrgb&dpr=1&w=500',
                'genre' => 'Rock',
            ],
            [
                'name' => '-N-',
                'description' => '-N-repart en tournée ! D\'abord dans les clubs de concerts pour dévoiler en live les titres de son nouvel album  puis à l\'affiche des festivals de l\'été.  Les fans ont déjà leur billet ! Et vous ?

                ',
                'image' => 'https://images.pexels.com/photos/8044204/pexels-photo-8044204.jpeg?auto=compress&cs=tinysrgb&dpr=1&w=500',
                'genre' => 'Rock',
            ],
            [
                'name' => 'Zuccherry',
                'description' => 'Le patron du rhythm\'n\'blues italien, était de retour en 2019 avec un nouvel album qui le met à nouveau sur les routes. On verra prochainement le soulman italien en concert en France pour interpréter ses derniers titres ',
                'image' => 'https://images.pexels.com/photos/1450114/pexels-photo-1450114.jpeg?auto=compress&cs=tinysrgb&dpr=1&w=500',
                'genre' => 'Pop',
            ],
            [
                'name' => 'Dragons imaginaires',
                'description' => 'Avec un son indie-rock aux influences électro, le groupe Dragons imaginaires a su conquérir la planète avec son dernier album. Le groupe a su s\'imposer dans le coeur des fans. ',
                'image' => 'https://images.pexels.com/photos/3769099/pexels-photo-3769099.jpeg?auto=compress&cs=tinysrgb&dpr=1&w=500',
                'genre' => 'Rock',
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
                'name' => 'JYL',
                'description' => 'Le Marseillais Jyl réalise en 2014 l\'exploit de passer du rap souterrain à la lumière des meilleures ventes du top albums.',
                'image' => 'https://images.pexels.com/photos/802195/pexels-photo-802195.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=750&w=1260',
                'genre' => 'Hip-Hop',
            ],

            [
                'name' => 'MOSHI',
                'description' => 'Deux ans après un premier album écoulé à plus de 200 000 exemplaires, celle que l\'on qualifie de nouvelle étoile de la chanson française a sorti un deuxième opus le 5 juin 2020. C\'est dans le tourbus d\'une tournée de plus de 140 dates à travers la France que naît ce nouvel album.',
                'image' => 'https://images.pexels.com/photos/2838868/pexels-photo-2838868.jpeg?auto=compress&cs=tinysrgb&dpr=1&w=500',
                'genre' => 'Hip-Hop',
            ],
            [
                'name' => 'Damien Marlé',
                'description' => 'Sublime combo entre reggae coloré et bonnes vibrations. Efficace et coloré!!',
                'image' => 'https://cdn.pixabay.com/photo/2016/01/31/18/06/man-1171806_960_720.jpg',
                'genre' => 'Reggae',
            ],
            [
                'name' => 'Donakil',
                'description' => 'Activiste du reggae et de la musique indépendante depuis les années 2000, Donakil nous délivre des lives brûlants imprégnés de tous ses voyages',
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
                'genre' => 'Alternative',
            ],
            [
                'name' => 'Bob Harley',
                'description' => 'Bob Harley sort son nouvel album dans un style inqualifiable mais très élaboré. On aime la sauce roots teintée de hip-hop et de reggae',
                'image' => 'https://cdn.pixabay.com/photo/2017/08/02/17/38/biker-2572582_960_720.jpg',
                'genre' => 'Alternative',
            ],
            [
                'name' => 'Skaka Punk',
                'description' => 'Ces fous furieux de la scène annoncent leur concert du futur : un punk numérique et des effets scéniques poussés à l\'extrême!! On attend de pied ferme leur premier concert de l\'année',
                'image' => 'https://cdn.pixabay.com/photo/2016/03/04/00/25/monkey-1235299_960_720.jpg',
                'genre' => 'Alternative',
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
                'image' => 'https://images.pexels.com/photos/11372431/pexels-photo-11372431.jpeg?auto=compress&cs=tinysrgb&dpr=3&h=750&w=1260',
                'genre' => 'Funk',
            ],
            [
                'name' => 'Duluxe',
                'description' => 'S\'inspirant librement des grands maitres du hip hop, du jazz et de la funk, Duluxe crée sa propre recette musicale, unique en son genre avec une seule constante : le groove ! Autant vous dire qu\'en concert Duluxe, ça remue.',
                'image' => 'https://images.pexels.com/photos/4142420/pexels-photo-4142420.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=750&w=1260',
                'genre' => 'Pop',
            ],
            [
                'name' => 'JAVA',
                'description' => 'Ce quatuor parisien  qui mélange rap et accordéon, cartonne avec des textes passés au vitriol. ',
                'image' => 'https://images.pexels.com/photos/838685/pexels-photo-838685.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=750&w=1260',
                'genre' => 'Variété Française',
            ],
            [
                'name' => 'Ninha',
                'description' => 'Ninha annonce la sortie d\'un nouvel album le 3 décembre. Des nouveaux titres que l\'on pourra découvrir en live à partir du mois prochain. Prêt à prendre votre billet ?  ',
                'image' => 'https://cdn.pixabay.com/photo/2015/09/08/17/35/man-930397_960_720.jpg',
                'genre' => 'Hip-Hop',
            ],
            [
                'name' => 'Jami Irokoi',
                'description' => 'Le groupe Jami Irokoi en tournée mondiale vient nous rendre visite! Ne manquer cette occasion, le dernioer concert en France remonte à 10 ans.',
                'image' => 'https://cdn.pixabay.com/photo/2020/07/23/11/58/man-5431169_960_720.jpg',
                'genre' => 'Funk',
            ],
            [
                'name' => 'Stevie Merveille',
                'description' => 'Stevie annonce sa dernière tournée le 6 juin. Concert qui va rester dans les mémoires, à ne surtout pas manquer!  ',
                'image' => 'https://cdn.pixabay.com/photo/2019/09/20/08/45/mud-morganfield-4491155_960_720.jpg',
                'genre' => 'Funk',
            ],
            [
                'name' => 'Mute',
                'description' => 'MEUTE est une Techno Marching Band - une douzaine de batteurs et de cornistes de Hambourg / Allemagne qui accomplissent le travail d\'un DJ avec leurs instruments acoustiques. Cette fanfare d\'un autre genre se balade sur l\'alliance de la techno et de la house.',
                'image' => 'https://images.pexels.com/photos/5781090/pexels-photo-5781090.jpeg?auto=compress&cs=tinysrgb&dpr=1&w=500',
                'genre' => 'Electro',
            ],
            [
                'name' => 'Martin Touareg',
                'description' => 'Avec plusieurs millions d\'albums vendus dans le monde et de nombreux singles multi-platine, le DJ-producteur-compositeur Martin TOuareg rencontre le même succès depuis 20 ans. Il défend désormais ses titres sur scène, non plus en tant que DJ mais en tant que performer et parfois chanteur avec un spectacle original au format live...',
                'image' => 'https://images.pexels.com/photos/1649693/pexels-photo-1649693.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=750&w=1260',
                'genre' => 'Electro',
            ],
            [
                'name' => 'OfenPâques',
                'description' => 'Après le succès mondial de leurs hits , les deux prodiges d\'Ofenbach se préparent à électriser la France lors de leur première tournée .',
                'image' => 'https://images.pexels.com/photos/1694900/pexels-photo-1694900.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=750&w=1260',
                'genre' => 'Electro',
            ],
            [
                'name' => 'Les pierres qui roulent',
                'description' => 'Les pierres qui roulent c\'est la formation de plusieurs diables du rock\'n roll. Ils font leur chemin dans le monde de la musique et restent un pilier indestructible depuis 60 ans. Alors que tant d\'autres ont disparu, ils continuent de délivrer leur musique survoltée. Leur Sixty Tour 22 compte 14 dates en Europe dont deux concerts en France. ',
                'image' => 'https://cdn.pixabay.com/photo/2012/12/22/03/34/keith-richards-71853__480.jpg',
                'genre' => 'Rock',
            ],
            [
                'name' => 'Diana Cross',
                'description' => 'Diana Cross sera en concert le 14 mai, cette artiste mythique nous annonce un concert inoubliable! ',
                'image' => 'https://cdn.pixabay.com/photo/2017/08/25/11/54/concert-2679903_960_720.jpg',
                'genre' => 'Funk',
            ],
            [
                'name' => 'Jason Key',
                'description' => 'Jason Key artiste populaire du Funk sera en concert en novembre. Venez nombreux découvrir ou redécouvrir cet artiste outre-Atlantique.',
                'image' => 'https://cdn.pixabay.com/photo/2022/04/01/17/24/singer-7105305_960_720.jpg',
                'genre' => 'Funk',
            ],
            [
                'name' => 'Bruno Jupiter',
                'description' => 'Bruno Jupiter donnera un concert venu de l\'espace. Venez vibrer lors de ce concert interstellaire.',
                'image' => 'https://cdn.pixabay.com/photo/2017/08/01/14/51/concert-2566001_960_720.jpg',
                'genre' => 'Funk',
            ],
            [
                'name' => 'Keziah John',
                'description' => 'Keziah John viendra enflammer la scène lors de son prochain concert, à ne surtout pas manquer.',
                'image' => 'https://cdn.pixabay.com/photo/2020/09/05/03/20/singer-5545481_960_720.jpg',
                'genre' => 'Funk',
            ],
            [
                'name' => 'Tonton Dave',
                'description' => 'Tonton Dave sera en concert en octobre. Notre roi du Reggae français nous fera un concert dans le pur style Jamaïcain. Prenez vite vos billets!',
                'image' => 'https://cdn.pixabay.com/photo/2017/10/02/21/08/music-2810220_960_720.jpg',
                'genre' => 'Reggae',
            ],
            [
                'name' => 'Pat Tryce',
                'description' => 'Pat Tryce sera en concert en avril. Cet artiste au reggae planant fera plusieurs dates en France. Prenez vite vos billets!',
                'image' => 'https://cdn.pixabay.com/photo/2021/05/28/08/57/man-6290275_960_720.jpg',
                'genre' => 'Reggae',
            ],
            [
                'name' => 'Via nez',
                'description' => 'Ses morceaux ont la couleur et la chaleur des feux de joie, le rayonnement des grands embrasements populaires.',
                'image' => 'https://images.pexels.com/photos/375893/pexels-photo-375893.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940',
                'genre' => 'Alternative',
            ],
            [
                'name' => 'Theremin',
                'description' => '
                Pilier de l\'alternatif hexagonal, Theremin est dans son genre un explorateur. Chaque projet est pour le musicien le prétexte d\'emprunter une nouvelle voix. Il sera donc intéressant de voir Theremin en concert transposer en live ses visions.  ',
                'image' => 'https://images.pexels.com/photos/4407690/pexels-photo-4407690.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940',
                'genre' => 'Alternative',
            ],
            [
                'name' => 'Camille Jordane',
                'description' => '
                Chanteuse de talent mais aussi actrice césarisée, Camille Jordane est une artiste accomplie. Elle rafraîchit et réinvente la chanson française. Raconter son quotidien de femme, sur des mélodies entêtantes et envoûtantes : voici sa marque de fabrique. ',
                'image' => 'https://images.pexels.com/photos/1864641/pexels-photo-1864641.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=750&w=1260',
                'genre' => 'Alternative',
            ],
            [
                'name' => 'Rodriguo',
                'description' => '            
                Née à Rio de Janeiro le 1er juillet 1967, Rodriguo s\'intéresse à la musique dès son plus jeune âge et, enfant, il prend des cours de piano et de batterie. À l\'adolescence,il intensifie ses études de chant et de théorie musicale, s\'intéresse de près à la musique brésilienne, et chante dans les groupes de ses amis.
',
                'image' => 'https://images.pexels.com/photos/2124569/pexels-photo-2124569.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=750&w=1260',
                'genre' => 'Alternative',
            ],
            [
                'name' => 'Antibalos',
                'description' => '            
                Avec une solide section de cuivres, un gang de percussionnistes experts, une rythmique funky et des textes chantés en anglais, espagnol et yoruba, Antibalos possède une puissance de feu prête à donner un nouveau souffle torride à l\'afrobeat alternatif.  Antibalos est décapant de sons électriques et traditionnels. En somme, un groove dansant et hypnotique.
',
                'image' => 'https://images.pexels.com/photos/1365167/pexels-photo-1365167.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=750&w=1260',
                'genre' => 'Alternative',
            ],
            [
                'name' => 'Vaudoo',
                'description' => '            
                Contraints au confinement, comme une bonne partie de la planète,les membres du groupe Vaudoo n’ont eu d’autre choix que de se retrancher en studio, des retrouvailles pour à nouveau invoquer les divinités et leurs forces spirituelles. Au départ pour un EP, mais les puissances créatrices ne se contrarient pas et impossible de les repousser quand elles ont décidé de s’inviter plus longtemps.Un message d’espoir autant qu’un appel au rassemblement pour traverser la tourmente et ressortir meilleurs.
',
                'image' => 'https://images.pexels.com/photos/6826755/pexels-photo-6826755.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=750&w=1260',
                'genre' => 'Alternative',
            ],
            [
                'name' => 'Camil',
                'description' => '            
                L\'auteur-compositeur-interprète et producteur colombien Camil, considéré comme l\'un des plus grands représentants de la nouvelle pop, revient en France après son tour du monde! Il y a étendu son exploration de genres tels que la pop, la champeta, la cumbia, l\'urbain, le corrido et le folklore colombien, en jouant de divers instruments tels que la guitare, le cuatro, le ronroco, le charango et le piano.
',
                'image' => 'https://images.pexels.com/photos/8973602/pexels-photo-8973602.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=750&w=1260',
                'genre' => 'Alternative',
            ],
            [
                'name' => 'Vivaldi et les quatres saisons',
                'description' => '            
                L\'Orchestre Ensemble reprend ce classique intemportel de Vivaldi.
',
                'image' => 'https://images.pexels.com/photos/2102568/pexels-photo-2102568.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=750&w=1260',
                'genre' => 'Classique',
            ],
            [
                'name' => 'Aïka',
                'description' => '            
                Le plus intemporel des opéras, sera interprété cette année par plus de 100 artistes sur scène, porté par une scénographie spectaculaire et des décors grandioses, pour un spectacle pharaonique.',
                'image' => 'https://images.pexels.com/photos/573914/pexels-photo-573914.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=750&w=1260',
                'genre' => 'Classique',
            ],
            [
                'name' => 'Camille et July Berthalet',
                'description' => '            
                Après avoir été révélées au grand public lors de show télévisés Camille et Julie se sont imposées comme meilleures ventes de musique classique.
                Elles reviennent avec une nouvelle tournée, insufflant une nouvelle énergie à leur univers artistique.',
                'image' => 'https://images.pexels.com/photos/7095043/pexels-photo-7095043.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=750&w=1260',
                'genre' => 'Classique',
            ],
            [
                'name' => 'Jean-michel Blaz',
                'description' => '            
                Maîtrisant déjà l\'art de tisser beauté et prouesses techniques au piano, Jean-Michel Blaz compose pour ensemble pour la première fois de sa carrière.',
                'image' => 'https://images.pexels.com/photos/6192181/pexels-photo-6192181.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=750&w=1260',
                'genre' => 'Classique',
            ],
            [
                'name' => 'Ludovico',
                'description' => '            
                Ses 3 concerts à Paris affichant complets en quelques semaines, Ludovico Einaudi ajoute une série de concerts à sa tournée !
                Un concert inédit pour nous présenter son nouvel album solo. De nouvelles compositions dans leurs formes la plus pure et la plus intime, mettant en valeur son style si unique.',
                'image' => 'https://images.pexels.com/photos/1631666/pexels-photo-1631666.jpeg?auto=compress&cs=tinysrgb&dpr=1&w=500',
                'genre' => 'Classique',
            ],
            [
                'name' => 'Sick and Baw',
                'description' => '            
                La force rythmique du piano et de la percussion alliée au lyrisme du violoncelle offre une écoute rafraîchissante des œuvres passionnantes de ce trio étonnant qui saura charmer et éblouir un large public avec des nouvelles couleurs et des sonorités surprenantes. L’album reste bien empreint de cette nostalgie palpable du tango, ici interprété par deux argentins en exil, loin de leur terre natale.',
                'image' => 'https://images.pexels.com/photos/7095836/pexels-photo-7095836.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=750&w=1260',
                'genre' => 'Classique',
            ],
            [
                'name' => 'Spring Festival',
                'description' => '            
                Summer Festival envahit la ville de ses décibels ! Les plus grandes stars DJ s\'y donnent en effet rendez-vous pour une grande fiesta électro , qui pour la toute première fois  durera deux jours, au plus grand bonheur des fans.',
                'image' => 'https://images.pexels.com/photos/3633307/pexels-photo-3633307.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940',
                'genre' => 'Electro',
            ],
            [
                'name' => 'Drummers',
                'description' => '            
                Ces trois frères tambourinent depuis leur naissance pour nous offrir une performance de jonglerie musicale virevoltante et remplie d\'humour.Entre rythmes effrénés et poésie, les trois frères mélangent allègrement les disciplines.Une expérience inédite de jonglerie musicale, des numéros époustouflants, un l’humour décalé ! Inclassable ! ',
                'image' => 'https://images.pexels.com/photos/5781090/pexels-photo-5781090.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940',
                'genre' => 'Rock',
            ],
            [
                'name' => 'Electrik Deux',
                'description' => ' C’est un groupe inclassable ! Depuis quinze ans, Electrik Deux revisite et bouleverse l’héritage jazz, soul, funk sur toutes les scènes mondiales. Le groupe s’aventure en territoire inconnu, quelque part entre groove organique et émotions digitales. Comme si le groove des années 70 rencontrait la french touch et l’électro d’aujourd’hui. Sans rien renier de ses fondamentaux, le groupe réussit l’alliance des époques et des courants musicaux dans un nouveau son unique et intemporel.   ',
                'image' => 'https://images.pexels.com/photos/2240766/pexels-photo-2240766.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940',
                'genre' => 'Electro',
            ],
            [
                'name' => 'Swiss House',
                'description' => ' En même temps que leur nouveau single, Swiss House a annoncé une tournée internationale, leur première vraie tournée depuis 2012. Longtemps vénérés par les fans pour leurs performances live grandioses, les membres du groupe ont vendu plus d\'un million de billets lors de leur précédente sortie. ',
                'image' => 'https://images.pexels.com/photos/3682820/pexels-photo-3682820.jpeg?auto=compress&cs=tinysrgb&dpr=1&w=500',
                'genre' => 'Electro',
            ],
            [
                'name' => 'Ben Restassis',
                'description' => ' Le Dj italien Benny Benassi est connu pour ses productions tech house, house et electroclash. 2022 marque l\'année d\'un fabuleux nouvel album et donc d\'une tournée!',
                'image' => 'https://images.pexels.com/photos/1845537/pexels-photo-1845537.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940',
                'genre' => 'Electro',
            ],
            [
                'name' => 'Fider',
                'description' => ' Issu d’influences deep, house et hip-pop, la première sortie de ce nouveau projet sera un rework contemporain de son dernier album, qui lui vaudra la validation une victoire de la musique. ',
                'image' => 'https://images.pexels.com/photos/3400600/pexels-photo-3400600.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940',
                'genre' => 'Electro',
            ],
            [
                'name' => 'Laurent Loup',
                'description' => ' 
                Laurent Loup fait danser les frénétiques de la house et du groove depuis l\'orée des nineties.  ',
                'image' => 'https://images.pexels.com/photos/2461694/pexels-photo-2461694.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940',
                'genre' => 'Electro',
            ],
            [
                'name' => 'Le gang des cool ',
                'description' => ' 
                The Kings of Disco Funk revient en tournée pour faire danser toute la France  Les frères de la soul reviennent mettre le feu au public après leur dernier concert en 2011 au Palais des Congrès à Paris.
  ',
                'image' => 'https://images.pexels.com/photos/9010057/pexels-photo-9010057.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940',
                'genre' => 'Funk',
            ],
            [
                'name' => 'Janet ',
                'description' => ' 
                Le show de Janet n’est pas un simple spectacle, ni une succession de numéros, c’est une expérience hors du temps, un show immersif sur des tubes disco funk joués et chantés par un orchestre live survolté. La soirée sera dirigée par une maîtresse de cérémonie déjantée, fil rouge du spectacle qui tiendra le public en haleine. Cette sublime diva sera accompagnée par un « assistant », véritable trublion, qui pourra faire déraper le spectacle à tout moment. Elle emmènera dans sa folie danseuses, danseurs, artistes, musiciens et public.
  ',
                'image' => 'https://images.pexels.com/photos/9009524/pexels-photo-9009524.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940',
                'genre' => 'Funk',
            ],
            [
                'name' => 'Mateo Parker ',
                'description' => ' 
                La "Mateo\'s touch", souvent critiquée par la presse spécialisée, connaît un enthousiasme débordant du côté du public, et particulièrement en France où il fait salle comble à chaque passage.

                Le pape du funk fait encore et toujours groover les salles.
  ',
                'image' => 'https://images.pexels.com/photos/8968215/pexels-photo-8968215.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940',
                'genre' => 'Funk',
            ],
            [
                'name' => 'Japanese Man ',
                'description' => ' 
                A l\'occasion des 15 ans du Label, les membres de Japanese Man ,se retrouvent en Live pour une création commune autour de leur dernier album.
                Pour présenter sur scène cet album et les classiques de chaque groupe, ils invitent des monstres de la scène hip-hop internationale, à les rejoindre pour un show exclusif et explosif, mixant les univers musicaux et visuels des 3 groupes entre HipHop, Electro Tropical et Scratch Music.
  ',
                'image' => 'https://images.pexels.com/photos/1845085/pexels-photo-1845085.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940',
                'genre' => 'Hip-Hop',
            ],
            [
                'name' => 'Burn DMC ',
                'description' => ' 
                Sans nul doute, le groupe de rap US qui, le premier aura marqué l\'histoire de ce mouvement en l\'amenant auprès d\'un large public.
  ',
                'image' => 'https://images.pexels.com/photos/3656773/pexels-photo-3656773.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940',
                'genre' => 'Hip-Hop',
            ],
            [
                'name' => 'Burn DMC ',
                'description' => ' 
                Burn DMC est un artiste à part. Il plane entre rêve et réalité dans l\'univers magique de son dernier album il développe des flows aériens et un lyrisme honnête et touchant.
  ',
                'image' => 'https://images.pexels.com/photos/3648641/pexels-photo-3648641.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940',
                'genre' => 'Hip-Hop',
            ],
            [
                'name' => 'Led Shiran ',
                'description' => ' 
                Et c\'est reparti pour une nouvelle tournée des stades ! Polly Siz présentera en concert les titres de son nouvel album mais aussi les tubes de ses précédents albums. Avec l\'énergie qu\'on lui connait, comptez sur le britannique pour faire de ses concerts des prestations qui resteront dans la mémoire de chaque spectateur. Prêt pour réserver votre billet ?
  ',
                'image' => 'https://images.pexels.com/photos/838702/pexels-photo-838702.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940',
                'genre' => 'Pop',
            ],
            [
                'name' => 'Polly Siz ',
                'description' => ' 
                Curieuse et avide, elle a pu s’ouvrir à de nouvelles influences.Elle est revenue de New York avec des percussions mélangées aux programmations Hip Hop, des flows hypnotiques et des claps qui annoncent les sirènes des riffs de guitares émanant d’un garage de Brooklyn. Elle y a notamment fait la rencontre de Luke Jenner (the Rapture), grand chantre du rock electro, et des gamins du Hip Hop survitaminé de The Skins, qui ont été déterminants dans la couleur et la forme de cet opus.
  ',
                'image' => 'https://images.pexels.com/photos/3358299/pexels-photo-3358299.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940',
                'genre' => 'Pop',
            ],
            [
                'name' => 'Duo Lipo ',
                'description' => ' 
                Duo Lipo  est une chanteuse pop née à Londres. Après trois premiers singles très remarqués au Royaume-Uni, elle s\'embarque pour une tournée et rencontre le succès à l\'international .
  ',
                'image' => 'https://images.pexels.com/photos/1150836/pexels-photo-1150836.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940',
                'genre' => 'Pop',
            ],
            [
                'name' => 'Franck Maintenant ',
                'description' => ' L\'odyssée pop de Franck Maintenant tient en grande partie au mélange unique de mélodies pop et de beats hyper-dansants .
  ',
                'image' => 'https://images.pexels.com/photos/167445/pexels-photo-167445.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940',
                'genre' => 'Pop',
            ],
            [
                'name' => 'Soldat Louise ',
                'description' => ' Guitare acoustique et Voix. Nos trois inséparables sont délicieux à souhait, variés, un peu sucré-salé, très tendance dans un registre uniquement de variété française et on en redemande !
  ',
                'image' => 'https://images.pexels.com/photos/2277438/pexels-photo-2277438.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940',
                'genre' => 'Pop',
            ],
            [
                'name' => 'David Guetto',
                'description' => 'Toujours en tournée dans toute la France. Le pilier de la scène électronique Française, symbole de la French touch, mondialement connu, n\'a pas perdu de son talent et à encore beaucoup d\'énergie à revendre. On vous attend nombreux !',
                'image' => 'https://cdn.pixabay.com/photo/2017/04/11/22/55/lightshow-2223127_960_720.jpg',
                'genre' => 'Electro',
            ]
        ];

        for ($i = 0; $i <= count($events) - 1; $i++)
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
            $hour = date_create_from_format('H:i', $faker->time('H:i'));
            $event->setHour($hour);
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
