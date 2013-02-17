<?php
namespace Bk2k\Bk2kCollection\Service;

/***************************************************************
 *  Copyright notice
 *
 *  (c) 2013 Benjamin Kott <info@bk2k.info>
 *  
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 3 of the License, or
 *  (at your option) any later version.
 *
 *  The GNU General Public License can be found at
 *  http://www.gnu.org/copyleft/gpl.html.
 *
 *  This script is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  This copyright notice MUST APPEAR in all copies of the script!
 ***************************************************************/

/**
 * @author Benjamin Kott <info@bk2k.info>
 */
class SitemapService implements \TYPO3\CMS\Core\SingletonInterface {
       
    /**
     * @var array
     */
    protected $urlCollection;
    
    /**
     * @var array
     */
    protected $pageCollection;
    
    /**
     * @var \TYPO3\CMS\Frontend\Page\PageRepository
     */
    protected $pageRepository;
    
    public function __construct() {
        $this->pageRepository = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance('TYPO3\\CMS\\Frontend\\Page\\PageRepository');
        $this->collectPages();
    }
    
    /**
     * @param int $id
     * @return array
     */
    protected function getPageMenu($id){
        return $this->pageRepository->getMenu($id, $fields = '*', $sortField = 'sorting'); 
    }

    /**
     * @param array $page
     */
    protected function collectPage($page){
        if($page['doktype'] == '1'){
            $this->pageCollection[$page['uid']] = $page;
        }
        $subPages = $this->getPageMenu($page['uid']);
        if(is_array($subPages)){
            foreach($subPages as $subPage){
                $this->collectPage($subPage);
            }
        }
    }

    /**
     * return void
     */
    protected function collectPages(){
        $rootline = $this->pageRepository->getRootLine($GLOBALS['TSFE']->id);        
        foreach($rootline as $page){
            $this->collectPage($this->pageRepository->getPage($page['uid']));
        }        
        $this->generateUrlCollection();
    }
    
    /**
     * @param string $loc
     * return void
     */   
    public function addPage($loc, $lastmod = NULL){
        $page = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance('Bk2k\Bk2kCollection\Object\Sitemap\Page');
        $page->setLoc($loc);
        if($lastmod){
            $page->setLastmod($lastmod);
        }
        $this->urlCollection[$loc] = $page;
    }
    
    /**
     * @return void
     */
    public function generateUrlCollection(){
        foreach($this->pageCollection as $page){            
            $this->addPage($this->getUrlById($page['uid']),($page['SYS_LASTCHANGED'] ? $page['SYS_LASTCHANGED'] : $page['crdate']));
        }  
        // HOOK TO ADD URLS
        if (is_array($GLOBALS['TYPO3_CONF_VARS']['EXTCONF']['bk2k_collection']['service']['sitemap']['addPages'])) {
            $_params = array(
                'urlCollection' => &$this->urlCollection
            );
            foreach ($GLOBALS['TYPO3_CONF_VARS']['EXTCONF']['bk2k_collection']['service']['sitemap']['addPages'] as $_funcRef) {   
                \TYPO3\CMS\Core\Utility\GeneralUtility::callUserFunction($_funcRef, $_params, $this);
            }
        }
    }
    
    public function getUrlById($pageUid){
        $config = array(
            'parameter' => $pageUid,
            'returnLast' => 'url',
            'additionalParams' => '',
            'useCacheHash' => FALSE,
            'forceAbsoluteUrl' => TRUE
        );
        return $GLOBALS['TSFE']->cObj->typoLink('', $config);
    }
    
    /**
     * @param string $loc
     * return void
     */   
    public function removePage($loc){
        unset($this->urlCollection[$loc]);
    }
    
    /**
     * return array
     */
    public function getUrlCollection(){
        return $this->urlCollection;
    }

}

?>