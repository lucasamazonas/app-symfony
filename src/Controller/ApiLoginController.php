<?php

namespace App\Controller;

use Lexik\Bundle\JWTAuthenticationBundle\Services\JWTTokenManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Http\Attribute\CurrentUser;

class ApiLoginController extends AbstractController
{
    public function __construct(
        public JWTTokenManagerInterface $JWTManager
    ) {}

    #[Route('/api/login', name: 'api_login')]
    public function index(#[CurrentUser] ?UserInterface $usuario): JsonResponse
    {
        if (is_null($usuario)) {
            return $this->json(
                ['message' => 'missing credentials'],
                Response::HTTP_UNAUTHORIZED
            );
        }

        $token = $this->JWTManager->create($usuario);

        return $this->json([
            'mensagem' => 'Bem-vindo, atenticação efetuada com sucesso!',
            'usuario' => $usuario->getUserIdentifier(),
            'token' => $token,
        ]);
    }
}
