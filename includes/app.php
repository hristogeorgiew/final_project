<?php
function validate_data($hours, $minutes, $seconds, $angle = null) {

    if (empty($hours) || empty($minutes) || empty($seconds)){
        return "Имате непопълнени полета, всичките полета са задължителни!";
    }
    if(!ctype_digit($hours) || !ctype_digit($minutes) || !ctype_digit($seconds)) {
        return 'Невалиден формат, моля въведете само числа!';
    }
    if($hours > 24 || $hours < 0) {
        return 'Невалиден формат на часа!';
    }
    if($minutes > 60 || $minutes < 0) {
        return 'Невалиден формат на минутите!';
    }
    if($seconds > 60 || $seconds < 0) {
        return 'Невалиден формат на секундите!';
    }

    if($angle > 180 && $angle < 0) {
        return 'Въведете ъгъл между 0 и 180 градуса!';
    }
    
    return true;
}

function calculation_data($time) {
    $time = explode(':', $time);
    $hours = $time[0];
    $minutes = $time[1];
    $seconds = $time[2];

    if($hours > 12) {
        $hours -= 12;
    }

    $angle = abs(30 * $hours + 0.5 * $minutes + ($seconds / 120) - (6 * $minutes + 0.1 * $seconds));
    return min($angle, 360 - $angle);
}


function clockHandAngle2($angle, $timeNow) {
    $timeNow = explode(':', $timeNow);
    $hours = $timeNow[0];
    $minutes = $timeNow[1];
    $seconds = $timeNow[2];

    $e = 0.09;
    while (abs(calculation_data($hours . ':' . $minutes . ':' . $seconds) - $angle) > $e) {
        $seconds += 1;
        if($seconds >= 60) {
            $seconds = 0;
            $minutes += 1;
        }

        if($minutes >= 60) {
            $minutes = 0;
            $hours += 1;
        }

        if($hours > 12) {
            $hours -= 12;
        }
    }
    $time = strtotime($hours . ':' . $minutes . ':' . $seconds);
    return date('g:i:s', $time);
}
