<?php
include_once dirname(__DIR__) . '/administrator/components/com_geolive/core.php';

include_once Core::LibDir() . DS . 'easycsv' . DS . 'EasyCsv.php';

$csv = EasyCsv::OpenCsv(__DIR__ . DS . 'sites.csv');

Core::LoadPlugin('Maps');
Core::LoadPlugin('Attributes');
?><pre><?php

print_r(EasyCsv::GetHeader($csv));

// foreach (array_diff(EasyCsv::GetHeader($csv), array(
// 'id',
// 'Name',
// 'LAT_Y',
// 'LONG_X',
// 'What happened?'
// )) as $field) {
// echo $field;
// $u = EasyCsv::DistinctValues($csv, $field);
// sort($u);
// print_r($u);
// }

$icons = EasyCsv::DistinctValues($csv, '0');

sort($icons);
print_r($icons);

$iconMap = array(
    'TV - private : new' => 'components/com_geolive/users_files/user_files_400/Uploads/Fxs_[G]_jHI_[ImAgE]_buK.png',
    'TV - private : closed' => 'components/com_geolive/users_files/user_files_400/Uploads/ga_wNP_K7a_[ImAgE]_[G].png',
    'TV - private : decrease in service' => 'components/com_geolive/users_files/user_files_400/Uploads/[G]_lo2_phB_jMK_[ImAgE].png',
    'TV - private : increase in service' => 'components/com_geolive/users_files/user_files_400/Uploads/VXX_LBi_BZ7_[G]_[ImAgE].png',

    'TV - public : new' => 'components/com_geolive/users_files/user_files_400/Uploads/7j8_[ImAgE]_0W3_[G]_EKx.png',
    'TV - public : closed' => 'components/com_geolive/users_files/user_files_400/Uploads/[G]_fe3_DIh_m6r_[ImAgE].png',
    'TV - public : decrease in service' => 'components/com_geolive/users_files/user_files_400/Uploads/[ImAgE]_Kva_[G]_KNi_GhP.png',
    'TV - public : increase in service' => 'components/com_geolive/users_files/user_files_400/Uploads/[G]_Ti1_cfJ_[ImAgE]_AEg.png',

    'community paper : closed' => 'components/com_geolive/users_files/user_files_400/Uploads/5EY_bPb_9pu_[G]_[ImAgE].png',
    'community paper : closed due to merger' => 'components/com_geolive/users_files/user_files_400/Uploads/[ImAgE]_ckm_cLL_[G]_dQ6.png',
    'community paper : decrease in service' => 'components/com_geolive/users_files/user_files_400/Uploads/[G]_k1v_esb_cE_[ImAgE].png',
    'community paper : increase in service' => 'components/com_geolive/users_files/user_files_400/Uploads/[G]_Drp_yoW_[ImAgE]_bO8.png',
    'community paper : new' => 'components/com_geolive/users_files/user_files_400/Uploads/MzA_[G]_[ImAgE]_itZ_37m.png',
    'community paper : new outlet produced by merger' => 'components/com_geolive/users_files/user_files_400/Uploads/Ffw_[G]_WO_A9_[ImAgE].png',
    'community paper : shifted to online' => 'components/com_geolive/users_files/user_files_400/Uploads/A5b_[G]_PTW_[ImAgE]_jjt.png',
    
    'daily paper - free : closed' => 'components/com_geolive/users_files/user_files_400/Uploads/ESs_jwW_3d_[G]_[ImAgE].png',
    'daily paper - free : new' => 'components/com_geolive/users_files/user_files_400/Uploads/qIw_uFv_[G]_bsm_[ImAgE].png',
    'daily paper - free : increase in service' => 'components/com_geolive/users_files/user_files_400/Uploads/Xfp_DTl_[G]_avi_[ImAgE].png',
    'daily paper - free : decrease in service' => 'components/com_geolive/users_files/user_files_400/Uploads/[ImAgE]_zrH_oVI_BtL_[G].png',
    'daily paper - free : daily becomes a community paper' => 'components/com_geolive/users_files/user_files_400/Uploads/nPT_[ImAgE]_[G]_HnR_1gp.png',
    
    'daily paper - paid : closed' => 'components/com_geolive/users_files/user_files_400/Uploads/95V_k0J_[ImAgE]_EWi_[G].png',
    'daily paper - paid : new' => 'components/com_geolive/users_files/user_files_400/Uploads/[ImAgE]_[G]_UWx_N5D_OhI.png',
    'daily paper - paid : closed due to merger' => 'components/com_geolive/users_files/user_files_400/Uploads/Rs8_[G]_LGP_[ImAgE]_cQ5.png',
    'daily paper - paid : decrease in service' => 'components/com_geolive/users_files/user_files_400/Uploads/[ImAgE]_[G]_mYW_wsV_Jte.png',
    'daily paper - paid : new' => 'components/com_geolive/users_files/user_files_400/Uploads/[ImAgE]_[G]_UWx_N5D_OhI.png',
    'daily paper - paid : new outlet produced by merger' => 'components/com_geolive/users_files/user_files_400/Uploads/[G]_ytA_531_[ImAgE]_04.png',
    'daily paper - paid : daily becomes a community paper' => 'components/com_geolive/users_files/user_files_400/Uploads/PYa_[ImAgE]_kk8_[G]_lV6.png',
    
    'online : closed' => 'components/com_geolive/users_files/user_files_400/Uploads/[G]_L9q_GPZ_[ImAgE]_CSi.png',
    'online : new' => 'components/com_geolive/users_files/user_files_400/Uploads/[G]_Qrd_6BY_[ImAgE]_FYG.png',
    'online : increase in service' => 'components/com_geolive/users_files/user_files_400/Uploads/SPT_WE6_[ImAgE]_XPb_[G].png',
    'online : decrease in service' => 'components/com_geolive/users_files/user_files_400/Uploads/08u_[G]_7Ze_[ImAgE]_e4x.png',
    
    'radio - private : new' => 'components/com_geolive/users_files/user_files_400/Uploads/[ImAgE]_[G]_gB3_9Vv_ShV.png',
    'radio - private : decrease in service' => 'components/com_geolive/users_files/user_files_400/Uploads/[G]_FB8_[ImAgE]_XxD_L0W.png',
    'radio - private : increase in service' => 'components/com_geolive/users_files/user_files_400/Uploads/[G]_[ImAgE]_sbP_IWk_QIL.png',
    'radio - private : closed' => 'components/com_geolive/users_files/user_files_400/Uploads/qok_qWp_[G]_[ImAgE]_QvV.png',

    'radio - public : new' => 'components/com_geolive/users_files/user_files_400/Uploads/[ImAgE]_hAM_[G]_Rs0_pRI.png',
    'radio - public : decrease in service' => 'components/com_geolive/users_files/user_files_400/Uploads/[G]_[ImAgE]_YCD_BF5_H7l.png',
    'radio - public : increase in service' => 'components/com_geolive/users_files/user_files_400/Uploads/XKD_[G]_[ImAgE]_e3z_Q48.png',
    'radio - public : closed' => 'components/com_geolive/users_files/user_files_400/Uploads/[ImAgE]_[G]_CHO_gOM_tjn.png'
    
);
?><style>
div {
	height: 30px;
	background-color: aliceblue;
	margin: 0;
}

img {
	height: 30px;
	vertical-align: middle;
}
</style><?php
foreach ($iconMap as $name => $icon) {
    
    echo '<div>' . $name . '=><img src="../' . $icon . '"/></div>';
}

echo "\n\n" . '   var iconSetMap=' . htmlspecialchars(json_encode($iconMap, JSON_PRETTY_PRINT)) . "\n\n";

$tableMetadata = AttributesTable::GetMetadata('newsAttributes');

EasyCsv::IterateRows_Assoc($csv, 
    function ($row) use($tableMetadata, $iconMap) {
        
        $iconKey = trim($row['0']);
        $iconKey=str_replace('  ', ' ', $iconKey);
        
        $marker = MapController::GetFeatureWithName($row['Name']);
        
        if ($marker) {
            
            if (key_exists($iconKey, $iconMap)) {
                if ($marker->getIcon() != $iconMap[$iconKey]) {
                    $marker->setIcon($iconMap[$iconKey]);
                    // MapController::StoreMapFeature($marker);
                }
            } else {
                echo '<br/>missing key for: ' . $iconKey . ' | ' . $row['Name'].'<br/></br/>';
            }
        } else {
            echo '<br/>missing marker for: ' . $row["Name"].'<br/></br/>';
        }
    });

?>


</pre>