<?php


namespace App\Services;


use IvoPetkov\HTML5DOMDocument;

class Parser
{

    public function parseAnchorTags(HTML5DOMDocument $dom, string $baseUrl): array
    {
        $hrefs = [];
        foreach ($dom->getElementsByTagName('a') as $node) {
            $href = $node->getAttribute("href");
            $parsedUrl = $this->parseUrl($href, $baseUrl);
            if ($parsedUrl) {
                $hrefs[] = $parsedUrl;
            }
        }
        return $hrefs;
    }

    public function parseUrl($href, ?string $baseUrl = null): ?string
    {
        $href = trim($href);
        $baseUrl = trim($baseUrl);

        $parseUrl = parse_url($href);

        if (isset($parseUrl['scheme']) && $this->isValidUrl($href)) {
            return rtrim($href, '/');
        }

        if (isset($parseUrl['path'])) {
            return rtrim($baseUrl . $this->cleanPath($parseUrl['path']), '/');
        }
        return false;
    }

    private function isValidUrl($href): bool
    {
        return !filter_var($href, FILTER_VALIDATE_URL) === false;
    }

    private function cleanPath($path)
    {
        if ($path !== 'void(0)') {
            return trim($path);
        }
        return '';
    }

    public function parseTitleTags(HTML5DOMDocument $dom): array
    {
        $titles = [];
        $headingTypes = ['title', 'h1', 'h2', 'h3', 'h4', 'h5', 'h6'];
        foreach ($headingTypes as $headingType) {
            foreach ($dom->getElementsByTagName($headingType) as $node) {
                $titles[$headingType][] = $node->textContent;
            }
        }
        return $titles;
    }

    public function parseImageTags(HTML5DOMDocument $dom, string $baseUrl): array
    {
        $images = [];
        foreach ($dom->getElementsByTagName('img') as $node) {
            $src = $node->getAttribute("src");
            $images[] = $this->parseUrl($src, $baseUrl);
        }
        return $this->deDuplicate($images);
    }

    protected function deDuplicate(array $links): array
    {
        $links2 = [];
        foreach ($links as $link) {
            $links2[$link] = true;
        }
        $links2 = array_keys($links2);
        return $links2;
    }
}

