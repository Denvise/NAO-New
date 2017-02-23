<?php

namespace NAO\CoreBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use NAO\CoreBundle\Entity\User;

class LoadUser extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        // Liste des utilisateurs
        $listUsers = array(
            array(
                'username' => 'Michou',
                'lastname' => 'DUJARDIN',
                'firstname' => 'Michel',
                'accountType' => 'Administrateur',
                'password' => 'admin',
                'salt' => '',
                'question' => 'Claudine',
                'roles' => array('ROLE_SUPER_ADMIN'),
                'valid' => true,
                'reference' => 'admin_user'
            ),
            array(
                'username' => 'Clo56',
                'lastname' => 'DURAND',
                'firstname' => 'Claude',
                'accountType' => 'Naturaliste',
                'password' => 'naturaliste',
                'salt' => '',
                'question' => 'Michelle',
                'roles' => array('ROLE_ADMIN'),
                'valid' => true,
                'reference' => 'naturaliste_user_1'
            ),
            array(
                'username' => 'Marty78',
                'lastname' => 'MARTIN',
                'firstname' => 'Jean',
                'accountType' => 'Naturaliste',
                'password' => 'naturaliste',
                'salt' => '',
                'question' => 'Sophie',
                'roles' => array('ROLE_ADMIN'),
                'valid' => false,
                'reference' => 'naturaliste_user_2'
            ),
            array(
                'username' => 'Katkat',
                'lastname' => 'DUPONT',
                'firstname' => 'Catherine',
                'accountType' => 'Particulier',
                'password' => 'particulier',
                'salt' => '',
                'question' => 'Martine',
                'roles' => array('ROLE_USER'),
                'valid' => true,
                'reference' => 'particulier_user'
            )
        );

        // Insertion des données dans la BDD
        foreach ($listUsers as $newUser) {
            $user = new User;
            $user->setUsername($newUser['username']);
            $user->setLastname($newUser['lastname']);
            $user->setFirstname($newUser['firstname']);
            $user->setAccountType($newUser['accountType']);
            $user->setPassword($newUser['password']);
            $user->setSalt($newUser['salt']);
            $user->setQuestion($newUser['question']);
            $user->setRoles($newUser['roles']);
            $user->setValid($newUser['valid']);

            $manager->persist($user);

            $this->addReference($newUser['reference'], $user); // Référence pour récupération dans la fixture LoadObservation
        }

        $manager->flush();
        $manager->clear();
    }

    public function getOrder()
    {
        return 2; // Ordre d'exécution de la fixture
    }
}
