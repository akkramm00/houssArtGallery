<?php

namespace App\DataFixtures;

use App\Entity\Products;
use App\Entity\Colletion;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Faker\Generator;

class AppFixtures extends Fixture
{
    /**
     * @var generator
     */
    private Generator $faker;



    public function __construct()

    {
        $this->faker = Factory::create('fr_FR');
    }

    public function load(ObjectManager $manager): void
    {

        // Products
        $product = [];
        $nameOptions = ['Univer', 'Calligrahpy', 'Nature', 'Espoir', 'amor', 'Liberty'];
        $sizeOptions = ['120 / 80', '100 / 60', '200 / 150', '250 / 200'];
        $categoryOptions = ['Abstrait', 'Figuratif', 'Calligraphy', 'Contemporain'];

        for ($p = 1; $p <= 50; $p++) {
            $products = new Products();
            $products->setName($nameOptions[array_rand($nameOptions)])
                ->setPrice(mt_rand('1000', '50000'))
                ->setSize($sizeOptions[array_rand($sizeOptions)])
                ->setProperty($this->faker->text(2000))
                ->setArtist($this->faker->words(2, true))
                ->setCategory($categoryOptions[array_rand($categoryOptions)])
                ->setIsPublic(mt_rand(0, 1) == 1 ? true : false);

            $product[] = $products;
            $manager->persist($products);
        }

        // Collection
        for ($c = 0; $c < 30; $c++) {
            $colletion = new Colletion();
            $colletion->setName($this->faker->words(2, true))
                ->setArtist($this->faker->words(2, true))
                ->setCategory($categoryOptions[array_rand($categoryOptions)])
                ->setDescription($this->faker->text(2000))
                ->setPrice(mt_rand('20000', '100000'))
                ->setIsFavorite(mt_rand(0, 1) == 1 ? true : false);

            for ($k = 0; $k < mt_rand(5, 15); $k++) {

                $colletion->addProduct($product[mt_rand(0, count($product) - 1)]);
            }

            $manager->persist($colletion);
        }

        $manager->flush();
    }
}
