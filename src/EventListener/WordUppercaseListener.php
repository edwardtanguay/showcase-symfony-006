<?php
// src/EventListener/WordUppercaseListener.php

namespace App\EventListener;

use Symfony\Component\HttpKernel\Event\ResponseEvent;

# TODO: this doesn't work, fix

class WordUppercaseListener
{
    public function onKernelResponse(ResponseEvent $event): void
    {
        // Only handle main request, not sub-requests
        if (!$event->isMainRequest()) {
            return;
        }

        $response = $event->getResponse();
        
        // Only process HTML responses
        $contentType = $response->headers->get('Content-Type');
        if (!$contentType || !str_contains($contentType, 'text/html')) {
            return;
        }

        $content = $response->getContent();
        
        // Replace words with their uppercase versions
        $modifiedContent = $this->uppercaseWords($content);
        
        $response->setContent($modifiedContent);
    }

    private function uppercaseWords(string $content): string
    {
        // Define the words to uppercase
        $words = ['aws', 'cdn'];
        
        foreach ($words as $word) {
            // Use case-insensitive replacement with word boundaries to avoid partial matches
            $pattern = '/\b' . preg_quote($word, '/') . '\b/i';
            $content = preg_replace_callback($pattern, function($matches) {
                return strtoupper($matches[0]);
            }, $content);
        }
        
        return $content;
    }
}
