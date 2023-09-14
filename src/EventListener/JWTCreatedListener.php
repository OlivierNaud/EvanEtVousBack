<?php

namespace App\EventListener;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Lexik\Bundle\JWTAuthenticationBundle\Event\JWTCreatedEvent;
use Symfony\Component\HttpFoundation\RequestStack;

final class JWTCreatedListener
{

  /**
     * @var RequestStack
     */
    private $requestStack;

    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    public function __construct(RequestStack $requestStack, EntityManagerInterface $entityManager)
    {
        $this->requestStack = $requestStack;
        $this->entityManager = $entityManager;
    }

    public function onJWTCreated(JWTCreatedEvent $event): void
    {
        $payload = $event->getData();
        $authUser = $this->entityManager->getRepository(User::class)->findOneBy(['email' => $payload['username']]);
        $payload['email'] = $authUser->getEmail();
        $payload['id'] = $authUser->getId();
        $payload['lastname'] = $authUser->getLastName();
        $payload['firstname'] = $authUser->getFirstName();
        $payload['phone'] = $authUser->getPhone();
        unset($payload['username']);
        
        $event->setData($payload);
    }
}