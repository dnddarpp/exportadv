<?
    $room_which = [
        'r401r' => 0x1,
        'r401s' => 0x2,

        'r601' => 0x10,
        'r602' => 0x100,

        'r701a' => 0x1000,
        'r701b' => 0x2000,
        'r701c' => 0x4000,
        'r701d' => 0x8000,
        'r701e' => 0x10000,
        'r701f' => 0x20000,
        'r701g' => 0x40000,
        'r701h' => 0x80000,

        'r702a' => 0x1000000,
        'r702b' => 0x2000000,
        'r702c' => 0x4000000,

        'r703a' => 0x100000000,
        'r703b' => 0x200000000,
        'r703c' => 0x400000000,
    ];

    function rooms_which($post){
        global $room_which;
        $which = 0;
        foreach( $room_which as $key => $value ){
            if( $post[$key] )
                $which |= $value;
        }
        return $which;
    }

    function which_room_map($which){
        global $room_which;
        $take = [];
        foreach( $room_which as $key => $value )
            if( $which & $value )
                $take[$key] = $value;
        return $take;
    }

    function which_room_str($which){
        $take = which_room_map($which);

        $set = [];
        foreach( $take as $key => $_ ){
            if( preg_match('/^r(...)(.?)$/', $key, $match ) ){
                if( !$set["$match[1]"] )
                    $set["$match[1]"] = [strtoupper($match[2])];
                else
                    $set["$match[1]"][] = strtoupper($match[2]);
            }
        }

        $out = [];
        foreach( $set as $key => $subs ){
            if( count($subs)==1 )
                $out[] = "$key$subs[0]";
            else
                $out[] = "$key(" . implode('', $subs) . ")";
        }

        return implode(', ', $out);
    }

    function room_checkboxes($which){
        global $room_which;
        if( $room_which['r401r'] & $which ) $r401r_checked = 'checked';
        if( $room_which['r401s'] & $which ) $r401s_checked = 'checked';
        $r401_checked = $r401r_checked && $r401s_checked ? 'checked' : '';
        if( $room_which['r601'] & $which ) $r601_checked = 'checked';
        if( $room_which['r602'] & $which ) $r602_checked = 'checked';
        if( $room_which['r701a'] & $which ) $r701a_checked = 'checked';
        if( $room_which['r701b'] & $which ) $r701b_checked = 'checked';
        if( $room_which['r701c'] & $which ) $r701c_checked = 'checked';
        if( $room_which['r701d'] & $which ) $r701d_checked = 'checked';
        if( $room_which['r701e'] & $which ) $r701e_checked = 'checked';
        if( $room_which['r701f'] & $which ) $r701f_checked = 'checked';
        if( $room_which['r701g'] & $which ) $r701g_checked = 'checked';
        if( $room_which['r701h'] & $which ) $r701h_checked = 'checked';
        $r701_checked = $r701a_checked && $r701b_checked && $r701c_checked && $r701d_checked && $r701e_checked && $r701f_checked && $r701g_checked && $r701h_checked ? 'checked' : '';
        if( $room_which['r702a'] & $which ) $r702a_checked = 'checked';
        if( $room_which['r702b'] & $which ) $r702b_checked = 'checked';
        if( $room_which['r702c'] & $which ) $r702c_checked = 'checked';
        $r702_checked = $r702a_checked && $r702b_checked && $r702c_checked ? 'checked' : '';
        if( $room_which['r703a'] & $which ) $r703a_checked = 'checked';
        if( $room_which['r703b'] & $which ) $r703b_checked = 'checked';
        if( $room_which['r703c'] & $which ) $r703c_checked = 'checked';
        $r703_checked = $r703a_checked && $r703b_checked && $r703c_checked ? 'checked' : '';
        return <<<EOT
        <div class=room_set>
            <div><label><input name=r401 type=checkbox value=1 {$r401_checked}> 401</label></div>
            <div style=margin-left:1em>
                <label><input name=r401r type=checkbox value=1 {$r401r_checked}> -R</label>
                <label><input name=r401s type=checkbox value=1 {$r401s_checked}> -S</label>
            </div>
            <div><label><input name=r601 type=checkbox value=1 {$r601_checked}> 601</label></div>
            <div><label><input name=r602 type=checkbox value=1 {$r602_checked}> 602</label></div>
            <div><label><input name=r701 type=checkbox value=1 {$r701_checked}> 701</label></div>
            <div style=margin-left:1em>
                <label><input name=r701a type=checkbox value=1 {$r701a_checked}> -A</label>
                <label><input name=r701b type=checkbox value=1 {$r701b_checked}> -B</label>
                <label><input name=r701c type=checkbox value=1 {$r701c_checked}> -C</label>
                <label><input name=r701d type=checkbox value=1 {$r701d_checked}> -D</label>
                <label><input name=r701e type=checkbox value=1 {$r701e_checked}> -E</label>
                <label><input name=r701f type=checkbox value=1 {$r701f_checked}> -F</label>
                <label><input name=r701g type=checkbox value=1 {$r701g_checked}> -G</label>
                <label><input name=r701h type=checkbox value=1 {$r701h_checked}> -H</label>
            </div>
            <div><label><input name=r702 type=checkbox value=1 {$r702_checked}> 702</label></div>
            <div style=margin-left:1em>
                <label><input name=r702a type=checkbox value=1 {$r702a_checked}> -A</label>
                <label><input name=r702b type=checkbox value=1 {$r702b_checked}> -B</label>
                <label><input name=r702c type=checkbox value=1 {$r702c_checked}> -C</label>
            </div>
            <div><label><input name=r703 type=checkbox value=1 {$r703_checked}> 703</label></div>
            <div style=margin-left:1em>
                <label><input name=r703a type=checkbox value=1 {$r703a_checked}> -A</label>
                <label><input name=r703b type=checkbox value=1 {$r703b_checked}> -B</label>
                <label><input name=r703c type=checkbox value=1 {$r703c_checked}> -C</label>
            </div>
        </div>
EOT;
    }
