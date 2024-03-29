<?php

namespace App\DataFixtures;

use App\Entity\User;
use App\Entity\Products;
use App\Entity\Colletion;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Faker\Generator;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{
    /**
     * @var generator
     */
    private Generator $faker;

    private UserPasswordHasherInterface $hasher;

    public function __construct(UserPasswordHasherInterface $hasher)

    {
        $this->faker = Factory::create('fr_FR');
        $this->hasher = $hasher;
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

        // Users
        // $users = [];

        // $admin = new User();
        // $admin->setFullName('Administrateur de garageVP')
        //     ->setPseudo('null')
        //     ->setEmail('admin@garagevp.fr')
        //     ->setRoles(['ROLE_USER', 'ROLE_ADMIN'])
        //     ->SetPlainPassword('password');

        // $users[] = $admin;
        // $manager->persist($admin);


        for ($i = 0; $i < 10; $i++) {
            $user = new User();
            $user->setFullName($this->faker->name())
                ->setPseudo(mt_rand(0, 1) === 1 ? $this->faker->firstName() : null)
                ->setEmail($this->faker->email())
                ->setRoles(['ROLE_USER'])
                ->setPlainPassword('password');

            $manager->persist($user);
        }

        $manager->flush();
    }
}
