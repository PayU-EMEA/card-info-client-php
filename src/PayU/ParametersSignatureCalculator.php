<?php

namespace PayU;

class ParametersSignatureCalculator
{
    const HASHING_ALGORITHM_SHA256 = 'sha256';

    /**
     * This method calculates the signature applying hashmac operation on a string resulted from concatenated values
     * prepended by their length.
     * @param string $algorithm
     * @param string $secretKey
     * @param array $params
     * @return string
     */
    public function calculateSignature($algorithm, $secretKey, array $params)
    {
        $signatureString = $this->concatenateArrayValueLengthsAndValues($params);

        return hash_hmac($algorithm, $signatureString, $secretKey);
    }

    private function concatenateArrayValueLengthsAndValues(array $params)
    {
        ksort($params, SORT_STRING);

        $signatureString = '';
        foreach ($params as $key => $value) {
            if (is_array($value)) {
                $signatureString .= $this->concatenateArrayValueLengthsAndValues($value);
            } else {
                $signatureString .= strlen($value) . $value;
            }
        }

        return $signatureString;
    }
}
