BK2K Extbase / Fluid Collection
===============================
A collection of viewhelpers and other stuff.


## Content Elements

### SVG / Image Content Element
This is an example for an content element width extbase and fal.
... developing ...


## ViewHelpers


### Extbase.Plugin
ViewHelper to output any extbase plugin directly called in the fluid template. 
If your extension uses the namespaces for 6.0 you have to set the vendor.

#### Example
```html
{namespace collection = BK2K\Bk2kCollection\ViewHelpers}
<collection:extbase.plugin vendor="Bk2k" extension="ExtensionName" plugin="PluginName" controller="Controller" action="Action" arguments="{settings: '{singlePid: 10}'}" />
```
#### Attributes
| Name          | Type      | Default value | Required  |
|:--------------|:----------|:--------------|:----------|
| vendor        | string    | NULL          | NO        |
| extension     | string    | NULL          | YES       |
| plugin        | string    | NULL          | YES       |
| controller    | string    | NULL          | YES       |
| action        | string    | NULL          | YES       |
| arguments     | array     | NULL          | NO        |


### Format.RemoveBlankLines
ViewHelper to remove blank lines from output

#### Example
```html
{namespace collection = BK2K\Bk2kCollection\ViewHelpers}
<collection:format.removeBlankLines>
-- random fluid/html stuff --
</collection:format.removeBlankLines>
```


### Media.LastImageInfo
ViewHelper to get $GLOBALS['TSFE']->lastImageInfo accessible in the fluid template

#### Example
```html
{namespace collection = BK2K\Bk2kCollection\ViewHelpers}
<f:image src="{src}" alt="{alt}" maxWidth="480" />
<collection:media.lastImageInfo>
<f:debug>{lastImageInfo}</f:debug>
</collection:media.lastImageInfo>
```


### Page.Meta 
ViewHelper to add a new or overriding an existing meta tag
#### Example
```html
{namespace collection = BK2K\Bk2kCollection\ViewHelpers}
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
{namespace collection = BK2K\Bk2kCollection\ViewHelpers}
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


### View.SetPartialRootPath
ViewHelper to change the partialRootPath for a specific part of the fluid template.

#### Example
```html
{namespace collection = BK2K\Bk2kCollection\ViewHelpers}
<collection:view.setPartialRootPath path="fileadmin/partials/">
<f:render partial="name" />
</collection:view.setPartialRootPath>
```

#### Attributes
| Name          | Type      | Default value | Required  |
|:--------------|:----------|:--------------|:----------|
| path          | string    | NULL          | YES       |



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


### SitemapService
This service will generate an xml sitemap. 
You need to include the static template.

#### Working Sitemap Example 
```html
http://www.bk2k.info/sitemap.xml
```

##### Register Hook
```html
$GLOBALS['TYPO3_CONF_VARS']['EXTCONF']['bk2k_collection']['service']['sitemap']['addPages'][] = 'EXT:'.$_EXTKEY.'/Classes/Hooks/Sitemap/AddPagesHook.php:vendorName\extensionName\Hooks\Sitemap\AddPagesHook->addPages';
```

##### Example Hook
```html
class AddPagesHook implements \TYPO3\CMS\Core\SingletonInterface {
        
    /**
     * @param int $uid
     * @return string
     */
    public function getUrlById($uid){
        $config = array(
            'parameter' => $uid,
            'returnLast' => 'url',
            'additionalParams' => '',
            'forceAbsoluteUrl' => TRUE
        );
        return $GLOBALS['TSFE']->cObj->typoLink('', $config);
    }

    /**
     * @param array $_params
     * @param \BK2K\Bk2kCollection\Service\SitemapService $pObj
     */
    public function addPages($_params, $pObj){
        $loc = $this->getUrlById('1');
        $page = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance('BK2K\Bk2kCollection\Object\Sitemap\Page');
        $page->setLoc($loc);
        $page->setLastmod(date());
        $_params['urlCollection'][$loc] = $page;        
    }
}
```


## Dependencies
| Name      | Version   |
|:----------|:----------|
| extbase   | 6.0       |
| fluid     | 6.0       |
| typo3     | 6.0.2     |
