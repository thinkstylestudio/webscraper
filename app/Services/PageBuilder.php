<?php


namespace App\Services;


use App\Models\Element;
use IvoPetkov\HTML5DOMDocument;
use Exception;

class PageBuilder
{
    private string $baseUrl;
    private Parser $parser;


    public function __construct(
        string $baseUrl
    ) {
        $this->baseUrl = $baseUrl;
        $this->parser = new Parser();
    }

    public function build(string $uri, $onlyInternal = true): Element
    {
        $element = new Element();
        $isUriInternal = $this->isUriInternal($uri);
        $element->setIsInternal($isUriInternal);
        $element->setUri($uri);

        if ($onlyInternal && $isUriInternal === false) {
            return $element;
        }

        $dom = new HTML5DOMDocument();

        try {
            $responseStartTime = microtime(true);
            $response = (new WebClient())->fetch($uri);
            $pageRequestTime = $this->getTimeDifferenceInMilliseconds($responseStartTime);
            $dom->loadHTML($response->body());
        } catch (Exception $e) {
             dump($response);
             dump($e);
             dump($responseStartTime);
             dump($pageRequestTime);
            // TODO: add error logging specifically in situations where the HTML5 doesn't conform to libraries specs e.g. page has more than one id=""
        }

        $element->setHtml5DomDocument($dom);

        $links = $this->parser->parseAnchorTags($dom, $this->baseUrl);
        $deDupedLinks = self::deDuplicateArray($links);
        $numberOfLinks = $this->numberOfLinks($deDupedLinks);
        $element->setInternalLinkCount($numberOfLinks['internal'] ?? 0);
        $element->setExternalLinkCount($numberOfLinks['external'] ?? 0);
        $element->setAnchorTags($deDupedLinks);
        $element->setTitleTags($this->parser->parseTitleTags($dom));
        try{
            $element->setPageStatusCode($response->status());
        } catch (Exception $e) {
            // TODO: add error logging specifically in situations where the HTML5 doesn't conform to libraries specs e.g. page has more than one id=""
        }
        $element->setRequestTime($pageRequestTime);
        $element->setImageTags($this->parser->parseImageTags($dom, $this->baseUrl));
        $element->setPlainText(strip_tags($dom->saveHTML()));

        return $element;
    }

    private function isUriInternal(string $uri): bool
    {
        $host = parse_url($uri)['host'];
        $baseUrl = parse_url($this->baseUrl)['host'];

        return $host === $baseUrl;
    }

    /**
     * @param float $responseStartTime
     * @return float|string
     */
    private function getTimeDifferenceInMilliseconds(float $responseStartTime)
    {
        $timeDifference = microtime(true) - $responseStartTime;
        return round($timeDifference * 1000);
    }

    public static function deDuplicateArray(array $links): array
    {
        $links2 = [];
        foreach ($links as $link) {
            $links2[$link] = true;
        }
        return array_keys($links2);
    }

    public function numberOfLinks(array $links): array
    {
        $linkCount = [];
        $internalCount = 0;
        $externalCount = 0;
        foreach ($links as $link) {
            if ($this->isUriInternal($link)) {
                $linkCount['internal'] = $internalCount++;
            } else {
                $linkCount['external'] = $externalCount++;
            }
        }
        return $linkCount;
    }
}
