<?php
namespace Bk2k\Bk2kCollection\ViewHelpers\Extbase;

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
 * <collection:extbase.plugin vendor="Bk2k" extension="ExtensionName" plugin="PluginName" controller="Controller" action="Action" arguments="{settings: '{singlePid: 10}'}" />
 * </code>
 * 
 * @author Benjamin Kott <info@bk2k.info>
 */
class PluginViewHelper extends \TYPO3\CMS\Fluid\Core\ViewHelper\AbstractViewHelper {

    /**
     * Extbase Bootstrap
     * @var \TYPO3\CMS\Extbase\Core\Bootstrap
     */
    protected $bootstrap;

    /**
     * Extbase Configuration Manager
     * @var \TYPO3\CMS\Extbase\Configuration\ConfigurationManager
     */
    protected $configurationManager;

    /**
     * @param \TYPO3\CMS\Extbase\Core\Bootstrap $bootstrap
     * @return void
     */
    public function injectBootstrap(\TYPO3\CMS\Extbase\Core\Bootstrap $bootstrap) {
       $this->bootstrap = $bootstrap;
    }

    /**
     * @param \TYPO3\CMS\Extbase\Configuration\ConfigurationManager $configurationManager
     * @return void
     */
    public function injectConfigurationManager(\TYPO3\CMS\Extbase\Configuration\ConfigurationManager $configurationManager) {
       $this->configurationManager = $configurationManager;
    }
   
   /**
     * Initialize arguments.
     *
     * @return void
     */
    public function initializeArguments() {
        $this->registerArgument('extension', 'string', 'extensionName', TRUE);
        $this->registerArgument('plugin', 'string', 'pluginName', TRUE);
        $this->registerArgument('controller', 'string', 'controllerName', TRUE);
        $this->registerArgument('action', 'string', 'actionName', TRUE);
        $this->registerArgument('vendor', 'string', 'vendorName', FALSE);
        $this->registerArgument('arguments', 'mixed', 'arguments', FALSE);
    }

    /**
     * @return mixed
     */
    public function render(){  
        $extensionConfiguration = $this->configurationManager->getConfiguration(\TYPO3\CMS\Extbase\Configuration\ConfigurationManagerInterface::CONFIGURATION_TYPE_FRAMEWORK, $this->arguments['extension'], $this->arguments['plugin']);
        $configuration = array(
            'extensionName' => $this->arguments['extension'],
            'pluginName' => $this->arguments['plugin'],
            'controllerName' => $this->arguments['controller'],
            'action' => $this->arguments['action']
        );
        if($this->arguments['vendor']){
            $configuration['vendorName'] = $this->arguments['vendor'];
        }
        if(is_array($this->arguments['arguments'])){
            $configuration = \array_merge($this->arguments['arguments'],$configuration);
        }
        $configuration = array_merge($extensionConfiguration,$configuration);
        ksort($configuration);
        return $this->bootstrap->run('', $configuration);
    }

}

?>