<?
    require_once('date.inc.php');
    require_once('db.inc.php');

    function KHB_read($lang, $btime=0, $etime=0){
        $khbs = array();
        if( !$btime )
            $btime = time();
        if( !$etime )
            $etime = $btime + 630720000;
        $res = db('select persistent, json, btime, etime from khb_attachment');
        while( ($row = $res->fetch_assoc()) ){
            $khb = json_decode($row['json'], true);
            $khb['persistent'] = $row['persistent'];

            if( $row['btime']>0 )
                $khb_btime = parse_date($khb['sdate'], date('H:i:s', $row['btime']));
            else
                $khb_btime = parse_date($khb['sdate'], '09:00:00');

            if( $row['etime']>0 )
                $khb_etime = parse_date($khb['edate'], date('H:i:s', $row['etime']));
            else
                $khb_etime = parse_date($khb['edate'], '18:00:00');

            if( $lang === 'en' ){
                if( $btime <= $khb_etime && $khb_btime <= $etime && $khb['name']['en'] )
                    $khbs[] = $khb;
            }
            elseif( $lang === 'zh' ){
                if( $btime <= $khb_etime && $khb_btime <= $etime && $khb['name']['zh-tw'] )
                    $khbs[] = $khb;
            }
            else{
                echo " "; # 先印一下，這樣當 $etime > 2147483647 以後，下面的比較式的結果才會正確
                if( $btime <= $khb_etime && $khb_btime <= $etime )
                    $khbs[] = $khb;
            }
        }
        return $khbs;
    }

    function KHB_normalize($entry, $lang){
        $out = [
            'id' => $entry['key'],
            'persistent' => $entry['persistent'],
            'class' => 1,
            'organizer' => $entry['company']['zh-tw'],
            'organizer_en' => $entry['company']['en'],
            'title' => $entry['name']['zh-tw'],
            'title_en' => $entry['name']['en'],
        ];
        if( $lang === 'en' ){
            $out['organizer'] = $entry['company']['en'] ?: $entry['company']['zh-tw'];
            $out['title'] = $entry['name']['en'] ?: $entry['name']['zh-tw'];
        }
        else{
            $out['organizer'] = $entry['company']['zh-tw'] ?: $entry['company']['en'];
            $out['title'] = $entry['name']['zh-tw'] ?: $entry['name']['en'];
        }

        list($out['url'], $out['hide'], $cover, $btime, $etime, $out['hide_time']) = db_row('select url, hide, if(content=\'\', \'\', concat(\'khb_attachment.\', id)), btime, etime, hide_time from khb_attachment where id=?', [$entry['key']]);

        if( $btime>0 )
            $out['btime'] = parse_date($entry['sdate'], date('H:i:s', $btime));
        else
            $out['btime'] = parse_date($entry['sdate'], '09:00:00');

        if( $etime>0 )
            $out['etime'] = parse_date($entry['edate'], date('H:i:s', $etime));
        else
            $out['etime'] = parse_date($entry['edate'], '18:00:00');

        if( $cover )
            $out['cover'] = $cover;
        $area = [];
        foreach( $entry['place'] as $places )
            foreach( $places as $place )
                foreach( $place['area'] as $a )
                    $area[$a] = 1;
        if( $area['P'] || $area['Q'] )
            $out['f1'] = 1;
        if( $area['R'] || $area['S'] )
            $out['f4'] = 1;
        return $out;
    }

    function KHB_one($key, $lang){
        foreach( KHB_read($lang, 1, time()+630720000) as $entry )
            if( $entry['key'] === $key )
                return KHB_normalize($entry, $lang);
        return null;
    }

    function KHB_list($lang, $btime, $etime){
        $list = [];
        foreach( KHB_read($lang, $btime, $etime) as $entry )
            $list[] = KHB_normalize($entry, $lang);
        return $list;
    }

    function KHB_list_no_hide($lang, $btime, $etime){
        $list = [];
        foreach( KHB_read($lang, $btime, $etime) as $entry ){
            $entry = KHB_normalize($entry, $lang);
            if( !$entry['hide'] )
                $list[] = $entry;
        }
        return $list;
    }
