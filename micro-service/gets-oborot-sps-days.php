<?php

try {

//    $date = $in['date'] ?? $_REQUEST['date'] ?? null;
//    if (empty($date))
//        throw new \Exception('нет даты');

    if (!isset($skip_start) || ( isset($skip_start) && $skip_start !== true ))
        require_once '0start.php';


    foreach (\Nyos\Nyos::$menu as $k => $v) {
        if ($v['type'] == 'iiko_checks' && $v['version'] == 1) {

            \Nyos\api\JOBDESC_OBOROT::$db_type = $v['db_type'];
//            \Nyos\mod\IikoOborot::$db_type = $v['db_type'];
//            \Nyos\api\Iiko::$db_type = $v['db_type'];

            \Nyos\api\JOBDESC_OBOROT::$db_host = $v['db_host'];
//            \Nyos\mod\IikoOborot::$db_host = $v['db_host'];
//            \Nyos\api\Iiko::$db_host = $v['db_host'];

            \Nyos\api\JOBDESC_OBOROT::$db_port = $v['db_port'];
//            \Nyos\mod\IikoOborot::$db_port = $v['db_port'];
//            \Nyos\api\Iiko::$db_port = $v['db_port'];

            \Nyos\api\JOBDESC_OBOROT::$db_base = $v['db_base'];
//            \Nyos\mod\IikoOborot::$db_base = $v['db_base'];
//            \Nyos\api\Iiko::$db_base = $v['db_base'];

            \Nyos\api\JOBDESC_OBOROT::$db_login = $v['db_login'];
//            \Nyos\mod\IikoOborot::$db_login = $v['db_login'];
//            \Nyos\api\Iiko::$db_login = $v['db_login'];

            \Nyos\api\JOBDESC_OBOROT::$db_pass = $v['db_pass'];
//            \Nyos\mod\IikoOborot::$db_pass = $v['db_pass'];
//            \Nyos\api\Iiko::$db_pass = $v['db_pass'];

            break;
        }
    }


// получаем со всех точек обороты за последние 4 дня, перезаписываем значения если нет значения

    $sps = \Nyos\mod\items::get($db, \Nyos\mod\JobDesc::$mod_sale_point, 'show', 'id_id');
    \f\pa($sps, 2);

    $return_sp_date = \Nyos\api\JOBDESC_OBOROT::getNoData($db, 20);
    \f\pa($return_sp_date, 2, '', 'чего не хватает');




    $now_sp_date = [];
    $dt = date('Y-m-d', $_SERVER['REQUEST_TIME'] - 3600 * 24 * 20);

    // \Nyos\mod\items::$show_sql = true;
    \Nyos\mod\items::$between['date'] = [$dt, date('Y-m-d', $_SERVER['REQUEST_TIME'] - 3600 * 24)];
    \Nyos\mod\items::$sql_select_vars = ['id', 'date', 'sale_point'];
    $list2 = \Nyos\mod\items::get($db, \Nyos\mod\JobDesc::$mod_oborots);
    // \f\pa($list, 2);
    foreach ($list2 as $v) {
        $now_sp_date[$v['sale_point']][$v['date']] = $v['id'];
    }
    \f\pa($now_sp_date, 2, '', '$now_sp_date');



    $adds = [];

    $edit_nn = 0;

    foreach ($return_sp_date as $sp => $date0) {

        // break;

        if (empty($sps[$sp]['id_tech_for_oborot']))
            continue;

//        if( empty($sps[$sp]['id_tech_for_oborot2']) )
//            continue;

        $sp_id = [$sps[$sp]['id_tech_for_oborot']];

        if (!empty($sps[$sp]['id_tech_for_oborot2']))
            array_push($sp_id, $sps[$sp]['id_tech_for_oborot2']);

        if (!empty($sps[$sp]['id_tech_for_oborot3']))
            array_push($sp_id, $sps[$sp]['id_tech_for_oborot3']);

        if (!empty($sps[$sp]['id_tech_for_oborot4']))
            array_push($sp_id, $sps[$sp]['id_tech_for_oborot4']);


        foreach ($date0 as $date => $s) {

            $skip_start = true;

            // $sp_id = $sps[$sp]['id_tech_for_oborot'];
            // $date = 

            // echo '<br/> sp ' . $sps[$sp]['head'] . ' d ' . $date;

//            try {
            $res = require 'get-oborot-1sp.php';
            // \f\pa($res, 2);    
//            } catch (\Exception $ex) {
//                echo '<br/>ошибочка';
//                continue;
//            }            
            
            if ( isset($now_sp_date[$sp][$date]) ) {
                
                $edit_nn++;
                
                // echo '<Br/>запись есть, редактируем ';
                // \f\pa($now_sp_date[$sp][$date]);
                
                \Nyos\mod\items::edit($db, \Nyos\mod\JobDesc::$mod_oborots, [ 'id' => $now_sp_date[$sp][$date] ], [ 'oborot_server' => $res['data']['oborot'] ] );
                
            } else {
                
                // echo '<Br/>записи нет, добавляем';
                $adds[] = [
                    'sale_point' => $sp,
                    'date' => $date,
                    'oborot_server' => $res['data']['oborot']
                ];
                
            }

//            echo '<hr>';
//            echo '<hr>';
//            echo '<hr>';
        }

        // break;
    }

    if (!empty($adds)) {
        // \f\pa($adds,'','','$adds');
        \Nyos\mod\items::adds($db, \Nyos\mod\JobDesc::$mod_oborots, $adds );
    }

    
    
    if (1 == 1 && class_exists('\\Nyos\\Msg')) {

        $msg_txt = 'грузим обороты точкам'
                .PHP_EOL.' добавлено: '.sizeof($adds)
                .PHP_EOL.' отредактировано: '.$edit_nn;
        
//        if (!isset($vv['admin_ajax_job'])) {
//            require_once DR . '/sites/' . \Nyos\nyos::$folder_now . '/config.php';
//        }

        \nyos\Msg::sendTelegramm($msg_txt, null, 2);
    }
    
    
    
    
//    
//
//// ----------------
//    
//    
//    
//    
//    
//    
//    $links = [];
//    if (!empty($return['data']['nodata'])) {
//        foreach ($return['data']['nodata'] as $sp => $v1) {
//            foreach ($v1 as $date => $v2) {
//                $links[] = [
//                    'sp' => $sp,
//                    'get_sp_load' => $sp,
//                    'date' => $date,
//                    'hide_form' => 'da',
//                    'no_send_msg' => 'da',
//                    'action' => 'get_oborot_for_sps'
//                ];
//            }
//        }
//    }
//
//// https://adomik.dev.uralweb.info/vendor/didrive_mod/iiko_oborot/1/didrive/ajax.php    
//// date=2019-12-09&hide_form=da&action=get_oborot_for_sps&get_sp_load=2229
//    // \f\pa($links,2);
//
//    $msg_txt = 'Массовая подгрузка оборотов';
//
//    \f\timer_start(47);
//    $ww = 0;
//    foreach ($links as $k => $gg) {
//
//        // echo '<br/>' . __LINE__;
//        //инициализация сеанса
//        if ($curl = curl_init()) {
//            // echo '<br/>' . __LINE__;
//            
//            \f\pa($gg);
//            
//            //указываем адрес страницы
//            curl_setopt($curl, CURLOPT_URL, 'http://' . $_SERVER['HTTP_HOST'] . '/vendor/didrive_mod/iiko_oborot/1/didrive/ajax.php?' . http_build_query($gg));
//            curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
//            curl_setopt($curl, CURLOPT_HEADER, 0);
//            //выполнение запроса
//            $result = curl_exec($curl);
//            
//            //закрытие сеанса
//            curl_close($curl);
//        }
//
//        // \f\pa($result);
//        $result1 = json_decode($result, true);
//        // echo '<Br/>'.$result1['data']['oborot'];
//        
//        \f\pa($result1);
//        
//        $timer = \f\timer_stop(47, 'ar');
//        // \f\pa(\f\timer_stop(47, 'ar'));
//        
//        $ww++;
//        // echo '<br/>kk: '.$ww;
//
//        $msg_txt .= PHP_EOL . $sps[$gg['sp']]['head'] . ' ' . $gg['date'] . ' + ' . $result1['data']['oborot'] . ' р';
//
//        if ($ww >= 50 || $timer['sec'] > 10) {
//            break;
//        }
//    }
//
//    $timer = \f\timer_stop(47, 'ar');
//
//    if ($ww == 0)
//        $msg_txt .= PHP_EOL . 'все обороты загружены, нечего грузить';
//
//    // \nyos\Msg::sendTelegramm($msg_txt, null, 1);
//    if (1 == 1 && class_exists('\\Nyos\\Msg')) {
//
//        if (!isset($vv['admin_ajax_job'])) {
//            require_once DR . '/sites/' . \Nyos\nyos::$folder_now . '/config.php';
//        }
//
//        \nyos\Msg::sendTelegramm($msg_txt, null, 1);
//
//        if (isset($vv['admin_ajax_job'])) {
//            foreach ($vv['admin_ajax_job'] as $k => $v) {
//                \Nyos\Msg::sendTelegramm($msg_txt, $v);
//            }
//        }
//    }
//
////    \f\end2('Обработано оборотов: ' . $ww, true, ['text' => $msg_txt, 'kolvo' => $ww, 'colvo_sec' => round($timer['sec'], 2)]);
//\f\pa( [ 'Обработано оборотов: ' . $ww, true, ['text' => $msg_txt, 'kolvo' => $ww, 'colvo_sec' => round($timer['sec'], 2)] ]  );
//    
//     \f\end2('удалено', true);
    //\f\end2($res['html'], true);
} catch (Exception $exc) {

    echo '<pre>';
    print_r($exc);
    echo '</pre>';
    // echo $exc->getTraceAsString();

    f\end2($exc->getMessage(), false, $exc);
}

die('end ' . __FILE__ . ' #' . __LINE__);
