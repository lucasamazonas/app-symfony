<?php

namespace App\DataFixtures;

use App\Entity\Usuario;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class UsuarioFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $usuario = new Usuario();
        $usuario->setEmail('teste@teste.com');
        $usuario->setPassword('$2y$13$/ds4kGLJZ5jXj1LviFKQzehXXHNmLG0o8ZPOh6buY8bMv2mJrtZNy');

        $manager->persist($usuario);
        $manager->flush();
    }
}
