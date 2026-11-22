@props(['locale'])

<svg viewBox="0 0 60 40" aria-hidden="true" class="language-switcher__flag">
    @if ($locale === 'it')
        <path fill="#009246" d="M0 0h20v40H0z" />
        <path fill="#fff" d="M20 0h20v40H20z" />
        <path fill="#ce2b37" d="M40 0h20v40H40z" />
    @else
        <path fill="#012169" d="M0 0h60v40H0z" />
        <path stroke="#fff" stroke-width="8" d="m0 0 60 40M60 0 0 40" />
        <path stroke="#c8102e" stroke-width="3" d="m0 0 60 40M60 0 0 40" />
        <path stroke="#fff" stroke-width="13" d="M30 0v40M0 20h60" />
        <path stroke="#c8102e" stroke-width="7" d="M30 0v40M0 20h60" />
    @endif
</svg>
