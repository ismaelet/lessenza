<?php

namespace Payments\Pix;

class Payload
{
    const ID_PAYLOAD_FORMAT_INDICATOR = '00';

    const ID_MERCHANT_ACCOUNT_INFORMATION = '26';

    const ID_MERCHANT_ACCOUNT_INFORMATION_GUI = '00';

    const ID_MERCHANT_ACCOUNT_INFORMATION_KEY = '01';

    const ID_MERCHANT_ACCOUNT_INFORMATION_DESCRIPTION = '02';

    const ID_MERCHANT_CATEGORY_CODE = '52';

    const ID_TRANSACTION_CURRENCY = '53';

    const ID_TRANSACTION_AMOUNT = '54';

    const ID_COUNTRY_CODE = '58';

    const ID_MERCHANT_NAME = '59';

    const ID_MERCHANT_CITY = '60';

    const ID_ADDITIONAL_DATA_FIELD_TEMPLATE = '62';

    const ID_ADDITIONAL_DATA_FIELD_TEMPLATE_TXID = '05';

    const ID_CRC16 = '63';

    public $pixKey;

    public $description;

    public $txId;

    public $amount;

    public function getQrCode()
    {
        $payloadCode =
            $this->getValue(self::ID_PAYLOAD_FORMAT_INDICATOR, '01').
            $this->getMerchant().
            $this->getValue(self::ID_MERCHANT_CATEGORY_CODE, '8999').
            $this->getValue(self::ID_TRANSACTION_CURRENCY, '986').
            $this->getValue(self::ID_TRANSACTION_AMOUNT, $this->amount).
            $this->getValue(self::ID_COUNTRY_CODE, 'BR').
            $this->getValue(self::ID_MERCHANT_NAME, 'Pagseguro Internet SA').
            $this->getValue(self::ID_MERCHANT_CITY, 'SAO PAULO').
            $this->getTxId();

        return $payloadCode.$this->getCRC16($payloadCode);
    }

    private function getValue($id, $value)
    {
        $size = str_pad(strlen($value), 2, '0', STR_PAD_LEFT);

        return $id.$size.$value;
    }

    private function getMerchant()
    {
        $gui = $this->getValue(self::ID_MERCHANT_ACCOUNT_INFORMATION_GUI, 'br.gov.bcb.pix');
        $key = $this->getValue(self::ID_MERCHANT_ACCOUNT_INFORMATION_KEY, $this->pixKey);
        $description = $this->getValue(self::ID_MERCHANT_ACCOUNT_INFORMATION_DESCRIPTION, $this->description);

        return $this->getValue(self::ID_MERCHANT_ACCOUNT_INFORMATION, $gui.$key.$description);
    }

    private function getTxId()
    {
        $txId = $this->getValue(self::ID_ADDITIONAL_DATA_FIELD_TEMPLATE_TXID, $this->txId);

        return $this->getValue(self::ID_ADDITIONAL_DATA_FIELD_TEMPLATE, $txId);
    }

    private function getCRC16($payloadCode)
    {

        $payloadCode .= self::ID_CRC16.'04';

        $polinomio = 0x1021;
        $resultado = 0xFFFF;

        if (($length = strlen($payloadCode)) > 0) {
            for ($offset = 0; $offset < $length; $offset++) {
                $resultado ^= (ord($payloadCode[$offset]) << 8);
                for ($bitwise = 0; $bitwise < 8; $bitwise++) {
                    if (($resultado <<= 1) & 0x10000) {
                        $resultado ^= $polinomio;
                    }
                    $resultado &= 0xFFFF;
                }
            }
        }

        return self::ID_CRC16.'04'.strtoupper(dechex($resultado));
    }
}
