<?php


namespace App\Models;


use IvoPetkov\HTML5DOMDocument;

class Element
{
    private HTML5DOMDocument  $response;
    private array $anchorTags;
    private ?array $imageTags;
    private bool $isInternal;
    private string $uri;
    private ?string $plainText;
    private ?array $titleTags;
    private ?string $pageStatusCode;
    private ?int $requestTime;
    private int $externalLinkCount;
    private int $internalLinkCount;

    public function setHtml5DomDocument($response): void
    {
        $this->response = $response;
    }

    public function getImageTags(): ?array
    {
        return $this->imageTags ?? null;
    }

    public function setImageTags($tag): void
    {
        $this->imageTags = $tag;
    }

    public function getAnchorTags(): array
    {
        return $this->anchorTags;
    }

    public function setAnchorTags($tag): void
    {
        $this->anchorTags = $tag;
    }

    public function getResponse(): HTML5DOMDocument
    {
        return $this->response;
    }

    public function setResponse($response): void
    {
        $this->response = $response;
    }

    public function getIsInternal(): bool
    {
        return $this->isInternal;
    }

    public function setIsInternal(bool $isInternal): void
    {
        $this->isInternal = $isInternal;
    }

    public function getUri(): string
    {
        return $this->uri;
    }

    public function setUri(string $uri): void
    {
        $this->uri = $uri;
    }

    public function getPlainText(): ?string
    {
        return $this->plainText ?? null;
    }

    public function setPlainText(string $plainText): void
    {
        $this->plainText = $plainText;
    }

    public function getTitleTags()
    {
        return $this->titleTags ?? null;
    }

    public function setTitleTags(array $parseTitleTags): void
    {
        $this->titleTags = $parseTitleTags;
    }

    public function getPageStatusCode()
    {
        return $this->pageStatusCode ?? null;
    }

    public function setPageStatusCode($pageStatusCode): void
    {
        $this->pageStatusCode = $pageStatusCode;
    }

    public function getRequestTime(): ?int
    {
        return $this->requestTime ?? null;
    }

    public function setRequestTime(int $requestTime): void
    {
        $this->requestTime = $requestTime;
    }

    public function getExternalLinkCount()
    {
        return $this->externalLinkCount ?? null;
    }

    public function setExternalLinkCount($externalLinkCount): void
    {
        $this->externalLinkCount = $externalLinkCount;
    }

    public function getInternalLinkCount()
    {
        return $this->internalLinkCount ?? null;
    }

    public function setInternalLinkCount($internalLinkCount): void
    {
        $this->internalLinkCount = $internalLinkCount;
    }


}
