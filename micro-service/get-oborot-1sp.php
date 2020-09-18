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









    $mod_list_time_lastload = 'sale_point_oborot_lastload_list';

//                if( !empty($date_fin) ){
//                    $ar_in_sql[':date_end'] = date( 'Y-m-d 23:59:00', strtotime($date_fin) );
//                }
    //$date = '2019-07-12';
    // $sps = \Nyos\mod\items::getItemsSimple($db, 'sale_point');
    
    $sps = \Nyos\mod\items::get($db, 'sale_point');
    
    \f\pa($sps);
    //\Nyos\mod\items::$sql_items_add_where = ' mi.date != '.date( 'Y-m-d', $_SERVER['REQUEST_TIME'] );

    if (isset($_REQUEST['get_sp_load'])) {
        foreach ($sps as $k => $v) {
            if (isset($v['id']) && $v['id'] == $_REQUEST['get_sp_load'] && isset($v['id_tech_for_oborot'])) {
                $get_sp_d = $v['id_tech_for_oborot'];
                $sp_site_id = $v['id'];
                $sp_site_name = $v['head'];
            }
        }
    }

//    if (isset($_REQUEST['get_sp_load'])) {
//        $timers = \Nyos\mod\items::getItemsSimple($db, $mod_list_time_lastload);
//        //\f\pa($timers);
//        foreach ($timers['data'] as $k => $v) {
//            $time_sp_key = $v['head'];
//            break;
//        }
//    }
//\f\pa($_SERVER);
    //\f\pa($_SERVER['REDIRECT_QUERY_STRING']);

    if (!isset($_REQUEST['hide_form'])) {

        $ll = '
3c93fc45-485a-46cb-9ee6-0399eb27148f
1cacedf6-f411-497b-b44e-18c73b813fd7
6f475233-a2b3-4d64-a173-1bf4831a7fd2
731c2594-a97e-4db2-90ea-1c9ba8402437
693e7f4f-ebc8-410f-b13e-25b54a62216f
365f9152-1d18-4776-a8c9-2ba39ee4f3cc
ce82d80e-8158-4a98-a98d-2ff167d4de6b
723d4eec-900d-43e5-86a5-33bfe7d4944d
9a720aba-478a-4787-8031-33d8f80a544a
5237f417-19b7-4774-9298-356eccf001b0
afe2c3ee-e3e5-4b91-9eef-38b61086ad18
9e3b1014-9285-415b-9a2d-4073c0598cef
1260ef55-f434-4576-aa03-47077a8ca0d0
2bc3b2e7-62f7-4839-991e-4789fc5a43b6
16f98ffb-526e-4562-a7bb-4c3a779b2194
f06da035-02f0-49ae-b16f-51f0a1d01b6f
80d0cc1f-233a-432e-9db7-588e73a97e02
f939f35f-c169-4be9-9933-5af230748ede ТТ1
eba3487f-db68-4084-a752-642ae0e73616
efac5394-ef56-4c43-adeb-6a849e0024d4
08f510f7-660f-4064-b52a-72a0643761bc
5e55c65f-4ef9-4127-acd3-765cc55a2cc0
4c360162-6e12-da32-0145-88f5ce8c0087
3ce15261-b48a-4373-b44e-8dbb62274901
8e5f876b-7b41-45ac-b01b-9311c552bb33
121dbeec-d7fb-4c9c-9966-a2c68e496958
593961aa-fcce-495c-82ea-a597d5cf4dd5
07537f97-f152-490f-9d95-a6a259cab694
2a3280c0-7292-415d-8d1f-c47f8cf7b52b
d12d22b8-753e-4b90-8aeb-d32246ae6057
cc7c9a77-e356-4a2e-b52e-dc88b377e222
48c62350-dc1c-4e3a-929f-de4d7c77c984
01d37b65-2399-4453-a8ad-e133026a397f
3f7ab84e-4477-4186-9d72-e21c08f6e6d8
b71407a7-d94d-423c-9eb7-e2d2a8884fa3
7ea67556-6935-4283-83af-f67e0adba56c
        ';

        $list = explode(PHP_EOL, $ll);
        // \f\pa($list,2);

        echo '<form action="/vendor/didrive_mod/iiko_oborot/1/didrive/ajax.php" method=get >
        <input type="date" name="date" value="" >
        <input type="hidden" name="action" value="get_oborot_for_sps" >
        <Br/>
        <Br/>
        <input type="checkbox" name="show" value="info" > показывать таблицы данных
        <br/>
        <br/>
        <input type="checkbox" name="hide_form" value="da" > скрыть форму
        <br/>
        <br/>
        выберите точку
        <br/>
        <select name="key_iiko_from_sp" >

        <option value="" >выбирете</option>
                ';
//            <option value="f939f35f-c169-4be9-9933-5af230748ede" >ТТ1</option>
//            <option >1260ef55-f434-4576-aa03-47077a8ca0d0</option>
//            <option >16f98ffb-526e-4562-a7bb-4c3a779b2194</option>
//            <option >01d37b65-2399-4453-a8ad-e133026a397f</option>
//            <option >f939f35f-c169-4be9-9933-5af230748ede</option>
//            <option >08f510f7-660f-4064-b52a-72a0643761bc</option>
//            <option >121dbeec-d7fb-4c9c-9966-a2c68e496958</option>
//            <option >d12d22b8-753e-4b90-8aeb-d32246ae6057</option>
//            <option >80d0cc1f-233a-432e-9db7-588e73a97e02</option>

        foreach ($sps as $k => $v) {
            if (!empty($v['id_tech_for_oborot']))
                echo '<option value="' . $v['id_tech_for_oborot'] . '" >' . $v['head'] . '</option>';
        }


        echo '
        </select>
        <br/>
        <br/>
        или выбериту тут
        <br/>
        <select name="sp_key_iiko" >
<option value="" >выбирете</option>';
//            <option value="f939f35f-c169-4be9-9933-5af230748ede" >ТТ1</option>
//            <option >1260ef55-f434-4576-aa03-47077a8ca0d0</option>
//            <option >16f98ffb-526e-4562-a7bb-4c3a779b2194</option>
//            <option >01d37b65-2399-4453-a8ad-e133026a397f</option>
//            <option >f939f35f-c169-4be9-9933-5af230748ede</option>
//            <option >08f510f7-660f-4064-b52a-72a0643761bc</option>
//            <option >121dbeec-d7fb-4c9c-9966-a2c68e496958</option>
//            <option >d12d22b8-753e-4b90-8aeb-d32246ae6057</option>
//            <option >80d0cc1f-233a-432e-9db7-588e73a97e02</option>

        foreach ($list as $k => $v) {
            if (isset($v{5})) {
                $l2 = explode(' ', $v);

                if (isset($l2[1])) {
                    echo '<option value="' . $l2[0] . '" >' . $l2[1] . '</option>';
                } else {
                    echo '<option>' . $l2[0] . '</option>';
                }
            }
        }


        echo '
        </select>
        <br/>
        <br/>
        <input type=submit value="отправить" >
        </form>';
    }

    if (isset($_REQUEST['show']))
        \f\pa($_REQUEST);

    if (empty($_REQUEST['date']))
        die('укажите дату');

    $date = date('Y-m-d', strtotime($_REQUEST['date']));

    $sp_id = $get_sp_d ?? $time_sp_key ?? $_REQUEST['key_iiko_from_sp'] ?? $_REQUEST['sp_key_iiko'] ?? false;

    // \f\pa($sp_id);
    // echo '<br/>'.__FILE__.' '.__LINE__;

    if ($sp_id !== false) {

        \Nyos\mod\IikoOborot::$show_html = false;

        try {

            $ret = \Nyos\mod\IikoOborot::loadOborotFromServer($sp_id, $date);
        } catch (\Exception $ex) {
            // echo $exc->getTraceAsString();
            $ret = [];
        }
        // \f\pa($ret);
//        \f\pa($sp_id);
        // echo '<br/>' . __FILE__ . ' ' . __LINE__;

        if (!empty($date) && !empty($sp_site_id)) {

            \Nyos\mod\items::deleteFromDops($db, \Nyos\mod\JobDesc::$mod_oborots, [
                'date' => $date,
                'sale_point' => $sp_site_id
            ]);

            // \Nyos\mod\items::addNewSimple($db, 'sale_point_oborot', array(
            \Nyos\mod\items::addNewSimple($db, \Nyos\mod\JobDesc::$mod_oborots, array(
                'date' => $date,
                'sale_point' => $sp_site_id,
                //'sale_point' => $sp_id,
                'oborot_server' => ( $ret['data']['oborot'] ?? 0 )
            ));
        }

        /**
         * пишем дату крайней загрузки
         */
//        $ff = $db->prepare('DELETE FROM mitems WHERE module = :id AND head = :sp ');
//        $ff->execute(array(
//            ':id' => $mod_list_time_lastload,
//            ':sp' => $sp_id
//        ));
//        \Nyos\mod\items::addNewSimple($db, $mod_list_time_lastload, array('head' => $sp_id));



        if (1 == 1 && class_exists('\Nyos\Msg')) {

            if (!isset($vv['admin_ajax_job'])) {
                require_once DR . '/sites/' . \Nyos\nyos::$folder_now . '/config.php';
            }

            $e = 'Подгружаем данные по обороту ' . (!empty($sp_site_name) ? '(' . $sp_site_name . ')' : '' ) . ' за день ' . date('y-m-d', strtotime($date))
                    . PHP_EOL
                    . ' плюс: ' . ( $ret['data']['plus'] ?? 'x' ) . ' ' . ( $ret['data']['minus'] ?? 'x' ) . ' = ' . ( $ret['data']['oborot'] ?? 'x' )
            // . sizeof($in3);
            ;


            if (!isset($_REQUEST['no_send_msg'])) {

                \nyos\Msg::sendTelegramm($e, null, 1);
                //\f\pa($vv['admin_ajax_job']);


                if (isset($vv['admin_ajax_job'])) {
                    foreach ($vv['admin_ajax_job'] as $k => $v) {
                        //\nyos\Msg::sendTelegramm($e, $v);
                        \nyos\Msg::sendTelegramm($e, $v);
                    }
                }
            }
        }

        die(\f\end2('оборот ' . ( $ret['data']['oborot'] ?? '-' ) . ' р', true, $ret));
    } else {
        //echo '<br/>' . __FILE__ . ' ' . __LINE__;
        die(\f\end2('не определена точка', false));
    }
    //echo '<br/>' . __FILE__ . ' ' . __LINE__;
    die(\f\end2('упс #' . __LINE__, false));







    $dops = array(
        \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
        \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC,
//                \PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES UTF8'
    );

    $db7 = new \PDO(
            \Nyos\api\Iiko::$db_type
            . ':dbname=' . ( isset(\Nyos\api\Iiko::$db_base{1}) ? \Nyos\api\Iiko::$db_base : '' )
            . ';host=' . ( isset(\Nyos\api\Iiko::$db_host{1}) ? \Nyos\api\Iiko::$db_host : '' )
            . ( isset(\Nyos\api\Iiko::$db_port{1}) ? ';port=' . \Nyos\api\Iiko::$db_port : '' )
            , ( isset(\Nyos\api\Iiko::$db_login{1}) ? \Nyos\api\Iiko::$db_login : '')
            , ( isset(\Nyos\api\Iiko::$db_pass{1}) ? \Nyos\api\Iiko::$db_pass : '')
            , $dops
    );




    $sql = // 'set @date1=\''.date('Y-m-d 00:00:00', strtotime('2019-07-11') ).'\' '.
//        '
//        declare @TIME1 as datetime
//        declare @TIME2 as datetime
//        SET @TIME1 = \''.date('Y-m-d 00:00:00', strtotime('2019-07-11') ).'\'
//        SET @TIME2 = \''.date('Y-m-d 23:59:00', strtotime('2019-07-11') ).'\'
//        '
            // . 'set @date2=\''.date('d.m.Y 23:00:00', strtotime('2019-07-11') ).'\' '
//            . 
            'SELECT '
            . ' dbo.OrderPaymentEvent.date '
            . ' , '
            . ' dbo.OrderPaymentEvent.prechequeTime , '
            . ' dbo.OrderPaymentEvent.orderSum, '
            . ' dbo.OrderPaymentEvent.sumCard, '
            . ' dbo.OrderPaymentEvent.sumCash , '
            . ' dbo.OrderPaymentEvent.unmodifiable , '
            . ' dbo.OrderPaymentEvent.changeSum , '
            . ' dbo.OrderPaymentEvent.receiptsSum , '
            . ' dbo.OrderPaymentEvent.problemOpName '
            . ' , '
            . ' dbo.OrderPaymentEvent.orderNum '
            . ' , '
            . ' dbo.OrderPaymentEvent.revision '
            . ' , '
            . ' dbo.OrderPaymentEvent.department '
            . ' , '
            . ' dbo.OrderPaymentEvent.auth_card_slip '
            . ' , '
            . ' dbo.OrderPaymentEvent.auth_user '
            . ' , '
            . ' dbo.OrderPaymentEvent.closeTime '
//            . ' , '
//            . ' dbo.OrderPaymentEvent.discount '
//            . ' , '
//            . ' dbo.OrderPaymentEvent.increase '
            . ' , '
            . ' dbo.OrderPaymentEvent.isBanquet '
            . ' , '
            . ' dbo.OrderPaymentEvent.numGuests '
            . ' , '
            . ' dbo.OrderPaymentEvent.openTime '
            . ' , '
            . ' dbo.OrderPaymentEvent.[order] '
            . ' , '
            . ' dbo.OrderPaymentEvent.orderNum '
            . ' , '
            . ' dbo.OrderPaymentEvent.orderSum '
            . ' , '
            . ' dbo.OrderPaymentEvent.orderSumAfterDiscount '
//            . ' , '
//            . ' dbo.OrderPaymentEvent.prechequeTime '
            . ' , '
            . ' dbo.OrderPaymentEvent.priceCategory '
            . ' , '
            . ' dbo.OrderPaymentEvent.problemOpName '
            . ' , '
            . ' dbo.OrderPaymentEvent.problemPriority '
            . ' , '
            . ' dbo.OrderPaymentEvent.problemType '
            . ' , '
            . ' dbo.OrderPaymentEvent.receiptsSum '
            . ' , '
            . ' dbo.OrderPaymentEvent.restaurantSection '
            . ' , '
            . ' dbo.OrderPaymentEvent.session_group '
            . ' , '
            . ' dbo.OrderPaymentEvent.session_id '
            . ' , '
            . ' dbo.OrderPaymentEvent.session_number '
            . ' , '
            . ' dbo.OrderPaymentEvent.storned '
            . ' , '
            . ' dbo.OrderPaymentEvent.tableNum '
            . ' , '
            . ' dbo.OrderPaymentEvent.[user] '
            . ' , '
            . ' dbo.OrderPaymentEvent.waiter '
            . ' , '
            . ' dbo.OrderPaymentEvent.cashRegister '
            . ' , '
            . ' dbo.OrderPaymentEvent.cashier '
            . ' , '
            . ' dbo.OrderPaymentEvent.changeSum '
            . ' , '
            . ' dbo.OrderPaymentEvent.counteragent '
            . ' , '
            . ' dbo.OrderPaymentEvent.detailedCheque '
            . ' , '
            . ' dbo.OrderPaymentEvent.divisions '
            . ' , '
            . ' dbo.OrderPaymentEvent.fiscalChequeNumber '
            . ' , '
            . ' dbo.OrderPaymentEvent.isDelivery '
            . ' , '
            . ' dbo.OrderPaymentEvent.nonCashPaymentType '
            . ' , '
            . ' dbo.OrderPaymentEvent.orderType '
            . ' , '
            . ' dbo.OrderPaymentEvent.pcCard '
            . ' , '
            . ' dbo.OrderPaymentEvent.pcDiscountCard '
            . ' , '
            . ' dbo.OrderPaymentEvent.pcUser '
            . ' , '
            . ' dbo.OrderPaymentEvent.sumCard '
            . ' , '
            . ' dbo.OrderPaymentEvent.sumCash '
            . ' , '
            . ' dbo.OrderPaymentEvent.sumCredit '
            . ' , '
            . ' dbo.OrderPaymentEvent.sumPlanned '
            . ' , '
            . ' dbo.OrderPaymentEvent.sumPrepay '
            . ' , '
            . ' dbo.OrderPaymentEvent.unmodifiable '
            . ' , '
            . ' dbo.OrderPaymentEvent.writeoffPaymentType '
            . ' , '
            . ' dbo.OrderPaymentEvent.writeoffRatio '
            . ' , '
            . ' dbo.OrderPaymentEvent.writeoffReason '
            . ' , '
            . ' dbo.OrderPaymentEvent.writeoffUser '
            . ' , '
            . ' dbo.OrderPaymentEvent.orderDeleted '
            . ' , '
            . ' dbo.OrderPaymentEvent.originName '
            . ' , '
            . ' dbo.OrderPaymentEvent.vatInvoiceId '







            // . ' dbo.OrderPaymentEvent.orderDeleted , ' 
            // . ' dbo.OrderPaymentEvent.session_number , ' 
            // . ' dbo.OrderPaymentEvent.restaurantSection , ' 
            // . ' dbo.OrderPaymentEvent.tableNum ' 
            // ' dbo.EmployeeAttendanceEntry.employee \'user\', '.
//            . ' dbo.EmployeeAttendanceEntry.personalSessionStart \'start\',
//                    dbo.EmployeeAttendanceEntry.personalSessionEnd \'end\'
//                    '
            . '
                FROM 
                    dbo.OrderPaymentEvent
                WHERE 
                '
            .
            ' restaurantSection = \'' . ( $_REQUEST['key_iiko_from_sp'] ?? $_REQUEST['sp_key_iiko'] ?? 'f939f35f-c169-4be9-9933-5af230748ede' ) . '\' '
            // . ' AND date > \'' . date('Y-m-d 00:00:00', strtotime($date)) . '\' '
            . ' AND date = \'' . date('Y-m-d', strtotime($date)) . '\' '
//            . '
//                    AND prechequeTime > \'' . date('Y-m-d 05:00:00', strtotime($date)) . '\'
//                    AND prechequeTime < \'' . date('Y-m-d 05:00:00', strtotime($date) + 3600 * 24) . '\'
//                    '
//            .'
//                    AND prechequeTime > @TIME1  
//                    '
//            .'
//                    AND prechequeTime between @TIME1 and @TIME2 
//                    '
//            .'
//                    AND prechequeTime >= @TIME1
//                    '
//            .'
//                    AND prechequeTime <= :date2 
//                    '
            // . (!empty($date_fin) ? ' AND personalSessionStart <= :date_end ' : '' )
            // .' LIMIT 0,10 '
            . ' ORDER BY prechequeTime ASC '
    ;

    if (isset($_REQUEST['show']))
        echo '<pre>' . $sql . '</pre>';

    $ff = $db7->prepare($sql);

//    $ar_in_sql = array(
//        // ':id_user' => 'f34d6d84-5ecb-4a40-9b03-71d03cb730cb',
//        // ':id_user' => $id_user_iiko,
//        ':date1' => date('d.m.Y 00:00:00', strtotime('2019-07-11') ),
//        ':date2' => date('d.m.Y 23:59:00', strtotime('2019-07-11') ),
//        //':date3' => date('d.m.Y', strtotime('2019-07-11') ),
//        //':sp_iiko_id' => 'f939f35f-c169-4be9-9933-5af230748ede'
//    );
//\f\pa($ar_in_sql);
    //$ff->execute($ar_in_sql);
    $ff->execute();
    //$e3 = $ff->fetchAll();
//            $e3 = [];

    if (isset($_REQUEST['show']))
        echo '<table cellpadding=10 border=1 >'; // <tr><td>1</td><td>2</td></tr>';


    $sum = 0;

    $n = 1;

    while ($e = $ff->fetch()) {

        if (isset($_REQUEST['show'])) {
            if ($n == 1) {
                echo '<tr>';

                foreach ($e as $k => $v) {
                    echo '<td>' . $k . '</td>';
                }

                echo '</tr>';
            }
        }
        $n++;

        //if( $e['orderSum'] == 543 ){
        if ($n == 2) {
            $ar2 = $e;
        }

        if (isset($_REQUEST['show']))
            echo '<tr>';

        foreach ($e as $k => $v) {

            if (isset($_REQUEST['show']))
                echo '<td>' . iconv('windows-1251', 'utf-8', $v) . '</td>';

            if ($k == 'sumCard' || $k == 'sumCash')
                $sum += $v;
        }

        if (isset($_REQUEST['show']))
            echo '</tr>';

        //$e['user'] = mb_convert_encoding($e['user'],'UTF-8','auto');
        //$e['user'] = utf8_decode($e['user']);
//                $e['user'] = utf8_encode($e['user']);
//                echo '<br/>'.mb_detect_order($e['user']);
        //$e['user'] = iconv('UCS-2LE','UTF-8',substr(base64_decode($e['user']),0,-1));
        //$e['user'] = html_entity_decode($e['user'], ENT_COMPAT | ENT_HTML401, 'UTF-8');
//                $e3[] = $e;
    }
//    \f\pa($e3);

    if (isset($_REQUEST['show'])) {
        echo '</table>';

        echo '<p>Сумма ' . $sum . '</p>';

        \f\pa($ar2, 2, '', '$ar2');
    }

    $sql = // 'set @date1=\''.date('Y-m-d 00:00:00', strtotime('2019-07-11') ).'\' '.
//        '
//        declare @TIME1 as datetime
//        declare @TIME2 as datetime
//        SET @TIME1 = \''.date('Y-m-d 00:00:00', strtotime('2019-07-11') ).'\'
//        SET @TIME2 = \''.date('Y-m-d 23:59:00', strtotime('2019-07-11') ).'\'
//        '
            // . 'set @date2=\''.date('d.m.Y 23:00:00', strtotime('2019-07-11') ).'\' '
//            . 
            'SELECT '
//            . '  id '
//            . ' , '
//            . ' lastModifyNode '
//            . ' , '
            . ' date '
            . ' , '
            . ' num '
            . ' , '
            . ' sum '
            . ' , '
            . ' type '
//            . ' , '
//            . ' revision '
//            . ' , '
//            
//            . ' department '
//            
//            . ' , '
//            . ' cashFlowCategory '
//            . ' , '
//            . ' cashOrderNumber '
//            . ' , '
//            . ' comment '
////            . ' , '
////            . ' conception '
//            . ' , '
//            . ' created '
//            . ' , '
//            . ' userCreated '
//            . ' , '
//            . ' documentId '
//            . ' , '
//            . ' documentItemId '
//            . ' , '
//            . ' from_amount '
//            . ' , '
//            . ' from_account '
//            . ' , '
//            . ' from_counteragent '
//            . ' , '
//            . ' from_product '
//            . ' , '
//            . ' modified '
//            . ' , '
//            . ' userModified '
//            . ' , '
////            . ' session_id '
////            . ' , '
//            . ' to_amount '
//            . ' , '
//            . ' to_account '
//            . ' , '
//            . ' to_counteragent '
//            . ' , '
//            . ' to_product '
//            . ' , '
//            . ' auth_card_slip '
//            . ' , '
//            . ' auth_user '
//            . ' , '
//            . ' cashier '
//            . ' , '
//            . ' causeEvent_id '
//            . ' , '
//            . ' penaltyOrBonusType '
//            . ' , '
//            . ' chequeNumber '
//            . ' , '
//            . ' isFiscal '
//            . ' , '
//            . ' orderId '
//            . ' , '
//            . ' paymentType '
//            . ' , '
//            . ' approvalCode '
//            . ' , '
//            . ' cardNumber '
//            . ' , '
//            . ' cardOwnerCompany '
//            . ' , '
//            . ' cardTypeName '
//            . ' , '
//            . ' nominal '
//            . ' , '
//            . ' vouchersNum '
//            . ' , '
//            . ' salesSum '
//            . ' , '
//            . ' program '
//            . ' , '
//            . ' revenueLevel '
//            . ' , '
//            . ' ndsPercent '
//            . ' , '
//            . ' sumNds '
//            . ' , '
//            . ' attendanceEntry_id '
//            . ' , '
//            . ' scheduleItem_id '
//            . ' , '
//            . ' writeoff_id '
//            . ' , '
//            . ' inventoryEvent_id '
//            . ' , '
//            . ' originDepartment '
//            . ' , '
//            . ' currency '
//            . ' , '
//            . ' currencyRate '
//            . ' , '
//            . ' sumInCurrency '
//            . ' , '
//            . ' to_productSize '
            . '
                FROM 
                    dbo.AccountingTransaction
                WHERE '
            . ' date = \'' . $ar2['date'] . '\' '
            . ' AND num = \'' . $ar2['session_number'] . '\' '

//            . ' AND sum < 0 '
//            . ' AND ( type = \'CARD\' OR type = \'CASH\' ) '
//            . 'created > \'' . date('Y-m-d 08:00:00', strtotime($date)) . '\'
//                AND created < \'' . date('Y-m-d 05:00:00', strtotime($date)+3600*24 ) . '\' '
    // .' AND created < \'' . date('Y-m-d 12:00:00', strtotime($date) + 3600 * 24) . '\' '
    ;

    if (isset($_REQUEST['show']))
        echo '<pre>' . $sql . '</pre>';

    $ff = $db7->prepare($sql);

//    $ar_in_sql = array(
//        // ':id_user' => 'f34d6d84-5ecb-4a40-9b03-71d03cb730cb',
//        // ':id_user' => $id_user_iiko,
//        ':date1' => date('d.m.Y 00:00:00', strtotime('2019-07-11') ),
//        ':date2' => date('d.m.Y 23:59:00', strtotime('2019-07-11') ),
//        //':date3' => date('d.m.Y', strtotime('2019-07-11') ),
//        //':sp_iiko_id' => 'f939f35f-c169-4be9-9933-5af230748ede'
//    );
//\f\pa($ar_in_sql);
    //$ff->execute($ar_in_sql);
    $ff->execute();
    //$e3 = $ff->fetchAll();
//            $e3 = [];

    if (isset($_REQUEST['show']))
        echo '<table cellpadding=10 border=1 >'; // <tr><td>1</td><td>2</td></tr>';


    $sum2 = 0;

    $n = 1;

    while ($e = $ff->fetch()) {

        if (isset($_REQUEST['show'])) {
            if ($n == 1) {
                echo '<tr>';

                foreach ($e as $k => $v) {
                    echo '<td>' . $k . '</td>';
                }

                echo '</tr>';
            }
        }
        $n++;

        // if ($e['sum'] == 1173 || 1 == 1 ) {
        //if ($e['num'] == 866 ) {
        // if ($e['num'] == $ar2['session_number'] ) {
        if (1 == 1) {

            if (isset($_REQUEST['show'])) {

                echo '<tr>';

                foreach ($e as $k => $v) {

                    // 1173
                    if (isset($v{2})) {
                        echo '<td>';
//                    echo '<nobr>' ;
//                    foreach($ar2 as $kk => $vv ){
//                        if( $vv != 0 &&  $vv == $v ){
//                            echo $kk.' ['.$vv.']++<br/>';
//                        }
//                    }
//                    echo '</nobr>' ;
//                    echo '<br/><br/>' ;
                        //echo '//'.iconv('windows-1251', 'utf-8', $v) . '//</td>';
                        echo iconv('windows-1251', 'utf-8', $v) . '</td>';
                    } else {
                        echo '<td>';
//                    echo '<nobr>' ;
//                    foreach($ar2 as $kk => $vv ){
//                        if( $vv != 0 && $vv == $v ){
//                            echo $kk.' ['.$vv.']++<br/>';
//                        }
//                    }
//                    echo '</nobr>' ;
//                    echo '<br/><br/>' ;
                        //echo '//'.$v . '//</td>';
                        echo $v . '</td>';
                    }
                }
                echo '</tr>';
            }
        }

        if ($e['sum'] < 0) {

            //if ( isset( $e['sum'] )  && $e['sum'] < 0 && isset( $e['type'] )  && ( $e['type'] == 'CASH' || $e['type'] == 'CARD' ) )
            if (isset($e['type']) && ( trim($e['type']) == 'CASH' || trim($e['type']) == 'CARD' )) {

                if (isset($_REQUEST['show']))
                    \f\pa($e);

                $sum2 += $e['sum'];
            }
        }

        //$e['user'] = mb_convert_encoding($e['user'],'UTF-8','auto');
        //$e['user'] = utf8_decode($e['user']);
//                $e['user'] = utf8_encode($e['user']);
//                echo '<br/>'.mb_detect_order($e['user']);
        //$e['user'] = iconv('UCS-2LE','UTF-8',substr(base64_decode($e['user']),0,-1));
        //$e['user'] = html_entity_decode($e['user'], ENT_COMPAT | ENT_HTML401, 'UTF-8');
//                $e3[] = $e;
//        if ( $e['sum'] < 0 && ( $e['type'] == 'CASH' || $e['type'] == 'CARD' ) )
//            $sum2 += $e['sum'];
    }
//    \f\pa($e3);








    echo __FILE__ . ' [' . __LINE__ . ']';

    if (1 == 1 && class_exists('\Nyos\Msg')) {

        if (!isset($vv['admin_auerific'])) {
            require_once DR . '/sites/' . \Nyos\nyos::$folder_now . '/config.php';
        }

        $e = 'Подгружаем данные по обороту за день ' . date('y-m-d', strtotime($ar2['date'])) . ' ' . PHP_EOL
                . ' oborot: ' . (int) ( $sum + $sum2 )
                . PHP_EOL
                . ' из них ' . PHP_EOL
                . ' плюс: ' . (int) $sum . PHP_EOL
                . 'минус: ' . (int) $sum2 . PHP_EOL
                . ' ) '  // . sizeof($in3);
        ;

//            foreach ($in3 as $k => $v) {
//                $e .= PHP_EOL . $v['date'] . ' - ' . $v['sp'] . ' - ' . $v['otdel'] . ' - ' . $v['minut'];
//            }

        \nyos\Msg::sendTelegramm($e, null, 1);

        if (isset($vv['admin_auerific'])) {
            foreach ($vv['admin_auerific'] as $k => $v) {
                \nyos\Msg::sendTelegramm($e, $v);
                //\Nyos\NyosMsg::sendTelegramm('Вход в управление ' . PHP_EOL . PHP_EOL . $e, $k );
            }
        }
    }

    if (isset($_REQUEST['show']))
        echo '</table>';

    if (isset($_REQUEST['show'])) {

        echo '<p>Сумма- : ' . (int) $sum2 . '</p>';
        echo '<p>Итого- : ' . (int) ( $sum + $sum2 ) . '</p>';
        exit;
    } else {
        die(\f\end2('получили данные по обороту точки', true, array(
            'oborot' => (int) ( $sum + $sum2 ),
            'plus' => (int) $sum,
            'minus' => (int) $sum2
        )));
    }

















    \f\end2('удалено', true);

    //\f\end2($res['html'], true);
} catch (Exception $exc) {

    echo '<pre>';
    print_r($exc);
    echo '</pre>';
    // echo $exc->getTraceAsString();

    f\end2($exc->getMessage(), false, $exc);
}