<?php

use function Ecommerce\cart;

cart()->confirm();

redirect('/confirmation');
