<?php

namespace NAO\CoreBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use NAO\CoreBundle\Entity\Observation;

class LoadObservation extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        // Liste des observations
        $listObservations = array(
            array(
                'user' => 'admin_user',
                'species' => 'Accipiter bicolor (Vieillot, 1817)',
                'date' => new \DateTime('2017-02-10'),
                'latitude' => 48.97192417479558,
                'longitude' => 1.7049407958984375,
                'image' => '',
                'valid' => true
            ),
            array(
                'user' => 'naturaliste_user_1',
                'species' => 'Aquila chrysaetos (Linnaeus, 1758)',
                'date' => new \DateTime('2017-01-24'),
                'latitude' => 48.85911334221528,
                'longitude' => 1.7969512939453125,
                'image' => '',
                'valid' => false
            ),
            array(
                'user' => 'particulier_user',
                'species' => 'Haliaeetus leucogaster (Gmelin, 1788)',
                'date' => new \DateTime('2017-02-19'),
                'latitude' => 48.79582797771649,
                'longitude' => 2.1540069580078125,
                'image' => '',
                'valid' => true
            )
        );

        // Insertion des données dans la BDD
        foreach ($listObservations as $newObservation) {
            $observation = new Observation;
            $observation->setUser($this->getReference($newObservation['user']));
            $observation->setSpecies($this->getReference($newObservation['species']));
            $observation->setDate($newObservation['date']);
            $observation->setLatitude($newObservation['latitude']);
            $observation->setLongitude($newObservation['longitude']);
            $observation->setImage($newObservation['image']);
            $observation->setValid($newObservation['valid']);

            $manager->persist($observation);
        }

        $manager->flush();
        $manager->clear();
    }

    public function getOrder()
    {
        return 3; // Ordre d'exécution de la fixture
    }
}
