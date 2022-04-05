<?php

namespace App\Controller\Api;

use App\Entity\Genre;
use App\Repository\GenreRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("api/genre", name="api_genres_")
 */
class GenreController extends AbstractController
{
    /**
     * Get genres collection
     * 
     * @Route("", name="list", methods={"GET"})
     * @return Response
     */
    public function getGenresCollection(GenreRepository $genreRepository): Response
    {
        // Data recovery (Repository)
        $genresList = $genreRepository->findAll();

        return $this->json(
            // Data to serialize => Convert to JSON
            $genresList,
            // Status code
            200,
            // Response headers to add (none)
            [],
            // The groups to be used by the Serializer
            ['groups' => 'get_genres_list']
        );
    }

    /**
     * Get one item
     * 
     * @Route("/{id}/events", name="item", methods={"GET"}, requirements={"id": "\d+"})
     * @return Response
     */
    public function getItem(int $id, GenreRepository $genreRepository): Response
    {
        // Data recovery (Repository)
        $genre = $genreRepository->find($id);

        if (is_null($genre))
        {
            $data = 
            [
                'error' => true,
                'message' => 'Non trouvé',
            ];
            return $this->json($data, Response::HTTP_NOT_FOUND);
        }

        return $this->json(

            // Data to serialize => Convert to JSON
            $genre, 
            // Status code
            200,
            // Response headers to add (none)
            [],
            // The groups to be used by the Serializer
            ['groups' => "get_genres_item"]);
    }
}