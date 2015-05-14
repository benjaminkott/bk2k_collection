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