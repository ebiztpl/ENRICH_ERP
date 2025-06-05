

<?php

$moduleName = __('root.settings.system');
$createItemName = 'Update ' . $moduleName;

$breadcrumbMainName = $moduleName;
$breadcrumbCurrentName = ' Update';

$breadcrumbMainIcon = 'fas fa-project-diagram';
$breadcrumbCurrentIcon = 'archive';

$ModelName = 'App\Setting';
$ParentRouteName = 'settings.system';

?>

<?php $__env->startSection('title'); ?>
    <?php echo e($moduleName); ?>-><?php echo e($createItemName); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('top-bar'); ?>
    <?php echo $__env->make('includes.top-bar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('left-sidebar'); ?>
    <?php echo $__env->make('includes.left-sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <section <?php if($is_rtl): ?> dir="rtl" <?php endif; ?> class="content">
        <div class="container-fluid">
            <ol class="breadcrumb breadcrumb-col-cyan <?php if($is_rtl): ?> pull-left  <?php else: ?> pull-right <?php endif; ?>">
                <li><a href="<?php echo e(route('dashboard')); ?>"><i class="material-icons">home</i> <?php echo e(__('root.common.home')); ?></a></li>
                <li><a href="<?php echo e(route($ParentRouteName)); ?>"> <i
                            class="material-icons">settings</i>&nbsp; <?php echo e($breadcrumbMainName); ?></a>
                </li>
                <li class="active"><i class="material-icons"><?php echo e($breadcrumbCurrentIcon); ?></i>&nbsp; <?php echo e($breadcrumbCurrentName); ?>

                </li>
            </ol>
            <!-- Inline Layout | With Floating Label -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                <?php echo e($createItemName); ?>

                            </h2>
                            <br>
                            <div class="body">
                                <form class="form" id="form_validation" method="post"
                                    action="<?php echo e(route($ParentRouteName . '.update')); ?>">
                                    <?php echo e(csrf_field()); ?>

                                    <div class="row clearfix">
                                        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-4">
                                            <p>Date Format</p>
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <select data-live-search="true" class="form-control show-tick"
                                                        name="date_format" id="">
                                                        <option <?php if($settings['date_format'] == 'd-m-Y'): ?> selected="" <?php endif; ?>
                                                            value="d-m-Y">dd-mm-YYYY (05-12-2019)
                                                        </option>
                                                        <option <?php if($settings['date_format'] == 'm-d-Y'): ?> selected="" <?php endif; ?>
                                                            value="m-d-Y">mm-dd-YYYY (12-05-2019)
                                                        </option>
                                                        <option <?php if($settings['date_format'] == 'd-M-Y'): ?> selected="" <?php endif; ?>
                                                            value="d-M-Y">dd-MM-YYYY (05-Dec-2019)
                                                        </option>
                                                        <option <?php if($settings['date_format'] == 'M-d-Y'): ?> selected="" <?php endif; ?>
                                                            value="M-d-Y">MM-dd-YYYY (Dec-05-2019)
                                                        </option>
                                                        <option <?php if($settings['date_format'] == 'M d, Y'): ?> selected="" <?php endif; ?>
                                                            value="M d, Y">MM dd, YYYY (Dec 05, 2019)
                                                        </option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-4">
                                            <p>Timezone</p>
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <select data-live-search="true" class="form-control show-tick"
                                                        name="timezone" id="">
                                                        <option <?php if($settings['timezone'] == 'Pacific/Midway'): ?> selected="" <?php endif; ?>
                                                            value="Pacific/Midway">(GMT-11:00) Midway Island
                                                        </option>
                                                        <option <?php if($settings['timezone'] == 'US/Samoa'): ?> selected="" <?php endif; ?>
                                                            value="US/Samoa">(GMT-11:00) Samoa
                                                        </option>
                                                        <option <?php if($settings['timezone'] == 'US/Hawaii'): ?> selected="" <?php endif; ?>
                                                            value="US/Hawaii">(GMT-10:00) Hawaii
                                                        </option>
                                                        <option <?php if($settings['timezone'] == 'US/Alaska'): ?> selected="" <?php endif; ?>
                                                            value="US/Alaska">(GMT-09:00) Alaska
                                                        </option>
                                                        <option <?php if($settings['timezone'] == 'US/Pacific'): ?> selected="" <?php endif; ?>
                                                            value="US/Pacific">(GMT-08:00) Pacific Time (US
                                                            &amp;
                                                            Canada)
                                                        </option>
                                                        <option <?php if($settings['timezone'] == 'America/Tijuana'): ?> selected="" <?php endif; ?>
                                                            value="America/Tijuana">(GMT-08:00) Tijuana
                                                        </option>
                                                        <option <?php if($settings['timezone'] == 'US/Arizona'): ?> selected="" <?php endif; ?>
                                                            value="US/Arizona">(GMT-07:00) Arizona
                                                        </option>
                                                        <option <?php if($settings['timezone'] == 'US/Mountain'): ?> selected="" <?php endif; ?>
                                                            value="US/Mountain">(GMT-07:00) Mountain Time (US
                                                            &amp;
                                                            Canada)
                                                        </option>
                                                        <option <?php if($settings['timezone'] == 'America/Chihuahua'): ?> selected="" <?php endif; ?>
                                                            value="America/Chihuahua">(GMT-07:00) Chihuahua
                                                        </option>
                                                        <option <?php if($settings['timezone'] == 'America/Mazatlan'): ?> selected="" <?php endif; ?>
                                                            value="America/Mazatlan">(GMT-07:00) Mazatlan
                                                        </option>
                                                        <option <?php if($settings['timezone'] == 'America/Mexico_City'): ?> selected="" <?php endif; ?>
                                                            value="America/Mexico_City">(GMT-06:00) Mexico
                                                            City
                                                        </option>
                                                        <option <?php if($settings['timezone'] == 'America/Monterrey'): ?> selected="" <?php endif; ?>
                                                            value="America/Monterrey">(GMT-06:00) Monterrey
                                                        </option>
                                                        <option <?php if($settings['timezone'] == 'Canada/Saskatchewan'): ?> selected="" <?php endif; ?>
                                                            value="Canada/Saskatchewan">(GMT-06:00)
                                                            Saskatchewan
                                                        </option>
                                                        <option <?php if($settings['timezone'] == 'US/Central'): ?> selected="" <?php endif; ?>
                                                            value="US/Central">(GMT-06:00) Central Time (US
                                                            &amp;
                                                            Canada)
                                                        </option>
                                                        <option <?php if($settings['timezone'] == 'US/Eastern'): ?> selected="" <?php endif; ?>
                                                            value="US/Eastern">(GMT-05:00) Eastern Time (US
                                                            &amp;
                                                            Canada)
                                                        </option>
                                                        <option <?php if($settings['timezone'] == 'US/East-Indiana'): ?> selected="" <?php endif; ?>
                                                            value="US/East-Indiana">(GMT-05:00) Indiana
                                                            (East)
                                                        </option>
                                                        <option <?php if($settings['timezone'] == 'America/Bogota'): ?> selected="" <?php endif; ?>
                                                            value="America/Bogota">(GMT-05:00) Bogota
                                                        </option>
                                                        <option <?php if($settings['timezone'] == 'America/Lima'): ?> selected="" <?php endif; ?>
                                                            value="America/Lima">(GMT-05:00) Lima
                                                        </option>
                                                        <option <?php if($settings['timezone'] == 'America/Caracas'): ?> selected="" <?php endif; ?>
                                                            value="America/Caracas">(GMT-04:30) Caracas
                                                        </option>
                                                        <option <?php if($settings['timezone'] == 'Canada/Atlantic'): ?> selected="" <?php endif; ?>
                                                            value="Canada/Atlantic">(GMT-04:00) Atlantic Time
                                                            (Canada)
                                                        </option>
                                                        <option <?php if($settings['timezone'] == 'America/La_Paz'): ?> selected="" <?php endif; ?>
                                                            value="America/La_Paz">(GMT-04:00) La Paz
                                                        </option>
                                                        <option <?php if($settings['timezone'] == 'America/Santiago'): ?> selected="" <?php endif; ?>
                                                            value="America/Santiago">(GMT-04:00) Santiago
                                                        </option>
                                                        <option <?php if($settings['timezone'] == 'Canada/Newfoundland'): ?> selected="" <?php endif; ?>
                                                            value="Canada/Newfoundland">(GMT-03:30)
                                                            Newfoundland
                                                        </option>
                                                        <option <?php if($settings['timezone'] == 'America/Buenos_Aires'): ?> selected="" <?php endif; ?>
                                                            value="America/Buenos_Aires">(GMT-03:00) Buenos
                                                            Aires
                                                        </option>
                                                        <option <?php if($settings['timezone'] == 'Greenland'): ?> selected="" <?php endif; ?>
                                                            value="Greenland">(GMT-03:00) Greenland
                                                        </option>
                                                        <option <?php if($settings['timezone'] == 'Atlantic/Stanley'): ?> selected="" <?php endif; ?>
                                                            value="Atlantic/Stanley">(GMT-02:00) Stanley
                                                        </option>
                                                        <option <?php if($settings['timezone'] == 'Atlantic/Azores'): ?> selected="" <?php endif; ?>
                                                            value="Atlantic/Azores">(GMT-01:00) Azores
                                                        </option>
                                                        <option <?php if($settings['timezone'] == 'Atlantic/Cape_Verde'): ?> selected="" <?php endif; ?>
                                                            value="Atlantic/Cape_Verde">(GMT-01:00) Cape
                                                            Verde Is.
                                                        </option>
                                                        <option <?php if($settings['timezone'] == 'Africa/Casablanca'): ?> selected="" <?php endif; ?>
                                                            value="Africa/Casablanca">(GMT) Casablanca
                                                        </option>
                                                        <option <?php if($settings['timezone'] == 'Europe/Dublin'): ?> selected="" <?php endif; ?>
                                                            value="Europe/Dublin">(GMT) Dublin
                                                        </option>
                                                        <option <?php if($settings['timezone'] == 'Europe/Lisbon'): ?> selected="" <?php endif; ?>
                                                            value="Europe/Lisbon">(GMT) Lisbon
                                                        </option>
                                                        <option <?php if($settings['timezone'] == 'Europe/London'): ?> selected="" <?php endif; ?>
                                                            value="Europe/London">(GMT) London
                                                        </option>
                                                        <option <?php if($settings['timezone'] == 'Africa/Monrovia'): ?> selected="" <?php endif; ?>
                                                            value="Africa/Monrovia">(GMT) Monrovia
                                                        </option>
                                                        <option <?php if($settings['timezone'] == 'Europe/Amsterdam'): ?> selected="" <?php endif; ?>
                                                            value="Europe/Amsterdam">(GMT+01:00) Amsterdam
                                                        </option>
                                                        <option <?php if($settings['timezone'] == 'Europe/Belgrade'): ?> selected="" <?php endif; ?>
                                                            value="Europe/Belgrade">(GMT+01:00) Belgrade
                                                        </option>
                                                        <option <?php if($settings['timezone'] == 'Europe/Berlin'): ?> selected="" <?php endif; ?>
                                                            value="Europe/Berlin">(GMT+01:00) Berlin
                                                        </option>
                                                        <option <?php if($settings['timezone'] == 'Europe/Bratislava'): ?> selected="" <?php endif; ?>
                                                            value="Europe/Bratislava">(GMT+01:00) Bratislava
                                                        </option>
                                                        <option <?php if($settings['timezone'] == 'Europe/Brussels'): ?> selected="" <?php endif; ?>
                                                            value="Europe/Brussels">(GMT+01:00) Brussels
                                                        </option>
                                                        <option <?php if($settings['timezone'] == 'Europe/Budapest'): ?> selected="" <?php endif; ?>
                                                            value="Europe/Budapest">(GMT+01:00) Budapest
                                                        </option>
                                                        <option <?php if($settings['timezone'] == 'Europe/Copenhagen'): ?> selected="" <?php endif; ?>
                                                            value="Europe/Copenhagen">(GMT+01:00) Copenhagen
                                                        </option>
                                                        <option <?php if($settings['timezone'] == 'Europe/Ljubljana'): ?> selected="" <?php endif; ?>
                                                            value="Europe/Ljubljana">(GMT+01:00) Ljubljana
                                                        </option>
                                                        <option <?php if($settings['timezone'] == 'Europe/Madrid'): ?> selected="" <?php endif; ?>
                                                            value="Europe/Madrid">(GMT+01:00) Madrid
                                                        </option>
                                                        <option <?php if($settings['timezone'] == 'Europe/Paris'): ?> selected="" <?php endif; ?>
                                                            value="Europe/Paris">(GMT+01:00) Paris
                                                        </option>
                                                        <option <?php if($settings['timezone'] == 'Europe/Prague'): ?> selected="" <?php endif; ?>
                                                            value="Europe/Prague">(GMT+01:00) Prague
                                                        </option>
                                                        <option <?php if($settings['timezone'] == 'Europe/Rome'): ?> selected="" <?php endif; ?>
                                                            value="Europe/Rome">(GMT+01:00) Rome
                                                        </option>
                                                        <option <?php if($settings['timezone'] == 'Europe/Sarajevo'): ?> selected="" <?php endif; ?>
                                                            value="Europe/Sarajevo">(GMT+01:00) Sarajevo
                                                        </option>
                                                        <option <?php if($settings['timezone'] == 'Europe/Skopje'): ?> selected="" <?php endif; ?>
                                                            value="Europe/Skopje">(GMT+01:00) Skopje
                                                        </option>
                                                        <option <?php if($settings['timezone'] == 'Europe/Stockholm'): ?> selected="" <?php endif; ?>
                                                            value="Europe/Stockholm">(GMT+01:00) Stockholm
                                                        </option>
                                                        <option <?php if($settings['timezone'] == 'Europe/Vienna'): ?> selected="" <?php endif; ?>
                                                            value="Europe/Vienna">(GMT+01:00) Vienna
                                                        </option>
                                                        <option <?php if($settings['timezone'] == 'Europe/Warsaw'): ?> selected="" <?php endif; ?>
                                                            value="Europe/Warsaw">(GMT+01:00) Warsaw
                                                        </option>
                                                        <option <?php if($settings['timezone'] == 'Europe/Zagreb'): ?> selected="" <?php endif; ?>
                                                            value="Europe/Zagreb">(GMT+01:00) Zagreb
                                                        </option>
                                                        <option <?php if($settings['timezone'] == 'Europe/Athens'): ?> selected="" <?php endif; ?>
                                                            value="Europe/Athens">(GMT+02:00) Athens
                                                        </option>
                                                        <option <?php if($settings['timezone'] == 'Europe/Bucharest'): ?> selected="" <?php endif; ?>
                                                            value="Europe/Bucharest">(GMT+02:00) Bucharest
                                                        </option>
                                                        <option <?php if($settings['timezone'] == 'Africa/Cairo'): ?> selected="" <?php endif; ?>
                                                            value="Africa/Cairo">(GMT+02:00) Cairo
                                                        </option>
                                                        <option <?php if($settings['timezone'] == 'Africa/Harare'): ?> selected="" <?php endif; ?>
                                                            value="Africa/Harare">(GMT+02:00) Harare
                                                        </option>
                                                        <option <?php if($settings['timezone'] == 'Europe/Helsinki'): ?> selected="" <?php endif; ?>
                                                            value="Europe/Helsinki">(GMT+02:00) Helsinki
                                                        </option>
                                                        <option <?php if($settings['timezone'] == 'Europe/Istanbul'): ?> selected="" <?php endif; ?>
                                                            value="Europe/Istanbul">(GMT+02:00) Istanbul
                                                        </option>
                                                        <option <?php if($settings['timezone'] == 'Asia/Jerusalem'): ?> selected="" <?php endif; ?>
                                                            value="Asia/Jerusalem">(GMT+02:00) Jerusalem
                                                        </option>
                                                        <option <?php if($settings['timezone'] == 'Europe/Kiev'): ?> selected="" <?php endif; ?>
                                                            value="Europe/Kiev">(GMT+02:00) Kyiv
                                                        </option>
                                                        <option <?php if($settings['timezone'] == 'Europe/Minsk'): ?> selected="" <?php endif; ?>
                                                            value="Europe/Minsk">(GMT+02:00) Minsk
                                                        </option>
                                                        <option <?php if($settings['timezone'] == 'Europe/Riga'): ?> selected="" <?php endif; ?>
                                                            value="Europe/Riga">(GMT+02:00) Riga
                                                        </option>
                                                        <option <?php if($settings['timezone'] == 'Europe/Sofia'): ?> selected="" <?php endif; ?>
                                                            value="Europe/Sofia">(GMT+02:00) Sofia
                                                        </option>
                                                        <option <?php if($settings['timezone'] == 'Europe/Tallinn'): ?> selected="" <?php endif; ?>
                                                            value="Europe/Tallinn">(GMT+02:00) Tallinn
                                                        </option>
                                                        <option <?php if($settings['timezone'] == 'Europe/Vilnius'): ?> selected="" <?php endif; ?>
                                                            value="Europe/Vilnius">(GMT+02:00) Vilnius
                                                        </option>
                                                        <option <?php if($settings['timezone'] == 'Asia/Baghdad'): ?> selected="" <?php endif; ?>
                                                            value="Asia/Baghdad">(GMT+03:00) Baghdad
                                                        </option>
                                                        <option <?php if($settings['timezone'] == 'Asia/Kuwait'): ?> selected="" <?php endif; ?>
                                                            value="Asia/Kuwait">(GMT+03:00) Kuwait
                                                        </option>
                                                        <option <?php if($settings['timezone'] == 'Africa/Nairobi'): ?> selected="" <?php endif; ?>
                                                            value="Africa/Nairobi">(GMT+03:00) Nairobi
                                                        </option>
                                                        <option <?php if($settings['timezone'] == 'Asia/Riyadh'): ?> selected="" <?php endif; ?>
                                                            value="Asia/Riyadh">(GMT+03:00) Riyadh
                                                        </option>
                                                        <option <?php if($settings['timezone'] == 'Europe/Moscow'): ?> selected="" <?php endif; ?>
                                                            value="Europe/Moscow">(GMT+03:00) Moscow
                                                        </option>
                                                        <option <?php if($settings['timezone'] == 'Asia/Tehran'): ?> selected="" <?php endif; ?>
                                                            value="Asia/Tehran">(GMT+03:30) Tehran
                                                        </option>
                                                        <option <?php if($settings['timezone'] == 'Asia/Baku'): ?> selected="" <?php endif; ?>
                                                            value="Asia/Baku">(GMT+04:00) Baku
                                                        </option>
                                                        <option <?php if($settings['timezone'] == 'Europe/Volgograd'): ?> selected="" <?php endif; ?>
                                                            value="Europe/Volgograd">(GMT+04:00) Volgograd
                                                        </option>
                                                        <option <?php if($settings['timezone'] == 'Asia/Muscat'): ?> selected="" <?php endif; ?>
                                                            value="Asia/Muscat">(GMT+04:00) Muscat
                                                        </option>
                                                        <option <?php if($settings['timezone'] == 'Asia/Tbilisi'): ?> selected="" <?php endif; ?>
                                                            value="Asia/Tbilisi">(GMT+04:00) Tbilisi
                                                        </option>
                                                        <option <?php if($settings['timezone'] == 'Asia/Yerevan'): ?> selected="" <?php endif; ?>
                                                            value="Asia/Yerevan">(GMT+04:00) Yerevan
                                                        </option>
                                                        <option <?php if($settings['timezone'] == 'Asia/Kabul'): ?> selected="" <?php endif; ?>
                                                            value="Asia/Kabul">(GMT+04:30) Kabul
                                                        </option>
                                                        <option <?php if($settings['timezone'] == 'Asia/Karachi'): ?> selected="" <?php endif; ?>
                                                            value="Asia/Karachi">(GMT+05:00) Karachi
                                                        </option>
                                                        <option <?php if($settings['timezone'] == 'Asia/Tashkent'): ?> selected="" <?php endif; ?>
                                                            value="Asia/Tashkent">(GMT+05:00) Tashkent
                                                        </option>
                                                        <option <?php if($settings['timezone'] == 'Asia/Kolkata'): ?> selected="" <?php endif; ?>
                                                            value="Asia/Kolkata">(GMT+05:30) Kolkata
                                                        </option>
                                                        <option <?php if($settings['timezone'] == 'Asia/Kathmandu'): ?> selected="" <?php endif; ?>
                                                            value="Asia/Kathmandu">(GMT+05:45) Kathmandu
                                                        </option>
                                                        <option <?php if($settings['timezone'] == 'Asia/Yekaterinburg'): ?> selected="" <?php endif; ?>
                                                            value="Asia/Yekaterinburg">(GMT+06:00)
                                                            Ekaterinburg
                                                        </option>
                                                        <option <?php if($settings['timezone'] == 'Asia/Almaty'): ?> selected="" <?php endif; ?>
                                                            value="Asia/Almaty">(GMT+06:00) Almaty
                                                        </option>
                                                        <option <?php if($settings['timezone'] == 'Asia/Dhaka'): ?> selected="" <?php endif; ?>
                                                            value="Asia/Dhaka">(GMT+06:00) Dhaka
                                                        </option>
                                                        <option <?php if($settings['timezone'] == 'Asia/Novosibirsk'): ?> selected="" <?php endif; ?>
                                                            value="Asia/Novosibirsk">(GMT+07:00) Novosibirsk
                                                        </option>
                                                        <option <?php if($settings['timezone'] == 'Asia/Bangkok'): ?> selected="" <?php endif; ?>
                                                            value="Asia/Bangkok">(GMT+07:00) Bangkok
                                                        </option>
                                                        <option <?php if($settings['timezone'] == 'Asia/Jakarta'): ?> selected="" <?php endif; ?>
                                                            value="Asia/Jakarta">(GMT+07:00) Jakarta
                                                        </option>
                                                        <option <?php if($settings['timezone'] == 'Asia/Krasnoyarsk'): ?> selected="" <?php endif; ?>
                                                            value="Asia/Krasnoyarsk">(GMT+08:00) Krasnoyarsk
                                                        </option>
                                                        <option <?php if($settings['timezone'] == 'Asia/Chongqing'): ?> selected="" <?php endif; ?>
                                                            value="Asia/Chongqing">(GMT+08:00) Chongqing
                                                        </option>
                                                        <option <?php if($settings['timezone'] == 'Asia/Hong_Kong'): ?> selected="" <?php endif; ?>
                                                            value="Asia/Hong_Kong">(GMT+08:00) Hong Kong
                                                        </option>
                                                        <option <?php if($settings['timezone'] == 'Asia/Kuala_Lumpur'): ?> selected="" <?php endif; ?>
                                                            value="Asia/Kuala_Lumpur">(GMT+08:00) Kuala
                                                            Lumpur
                                                        </option>
                                                        <option <?php if($settings['timezone'] == 'Australia/Perth'): ?> selected="" <?php endif; ?>
                                                            value="Australia/Perth">(GMT+08:00) Perth
                                                        </option>
                                                        <option <?php if($settings['timezone'] == 'Asia/Singapore'): ?> selected="" <?php endif; ?>
                                                            value="Asia/Singapore">(GMT+08:00) Singapore
                                                        </option>
                                                        <option <?php if($settings['timezone'] == 'Asia/Taipei'): ?> selected="" <?php endif; ?>
                                                            value="Asia/Taipei">(GMT+08:00) Taipei
                                                        </option>
                                                        <option <?php if($settings['timezone'] == 'Asia/Ulaanbaatar'): ?> selected="" <?php endif; ?>
                                                            value="Asia/Ulaanbaatar">(GMT+08:00) Ulaan Bataar
                                                        </option>
                                                        <option <?php if($settings['timezone'] == 'Asia/Urumqi'): ?> selected="" <?php endif; ?>
                                                            value="Asia/Urumqi">(GMT+08:00) Urumqi
                                                        </option>
                                                        <option <?php if($settings['timezone'] == 'Asia/Irkutsk'): ?> selected="" <?php endif; ?>
                                                            value="Asia/Irkutsk">(GMT+09:00) Irkutsk
                                                        </option>
                                                        <option <?php if($settings['timezone'] == 'Asia/Seoul'): ?> selected="" <?php endif; ?>
                                                            value="Asia/Seoul">(GMT+09:00) Seoul
                                                        </option>
                                                        <option <?php if($settings['timezone'] == 'Asia/Tokyo'): ?> selected="" <?php endif; ?>
                                                            value="Asia/Tokyo">(GMT+09:00) Tokyo
                                                        </option>
                                                        <option <?php if($settings['timezone'] == 'Australia/Adelaide'): ?> selected="" <?php endif; ?>
                                                            value="Australia/Adelaide">(GMT+09:30) Adelaide
                                                        </option>
                                                        <option <?php if($settings['timezone'] == 'Australia/Darwin'): ?> selected="" <?php endif; ?>
                                                            value="Australia/Darwin">(GMT+09:30) Darwin
                                                        </option>
                                                        <option <?php if($settings['timezone'] == 'Asia/Yakutsk'): ?> selected="" <?php endif; ?>
                                                            value="Asia/Yakutsk">(GMT+10:00) Yakutsk
                                                        </option>
                                                        <option <?php if($settings['timezone'] == 'Australia/Brisbane'): ?> selected="" <?php endif; ?>
                                                            value="Australia/Brisbane">(GMT+10:00) Brisbane
                                                        </option>
                                                        <option <?php if($settings['timezone'] == 'Australia/Canberra'): ?> selected="" <?php endif; ?>
                                                            value="Australia/Canberra">(GMT+10:00) Canberra
                                                        </option>
                                                        <option <?php if($settings['timezone'] == 'Pacific/Guam'): ?> selected="" <?php endif; ?>
                                                            value="Pacific/Guam">(GMT+10:00) Guam
                                                        </option>
                                                        <option <?php if($settings['timezone'] == 'Australia/Hobart'): ?> selected="" <?php endif; ?>
                                                            value="Australia/Hobart">(GMT+10:00) Hobart
                                                        </option>
                                                        <option <?php if($settings['timezone'] == 'Australia/Melbourne'): ?> selected="" <?php endif; ?>
                                                            value="Australia/Melbourne">(GMT+10:00) Melbourne
                                                        </option>
                                                        <option <?php if($settings['timezone'] == 'Pacific/Port_Moresby'): ?> selected="" <?php endif; ?>
                                                            value="Pacific/Port_Moresby">(GMT+10:00) Port
                                                            Moresby
                                                        </option>
                                                        <option <?php if($settings['timezone'] == 'Australia/Sydney'): ?> selected="" <?php endif; ?>
                                                            value="Australia/Sydney">(GMT+10:00) Sydney
                                                        </option>
                                                        <option <?php if($settings['timezone'] == 'Asia/Vladivostok'): ?> selected="" <?php endif; ?>
                                                            value="Asia/Vladivostok">(GMT+11:00) Vladivostok
                                                        </option>
                                                        <option <?php if($settings['timezone'] == 'Asia/Magadan'): ?> selected="" <?php endif; ?>
                                                            value="Asia/Magadan">(GMT+12:00) Magadan
                                                        </option>
                                                        <option <?php if($settings['timezone'] == 'Pacific/Auckland'): ?> selected="" <?php endif; ?>
                                                            value="Pacific/Auckland">(GMT+12:00) Auckland
                                                        </option>
                                                        <option <?php if($settings['timezone'] == 'Pacific/Fiji'): ?> selected="" <?php endif; ?>
                                                            value="Pacific/Fiji">(GMT+12:00) Fiji
                                                        </option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-4">
                                            <p>Currency Code</p>
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <select name="currency_code" data-live-search="true"
                                                        class="form-control show-tick">
                                                        <option <?php if($settings['currency_code'] == 'PKR'): ?> selected="" <?php endif; ?>
                                                            value="PKR">PKR
                                                        </option>
                                                        <option <?php if($settings['currency_code'] == 'BDT'): ?> selected="" <?php endif; ?>
                                                            value="BDT">BDT
                                                        </option>
                                                        <option <?php if($settings['currency_code'] == 'USD'): ?> selected="" <?php endif; ?>
                                                            value="USD">USD
                                                        </option>
                                                        <option <?php if($settings['currency_code'] == 'INR'): ?> selected="" <?php endif; ?>
                                                            value="INR">INR
                                                        </option>
                                                        <option <?php if($settings['currency_code'] == 'GBP'): ?> selected="" <?php endif; ?>
                                                            value="GBP">GBP
                                                        </option>
                                                        <option <?php if($settings['currency_code'] == 'JPY'): ?> selected="" <?php endif; ?>
                                                            value="JPY">JPY
                                                        </option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-4">
                                            <p>Currency Symbol </p>
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <select name="currency_symbol" data-live-search="true"
                                                        class="form-control show-tick">
                                                        <option <?php if($settings['currency_symbol'] == '৳'): ?> selected="" <?php endif; ?>
                                                            value="৳">TK &#2547;
                                                        </option>
                                                        <option <?php if($settings['currency_symbol'] == '$'): ?> selected="" <?php endif; ?>
                                                            value="$">USD &#36;
                                                        </option>
                                                        <option <?php if($settings['currency_symbol'] == '₹'): ?> selected="" <?php endif; ?>
                                                            value="₹">Rupee &#8377;
                                                        </option>
                                                        <option <?php if($settings['currency_symbol'] == '£'): ?> selected="" <?php endif; ?>
                                                            value="£">Pounds sterling &#163;
                                                        </option>
                                                        <option <?php if($settings['currency_symbol'] == '¥'): ?> selected="" <?php endif; ?>
                                                            value="¥">Japanese yen &#165;
                                                        </option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-4">
                                            <p>Currency (Symbol/Code)</p>
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <select class="form-control show-tick" name="is_code" id="">
                                                        <option <?php if($settings['is_code'] == 'code'): ?> selected="" <?php endif; ?>
                                                            value="code">Currency Code
                                                        </option>
                                                        <option <?php if($settings['is_code'] == 'symbol'): ?> selected="" <?php endif; ?>
                                                            value="symbol">Currency Symbol
                                                        </option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-4">
                                            <p>Currency Position</p>
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <select class="form-control show-tick" name="currency_position"
                                                        id="">
                                                        <option <?php if($settings['currency_position'] == 'Prefix'): ?> selected="" <?php endif; ?>
                                                            value="Prefix">Prefix
                                                        </option>
                                                        <option <?php if($settings['currency_position'] == 'Suffix'): ?> selected="" <?php endif; ?>
                                                            value="Suffix">Suffix
                                                        </option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-4">
                                            <p>Is RTL ?</p>
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <select class="form-control show-tick" name="is_rtl" id="">
                                                        <option <?php if($settings['is_rtl'] == 'No'): ?> selected="" <?php endif; ?>
                                                            value="No">No
                                                        </option>
                                                        <option <?php if($settings['is_rtl'] == 'Yes'): ?> selected="" <?php endif; ?>
                                                            value="Yes">Yes
                                                        </option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 field_area">
                                            <p>First Transaction Date</p>
                                            <div class="form-group form-float">
                                                <div class="form-line" id="bs_datepicker_container">
                                                    <input autocomplete="off"
                                                        value="<?php echo e(date('d/m/Y', strtotime($settings['fixed_asset_schedule_starting_date']))); ?>"
                                                        name="fixed_asset_schedule_starting_date" type="text"
                                                        class="form-control" placeholder="Please choose a date...">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <div class="form-line">
                                                <button type="submit" class="btn btn-primary m-t-15 waves-effect">
                                                    <?php echo e(__('root.common.update')); ?>

                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>
                <!-- #END# Inline Layout | With Floating Label -->
            </div>
        </div>
    </section>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('include-css'); ?>
    <!-- Colorpicker Css -->
    <link href="<?php echo e(asset('asset/plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.css')); ?>" rel="stylesheet" />

    <!-- Dropzone Css -->
    <link href="<?php echo e(asset('asset/plugins/dropzone/dropzone.css')); ?>" rel="stylesheet">

    <!-- Multi Select Css -->
    <link href="<?php echo e(asset('asset/plugins/multi-select/css/multi-select.css')); ?>" rel="stylesheet">

    <!-- Bootstrap Spinner Css -->
    <link href="<?php echo e(asset('asset/plugins/jquery-spinner/css/bootstrap-spinner.css')); ?>" rel="stylesheet">

    <!-- Bootstrap Tagsinput Css -->
    <link href="<?php echo e(asset('asset/plugins/bootstrap-tagsinput/bootstrap-tagsinput.css')); ?>" rel="stylesheet">

    <!-- Bootstrap Select Css -->
    <link href="<?php echo e(asset('asset/plugins/bootstrap-select/css/bootstrap-select.css')); ?>" rel="stylesheet" />



    <!-- Bootstrap Material Datetime Picker Css -->
    <link href="<?php echo e(asset('asset/plugins/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css')); ?>"
        rel="stylesheet" />

    <!-- Bootstrap DatePicker Css -->
    <link href="<?php echo e(asset('asset/plugins/bootstrap-datepicker/css/bootstrap-datepicker.css')); ?>" rel="stylesheet" />


    <!-- noUISlider Css -->
    <link href="<?php echo e(asset('asset/plugins/nouislider/nouislider.min.css')); ?>" rel="stylesheet" />

    <!-- Sweet Alert Css -->
    <link href="<?php echo e(asset('asset/plugins/sweetalert/sweetalert.css')); ?>" rel="stylesheet" />
<?php $__env->stopPush(); ?>

<?php $__env->startPush('include-js'); ?>
    <!-- Moment Plugin Js -->
    <script src="<?php echo e(asset('asset/plugins/momentjs/moment.js')); ?>"></script>

    <!-- Bootstrap Material Datetime Picker Plugin Js -->
    <script src="<?php echo e(asset('asset/plugins/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js')); ?>">
    </script>

    <!-- Bootstrap Datepicker Plugin Js -->
    <script src="<?php echo e(asset('asset/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js')); ?>"></script>


    <!-- Sweet Alert Plugin Js -->
    <script src="<?php echo e(asset('asset/plugins/sweetalert/sweetalert.min.js')); ?>"></script>


    <!-- Autosize Plugin Js -->
    <script src="<?php echo e(asset('asset/plugins/autosize/autosize.js')); ?>"></script>

    <script src="<?php echo e(asset('asset/js/pages/forms/basic-form-elements.js')); ?>"></script>


    <script>
        <?php if(Session::has('success')): ?>
            toastr["success"]('<?php echo e(Session::get('success')); ?>');
        <?php endif; ?>

        <?php if(Session::has('error')): ?>
            toastr["error"]('<?php echo e(Session::get('error')); ?>');
        <?php endif; ?>



        <?php if($errors->any()): ?>
            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                toastr["error"]('<?php echo e($error); ?>');
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php endif; ?>
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/vhosts/enrichapp.co.in/httpdocs/eaccount/resources/views/admin/settings/system.blade.php ENDPATH**/ ?>