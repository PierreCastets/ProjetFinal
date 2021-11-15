<?php

namespace App\Controller;

use App\Entity\Category;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CategoryController extends AbstractController
{
    /**
     * @Route("/category", name="category", methods={"GET"})
     */
    public function index(): Response
    {
        $categories = $this->getDoctrine()->getRepository(Category::class)->findAll();
        
        return $this->render('category/index.html.twig', [
            'categories' => $categories,
        ]);
    }

    /**
     * @Route("/category/new", name="category_new", methods={"POST"})
     */
    public function new(Request $request): Response
    {
        $payload = json_decode($request->getContent(), false);

        $em = $this->getDoctrine()->getManager();
        $category = new Category();
        $category->setName($payload->name);

        $em->persist($category);
        $em->flush();

        return new Response('New category created with id: ' . $category->getId());
    }
}
