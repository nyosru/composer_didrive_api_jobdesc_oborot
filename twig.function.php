<?php

/**
  определение функций для TWIG
 */
//creatSecret
//echo __FILE__;
//die();

/**
 * получаем средние значения ожидания с указанной даты по дату в точке продаж
 */
if( isset($twig) ){
    
$function = new Twig_SimpleFunction('api_jobdesc_oborot__get', function ( $site, $module ) {

    $r = \Nyos\api\ImportExport::getLocalDump($site, $module);
    // \f\pa($r);
    return $r;

});
$twig->addFunction($function);

}

//$function = new Twig_SimpleFunction('ApiYadom_time_ex_get_timer_on_sp', function ( $db, string $sp_id, $date_start, $date_fin ) {
//
//    // echo __LINE__;
//    $return = \Nyos\api\JobExpectation::getTimerExpectation(  $db, $sp_id, $date_start, $date_fin );
//
//    return $return;
//});
//$twig->addFunction($function);
