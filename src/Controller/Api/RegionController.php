<?php

namespace App\Controller\Api;

use App\Entity\Region;
use App\Repository\RegionRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("api/region", name="api_regions_")
 */
class RegionController extends AbstractController
{
    /**
     * Get regions collection
     * 
     * @Route("", name="list", methods={"GET"})
     * @return Response
     */
    public function getRegionsCollection(RegionRepository $regionRepository): Response
    {
        // Data recovery (Repository)
        $regionsList = $regionRepository->findAll();

        return $this->json(
            // Data to serialize => Convert to JSON
            $regionsList,
            // Status code
            200,
            // Response headers to add (none)
            [],
            // The groups to be used by the Serializer
            ['groups' => 'get_regions_list']
        );
    }

    /**
     * Get one item
     * 
     * @Route("/{id}/events", name="item", methods={"GET"}, requirements={"id": "\d+"})
     * @return Response
     */
    public function getItem(int $id, RegionRepository $regionRepository): Response
    {
        // Data recovery (Repository)
        $region = $regionRepository->find($id);

        if (is_null($region))
        {
            $data = 
            [
                'error' => true,
                'message' => 'Evénement non trouvé',
            ];
            return $this->json($data, Response::HTTP_NOT_FOUND);
        }

        return $this->json(

            // Data to serialize => Convert to JSON
            $region, 
            // Status code
            200,
            // Response headers to add (none)
            [],
            // The groups to be used by the Serializer
            ['groups' => "get_regions_item"]);
    }
}