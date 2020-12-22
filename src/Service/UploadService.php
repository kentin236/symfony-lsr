<?php


namespace App\Service;


use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Session\Flash\FlashBagInterface;
use Symfony\Component\String\Slugger\SluggerInterface;

class UploadService
{
    private $parameterBag;
    private $slugger;
    private $flashBag;
    private $em;
    private $uploadsDir;

    public function __construct(ParameterBagInterface $parameterBag, SluggerInterface $slugger, FlashBagInterface $flashBag, EntityManagerInterface $em, $uploadsDir)
    {
        $this->parameterBag = $parameterBag;
        $this->slugger = $slugger;
        $this->flashBag = $flashBag;
        $this->em = $em;
        $this->uploadsDir = $uploadsDir;
    }

    public function checkIfUploadDirExist(): void
    {
        $filesystem = new Filesystem();
        if (!$filesystem->exists($this->parameterBag->get('app.uploads_dir'))) {
            $filesystem->mkdir($this->parameterBag->get('app.uploads_dir'));
        }
    }

    public function uploadFile(UploadedFile $file)
    {
        $originalName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
        $safeFilename = $this->slugger->slug($originalName);
        $newFilename = $safeFilename.'.'.uniqid('', true).'.'.$file->guessExtension();
        try {
            $this->checkIfUploadDirExist();
            $file->move(
                $this->parameterBag->get('app.uploads_dir'),
                $newFilename
            );
            //$newFile = new FileEntity();
            //$newFile->setFilename($newFilename);
            //$this->em->persist($newFile);
            $this->em->flush();
            $this->flashBag->add('success', "Success");
            return true;
        } catch (FileException $e) {
            return $e;
        }
    }
}