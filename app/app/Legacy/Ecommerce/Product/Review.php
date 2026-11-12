<?php

namespace App\Legacy\Ecommerce;

class Review
{
    private $time;

    public $userId;

    public $text;

    public $score;

    public $scorePercent;

    public $scoreOutOfFive;

    public function __construct($id)
    {

        if ($row = \Legacy\System\Classes\DB::row('* FROM ecommerce_reviews WHERE id=?', [$id])) {
            $this->userId = $row['userId'];
            $this->text = $row['text'];
            $this->score = $row['score'];
            $this->scorePercent = $this->score * 10;
            $this->scoreOutOfFive = $this->score / 2;
            $this->time = $row['time'];
        }
    }

    public function __get($name)
    {
        switch ($name) {
            case 'fullName':
                return $this->fullName = (new \Legacy\System\Classes\User($this->userId))->fullName;
        }
    }
}
