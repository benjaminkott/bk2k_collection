<?php
namespace BK2K\Bk2kCollection\Object\Sitemap;

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
class Page {
    
    /**
     * @var string
     * @validate NotEmpty
     */    
    protected $loc;
    
    /**
     * @var string
     */
    protected $lastmod;
    
    /**
     * @param string $loc
     */
    public function setLoc($loc){
        $this->loc = $loc;
    }
    
    /**
     * @param string $lastmod
     */
    public function setLastmod($lastmod){
        $this->lastmod = $lastmod;
    }
    
    /**
     * @return string
     */
    public function getLoc(){
        return $this->loc;
    }
    
    /**
     * @return string $lastmod
     */
    public function getLastmod(){
        return $this->lastmod;
    }

}

?>