<?php
// src/BlogBundle/DataFixtures/ORM/LoadBilletComment.php

namespace BlogBundle\DataFixtures\ORM;

use BlogBundle\Entity\Billet;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LoadBilletComment implements FixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $billets = array(
            array(
                new \DateTime(),
                "Episode 1",
                "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam auctor sagittis consectetur. 
                Vivamus aliquet pulvinar mi non tincidunt. Praesent congue semper est, a consequat orci. 
                Etiam nec mi non velit laoreet laoreet. Cras vitae lectus felis. Nullam faucibus sem enim. 
                Praesent tincidunt felis id nibh ultrices, nec rhoncus magna venenatis."
            ),
            array(
                new \DateTime(),
                "Episode 2",
                "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla euismod, nisl ut sollicitudin pulvinar, 
                ex sem placerat tortor, iaculis faucibus eros ligula non metus. Donec elementum enim sit amet risus sodales lacinia. 
                Nulla congue, urna nec elementum vestibulum, elit dolor consectetur leo, eget rhoncus dui eros sit amet purus. 
                Maecenas."
            ),
            array(
                new \DateTime(),
                "Episode 3",
                "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus nec gravida nibh, id vestibulum diam. 
                Nam cursus tempus iaculis. Proin pellentesque magna enim, at efficitur mi venenatis in. 
                Nunc sit amet porta mi, vel placerat lectus. Nunc dictum justo nec orci egestas lobortis. 
                Aliquam a rhoncus nibh. Morbi suscipit, lorem."
            )
        );

        foreach ($billets as $billet)
        {
            $newBillet = new Billet();

            foreach ($billet as $cle => $valeur)
            {
                switch ($cle)
                {
                    case 0:
                        $newBillet->setDateUpadte($valeur);
                        break;
                    case 1:
                        $newBillet->setTitle($valeur);
                        break;
                    case 2:
                        $newBillet->setContent($valeur);
                        break;
                }
            }

            $manager->persist($newBillet);
        }

        $manager->flush();
    }
}
