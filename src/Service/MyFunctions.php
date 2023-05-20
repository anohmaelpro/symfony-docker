<?php

namespace App\Service;

use App\Entity\Files;
use Doctrine\ORM\EntityManagerInterface;
use mysql_xdevapi\Exception;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\String\Slugger\SluggerInterface;

class MyFunctions
{
	/**
	 * @var SluggerInterface
	 */
	private SluggerInterface $slugger;
	
	/**
	 * @var ParameterBagInterface
	 */
	protected ParameterBagInterface $parameterBag;
	
	/**
	 * @var EntityManagerInterface
	 */
	private EntityManagerInterface $entityManager;
	
	public function __construct(SluggerInterface $slugger, ParameterBagInterface $parameterBag, EntityManagerInterface $entityManager)
	{
		$this->slugger = $slugger ;
		$this->parameterBag = $parameterBag ;
		$this->entityManager = $entityManager ;
	}
	public function uploadFileMainFunction(File $file): bool
	{
		$newFile = new Files();
		$fileUploadedName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
		$safeFilename = $this->slugger->slug($fileUploadedName);
		$fileName = $safeFilename.'_'.uniqid('fileName-uploaded-', true).'.'.$file->guessExtension();
		$fileExtension = $file->guessExtension();
		
		try{
			$file->move($this->parameterBag->get('upload_file_directory'), $fileName);
		} catch (FileException $exception) {
			throw new Exception($exception->getMessage());
		}
		
		$newFile->setFileName($fileName)
			   ->setExtensionFile($fileExtension)
			   ->setPathFile($this->parameterBag->get('upload_file_directory'));
		
		$this->entityManager->persist($newFile) ;
		
		$this->entityManager->flush();
		
		return true;
	}
}