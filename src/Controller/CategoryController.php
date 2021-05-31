<?php
// src/Controller/CategoryController.php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Category;
use App\Entity\Program;

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
     * @Route("/{categoryName}", name="show")
     * @return Response
     */
    public function show(int $categoryName):Response
    {
        $programs = $this->getDoctrine()
            ->getRepository(Program::class)
            ->findBy(
                ['category' => $categoryName],
                ['id' => 'DESC']
            );

        if (!$programs) {
            throw $this->createNotFoundException(
                'No program with id : '.$categoryName.' found in program\'s table.'
            );
        }

        return $this->render('category/show.html.twig', [
            'programs' => $programs
        ]);
    }
}