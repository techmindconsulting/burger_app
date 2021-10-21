<?php

namespace App\DataFixtures;

use App\Entity\ProductType;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Yaml\Yaml;

class ProductTypeFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $dummyData = Yaml::parseFile(__DIR__ . '/data/product-types.yaml');

        foreach ($dummyData['product-types'] as $dummyProductType) {
            $productType = new ProductType();
            $productType
                ->setName($dummyProductType['name'])
                ->setSlug(strtolower($dummyProductType['name']));

            $manager->persist($productType);
        }

        $manager->flush();
    }
}
