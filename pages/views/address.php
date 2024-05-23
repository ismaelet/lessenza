{% block form-body %}

<?php generate_form($inputs) ?>

{% end form-body %}

{% block form-footer %}

<button type="submit" class="button" name="submit">Salva</button>
<a class="button button--secondary" href="<?= client_url('/profile') ?>">Indietro</a>

{% end form-footer %}