BK2K Extbase / Fluid Collection
===============================
A collection of viewhelpers and other stuff.

# ViewHelpers

Extbase.Plugin
```
{namespace collection = TYPO3\Bk2kCollection\ViewHelpers}
<collection:extbase.plugin extension="ExtensionName" plugin="PluginName" controller="Controller" action="Action" arguments="{settings: '{singlePid: 10}'}" />
```

Page.Meta 
```
{namespace collection = TYPO3\Bk2kCollection\ViewHelpers}
<collection:page.meta name="description" content="Insert random description here" />
```

# Dependencies
* extbase => 6.0
* fluid => 6.0
* typo3 => 6.0
