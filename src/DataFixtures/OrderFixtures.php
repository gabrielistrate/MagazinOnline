<?php

namespace App\DataFixtures;

use App\Entity\Order;
use App\Entity\OrderList;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class OrderFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {

        $manager->flush();
    }
}
