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
     * @Route("/search",  methods={"GET","POST"}, name="searh_index")
     * @param Request $request
     * @param PostRepository $posts
     * @return Response
     */
    public function index(Request $request, PostRepository $posts): Response
    {
        $text = "";
        if ($request->request->all()) {
            $uploadDir = __DIR__ . "/../../var/uploads/";
            $uploadFile = $uploadDir . basename($_FILES['file_search']['name']);
            move_uploaded_file($_FILES['file_search']['tmp_name'], $uploadFile);

            $filename = $uploadFile;
            $handle = fopen($filename, "r");
            $contents = fread($handle, filesize($filename));
            fclose($handle);
            $search = new Search();

            $countSymbols = $_POST['count_symbols'];
            $step = filesize($filename) / $countSymbols;
            for ($i = 0; $i < $step; $i++) {
                $subStr = substr($contents, ($countSymbols * $i), $countSymbols);
                $searchedIndex = $search->KMPSearch($_POST['search'], $subStr);
                $text .= "В строке  {$i}  ".trim($subStr).": " . $searchedIndex . PHP_EOL;
            }
        }
        return $this->render('search/search.twig', ['text' => $text]);
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