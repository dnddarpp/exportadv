<?
    function today_btime($now=null){
        if( !$now )
            $now = time();
        return $now - ($now + 28800) % 86400;
    }

    function today_etime($now=null){
        if( !$now )
            $now = time();
        return $now + 86400 - ($now + 28800) % 86400;
    }
