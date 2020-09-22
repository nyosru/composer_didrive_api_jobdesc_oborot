<?php

if (isset($skip_start) && $skip_start === true) {
    
} else {
    require_once '0start.php';
    $skip_start = false;
}

\f\timer_start(1);

// если нужно не обращать внимания на кеш
// if (!empty($_GET['no_load_cash']))
    \Nyos\api\Iiko::$cash = false;

// getConfigDbIiko

\Nyos\api\Iiko::getConfigDbIiko();

// $re['data'] = \Nyos\api\Iiko::getAnswer('подразделения');

$v = [
    // 'department' => '8e5f876b-7b41-45ac-b01b-9311c552bb33' ,
    // 'department' => '4c360162-6e12-da32-0145-88f5ce8c000d' ,
    // 'department' => 'f7ccc3ad-0e49-41f6-8f1a-54271aefbab9' ,
    // 'department' => '19fdf41e-74f9-4926-aa7d-54cf0016c51b' ,
    // 'department' => '7135f47f-7ce6-4189-be06-93cd4c5d6431' ,
    // 'department' => '8e5f876b-7b41-45ac-b01b-9311c552bb33' ,
    // 'department' => 'befb12f4-0615-4c79-8163-1db7089f4c01' ,
    //'department' => '4c360162-6e12-da32-0145-88f5ce8c000d' ,
    //tt1
    'department' => 'f939f35f-c169-4be9-9933-5af230748ede' ,
    'dateFrom' => date('d.m.Y', $_SERVER['REQUEST_TIME'] - 3600*24*2 ),
    'hourFrom' => 6,
    'hourTo' => 5,
    'dishDetails' => 'false',
    'allRevenue' => 'false'
    ];
$v['dateTo'] = date('d.m.Y', strtotime( $v['dateFrom'].' +1 day ' ) );

\Nyos\api\Iiko::$show_uri = true;
$re['data'] = \Nyos\api\Iiko::getAnswer('reports/sales', $v );

//\f\pa($re['data']);

$re['data'] = \Nyos\api\Iiko::getAnswer('выход');
// \f\pa($re['data'],'','','');
echo '<br/>стёрли ключ доступа';


//
//$new = \Nyos\api\Iiko::loadIikoPeople();
//
////\f\pa($new['data'], 2, '', 'new результат загрузки '.sizeof($new['data']));
//
//$now = \Nyos\mod\items::get($db, \Nyos\mod\JobDesc::$mod_jobman);
//
//// \f\pa($now, 2, '', 'old текущие записи '.sizeof($now) );
//// сравниваем старое и новое
//$diff = \Nyos\api\Iiko::diffLoadData($new['data'], $now);
//// \f\pa($diff, 2, '', '$res_diff');
//
//$new_add = [];
//$new_name = '';
//foreach ($diff['data']['new_items'] as $k => $v) {
//
//    $v1 = [];
//
//    foreach ($v as $k0 => $v0) {
//
//        if (empty($v0))
//            continue;
//
//        if ($k0 == 'id') {
//            $v1['iiko_id'] = $v0;
//        } elseif ($k0 == 'name') {
//            $v1['iiko_name'] = $v0;
//        } elseif ($k0 == 'birthday') {
//            $v1[$k0] = substr($v0, 0, 10);
//        } else {
//            $v1[$k0] = $v0;
//        }
//    }
//
//    $new_add[] = $v1;
//    //\f\pa($v['name']);
//    // \f\pa($v1);
//    $new_name .= $v['lastName'] . ' ';
//}
//
//// \f\pa($new_add);
//
//if (!empty($new_add)) {
//    //   echo '<br/>'.__LINE__;
//    $new = \Nyos\mod\items::adds($db, \Nyos\mod\JobDesc::$mod_jobman, $new_add);
//    // \f\pa($new);
//}
//
//$edited = 0;
//
//// echo '<br/>изменить '.sizeof($diff['data']['new_dop_data']);
//
//if (!empty($diff['data']['new_dop_data'])) {
//
//    \f\timer_start(789);
//
//    foreach ($diff['data']['new_dop_data'] as $user_id => $v) {
//
//        try {
//            \f\db\db_edit2($db, 'mod_' . \f\translit(\Nyos\mod\JobDesc::$mod_jobman, 'uri2'), ['id' => $user_id], $v);
//        } catch (\PDOException $exc) {
//            // echo $exc->getTraceAsString();
//            \f\pa($exc->getMessage());
//        }
//
//        $edited++;
//
//        $e = \f\timer_stop(789, 'ar');
//        // \f\pa($e);
//        if ($e['sec'] > 5)
//            break;
//    }
//}
//
//// \f\pa($diff['data']['new_dop_data']);
//// $msg = 'Загрузили данные с айки по пользователям ( ' . sizeof($re) . ' записей )';
//$msg = 'Загрузили данные с айки по пользователям'
//        . PHP_EOL . 'записей ' . sizeof($now)
//        . PHP_EOL . 'новых сотрудников  ' . (!empty($new_add) ? sizeof($new_add) : 0 )
//        . ' ' . $new_name
//        . PHP_EOL . 'нужно обновить: ' . ( !empty($diff['data']['new_dop_data']) ? sizeof($diff['data']['new_dop_data'])-2 : 0 ) . ' = обновлено: ' . ( $edited - 2 )
//;
//
//\Nyos\Msg::sendTelegramm($msg, null, 2);
//
//\f\end2($msg, true, [
//    'loaded' => sizeof($new['data'] ?? [] ),
//    'new' => sizeof( $new_add ),
//    'need_edit' => sizeof($diff['data']['new_dop_data']),
//    'edited' => $edited
//]);

//
//die();
//
//
//// die('<br/>#'.__LINE__);
////                // если кеш есть
////                if (isset($e['file_cash_est']) && $e['file_cash_est'] == 'da') {
////                    echo '<br/>#' . __LINE__;
////                }
////                // если кеша нет, то записываем
////                else {
////                    echo '<br/>#' . __LINE__;
////                }
//
//if (!empty($e['data']))
//    $e2 = \Nyos\api\Iiko::saveIikoPeople($db, $e['data']);
//
//// \f\pa($e2, 2, '', ' результат выполнения загрузки и проверки данных');
//
//$msg2 = ( (!empty($e['error_txt'])) ? 'Обнаружена ошибка:' . $e['error_txt'] . PHP_EOL : '' )
//        . 'Добавлено пользователей: ' . ( $e2['new_items'] ?? 0 )
//        . PHP_EOL . 'Обновлено заголовоков (ФИО): ' . ( $e2['new_head'] ?? 0 )
//        . PHP_EOL . 'Обновлено параметров: ' . ( $e2['new_dops_kolvo'] ?? 0 )
//;
//
////die('<br/>#' . __LINE__);
////
////
////
////$msg2 = '';
////
////if ((!empty($e2['kolvo_new']) && is_numeric($e2['kolvo_new']) && $e2['kolvo_new'] > 0 ) || (!empty($e2['kolvo_edit_dop']) && is_numeric($e2['kolvo_edit_dop']) && $e2['kolvo_edit_dop'] > 0 )) {
////
////    $msg2 .= 'удаляем кеш данных так как были изменения в локальной базе даных' . PHP_EOL;
////}
//
//$msg2 .= PHP_EOL . 'комп время: ' . \f\timer_stop(1) . PHP_EOL;
//
//try {
//
//    if (class_exists('\\Nyos\\Msg')) {
//
//        // echo 'Послали отчёт об операции в телеграм';
//        // $msg = 'Загрузили данные с айки по пользователям ( ' . sizeof($re) . ' записей )';
//        $msg = 'Загрузили данные с айки по пользователям'
////                . PHP_EOL . 'записей ' . ( $e2['kolvo_in'] ?? '-' )
////                . PHP_EOL . 'новых сотрудников  ' . ( $e2['kolvo_new'] ?? '-' )
////                . PHP_EOL . 'изменённых доп параметров ' . ( $e2['kolvo_edit_dop'] ?? '-' )
//                . PHP_EOL . ( $msg2 ?? '' )
//        ;
//
//        \Nyos\Msg::sendTelegramm($msg, null, 2);
//
//        if (file_exists(DR . DS . 'sites' . DS . \Nyos\Nyos::$folder_now . DS . 'config.php'))
//            require_once DR . DS . 'sites' . DS . \Nyos\Nyos::$folder_now . DS . 'config.php';
//
//        if (!empty($vv['info_send_telegram']['admin_ajax_job'])) {
//            foreach ($vv['admin_auerific'] as $k => $v) {
//                \Nyos\Msg::sendTelegramm($msg, $v);
//            }
//        }
//
//        echo '<br/>Послали отчёт об операции в телеграм';
//    } else {
//
//        echo '<br/>НЕ Послали отчёт об операции в телеграм';
//    }
//} catch (\Exception $ex) {
//
//    $text = '<pre>--- ' . __FILE__ . ' ' . __LINE__ . '-------'
//            . PHP_EOL . $ex->getMessage() . ' #' . $ex->getCode()
//            . PHP_EOL . $ex->getFile() . ' #' . $ex->getLine()
//            . PHP_EOL . $ex->getTraceAsString()
//            . '</pre>';
//}
//
//die('<br/>' . __FILE__ . ' ' . __LINE__);
