<?
    function parse_date($date_str, $time_str='00:00'){
        $out = 0;
        if( preg_match('/(\d+)\D+(\d+)\D+(\d+)/', $date_str, $match) )
            $out = mktime(0, 0, 0, $match[2], $match[3], $match[1]);
        if( $out && preg_match('/(\d+):(\d+)/', $time_str, $match) ){
            if( $match[1] < 24 && $match[2] < 60 )
                $out += $match[1] * 3600 + $match[2] * 60;
        }
        return $out;
    }

    function day_btime($time){
        return $time - ($time + 28800) % 86400;
    }
