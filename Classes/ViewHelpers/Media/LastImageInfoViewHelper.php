<?php
namespace Bk2k\Bk2kCollection\ViewHelpers\Media;

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
 * = Example =
 *
 * <code title="Example">
 * {namespace collection = Bk2k\Bk2kCollection\ViewHelpers}
 * <f:image src="{src}" alt="{alt}" maxWidth="480" />
 * <collection:media.lastImageInfo>
 * <f:debug>{lastImageInfo}</f:debug>
 * </collection:media.lastImageInfo>
 * </code>
 * 
 * @author Benjamin Kott <info@bk2k.info>
 */
class LastImageInfoViewHelper extends \TYPO3\CMS\Fluid\Core\ViewHelper\AbstractViewHelper {

    public function render() {
        $this->templateVariableContainer->add('lastImageInfo', $GLOBALS['TSFE']->lastImageInfo);
        $content = $this->renderChildren();
        $this->templateVariableContainer->remove('lastImageInfo');
        return $content;
    }

}

?>