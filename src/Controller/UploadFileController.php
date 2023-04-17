<?php

namespace App\Controller;

use App\Entity\Files;
use App\Form\FileType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UploadFileController extends AbstractController
{
	#[Route('/upload-file', name: 'app_upload_file')]
	public function index(Request $request): Response
	{
		$file = new Files();
		$form = $this->createForm(FileType::class, $file);
		return $this->render('upload_file/index.html.twig', [
			'controller_name' => 'UploadFileController',
			'form-file' => $form->createView()
		]);
	}
}
