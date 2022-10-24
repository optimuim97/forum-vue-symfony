<?php

namespace App\Controller;


use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AuthController extends ApiController
{
    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    /**
     * @Route("/api/register", name="register", methods={"POST"})
     * @param Request $request
     * @param UserPasswordEncoderInterface $encoder
     * @return JsonResponse
     */
    public function register(Request $request, UserPasswordEncoderInterface $encoder): JsonResponse
    {

        $errors = [];
        $request = $this->transformJsonBody($request);

        $username = $request->get('username');
        $email = $request->get('email');
        $dial_code = $request->get('dial_code');
        $phone_number = $request->get('phone_number');
        $password = $request->get('password');

        if (empty($username) ) {
            array_push($errors, "Le Champ nom d'utilisateur ne doit pas rester vide");
        }
        if(empty($email)){
            array_push($errors, "Le Champ email ne doit pas rester vide");
        }
        if (empty($password) ) {
            array_push($errors, "Le Champ mot de passe ne doit pas rester vide");
        }

        if(count($errors)){
            return $this->respondValidationError(json_encode($errors));
        }
    

        $user = new User($username);
        $user->setPassword($encoder->encodePassword($user, $password));
        $user->setEmail($email);
        $user->setUsername($username);
        $user->setDialCode($dial_code);
        $user->setPhoneNumber($phone_number);
        $user->setCreatedAt(new \DateTime());
        $user->setUpdatedAt(new \DateTime());
        $this->em->persist($user);
        $this->em-> flush();
        return $this->respondWithSuccess(sprintf('User %s successfully created', $user->getUsername()));
    }    
}
