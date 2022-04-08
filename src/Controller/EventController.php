<?php

namespace App\Controller;

use App\Entity\Event;
use App\Form\EventType;
use App\Repository\EventRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/back/event")
 */
class EventController extends AbstractController
{
    /**
     * @Route("", name="back_event_index", methods={"GET"})
     */
    public function index(EventRepository $eventRepository, Request $request): Response
    {
        // tutorial link for pagination
        // https://www.youtube.com/watch?v=PnFrb2kYRCg&t=2418s

        // Setting the number of items per page
        $limit = 10;

        // Retrieve page number
        $page = (int)$request->query->get("page", 1); 

        // Retrieving page events
        $events = $eventRepository->getPaginatedEvents($page, $limit);

        // Retrieving the total number of events
        $total = $eventRepository->getTotalEvents();

        return $this->render('event/index.html.twig', compact('events', 'total', 'limit', 'page'));
    }

    /**
     * @Route("/create", name="back_event_create", methods={"GET", "POST"})
     */
    public function new(Request $request, EventRepository $eventRepository): Response
    {
        $event = new Event();
        $form = $this->createForm(EventType::class, $event);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $eventRepository->add($event);
            return $this->redirectToRoute('back_event_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('event/create.html.twig', [
            'event' => $event,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}/update", name="back_event_update", methods={"GET", "POST"})
     */
    public function edit(Request $request, Event $event, EventRepository $eventRepository): Response
    {
        $form = $this->createForm(EventType::class, $event);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $eventRepository->add($event);
            return $this->redirectToRoute('back_event_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('event/update.html.twig', [
            'event' => $event,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="back_event_delete", methods={"POST"})
     */
    public function delete(Request $request, Event $event, EventRepository $eventRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$event->getId(), $request->request->get('_token'))) {
            $eventRepository->remove($event);
        }

        return $this->redirectToRoute('back_event_index', [], Response::HTTP_SEE_OTHER);
    }
}
