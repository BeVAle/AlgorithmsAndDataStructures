<?php


namespace App\Controller;


use App\Repository\PostRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class StructureController extends AbstractController
{
    /**
     * @Route("/structure",  methods="GET", name="structure_index")
     * @param Request $request
     * @param PostRepository $posts
     * @return Response
     */
    public function index(Request $request,  PostRepository $posts): Response
    {
        return $this->render('structure/structure.twig');
    }
}