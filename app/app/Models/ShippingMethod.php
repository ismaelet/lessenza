<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ShippingMethod extends Model {

	private const MONTH_NAMES = ['Gennaio', 'Febbraio', 'Marzo', 'Aprile', 'Maggio', 'Giugno', 'Luglio', 'Agosto', 'Settembre', 'Ottobre', 'Novembre', 'Dicembre'];
	private const DAY_NAMES = ['Lunedì', 'Martedì', 'Mercoledì', 'Giovedì', 'Venerdì', 'Sabato', 'Domenica'];


	private function deliveryDate() {
		$deliveryDate = [];
		$totDays = $totWorkDays = 0;

		$today = date('Y/m/d/', time());
		$weekDay = date('N', strtotime($today));
		$holidays = ['25-12', '26-12',];
		$minimumDeliveryDays = $this->apiResults ? $this->apiResults['minimumDeliveryDays'] : $this->minimumDeliveryDays;
		$maximumDeliveryDays = $this->apiResults ? $this->apiResults['maximumDeliveryDays'] : $this->maximumDeliveryDays;
		$extimateDays = $minimumDeliveryDays == $maximumDeliveryDays ? [$minimumDeliveryDays] : [$minimumDeliveryDays, $maximumDeliveryDays];

		foreach ($extimateDays as $deliveryDays) {
			while ($totWorkDays < $deliveryDays) {

				$totDays++;
				$weekDay++;

				if ($weekDay > 7) $weekDay = 1;

				$day = date('d-m', strtotime($today . ' +' . $totDays . ' days'));

				if (!in_array($weekDay, [6, 7]) && !in_array($day, $holidays)) $totWorkDays++;
			}

			$deliveryDate[] = strtotime($today . ' + ' . $totDays . ' days');
		}

		return $deliveryDate;
	}

	public function deliveryDateString() {
		$deliveryDate = [];

		foreach ($this->deliveryDate() as $date) {
			$dateWeekDay = date('N', $date);
			$dateMonthDay = date('d', $date);
			$dateMonth = date('m', $date);

			$deliveryDate[] = '<span class="">' . strtolower(self::DAY_NAMES[$dateWeekDay - 1]) . ' ' . $dateMonthDay . ' ' . strtolower(self::MONTH_NAMES[$dateMonth - 1]) . '</span> ';
		}

		return implode(' - ', $deliveryDate);
	}
}
