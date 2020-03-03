<?php


namespace App\Controller;


use App\Model\Search;
use App\Repository\PostRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SearchController extends AbstractController
{
    /**
     * @Route("/search",  methods="GET", name="searh_index")
     * @param Request $request
     * @param PostRepository $posts
     * @return Response
     */
    public function index(Request $request, PostRepository $posts): Response
    {
        return $this->render('search/search.twig');
    }


    /**
     * @Route("/do-search",  methods="POST", name="search_rabin")
     * @param Request $request
     * @param PostRepository $posts
     * @return Response
     */
    public function rabinSearch(Request $request, PostRepository $posts): Response
    {
        $searchType = $request->request->get('searchType', 0);
        $pattern = $request->request->get('pattern', 0);
        $text = $request->request->get('text', 0);

        $search = new Search();
        $searchedIndex = " ";
        switch ($searchType) {
            case 'rabinSearch' :
                $searchedIndex = $search->rabinSearch($pattern, $text);
                break;
            case 'MooreSearch' :
                $searchedIndex = $search->mooreSearch($pattern, $text);
                break;
            case 'KMPSearch' :
                $searchedIndex = $search->KMPSearch($pattern, $text);
                break;
        }

        return $this->json($searchedIndex);
    }
}