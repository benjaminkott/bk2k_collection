<?php

if(!defined('TYPO3_MODE')){
    die('Access denied.');
}

if(TYPO3_MODE == 'FE') {
    $GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['t3lib/class.t3lib_pagerenderer.php']['render-postProcess'][] =  'EXT:'.$_EXTKEY.'/Classes/Service/MetaService.php:TYPO3\Bk2kCollection\Service\MetaService->pageRenderPostProcess';
}

?>