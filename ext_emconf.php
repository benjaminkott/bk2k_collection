<?php

########################################################################
# Extension Manager/Repository config file for ext: "bk2k_collection"
#
# Manual updates:
# Only the data in the array - anything else is removed by next write.
# "version" and "dependencies" must not be touched!
########################################################################

$EM_CONF[$_EXTKEY] = array(
    'title' => 'BK2K Extbase / Fluid Collection',
    'description' => 'A collection of viewhelpers and other stuff.',
    'category' => 'plugin',
    'author' => 'Benjamin Kott',
    'author_email' => 'info@bk2k.info',
    'shy' => '',
    'priority' => '',
    'module' => '',
    'state' => 'alpha',
    'internal' => '',
    'uploadfolder' => '0',
    'createDirs' => '',
    'modify_tables' => '',
    'clearCacheOnLoad' => 0,
    'lockType' => '',
    'version' => '0.1',
    'constraints' => array(
        'depends' => array(
            'extbase' => '6.0',
            'fluid' => '6.0',
            'typo3' => '6.0',
        ),
        'conflicts' => array(
        ),
        'suggests' => array(
        ),
    ),
);

?>