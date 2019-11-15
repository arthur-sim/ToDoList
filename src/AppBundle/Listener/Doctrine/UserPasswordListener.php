<?php

namespace AppBundle\Listener\Doctrine;

use AppBundle\Entity\User;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Doctrine\ORM\Event\PreUpdateEventArgs;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserPasswordListener
{
    /**
     * @var UserPasswordEncoderInterface
     */
    private $userPasswordEncoder;

    public function __construct(UserPasswordEncoderInterface $userPasswordEncoder)
    {
        $this->userPasswordEncoder = $userPasswordEncoder;
    }

    public function prePersist(LifecycleEventArgs $args)
    {
        $entity = $args->getEntity();


        $this->encodePassword($entity);
    }

    public function preUpdate(PreUpdateEventArgs $args)
    {
        $entity = $args->getEntity();


        $this->encodePassword($entity);
        
        $em   = $args->getEntityManager();
        $uow  = $em->getUnitOfWork();
        $meta = $em->getClassMetadata(get_class($entity));
        $uow->recomputeSingleEntityChangeSet($meta, $entity);
    }

    private function encodePassword($entity)
    {
        if (
            (!$entity instanceof User) ||
            ($entity->getPlainPassword() === null)
        ) {
            return;
        }

        $entity->setPassword(
            $this->userPasswordEncoder->encodePassword(
                $entity,
                $entity->getPlainPassword()
            )
        );
    }
}