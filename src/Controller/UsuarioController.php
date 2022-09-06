<?php

namespace App\Controller;

use App\Entity\Usuario;
use App\Repository\UsuarioRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class UsuarioController extends AbstractController
{
    protected UsuarioRepository $usuarioRepository;

    public function __construct(UsuarioRepository $usuarioRepository)
    {
        $this->usuarioRepository = $usuarioRepository;
    }

    #[Route('/usuarios', methods: 'get')]
    public function getUsuarios(): JsonResponse
    {
        $usuarios = $this->usuarioRepository->findAll();

        $array = [];
        foreach ($usuarios as $usuario) {
            $array[] = $usuario->jsonSerialize();
        }

        return $this->json(['usuarios' => $array]);
    }

    #[Route('/usuarios/{id}', methods: 'get')]
    public function getUsuario(int $id): JsonResponse
    {
        $usuario = $this->usuarioRepository->find($id)->jsonSerialize();
        return $this->json(['usuario' => $usuario]);
    }

    #[Route('/usuarios', methods: 'post')]
    public function setUsuario(Usuario $usuario): JsonResponse
    {
        return $this->json([]);
    }
}
