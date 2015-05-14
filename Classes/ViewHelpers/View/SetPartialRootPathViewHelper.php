<?php
namespace BK2K\Bk2kCollection\ViewHelpers\View;

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
 * {namespace collection = BK2K\Bk2kCollection\ViewHelpers}
 * <collection:view.setPartialRootPath path="fileadmin/partials/">
 * <f:render partial="name" />
 * </collection:view.setPartialRootPath>
 * 
 * @author Benjamin Kott <info@bk2k.info>
 */
class SetPartialRootPathViewHelper extends \TYPO3\CMS\Fluid\Core\ViewHelper\AbstractViewHelper {

    /**
     * Initialize arguments.
     *
     * @return void
     */
    public function initializeArguments() {
        $this->registerArgument('path', 'string', 'PartialRootPath', TRUE, NULL);       
    }
    
    /**
     * @return string HTML String of all child nodes.
     */
    public function render() {      
        if($this->arguments['path'] != NULL){
            $partial_orig = $this->renderingContext->getViewHelperVariableContainer()->getView()->getPartialRootPath();
            $this->renderingContext->getViewHelperVariableContainer()->getView()->setPartialRootPath($this->arguments['path']); 
        }
        $content = $this->renderChildren();
        if($this->arguments['path'] != NULL){
            $this->renderingContext->getViewHelperVariableContainer()->getView()->setPartialRootPath($partial_orig);
        }
        return $content;
    }
}

?>
