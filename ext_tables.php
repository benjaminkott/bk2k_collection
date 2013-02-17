<?php

if(!defined('TYPO3_MODE')){
    die ('Access denied.');
}

/**
 * Static TypoScript
 */
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile($_EXTKEY, 'Configuration/TypoScript', 'BK2K Extbase / Fluid Collection');

/**
 * Register Content Element - SVG / Image and TCA Settings
 */
\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
    'Bk2k.'.$_EXTKEY,
    'Svgimage',
    'SVG / Image Content Element'
);
\TYPO3\CMS\Core\Utility\GeneralUtility::loadTCA('tt_content');
$TCA['tt_content']['types']['bk2kcollection_svgimage']['showitem'] = "
    --palette--;LLL:EXT:cms/locallang_ttc.xml:palette.general;general,
    --palette--;LLL:EXT:cms/locallang_ttc.xml:palette.header;header,
    --div--;LLL:EXT:cms/locallang_ttc.xml:tabs.images,
    image,
    imagesvg,
    --div--;LLL:EXT:cms/locallang_ttc.xml:tabs.appearance,
    --palette--;LLL:EXT:cms/locallang_ttc.xml:palette.frames;frames,
    --div--;LLL:EXT:cms/locallang_ttc.xml:tabs.access,
    --palette--;LLL:EXT:cms/locallang_ttc.xml:palette.visibility;visibility,
    --palette--;LLL:EXT:cms/locallang_ttc.xml:palette.access;access,
    --div--;LLL:EXT:cms/locallang_ttc.xml:tabs.extended 
";
$svgimages_columns['imagesvg']['label'] = 'SVG';
$svgimages_columns['imagesvg']['config'] = \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::getFileFieldTCAConfig('imagesvg',array(),'svg');
$svgimages_columns['imagesvg']['config']['maxitems'] = 1;
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTCAcolumns('tt_content',$svgimages_columns);

?>