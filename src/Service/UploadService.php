<?php


namespace App\Service;


use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\Exception\UploadException;
use Symfony\Component\String\Slugger\SluggerInterface;

/**
 * Class UploadService
 * @package App\Service
 */
class UploadService
{
    /**
     * @var SluggerInterface
     */
    private SluggerInterface $slugger;

    /**
     * @var ParameterBagInterface
     */
    private ParameterBagInterface $parameterBag;

    /**
     * UploadService constructor.
     * @param SluggerInterface $slugger
     * @param ParameterBagInterface $parameterBag
     */
    public function __construct(SluggerInterface $slugger, ParameterBagInterface $parameterBag)
    {
        $this->slugger = $slugger;
        $this->parameterBag = $parameterBag;
    }

    /**
     * @param FormInterface $formProperty
     * @param string|null $path
     * @return string
     */
    public function upload(FormInterface $formProperty, string $path = null): string
    {
        $brochureFile = $formProperty->getData();

        //Get the realname of uploaded file
        $originalFilename = pathinfo($brochureFile->getClientOriginalName(), PATHINFO_FILENAME);

        // this is needed to safely include the file name as part of the URL, ex: [my photo.jpg] will be converted to [my-photo.jpg]
        $safeFilename = $this->slugger->slug($originalFilename);
        $newFilename = uniqid($safeFilename, true).'.'.$brochureFile->guessExtension();

        // Move the file to the directory where brochures are stored
        try {
            $brochureFile->move($path ?? $this->parameterBag->get('upload_directory'), $newFilename);
        } catch (FileException $exception) {
            // ... handle exception if something happens during file upload due to read/write permissions
            throw new UploadException(null, 0, $exception);
        }

        return $newFilename;
    }

}