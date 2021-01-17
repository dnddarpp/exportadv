<?
    $db = new mysqli('localhost', 'chunmu_dev', '6FUovp3k64', 'chunmu_exportadv');

    function db($query, $params=[]){
        global $db;
        if( $params ){
            $query = explode('?', $query);
            $sql = '';
            while( $query ){
                $sql .= array_shift($query);
                if( $params )
                    $sql .= '"' . $db->real_escape_string(array_shift($params)) . '"';
            }
        }
        else
            $sql = $query;
        #echo "SQL: $sql<br>";
        $res = $db->query($sql);
        if( $res===false )
            error_log($db->error);
        return $res;
    }

    function db_row($query, $params=[]){
        $res = db($query, $params);
        if( $res===false )
            return [];
        return $res->fetch_row();
    }

    function db_assoc($query, $params=[]){
        $res = db($query, $params);
        if( $res===false )
            return [];
        return $res->fetch_assoc();
    }

    function db_cols($query, $params=[]){
        $res = db($query, $params);
        if( $res===false )
            return [];
        $out = [];
        while( $row = $res->fetch_row() )
            $out[] = $row[0];
        return $out;
    }

    if( !function_exists('password_hash') ){
        function password_hash($password, $dummy1, $options){
            $cost = $options['cost'] ?: 13;
            if( array_key_exists('salt', $options) )
                $salt = $options['salt'];
            else{
                $salt = '';
                for($i=0; $i<22; ++$i){
                    $r = rand(0, 53);
                    if( $r>=28 )
                        $salt .= chr(ord('a') + $r - 28);
                    elseif( $r>=2 )
                        $salt .= chr(ord('A') + $r - 2);
                    elseif( $r )
                        $salt .= '.';
                    else
                        $salt .= '/';
                }
            }
            return crypt($password, sprintf('$2y$%02d$%s', $cost, $salt));
        }
    }

    if( !function_exists('password_verify') ){
        function password_verify($password, $hash){
            if( !preg_match('/\$2y\$(\d\d)\$(.{22})/', $hash, $match) )
                return false;
            list($dummy, $cost, $salt) = $match;
            if( defined('PASSWORD_DEFAULT') )
                $PASSWORD_DEFAULT = PASSWORD_DEFAULT;
            else
                $PASSWORD_DEFAULT = 1;
            $hash2 = password_hash($password, $PASSWORD_DEFAULT, ['cost' => $cost, 'salt' => $salt]);
            return $hash === $hash2;
        }
    }
