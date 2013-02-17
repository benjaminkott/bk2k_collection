<?php

if(!defined('TYPO3_MODE')){
    die('Access denied.');
}

/**
 * configure extbase svg/image content element
 */
\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
    'Bk2k.'.$_EXTKEY,
    'Svgimage',
    array(
        'Svgimage' => 'render',
    ),
    array(
    ),
    \TYPO3\CMS\Extbase\Utility\ExtensionUtility::PLUGIN_TYPE_CONTENT_ELEMENT
);

/**
 * configure extbase sitemap plugin
 */
\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
    'Bk2k.'.$_EXTKEY,
    'Sitemap',
    array(
        'Sitemap' => 'render',
    ),
    array(
        'Sitemap' => 'render',
    )
);

if(TYPO3_MODE == 'FE') {
    /**
     * register hook for metadata service
     */
    $GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['t3lib/class.t3lib_pagerenderer.php']['render-postProcess'][] =  'EXT:'.$_EXTKEY.'/Classes/Service/MetaService.php:Bk2k\Bk2kCollection\Service\MetaService->pageRenderPostProcess';
    
    /**
     * register realurl pagetype for sitemap
     */
    $GLOBALS['TYPO3_CONF_VARS']['EXTCONF']['realurl']['_DEFAULT']['fileName']['index']['sitemap.xml'] = array (
        'keyValues' => array (
            'type' => '2000',
        )
    );
}

?>