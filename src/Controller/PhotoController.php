<?php

namespace App\Controller;                                                                          
require '/var/www/html/vendor/autoload.php';                                  
use Aws\S3\S3Client;                                                                               
use Aws\Exception\AwsException;                                                          
use App\Entity\Photo;                                                                    
use App\Form\PhotoType;                                                                            
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;                                  
use Symfony\Component\HttpFoundation\Request;                                      
use Symfony\Component\HttpFoundation\Response;                                                     
use Symfony\Component\Routing\Annotation\Route;                                          
use Symfony\Component\String\Slugger\SluggerInterface;                                   
use Symfony\Component\HttpFoundation\File\Exception\FileException;                                 
use Aws\Credentials\CredentialProvider;  

class PhotoController extends AbstractController
{
    /**
     * @Route("/photo", name="photo")
     */
    public function index(): Response
    {
        $photos = $this->getDoctrine()->getRepository(Photo::class)->findAll();

        return $this->render('photo/index.html.twig', [
            'photos' => $photos,
        ]);
    }

    /**
     * @Route("/photo/new", name="photo_new")
     */
    public function new(Request $request, SluggerInterface $slugger): Response
    {
        $photo = new Photo();
        $form = $this->createForm(PhotoType::class, $photo);
        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            /** @var UploadedFile $file */
            $file = $form->get('url')->getData();

            if ($file) {
                // $originalFilename = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
                // dump($originalFilename);
                // $safeFilename = $slugger->slug($originalFilename);
                // dump($safeFilename);
                // $newFilename = $safeFilename.'-'.uniqid().'.'.$file->guessExtension();
                $newFilename = uniqid().'.'.$file->guessExtension();
                dump($newFilename);

                try {
                    $file->move($this->getParameter('photos_dir'), $newFilename);
                } catch (FileException $e) {
                    // ... handle exception if something happens during file upload
                    dump($e->getMessage());
                }
                
                $photo->setUrl($newFilename);
                $photo->setTitle($form->get('title')->getData());

                $em = $this->getDoctrine()->getManager();
                $em->persist(($photo));
                $em->flush();
                dump($photo);
        try {                                                                                      
        //Create a S3Clienti                                                       
$s3Client = new S3Client([                                                                         
    'version'     => 'latest',                                                           
    'region'      => 'eu-central-1',                                                     
    'credentials' => [                                                                             
        'key'    => $_ENV["aws_access_key"],                                                        
        'secret' => $_ENV["aws_secret_key"]                    
    ],                                                                                             
]);                                                                                      
    $result = $s3Client->uploadDirectory('/var/www/html/public/uploads/photos', 'bucket-projet-final/uploads/photos');
} catch (S3Exception $e) {                                                                         
    echo $e->getMessage() . "\n";                                                                  
} 
                return $this->redirectToRoute('photo');
            }
        }

        return $this->render('photo/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
