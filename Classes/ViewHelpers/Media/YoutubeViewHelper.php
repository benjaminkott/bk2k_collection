<?php
namespace Bk2k\Bk2kCollection\ViewHelpers\Media;

/***************************************************************
 *  Copyright notice
 *
 *  (c) 2012 Benjamin Kott <info@bk2k.info>
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
 * @package TYPO3
 * @subpackage bk2k
 * @version $Id$
 */
class YoutubeViewHelper extends \TYPO3\CMS\Fluid\Core\ViewHelper\AbstractViewHelper {

    /**
     * @param string $string
     * @param integer $width
     * @param integer $height
     * @return string
     */
    public function render($url = NULL, $width, $height) {
        if ($url === NULL) {
            $url = $this->renderChildren();
        }
        
        $url = parse_url($url);
        parse_str($url['query']);
        
        if($v){
            $content = '<iframe width="'.$width.'" height="'.$height.'" src="http://www.youtube.com/embed/'.$v.'" frameborder="0" allowfullscreen></iframe>';
        }

        return $content;
    }

}

?>