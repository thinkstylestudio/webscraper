<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\Crawler;
use Illuminate\Http\Response;

class CrawlerController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param Request $request
     * @return Response
     */
    public function __invoke(Request $request)
    {

        //- Table to display each page crawled and it's status code
        $baseUrl = 'https://thinkstylestudio.com';
        $onlyInternal = true;
        $limit = 30;

        $crawler = new Crawler();
        $elements = $crawler->retrieveElements($baseUrl, $limit, $onlyInternal);
        //- Number of a unique images
        $numberOfUniqueImages = $crawler->getNumberOfUniqueImages($elements);
        //- Number of unique internal links
        $numberOfInternalLinks = $crawler->getNumberOfInternalLinks($elements);
        //- Number of unique external links
        $numberOfExternalLinks = $crawler->getNumberOfExternalLinks($elements);
        //- Avg word count
        $averagePerPageWordCount = $crawler->averagePerPageWordCount($elements);
        //- Avg Title length
        $averageHeadingLength = $crawler->getAverageHeadingLength($elements);
        return view(
            'welcome',
            [
                'elements' => $elements,
                'numberOfUniqueImages' => $numberOfUniqueImages,
                'numberOfInternalLinks' => $numberOfInternalLinks,
                'numberOfExternalLinks' => $numberOfExternalLinks,
                'averagePerPageWordCount' => $averagePerPageWordCount,
                'averageHeadingLength' => $averageHeadingLength,
            ]
        );

    }

}
