<?php

use function Ecommerce\cart;

cart()->confirm();

redirect_legacy('/confirmation');
