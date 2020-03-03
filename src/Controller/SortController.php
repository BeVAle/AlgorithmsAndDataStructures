<?php


namespace App\Controller;


use App\Model\Sort;
use App\Repository\PostRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SortController extends AbstractController
{
    /**
     * @Route("/sort",  methods="GET", name="sort_index")
     * @param Request $request
     * @param PostRepository $posts
     * @return Response
     */
    public function index(Request $request,  PostRepository $posts): Response
    {
        return $this->render('sort/sort.twig');
    }

    /**
     * @Route("/sortBubble",  methods="POST", name="sort_bubble")
     * @param Request $request
     * @param PostRepository $posts
     * @return Response
     */
    public function bubbleSort(Request $request,  PostRepository $posts): Response
    {
        $sequence = explode(" ",$request->request->get('sequence', 0));
        $sortType = explode(" ",$request->request->get('sort', [0]));

        $sort = new Sort();
        $sortedSequence= " ";
        switch ($sortType[0]) {
            case 'bubbleSort' :
                $sortedSequence = $sort->bubbleSort($sequence);
                break;
            case 'selectSort' :
                $sortedSequence = $sort->selectSort($sequence);
                break;
            case 'insertSort' :
                $sortedSequence = $sort->insertSort($sequence);
                break;
            case 'quickSort' :
                $sortedSequence = $sort->quickSort($sequence);
                break;
            case 'radixSort' :
                $sortedSequence = $sort->radixSort($sequence);
                break;
        }


        return $this->json(implode(' ', $sortedSequence));
    }






}