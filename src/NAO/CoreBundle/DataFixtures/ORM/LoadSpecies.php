<?php

namespace NAO\CoreBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use NAO\CoreBundle\Entity\Species;

class LoadSpecies extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        // Ouverture du fichier CSV
        $file = fopen(dirname(__FILE__).'/TAXREF.csv', 'r');

        $batchSize = 20; // Variable pour le flush toutes les 20 occurrences
        $i = 0;

        // Insertion des données dans la BDD
        while (!feof($file)) {
            $line = fgetcsv($file, null, ';');

            $species = new Species;
            $species->setRef($line[0]);
            $species->setName($line[1]);
            $species->setFullName($line[2]);
            $species->setVernName($line[3]);
            $species->setRank($line[4]);
            $species->setPhylum($line[5]);
            $species->setClasse($line[6]);
            $species->setCategory($line[7]);
            $species->setFamily($line[8]);
            $species->setHabitat($line[9]);

            $manager->persist($species);

            $this->addReference($line[2], $species); // Référence pour récupération dans la fixture LoadObservation

            if (($i % $batchSize) === 0) {
                $manager->flush();
                $manager->clear();
            }

            $i++;
        }
    }

    public function getOrder()
    {
        return 1; // Ordre d'exécution de la fixture
    }
}
