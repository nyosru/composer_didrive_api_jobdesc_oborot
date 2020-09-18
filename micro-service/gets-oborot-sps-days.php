<?php

try {

//    $date = $in['date'] ?? $_REQUEST['date'] ?? null;
//    if (empty($date))
//        throw new \Exception('нет даты');

    if (!isset($skip_start) || ( isset($skip_start) && $skip_start !== true ))
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




// получаем со всех точек обороты за последние 4 дня, перезаписываем значения если нет значения

    $sps = \Nyos\mod\items::get($db, \Nyos\mod\JobDesc::$mod_sale_point);
    \f\pa($sps);

    $return = \Nyos\api\JOBDESC_OBOROT::getNoData($db, 20);
    \f\pa($return, 2, '', 'чего не хватает');



// ----------------
    
    
    
    
    
    
    $links = [];
    if (!empty($return['data']['nodata'])) {
        foreach ($return['data']['nodata'] as $sp => $v1) {
            foreach ($v1 as $date => $v2) {
                $links[] = [
                    'sp' => $sp,
                    'get_sp_load' => $sp,
                    'date' => $date,
                    'hide_form' => 'da',
                    'no_send_msg' => 'da',
                    'action' => 'get_oborot_for_sps'
                ];
            }
        }
    }

// https://adomik.dev.uralweb.info/vendor/didrive_mod/iiko_oborot/1/didrive/ajax.php    
// date=2019-12-09&hide_form=da&action=get_oborot_for_sps&get_sp_load=2229
    // \f\pa($links,2);

    $msg_txt = 'Массовая подгрузка оборотов';

    \f\timer_start(47);
    $ww = 0;
    foreach ($links as $k => $gg) {

        // echo '<br/>' . __LINE__;
        //инициализация сеанса
        if ($curl = curl_init()) {
            // echo '<br/>' . __LINE__;
            
            \f\pa($gg);
            
            //указываем адрес страницы
            curl_setopt($curl, CURLOPT_URL, 'http://' . $_SERVER['HTTP_HOST'] . '/vendor/didrive_mod/iiko_oborot/1/didrive/ajax.php?' . http_build_query($gg));
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($curl, CURLOPT_HEADER, 0);
            //выполнение запроса
            $result = curl_exec($curl);
            
            //закрытие сеанса
            curl_close($curl);
        }

        // \f\pa($result);
        $result1 = json_decode($result, true);
        // echo '<Br/>'.$result1['data']['oborot'];
        
        \f\pa($result1);
        
        $timer = \f\timer_stop(47, 'ar');
        // \f\pa(\f\timer_stop(47, 'ar'));
        
        $ww++;
        // echo '<br/>kk: '.$ww;

        $msg_txt .= PHP_EOL . $sps[$gg['sp']]['head'] . ' ' . $gg['date'] . ' + ' . $result1['data']['oborot'] . ' р';

        if ($ww >= 50 || $timer['sec'] > 10) {
            break;
        }
    }

    $timer = \f\timer_stop(47, 'ar');

    if ($ww == 0)
        $msg_txt .= PHP_EOL . 'все обороты загружены, нечего грузить';

    // \nyos\Msg::sendTelegramm($msg_txt, null, 1);
    if (1 == 1 && class_exists('\\Nyos\\Msg')) {

        if (!isset($vv['admin_ajax_job'])) {
            require_once DR . '/sites/' . \Nyos\nyos::$folder_now . '/config.php';
        }

        \nyos\Msg::sendTelegramm($msg_txt, null, 1);

        if (isset($vv['admin_ajax_job'])) {
            foreach ($vv['admin_ajax_job'] as $k => $v) {
                \Nyos\Msg::sendTelegramm($msg_txt, $v);
            }
        }
    }

//    \f\end2('Обработано оборотов: ' . $ww, true, ['text' => $msg_txt, 'kolvo' => $ww, 'colvo_sec' => round($timer['sec'], 2)]);
\f\pa( [ 'Обработано оборотов: ' . $ww, true, ['text' => $msg_txt, 'kolvo' => $ww, 'colvo_sec' => round($timer['sec'], 2)] ]  );
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    





    \f\end2('удалено', true);

    //\f\end2($res['html'], true);
} catch (Exception $exc) {

    echo '<pre>';
    print_r($exc);
    echo '</pre>';
    // echo $exc->getTraceAsString();

    f\end2($exc->getMessage(), false, $exc);
}