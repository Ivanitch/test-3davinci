<?php

declare(strict_types=1);

ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

class Validator
{
    private string $messageForbiddenSymbols = '';

    /**
     * @return string
     */
    public function getMessageForbiddenSymbols(): string
    {
        return $this->messageForbiddenSymbols;
    }

    public function setMessageForbiddenSymbols(string $message)
    {
        $this->messageForbiddenSymbols = $message;
    }

    /**
     * Находит все запрещённые символы
     * @param $pattern
     * @param $string
     * @return bool
     */
    public function forbiddenSymbols($pattern, $string): bool
    {
        if (!preg_match($pattern, $string)) {
            $arrs = preg_split('//u', $string, -1, PREG_SPLIT_NO_EMPTY);
            $arr = preg_grep($pattern, $arrs, PREG_GREP_INVERT);
            $arr = array_unique($arr);
            if (count($arr) != count(array_unique($arrs))) {
                $this->setMessageForbiddenSymbols("Forbidden characters: '" . implode(', ', $arr) . "'");
            } else {
                $this->setMessageForbiddenSymbols("Does not match a regular expression: '" . $pattern . "'");
            }
            return true;
        }
        return false;
    }
}


$validator = new Validator();
$string = 'String';
$pattern = '/^[a-zA-Z\p{Cyrillic}\d ,\+\*\.\-\/\(\)\[\];]*$/u';
$error = '';

if ($validator->forbiddenSymbols($pattern, $string)) {
    $error = sprintf("Parameter '%s' is not valid. ", $string) . $validator->getMessageForbiddenSymbols();
    var_dump($error);
}
