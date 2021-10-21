<?php


namespace App\DataFixtures;


use App\Entity\Product;
use App\Repository\ProductTypeRepository;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Yaml\Yaml;

class ProductFixtures extends Fixture implements DependentFixtureInterface
{
    private ProductTypeRepository $productTypeRepository;

    public function __construct(ProductTypeRepository  $productTypeRepository)
    {
        $this->productTypeRepository = $productTypeRepository;
    }

    public function load(ObjectManager $manager)
    {
       $dummyProduct = Yaml::parseFile(__DIR__.'/data/product.yaml');

      foreach ($dummyProduct['products'] as $dummyProduct) {

          $productType = $this->productTypeRepository->findOneBy([
              'name' => $dummyProduct['type']
          ]);

          $product = new Product();
          $product
              ->setName($dummyProduct['name'])
              ->setSlug($dummyProduct['slug'])
              ->setDescription($dummyProduct['description'])
              ->setPrice($dummyProduct['price'])
              ->setImageUrl($dummyProduct['slug']. 'png')
              ->setProductType($productType);

          $manager->persist($product);
      }

      $manager->flush();
    }

    public function getDependencies()
    {
        return [
            ProductTypeFixtures::class
        ];
    }
}