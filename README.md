bk2k_collection
===============

ViewHelpers

Extbase.Plugin
<code title="Example">
{namespace collection = TYPO3\Bk2kCollection\ViewHelpers}
<collection:extbase.plugin extension="ExtensionName" plugin="PluginName" controller="Controller" action="Action" arguments="{settings: '{singlePid: 10}'}" />
</code>

Page.Meta
<code title="Example">
{namespace collection = TYPO3\Bk2kCollection\ViewHelpers}
<collection:page.meta name="description" content="Insert random description here" />
</code>

Dependencies
extbase => 6.0
fluid => 6.0
typo3 => 6.0
