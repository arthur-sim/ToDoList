<?php
namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
 
class UserFixtures extends Fixture 
{
    public static $nbUsers = -1;
    public function load(ObjectManager $manager)
    {
        foreach ($this->getUserData() as [$id, $name, $password, $eMail, $roles]) {
            $user = (new User())
                    ->setid($id)
                    ->setUsername($name)
                    ->setPlainPassword($password)
                    ->setEmail($eMail)
                    ->setRoles($roles);
            $manager->persist($user);
            self::$nbUsers++;
            $this->addReference('user_'.self::$nbUsers, $user);           
        }
 
        $manager->flush();
    }
 
    private function getUserData(): array
    {
        return [
            ['1', 'admin1','password','test1@test.com',['ROLE_ADMIN']],
            ['2', 'admin2','password','test2@test.com',['ROLE_ADMIN']],
            ['3', 'user3','password','test3@test.com',['ROLE_USER']]
        ];
    }

}