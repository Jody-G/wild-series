<?php
// src/Controller/CategoryController.php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Category;

/**
 * @Route("/categories", name="category_")
 */

class CategoryController extends AbstractController
{
    /**
     * @Route("/", name="index")
     * @return Reponse A reponse instance
     */
    public function index(): Response
    {
        $categories = $this->getDoctrine()
            ->getRepository(Category::class)
            ->findAll();

        return $this->render(
            'category/index.html.twig',
            ['categories' => $categories]
        );
    }
    /**
     * Getting a category by id
     *
     * @Route("/{name}", name="show")
     * @return Response
     */
    public function show(string $name):Response
    {
        $category = $this->getDoctrine()
            ->getRepository(Category::class)
            ->findBy(['name' => $name]);

        if (!$category) {
            throw $this->createNotFoundException(
                'No categories with name : '.$name.' found in category\'s table.'
            );
        }
        return $this->render('category/show.html.twig', [
            'category' => $category,
        ]);
    }
}