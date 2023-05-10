<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

final class ProfileController extends AbstractController
{
    #[Route('/profile', name: 'app_profile')]
    public function __invoke(): JsonResponse
    {
        return $this->json([
            'message' => 'Profile controller',
            'path' => 'src/Controller/ProfileController.php',
        ]);
    }
}
