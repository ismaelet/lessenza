@props(['links'])

@php
	$items = [];
	$navigationItemList = header_filter_navigation_items((array) $links, false);

	foreach ($navigationItemList as $item) {
	    $items[] = generate_nav_item($item);
	}

	$items = implode('', $items);

	// nav item
	function generate_nav_item($item)
	{
	    $link = isset($item['url']) ? 'href="' . $item['url'] . '"' : '';
	    $title = $item['label'];
	    $dropdownIcon = isset($item['drop']) ? '<span class="h__ddown-icon">&#x25BC;</span>' : '';
	    $dropdown = isset($item['drop']) ? generate_dropdown($item) : '';
	    $dataMegameu = isset($item['megamenu'])
	        ? 'data-function="open-megamenu" data-target="' . $item['megamenu'] . '"'
	        : '';

	    // classes
	    $classActive = isset($item['url']) ? 'h__link--active' : 'h__link--inactive';
	    $classHighlighted = $item['location'] == 'home' ? 'h__link--highlighted' : '';
	    $classes = array_filter(['h__link', $classActive, $classHighlighted]);
	    $classes = implode(' ', $classes);

	    $html =
	        '<li class="' .
	        $classes .
	        '" ' .
	        $dataMegameu .
	        '>
<a ' .
	        $link .
	        '>
	' .
	        $title .
	        '' .
	        $dropdownIcon .
	        '
</a>
' .
	        $dropdown .
	        '
</li>
';

	    return $html;
	}

	// dropdown
	function generate_dropdown($item)
	{
	    global $header;

	    $items = [];

	    // dropdown items
	    foreach ((array) $header['dropdowns'][$item['drop']] as $dropdownItem) {
	        $link = $dropdownItem[1];
	        $title = $dropdownItem[0];

	        $itemHtml =
	            '
					<p class="h__ddown-link">
						<a href="' .
	            $link .
	            '">' .
	            $title .
	            '</a>
</p>';

	        $items[] = $itemHtml;
	    }

	    $items = implode('', $items);

	    // dropdown structure
	    $html =
	        '<div class="h__ddown">
					' .
	        $items .
	        '
</div>';

	    return $html;
	}
@endphp

<nav class="h__nav">
	<ul>
		{!! $items !!}
	</ul>
</nav>
