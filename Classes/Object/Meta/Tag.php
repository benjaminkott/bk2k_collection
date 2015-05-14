<?php
namespace BK2K\Bk2kCollection\Object\Meta;

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
class Tag {
    
    /**
     * @var string
     * @validate NotEmpty
     */    
    protected $content;
    
    /**
     * @var string
     */
    protected $name; 
    
    /**
     * @var string
     */
    protected $property;
    
    /**
     * @var string
     */
    protected $scheme;
    
    /**
     * @var string
     */   
    protected $httpEquiv;
    
    /**
     * @var string
     */
    protected $lang;
    
    /**
     * @var string
     */   
    protected $charset;
    
    /**
     * @var bool
     */   
    protected $keep;
    
    /**
     * @param string $content
     */
    public function setContent($content){
        $this->content = $content;
    }
    
    /**
     * @param string $name
     */
    public function setName($name){
        $this->name = $name;
    }
    
    /**
     * @param string $property
     */
    public function setProperty($property){
        $this->property = $property;
    }
    
    /**
     * @param string $scheme
     */
    public function setScheme($scheme){
        $this->scheme = $scheme;
    }
    
    /**
     * @param string $httpEquiv
     */
    public function setHttpEquiv($httpEquiv){
        $this->httpEquiv = $httpEquiv;
    }
    
    /**
     * @param string $lang
     */
    public function setLang($lang){
        $this->lang = $lang;        
    }
    
    /**
     * @param string $charset
     */
    public function setCharset($charset){
        $this->charset = $charset;        
    }
    
    /**
     * @param boolean $keep
     */
    public function setKeep($keep){
        $this->keep = $keep;        
    }
    
    /**
     * @return string
     */
    public function getContent(){
        return $this->content;
    }
    
    /**
     * @return string
     */
    public function getName(){
        return $this->name;
    }
    
    /**
     * @return string
     */
    public function getProperty(){
        return $this->property;
    }
    
    /**
     * @return string
     */
    public function getScheme(){
        return $this->scheme;
    }
    
    /**
     * @return string
     */
    public function getHttpEquiv(){
        return $this->httpEquiv;
    }
    
    /**
     * @return string
     */
    public function getLang(){
        return $this->lang;
    }
    
    /**
     * @return string
     */
    public function getCharset(){
        return $this->charset;
    }
    
    /**
     * @return boolean
     */
    public function getKeep(){
        return $this->keep;
    }
    
}

?>