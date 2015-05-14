<?php
namespace BK2K\Bk2kCollection\Service;

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

use TYPO3\CMS\Core\SingletonInterface;

/**
 * @package TYPO3
 * @subpackage bk2k_collection
 * @author Benjamin Kott <info@bk2k.info>
 */
class MetaService implements SingletonInterface {

	/**
	 * @var array
	 */
	protected $metaDataCollection;

	/**
	 * @var array
	 */
	protected $mergedDataCollection;

	/**
	 * @param string $content
	 * @param string $name
	 * @param string $property
	 * @param string $scheme
	 * @param string $httpEquiv
	 * @param string $lang
	 * @param string $charset
	 * @param string $collection
	 * @param boolean $keep
	 */
	public function addMeta($content, $name = NULL, $property = NULL, $scheme = NULL, $httpEquiv = NULL, $lang = NULL, $charset = NULL, $collection = "service", $keep = false){

		$tag = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance('BK2K\Bk2kCollection\Object\Meta\Tag');
		$tag->setContent($content);
		$tag->setName($name);
		$tag->setProperty($property);
		$tag->setScheme($scheme);
		$tag->setHttpEquiv($httpEquiv);
		$tag->setLang($lang);
		$tag->setCharset($charset);
		$tag->setKeep($keep);

		if($tag->getKeep()){
			$this->metaDataCollection[$collection]['keep'][] = $tag;
		}elseif($tag->getName()){
			$this->metaDataCollection[$collection]['name'][$tag->getName()] = $tag;
		}elseif($tag->getProperty()){
			$this->metaDataCollection[$collection]['property'][$tag->getProperty()] = $tag;
		}elseif($tag->getHttpEquiv()){
			$this->metaDataCollection[$collection]['http-equiv'][$tag->getHttpEquiv()] = $tag;
		}else{
			$this->metaDataCollection[$collection]['unknown'][] = $tag;
		}

	}

	/**
	 * @param array $params
	 * @param \TYPO3\CMS\Core\Page\PageRenderer $pObj
	 */
	public function pageRenderPostProcess($params, $pObj) {

		$this->parseGeneratedMetaTags($params['metaTags']);
		$this->mergeCollections();
		$params['metaTags'] = $this->generateMetaTags();

	}

	/**
	 * @return array
	 */
	protected function generateMetaTags(){
		$output = array();
		foreach($this->mergedDataCollection as $key => $tag){
			$output[] = $this->convertTagToString($tag);
		}
		return $output;
	}

	/**
	 * @return array
	 */
	protected function mergeCollections(){

		$tmpNewCollection = array();
		$newCollection = array();

		if(is_array($this->metaDataCollection['extracted']['name'])){
			$typeName = $this->metaDataCollection['extracted']['name'];
			if(is_array($this->metaDataCollection['service']['name'])){
				foreach($this->metaDataCollection['service']['name'] as $key => $tag){
					$typeName[$key] = $tag;
				}
			}
			ksort($typeName);
			array_push($tmpNewCollection,$typeName);
		}

		if(is_array($this->metaDataCollection['extracted']['property'])){
			$typeProperty = $this->metaDataCollection['extracted']['property'];
			if(is_array($this->metaDataCollection['service']['property'])){
				foreach($this->metaDataCollection['service']['property'] as $key => $tag){
					$typeProperty[$key] = $tag;
				}
			}
			ksort($typeProperty);
			array_push($tmpNewCollection,$typeProperty);
		}

		if(is_array($this->metaDataCollection['extracted']['http-equiv'])){
			$typeHttpEquiv = $this->metaDataCollection['extracted']['http-equiv'];
			if(is_array($this->metaDataCollection['service']['http-equiv'])){
				foreach($this->metaDataCollection['service']['http-equiv'] as $key => $tag){
					$typeHttpEquiv[$key] = $tag;
				}
			}
			ksort($typeHttpEquiv);
			array_push($tmpNewCollection,$typeHttpEquiv);
		}

		if(is_array($this->metaDataCollection['extracted']['unknown'])){
			array_push($tmpNewCollection,$this->metaDataCollection['extracted']['unknown']);
		}
		if(is_array($this->metaDataCollection['service']['unknown'])){
			array_push($tmpNewCollection,$this->metaDataCollection['service']['unknown']);
		}
		if(is_array($this->metaDataCollection['service']['keep'])){
			array_push($tmpNewCollection,$this->metaDataCollection['service']['keep']);
		}

		if(is_array($tmpNewCollection)){
			foreach($tmpNewCollection as $section){
				if(is_array($section)){
					foreach($section as $tag){
						array_push($newCollection,$tag);
					}
				}
			}
		}

		$this->mergedDataCollection = $newCollection;

	}

	/**
	 * @param array $metaTags
	 * @return void
	 */
	protected function parseGeneratedMetaTags($metaTags = NULL){
		if($metaTags){
			$output = array();
			foreach($metaTags as $key => $tag){
				$this->parseTagToArray($tag);
			}
		}
	}

	/**
	 * @param \BK2K\Bk2kCollection\Object\Meta\Tag $tag
	 * @return string
	 */
	protected function convertTagToString(\BK2K\Bk2kCollection\Object\Meta\Tag $tag){
		$dom = new \DOMDocument('1.0', 'utf-8');
		$node = $dom->createElement("meta");
		$newnode = $dom->appendChild($node);
		if($tag->getName()){
			$newnode->setAttribute('name',$tag->getName());
		}
		if($tag->getProperty()){
			$newnode->setAttribute('property',$tag->getProperty());
		}
		if($tag->getHttpEquiv()){
			$newnode->setAttribute('http-equiv',$tag->getHttpEquiv());
		}
		if($tag->getContent()){
			$newnode->setAttribute('content',$tag->getContent());
		}
		if($tag->getScheme()){
			$newnode->setAttribute('scheme',$tag->getScheme());
		}
		if($tag->getLang()){
			$newnode->setAttribute('lang',$tag->getLang());
		}
		if($tag->getCharset()){
			$newnode->setAttribute('charset',$tag->getCharset());
		}
		return $dom->saveHTML($newnode);
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

					// NOTE: THIS IS STRANGE! WORKS FOR NOW
					$output[$name] = utf8_decode($attribute->value);

				}
				$this->addExtractedMetaTag($output);
				return true;
			}
		}
		return false;
	}

	/**
	 * @param array $tag
	 */
	protected function addExtractedMetaTag($tag){
		$this->addMeta(
			$tag['content'],
			$tag['name'],
			$tag['property'],
			$tag['scheme'],
			$tag['http-equiv'],
			$tag['lang'],
			$tag['charset'],
			'extracted'
		);
	}

}