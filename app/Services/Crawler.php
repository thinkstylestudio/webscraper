<?php


namespace App\Services;


class Crawler
{

    public function retrieveElements(string $baseUrl, int $limit, bool $onlyInternal)
    {
        $pageBuilder = new PageBuilder(
            $baseUrl
        );

        $elements[] = $element = $pageBuilder->build($baseUrl);
        //- Number of pages crawled
        $crawledPages = 1;
        $anchorTags = $element->getAnchorTags();

        // remove first result as it's the same as the one previously fetched.
        unset($anchorTags[0]);
        foreach ($anchorTags as $link) {
            if ($crawledPages === $limit) {
                break;
            }
            $elements[] = $pageBuilder->build($link, $onlyInternal);
            $crawledPages++;
        }

        return $elements;
    }

    public function averagePerPageWordCount(array $elements)
    {
        $counts = [];
        foreach ($elements as $element) {
            $counts[] = str_word_count($element->getPlainText());
        }
        return collect($counts)->avg();
    }

    public function getNumberOfUniqueImages(array $elements)
    {
        $collection = collect([]);

        foreach ($elements as $element) {
            $collection->push($element->getImageTags());
        }

        return count($collection->flatten()->unique());
    }

    public function getAverageHeadingLength($elements)
    {
        $averageTitleCountsByTagType = [];
        foreach ($elements as $element) {
            if (!$element->getTitleTags()) {
                continue;
            }
            foreach ($element->getTitleTags() as $tagType => $titleTags) {
                $averageTitleCountsByTagType[$tagType] = $this->getAverageTitleCountsByTagType($titleTags);
            }
        }
        return $averageTitleCountsByTagType;
    }

    public function getAverageTitleCountsByTagType($titleTags): int
    {
        $averageTitleCounts = [];
        foreach ($titleTags as $titleTag) {
            $averageTitleCounts[] = strlen($titleTag);
        }
        return collect($averageTitleCounts)->avg();
    }

    public function getNumberOfExternalLinks(array $elements)
    {
        $collection = collect($elements);
        return $collection->filter(
            function ($value) {
                return $value->getIsInternal() === false;
            }
        )->count();
    }


    public function getNumberOfInternalLinks(array $elements)
    {
        $collection = collect($elements);
        return $collection->filter(
            function ($value) {
                return $value->getIsInternal() === true;
            }
        )->count();
    }
}
