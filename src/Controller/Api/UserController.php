<?php

namespace App\Controller\Api;

use App\Entity\User;
use App\Repository\UserRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\Serializer\Exception\NotEncodableValueException;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\ConstraintViolation;
use Symfony\Component\Validator\Validator\ValidatorInterface;


/**
 * @Route("api", name="api_user_")
 */
class UserController extends AbstractController
{

    /**
     * Create user item
     *
     * @Route("/user/create", name="api_user_post", methods={"POST"})
     */
    public function createItem(Request $request, SerializerInterface $serializer, ManagerRegistry $doctrine, ValidatorInterface $validator, UserPasswordHasherInterface $userPasswordHasherInterface)
    {
        $jsonContent = $request->getContent();

        try 
        {
            $user = $serializer->deserialize($jsonContent, User::class, 'json');
        } 
        catch (NotEncodableValueException $e) 
        {
            return $this->json(
                ['error' => 'JSON error'],
                Response::HTTP_UNPROCESSABLE_ENTITY
            );
        }

        $errors = $validator->validate($user);

        if (count($errors) > 0) 
        {
            $errorsClean = [];
            /** @var ConstraintViolation $error */
            foreach ($errors as $error) 
            {
                $errorsClean[$error->getPropertyPath()][] = $error->getMessage();
            };
            return $this->json($errorsClean, Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $entityManager = $doctrine->getManager();
        $hashedPassword = $userPasswordHasherInterface->hashPassword($user, $user->getPassword());
        $user->setPassword($hashedPassword);
        $entityManager->persist($user);
        $entityManager->flush();
        return $this->json(
            $user,
            Response::HTTP_CREATED,
            [
                'Location' => $this->generateUrl('api_events_home')
            ],
            ['groups' => 'get_user_item']
        );
    }

    /**
     * Login
     * 
     * @Route("/login", name="api_user_login", methods={"POST"})
     */
    public function login()
    {

    }
}