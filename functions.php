<?php

function debug($str) {
    echo "<pre>";
    print_r($str);
    echo "</pre>";
}


function luhnAlgorithm($digit)
{
    $number = strrev(preg_replace('/[^\d]/', '', $digit));
    $sum = 0;
    for ($i = 0, $j = strlen($number); $i < $j; $i++) {
        if (($i % 2) == 0) {
            $val = $number[$i];
        } else {
            $val = $number[$i] * 2;
            if ($val > 9)  {
                $val -= 9;
            }
        }
        $sum += $val;
    }
    return (($sum % 10) === 0); //true false
}


// Делаем из tac'a(8цифр) -> IMEI+контр.число(15цифр)
function getTrueImei($tac) {
	$tac = substr($tac, 0, 8);
    $imei = str_pad($tac, 15, '0');
    while( luhnAlgorithm($imei) == false ) {
        $imei++;
    }
    return $imei;
}


// Проверка IMEI\TAC на соответствие 
// длина от 8 до 15 цифр
function cutImei($digit) {
    if (preg_match('/[0-9]{8,15}/', $digit)) {

        if (strlen($digit) >= 8) {
            // обрезаем до 8 символов
            $tac = substr($digit, 0, 8);

            // добавляем до 15 символов
            $imei = str_pad($tac, 15, '0');

            // высчитываем контрольное число
            while( luhnAlgorithm($imei) == false ) {
                $imei++;
            }
            return $imei;
        }

    } else return false;
}