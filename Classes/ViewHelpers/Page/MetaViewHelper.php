<?php
namespace TYPO3\Bk2kCollection\ViewHelpers\Page;

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
 * = Example =
 *
 * <code title="Example">
 * {namespace collection = TYPO3\Bk2kCollection\ViewHelpers}
 * <collection:page.meta name="description" content="Insert random description here" />
 * </code>
 * 
 * @package TYPO3
 * @subpackage bk2k_collection
 * @author Benjamin Kott <info@bk2k.info>
 */
class MetaViewHelper extends \TYPO3\CMS\Fluid\Core\ViewHelper\AbstractViewHelper {
    
    /**
      * @var \TYPO3\Bk2kCollection\Service\MetaService
      */
    protected $metaService;
    
    /**
     * @param \TYPO3\Bk2kCollection\Service\MetaService $metaService
     * @return void
     */
    public function injectMetaService(\TYPO3\Bk2kCollection\Service\MetaService $metaService) {
       $this->metaService = $metaService;
    }
    
    /**
     * Initialize arguments.
     *
     * @return void
     */
    public function initializeArguments() {
        $this->registerArgument('content', 'string', 'Content', TRUE);
        $this->registerArgument('name', 'string', 'Name', FALSE);
        $this->registerArgument('property', 'string', 'Property', FALSE);
        $this->registerArgument('scheme', 'string', 'Scheme', FALSE);
        $this->registerArgument('httpEnquiv', 'string', 'HttpEnquiv', FALSE);
        $this->registerArgument('lang', 'string', 'Lang', FALSE);
        $this->registerArgument('charset', 'string', 'Charset', FALSE);
    }
    
    /** 
     * @return void
     */
    public function render() {
        $this->metaService->addMeta(
            $this->arguments['content'],
            $this->arguments['name'],
            $this->arguments['property'],
            $this->arguments['scheme'],
            $this->arguments['httpEnquiv'],
            $this->arguments['lang'],
            $this->arguments['charset']
        );
    }    
    
}

?>
