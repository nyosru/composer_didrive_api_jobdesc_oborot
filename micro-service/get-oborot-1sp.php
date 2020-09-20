<?php

try {

//    $date = $in['date'] ?? $_REQUEST['date'] ?? null;
//    if (empty($date))
//        throw new \Exception('нет даты');

    if (!isset($skip_start) || ( isset($skip_start) && $skip_start !== true )) {

        require_once '0start.php';

        foreach (\Nyos\Nyos::$menu as $k => $v) {
            if ($v['type'] == 'iiko_checks' && $v['version'] == 1) {

                \Nyos\mod\IikoOborot::$db_type = $v['db_type'];
                \Nyos\api\Iiko::$db_type = $v['db_type'];
                \Nyos\mod\IikoOborot::$db_host = $v['db_host'];
                \Nyos\api\Iiko::$db_host = $v['db_host'];
                \Nyos\mod\IikoOborot::$db_port = $v['db_port'];
                \Nyos\api\Iiko::$db_port = $v['db_port'];
                \Nyos\mod\IikoOborot::$db_base = $v['db_base'];
                \Nyos\api\Iiko::$db_base = $v['db_base'];
                \Nyos\mod\IikoOborot::$db_login = $v['db_login'];
                \Nyos\api\Iiko::$db_login = $v['db_login'];
                \Nyos\mod\IikoOborot::$db_pass = $v['db_pass'];
                \Nyos\api\Iiko::$db_pass = $v['db_pass'];

                break;
            }
        }
    }

    
    
    $ret = [];

    $ret = \Nyos\api\JOBDESC_OBOROT::loadOborotFromServer($sp_id, $date);
    
    return $ret;

//    \f\end2('удалено', true);

//\f\end2($res['html'], true);
} catch (Exception $exc) {

    // echo '<pre>';    print_r($exc);    echo '</pre>';
    // echo $exc->getTraceAsString();

    // \f\end2($exc->getMessage(), false, [ $exc->getFile(), $exc->getLine(), $exc->getMessage() ] );
    return $exc->getFile() .' '. $exc->getLine() .' '. $exc->getMessage() ;
}