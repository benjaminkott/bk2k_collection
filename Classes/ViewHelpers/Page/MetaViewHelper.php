<?php
namespace Bk2k\Bk2kCollection\ViewHelpers\Page;

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
 * <collection:page.meta name="description" content="Insert random description here" />
 * </code>
 * 
 * @author Benjamin Kott <info@bk2k.info>
 */
class MetaViewHelper extends \TYPO3\CMS\Fluid\Core\ViewHelper\AbstractViewHelper {
    
    /**
      * @var \Bk2k\Bk2kCollection\Service\MetaService
      */
    protected $metaService;
    
    /**
     * @param \TYPO3\Bk2kCollection\Service\MetaService $metaService
     * @return void
     */
    public function injectMetaService(\Bk2k\Bk2kCollection\Service\MetaService $metaService) {
       $this->metaService = $metaService;
    }
    
    /**
     * Initialize arguments.
     *
     * @return void
     */
    public function initializeArguments() {
        $this->registerArgument('content', 'string', 'Property: content', TRUE);
        $this->registerArgument('name', 'string', 'Property: name', FALSE);
        $this->registerArgument('property', 'string', 'Property: property', FALSE);
        $this->registerArgument('scheme', 'string', 'Property: scheme', FALSE);
        $this->registerArgument('httpEquiv', 'string', 'Property: http-equiv', FALSE);
        $this->registerArgument('lang', 'string', 'Property: lang', FALSE); 
        $this->registerArgument('keep', 'boolean', 'Keep the entry and do not try to merge', FALSE); 
    }
    
    /** 
     * @return void
     */
    public function render() {
        if(TYPO3_MODE == 'BE'){
            return;
	}
	if(isset($this->arguments['content']) && !empty($this->arguments['content'])){
            $this->metaService->addMeta(
                $this->arguments['content'],
                $this->arguments['name'],
                $this->arguments['property'],
                $this->arguments['scheme'],
                $this->arguments['httpEquiv'],
                $this->arguments['lang'],
                NULL,
                'service',
                $this->arguments['keep']
            );
        }
    }    
    
}

?>
