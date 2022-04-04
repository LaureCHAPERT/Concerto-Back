<?php

namespace App\Controller\Api;

use App\Entity\Event;
use App\Repository\EventRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("api/event", name="api_events_")
 */
class EventController extends AbstractController
{
    /**
     * Get events collection
     * 
     * @Route("", name="list", methods={"GET"})
     * @return Response
     */
    public function getEventsCollection(EventRepository $eventRepository): Response
    {
        // Data recovery (Repository)
        $eventsList = $eventRepository->findAll();

        return $this->json(
            // Data to serialize => Convert to JSON
            $eventsList,
            // Status code
            200,
            // Response headers to add (none)
            [],
            // The groups to be used by the Serializer
            ['groups' => 'get_events_list']
        );
    }

    /**
     * Get one item
     * 
     * @Route("/{id}", name="item", methods={"GET"}, requirements={"id": "\d+"})
     * @return Response
     */
    public function getItem(int $id, EventRepository $eventRepository): Response
    {
        // Data recovery (Repository)
        $event = $eventRepository->find($id);

        if (is_null($event))
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
            $event, 
            // Status code
            200,
            // Response headers to add (none)
            [],
            // The groups to be used by the Serializer
            ['groups' => "get_events_item"]);
    }
}