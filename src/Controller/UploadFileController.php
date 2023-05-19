<?php

namespace App\Controller;

use App\Entity\Files;
use App\Form\MyFileType;
use App\Service\MyFunctions;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UploadFileController extends AbstractController
{
	private MyFunctions $myFunctions;
	
	public function __construct(MyFunctions $myFunctions)
	{
		$this->myFunctions = $myFunctions;
	}
	
	
	#[Route('/upload-file', name: 'app_upload_file')]
	public function index(Request $request): Response
	{
		$fileEntity = new Files();
		$form = $this->createForm(MyFileType::class, $fileEntity);
		$submittedToken = $request->request->get('token');
		$form->handleRequest($request);
		
		if ($this->isCsrfTokenValid('form-token-item', $submittedToken)) {
			// Do something
			if ($form->isSubmitted() && $form->isValid()) {
				$fileUploaded = $form->get('fileName')->getData();
				if ($fileUploaded){
					if($this->myFunctions->uploadFileMainFunction($fileUploaded)){
						$this->addFlash("success", "The file has been successfully added.");
					} else {
						$this->addFlash("warning", "Something went wrong while trying to add files.");
					}
				}
			} else {
				$this->addFlash("warning", "Invalid form.");
			}
		} else {
			$this->addFlash("warning", "Something went wrong when you submitted the form. Make sure that the form is valid.");
		}
		
		return $this->render('upload_file/index.html.twig', [
			'controller_name' => 'UploadFileController',
			'formFile' => $form->createView(),
		]);
	}
}
