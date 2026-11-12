<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ShippingMethod extends Model
{
    private const MONTH_NAMES = ['Gennaio', 'Febbraio', 'Marzo', 'Aprile', 'Maggio', 'Giugno', 'Luglio', 'Agosto', 'Settembre', 'Ottobre', 'Novembre', 'Dicembre'];

    private const DAY_NAMES = ['Lunedì', 'Martedì', 'Mercoledì', 'Giovedì', 'Venerdì', 'Sabato', 'Domenica'];

    private array $islands = [
        // Sicilia
        'AG',
        'CL',
        'CT',
        'EN',
        'ME',
        'PA',
        'RG',
        'SR',
        'TP',

        // Sardegna
        'CA',
        'NU',
        'OR',
        'SS',
        'SU',
    ];

    private string $aosta = 'AO';

    private array $fees = [
        2 => [
            'standard' => 8.5,
            'aosta' => 16,
            'islands' => 9.5,
        ],
        4 => [
            'standard' => 14,
            'aosta' => 21,
            'islands' => 18,
        ],
        6 => [
            'standard' => 19,
            'aosta' => 26.5,
            'islands' => 24,
        ],
        8 => [
            'standard' => 19,
            'aosta' => 26.5,
            'islands' => 25,
        ],
        10 => [
            'standard' => 22.5,
            'aosta' => 30,
            'islands' => 32.5,
        ],
        12 => [
            'standard' => 27,
            'aosta' => 30,
            'islands' => 33.5,
        ],
        14 => [
            'standard' => 27,
            'aosta' => 30,
            'islands' => 34.5,
        ],
        16 => [
            'standard' => 27,
            'aosta' => 30,
            'islands' => 36,
        ],
        18 => [
            'standard' => 27,
            'aosta' => 30,
            'islands' => 37,
        ],
        20 => [
            'standard' => 45.5,
            'aosta' => 53,
            'islands' => 57,
        ],
        32 => [
            'standard' => 45.5,
            'aosta' => 53,
            'islands' => 62,
        ],
        'default' => [
            'standard' => 45.5,
            'aosta' => 53,
            'islands' => 62,
        ],
    ];

    private function deliveryDate()
    {
        $deliveryDate = [];
        $totDays = $totWorkDays = 0;

        $today = date('Y/m/d/', time());
        $weekDay = date('N', strtotime($today));
        $holidays = ['25-12', '26-12'];
        $minimumDeliveryDays = $this->apiResults ? $this->apiResults['minimumDeliveryDays'] : $this->minimumDeliveryDays;
        $maximumDeliveryDays = $this->apiResults ? $this->apiResults['maximumDeliveryDays'] : $this->maximumDeliveryDays;
        $extimateDays = $minimumDeliveryDays == $maximumDeliveryDays ? [$minimumDeliveryDays] : [$minimumDeliveryDays, $maximumDeliveryDays];

        foreach ($extimateDays as $deliveryDays) {
            while ($totWorkDays < $deliveryDays) {

                $totDays++;
                $weekDay++;

                if ($weekDay > 7) {
                    $weekDay = 1;
                }

                $day = date('d-m', strtotime($today.' +'.$totDays.' days'));

                if (! in_array($weekDay, [6, 7]) && ! in_array($day, $holidays)) {
                    $totWorkDays++;
                }
            }

            $deliveryDate[] = strtotime($today.' + '.$totDays.' days');
        }

        return $deliveryDate;
    }

    public function deliveryDateString()
    {
        $deliveryDate = [];

        foreach ($this->deliveryDate() as $date) {
            $dateWeekDay = date('N', $date);
            $dateMonthDay = date('d', $date);
            $dateMonth = date('m', $date);

            $deliveryDate[] = '<span class="">'.strtolower(self::DAY_NAMES[$dateWeekDay - 1]).' '.$dateMonthDay.' '.strtolower(self::MONTH_NAMES[$dateMonth - 1]).'</span> ';
        }

        return implode(' - ', $deliveryDate);
    }

    /**
     * Get the estimated delivery date(s) for the shipping method.
     */
    public function price(?Order $order = null): float
    {
        $order = $order ?? Order::find(cart()->id);
        $quantity = $order->quantity ?: 1;
        $province = $order->address?->region ?? '';

        $type = in_array($province, $this->islands) ? 'islands' : ($province === $this->aosta ? 'aosta' : 'standard');

        return $this->getFee($this->fees, $quantity, $type);
    }

    /**
     * Get the shipping fee for a specific quantity and zone.
     */
    public function getFee(array $fees, int $quantity, string $zone = 'standard'): float
    {
        // Get only the numeric keys
        $ranges = array_filter(array_keys($fees), 'is_numeric');

        // Sort them to be safe
        sort($ranges, SORT_NUMERIC);

        foreach ($ranges as $range) {
            if ($quantity <= $range) {
                return $fees[$range][$zone];
            }
        }

        // fallback to default
        return $fees['default'][$zone];
    }

    /**
     * Get the default shipping method
     */
    public static function default(): ShippingMethod
    {
        return ShippingMethod::orderBy('id')->first();
    }
}
