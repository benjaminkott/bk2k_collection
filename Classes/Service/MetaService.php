<?php
namespace TYPO3\Bk2kCollection\Service;

/***************************************************************
*  Copyright notice
*
*  (c) 2010 Benjamin Kott <info@bk2k.info>
*  All rights reserved
*
*  This script is part of the TYPO3 project. The TYPO3 project is
*  free software; you can redistribute it and/or modify
*  it under the terms of the GNU General Public License as published by
*  the Free Software Foundation; either version 2 of the License, or
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
 * Controller of news records
 *
 * @package TYPO3
 * @subpackage bk2k_collection
 * @author Benjamin Kott <info@bk2k.info>
 */
class MetaService implements \TYPO3\CMS\Core\SingletonInterface {
        
    /**
     * @var array
     */
    protected $metaDataCollection;
    
    /**
     * @var array
     */
    protected $metaDataCollectionExtracted;
    
    /**
     * @param string $name
     * @param string $content
     * @param string $additional
     */
    public function addMeta($name = NULL,$content = NULL){
        
        $this->metaDataCollection[$name] = array(
            'name' => $name,
            'content' => $content
        );

    }
        
    /**
     * @param array $params
     * @param \TYPO3\CMS\Core\Page\PageRenderer $pObj
     */
    public function pageRenderPostProcess($params, $pObj) {
        $params['metaTags'] = array_merge($this->parseGeneratedMetaTags($params['metaTags']),$this->generateMetaTags());
    }
    
    /**
     * @return array
     */
    protected function generateMetaTags(){
        $newCollection = $this->mergeCollections();
        $output = array();
        foreach($newCollection as $key => $tag){
            $output[] = $this->generateMetaTag($tag);
        }
        return $output;
    }
    
    /**
     * @param array $tag
     * @return string
     */
    protected function generateMetaTag($tag){
        $dom = new \DOMDocument('1.0','UTF-8');
        $node = $dom->createElement("meta");
        $newnode = $dom->appendChild($node);
        foreach($tag as $key => $value){
            $newnode->setAttribute($key,$value);
        }
        return $dom->saveHTML($newnode);   
    }
    
    /**
     * @return array
     */
    protected function mergeCollections(){
        if(!$this->metaDataCollectionExtracted){
            return $this->metaDataCollection;
        }else{
            $output = $this->metaDataCollectionExtracted;
            foreach($this->metaDataCollection as $key => $tag){
                $output[$key] = $tag; 
            }
            return $output;            
        }
    }

    /**
     * @param array $metaTags
     * @return mixed
     */
    protected function parseGeneratedMetaTags($metaTags = NULL){
        if($metaTags){
            $output = array();            
            foreach($metaTags as $key => $tag){
                if($this->parseTagToArray($tag)){
                    unset($metaTags[$key]);
                }               
            }
            return $metaTags;
        }
        return false;
    }
    
    /**
     * @param string $tag
     * @return boolean
     */
    protected function parseTagToArray($tag = NULL){
        if($tag){
            $output = array();
            $dom = new \DOMDocument;
            $dom->loadHTML($tag);
            $domNodes = $dom->getElementsByTagName('meta');
            foreach($domNodes as $domElement){
                foreach($domElement->attributes as $name => $attribute){
                    $output[$name] = $domElement->getAttribute($name);
                }
                if($output['name']){
                    $this->addExtractedMetaTag($output);
                    return true;
                }                
                return false;
            }
        }
        return false;
    }

    /**
     * @param array $tag
     */
    public function addExtractedMetaTag($tag){
        $this->metaDataCollectionExtracted[$tag['name']] = $tag;
    }

}

?>