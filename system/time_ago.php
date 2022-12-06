<?php
function time_ago($datetime, $full = false) {
    /**int to string time by arif */
    $datte=date("Y-m-d H:i:s",$datetime);
    $now = new DateTime;
     /**onl string time by arif */
    $ago = new DateTime($datte);
    $diff = $now->diff($ago);
    /**devided time by arif */
    $diff->w = floor($diff->d / 7);
    $diff->d -= $diff->w * 7;
    /**time array by arif */
    $string = array(
        'y' => 'year',
        'm' => 'month',
        'w' => 'week',
        'd' => 'day',
        'h' => 'hour',
        'i' => 'minute',
        's' => 'second',
    );
     /**loop for convert string by arif */
    foreach ($string as $k => &$v) {
        if ($diff->$k) {
            $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
        } else {
            unset($string[$k]);
        }
    }
 /**check string time by arif */
    if (!$full) $string = array_slice($string, 0, 1);
    return $string ? implode(', ', $string) . ' ago' : 'just now';
}
?>