<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Order Statuses
    |--------------------------------------------------------------------------
    |
    | The available order statuses in the e-commerce system.
    |
    */
    'order_statuses' => [
        '-1' => [
            'tag' => 'canceled',
            'label' => 'Cancellato',
            'icon' => 'close',
        ],
        '0' => [
            'tag' => 'open',
            'label' => 'Non completato',
            'icon' => 'pause',
        ],
        '1' => [
            'tag' => 'payment_pending',
            'label' => 'In attesa del pagamento',
            'icon' => 'hourglass',
        ],
        '2' => [
            'tag' => 'payment_confirmed',
            'label' => 'Pagamento confermato',
            'icon' => 'checked',
        ],
        '3' => [
            'tag' => 'shipped',
            'label' => 'Spedito',
            'icon' => 'shipping',
        ],
        '4' => [
            'tag' => 'delivered',
            'label' => 'Consegnato',
            'icon' => 'delivered',
        ],
    ],
];
