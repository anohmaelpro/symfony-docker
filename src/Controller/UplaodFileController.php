<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UplaodFileController extends AbstractController
{
    #[Route('/uplaod-file', name: 'app_uplaod_file')]
    public function index(): Response
    {
        return $this->render('uplaod_file/index.html.twig', [
            'controller_name' => 'UplaodFileController',
        ]);
    }
}
