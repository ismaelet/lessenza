{% extends main %}

{% block main %}

<div class="page-body main-wrap">

	<?php include_once('-expands-profile/nav.php'); ?>

	<div class="page-content">
		{% place content %}
	</div>

</div>

{% end main %}