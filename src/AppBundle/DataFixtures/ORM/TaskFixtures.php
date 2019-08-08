<?php
namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\Task;
use AppBundle\DataFixtures\ORM\UserFixtures;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class TaskFixtures extends Fixture 
{
    public function load(ObjectManager $manager)
    {     
        foreach ($this->getTaskData() as [ $title, $content, $isDone]) {
            $user = $this->getReference('user_'.rand(0, UserFixtures::$nbUsers));
            $product = (new Task())
                    ->setTitle($title)
                    ->setContent($content)
                    ->setIsDone($isDone)
                    ->setUser($user);
            $manager->persist($product);    
        }
 
        $manager->flush();
    }
 
    private function getTaskData(): array
    {
        return [
                ['Task1','Content1', '0'],
                ['Task2','Content2', '0'],
                ['Task3','Content3', '0']
            ];
    }
    public function getDependencies() {
        return [UserFixtures::class];
    }

}

