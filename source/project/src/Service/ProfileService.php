<?php

namespace App\Service;

use App\Entity\Filter;
use App\Entity\Profile;
use Doctrine\ORM\EntityManagerInterface;

class ProfileService
{
    /** @var EntityManagerInterface */
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager) {
        $this->entityManager = $entityManager;
    }

    public function getProfile(string $name) {
        /** @var Profile $user */
        $user = $this->entityManager
            ->getRepository(Profile::class)
            ->findOneBySomeField($name)
            ;
        //---
        return $user->getName();
    }

    /**
     * Получение имени профиля (в последующем можно привязать к entity User через Profile пользователя)
     * @param int $configId
     * @return mixed
     */
    public function show(int $configId) {
        /** @var Profile $config */
        $config = $this->entityManager
            ->getRepository(Profile::class)
            ->find($configId);
        //---
        return $config->getName();
    }

    public function setProfile(string $user) {
        /** @var Profile $user */
        $profile = $this->entityManager->getRepository(Profile::class)->findOneBySomeField($user);

        if($profile === null) {     // моделируем ситуацию отсутствия пользователя в DB
            $profile = new Profile();
            $profile->setName($user);
            $this->entityManager->persist($profile);
            $this->entityManager->flush();
            $this->entityManager->clear();
        }
        //---
        return $profile->getId();
    }
}