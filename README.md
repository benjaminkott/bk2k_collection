BK2K Extbase / Fluid Collection
===============================
A collection of viewhelpers and other stuff.

## ViewHelpers

### Extbase.Plugin
#### Example
```
{namespace collection = TYPO3\Bk2kCollection\ViewHelpers}
<collection:extbase.plugin extension="ExtensionName" plugin="PluginName" controller="Controller" action="Action" arguments="{settings: '{singlePid: 10}'}" />
```
#### Attributes
| Name          | Type      | Default value | Required  |
|:--------------|:----------|:--------------|:----------|
| extension     | string    | NULL          | YES       |
| plugin        | string    | NULL          | YES       |
| controller    | string    | NULL          | YES       |
| action        | string    | NULL          | YES       |
| arguments     | array     | NULL          | NO        |


### Page.Meta 
#### Example
```
{namespace collection = TYPO3\Bk2kCollection\ViewHelpers}
<collection:page.meta name="description" content="Insert random description here" />
```
#### Attributes
| Name          | Type      | Default value | Required  |
|:--------------|:----------|:--------------|:----------|
| content       | string    |               | YES       |
| name          | string    | NULL          | NO        |
| property      | string    | NULL          | NO        |
| scheme        | string    | NULL          | NO        |
| httpEnquiv    | string    | NULL          | NO        |
| lang          | string    | NULL          | NO        |


## Dependencies
| Name      | Version   |
|:----------|:----------|
| extbase   | 6.0       |
| fluid     | 6.0       |
| typo3     | 6.0       |
