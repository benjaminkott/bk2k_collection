BK2K Extbase / Fluid Collection
===============================
A collection of viewhelpers and other stuff.



## ViewHelpers


### Extbase.Plugin
ViewHelper to output any Extbase Plugin directly called in the fluid template

#### Example
```html
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
ViewHelper to add a new or overriding an existing meta tag
#### Example
```html
{namespace collection = TYPO3\Bk2kCollection\ViewHelpers}
<collection:page.meta name="description" content="Insert random description here" />
```
#### Attributes
| Name          | Type      | Default value | Required  |
|:--------------|:----------|:--------------|:----------|
| content       | string    | NULL          | YES       |
| name          | string    | NULL          | NO        |
| property      | string    | NULL          | NO        |
| scheme        | string    | NULL          | NO        |
| httpEnquiv    | string    | NULL          | NO        |
| lang          | string    | NULL          | NO        |


### Uri.Image
This extends viewhelper the default fluid uri image viewhelper to get absolute urls in the frontend.
#### Example
```html
{namespace collection = TYPO3\Bk2kCollection\ViewHelpers}
{collection:uri.image(src:'uploads/tx_extension/{image}' maxWidth:'100', absolute: 1)}
```
#### Attributes
| Name          | Type      | Default value | Required  |
|:--------------|:----------|:--------------|:----------|
| src           | string    | NULL          | YES       |
| width         | string    | NULL          | NO        |
| height        | string    | NULL          | NO        |
| minWidth      | integer   | NULL          | NO        |
| minHeight     | integer   | NULL          | NO        |
| maxWidth      | integer   | NULL          | NO        |
| maxHeight     | integer   | NULL          | NO        |
| absolute      | boolean   | FALSE         | NO        |



## Service


### MetaService
This service will handle all additions by the page.meta viewhelper and merges
them with previous rendered tags by TYPO3. It also cleans up double meta tag definitions and orders them alphabetical.
##### Before
```html
<meta property="og:site_name" content="site_name">
<meta name="description" content="description 1">
<meta property="og:title" content="title">
<meta name="description" content="description 2">
<meta name="author" content="authorname">
```
##### After
```html
<meta name="author" content="authorname">
<meta name="description" content="description 2">
<meta property="og:site_name" content="site_name">
<meta property="og:title" content="title">
```
To get that work the service uses the render-postProcess hook to take operations.



## Dependencies
| Name      | Version   |
|:----------|:----------|
| extbase   | 6.0       |
| fluid     | 6.0       |
| typo3     | 6.0       |
