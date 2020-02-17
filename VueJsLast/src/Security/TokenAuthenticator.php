<?php

namespace App\Security;

use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Guard\AbstractGuardAuthenticator;


/**
 * Class TokenAuthenticator
 * @package App\Security
*/
class TokenAuthenticator extends AbstractGuardAuthenticator
{
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;


    /** @var UserRepository  */
    private $userRepository;


    /**
     * TokenAuthenticator constructor.
     * @param EntityManagerInterface $entityManager
     * @param UserRepository $userRepository
    */
    public function __construct(EntityManagerInterface $entityManager, UserRepository $userRepository)
    {
        $this->entityManager = $entityManager;
        $this->userRepository = $userRepository;
    }

    /**
     * @param Request $request
     * @return bool|mixed
    */
    public function supports(Request $request)
    {
        # added
        return $request->query->get('token');
    }

    /**
     * @param Request $request
     * @return array|mixed
    */
    public function getCredentials(Request $request)
    {
        # added
        $credentials = [
            'token' => $request->query->get('token'),
        ];

        return $credentials;
    }

    /**
     * @param mixed $credentials
     * @param UserProviderInterface $userProvider
     * @return UserInterface|void|null
     * @throws \Exception
    */
    public function getUser($credentials, UserProviderInterface $userProvider)
    {
         # Find User By Token
         $user = $this->userRepository->findOneBy(['token' => $credentials['token']]);

         if(! $user)
         {
            throw new \Exception('This token belongs to no one!');
         }

         return $user;
    }

    /**
     * @param mixed $credentials
     * @param UserInterface $user
     * @return bool
    */
    public function checkCredentials($credentials, UserInterface $user)
    {
        if($credentials['token'] === $user->getToken())
        {
            $user->setToken('');
            $this->entityManager->persist($user);
            $this->entityManager->flush();

            return true;
        }

        return false;
    }

    /**
     * @param Request $request
     * @param AuthenticationException $exception
     * @return Response|null
    */
    public function onAuthenticationFailure(Request $request, AuthenticationException $exception)
    {
        return new Response('Yeeeet!');
    }

    /**
     * @param Request $request
     * @param TokenInterface $token
     * @param string $providerKey
     * @return Response|null
    */
    public function onAuthenticationSuccess(Request $request, TokenInterface $token, $providerKey)
    {
        return new Response("You're now logged in!");
    }

    public function start(Request $request, AuthenticationException $authException = null)
    {
        // todo
    }

    public function supportsRememberMe()
    {
        // todo
    }
}
