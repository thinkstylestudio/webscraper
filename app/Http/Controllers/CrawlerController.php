<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\Crawler;
use Illuminate\Http\Response;
use Illuminate\View\View;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\Foundation\Application;

class CrawlerController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $onlyInternal = true;

        $validatedData = $request->validate(
            [
                'baseUrl' => 'required|url|max:255',
                'limit' => 'required|integer|max:30'
            ]
        );

        $crawler = new Crawler();
        $elements = $crawler->retrieveElements($validatedData['baseUrl'], $validatedData['limit'], $onlyInternal);
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
