<?php

/**
 * Translate authored content while retaining the Italian source when no translation exists.
 */
function localized_text(?string $text): string
{
    $text ??= '';
    $key = preg_replace('/\s+/u', ' ', html_entity_decode(trim($text), ENT_QUOTES | ENT_HTML5, 'UTF-8'));

    return app('translator')->hasForLocale($key, app()->getLocale()) ? __($key) : $text;
}

/**
 * Translate text nodes without changing trusted source markup, links or product identifiers.
 */
function localized_html(?string $html): string
{
    if (app()->getLocale() === 'it') {
        return $html ?? '';
    }

    $parts = preg_split('/(<[^>]+>|\r?\n|\\\\r\\\\n|\\\\n)/u', $html ?? '', flags: PREG_SPLIT_DELIM_CAPTURE);

    return implode('', array_map(function (string $part): string {
        if (str_starts_with($part, '<')) {
            return $part;
        }

        $translation = localized_text($part);
        if ($translation === $part) {
            return $part;
        }

        preg_match('/^(\s*).*?(\s*)$/su', $part, $spacing);

        return $spacing[1].e($translation).$spacing[2];
    }, $parts));
}

/**
 * Match translated product and collection names against their original database values.
 */
function localized_search_terms(string $query): array
{
    $terms = [$query];
    if (app()->getLocale() === 'en') {
        foreach (app('translator')->getLoader()->load('en', '*', '*') as $source => $translation) {
            if (mb_strlen($source) <= 50 && str_contains(mb_strtolower($translation), mb_strtolower($query))) {
                $terms[] = $source;
            }
        }
    }

    return array_values(array_unique($terms));
}
