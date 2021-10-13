---
layout: page
title: Creating & Managing Custom Metadata Fields 
weight: 110
---

Kaltura supports three types of [metadata](https://knowledge.kaltura.com/help/what-types-of-metadata-can-be-used-in-the-kmc) for its media assets.

1. Technical metadata (read only) – includes the technical attributes of the media file. For example, the file type, duration, file format.
2. Basic metadata – includes Name, Description, Tags, and Categories’ fields. In addition, Kaltura allows referencing the media entry using an external identifier which can be stored in the Reference ID field.
3. Custom metadata – includes custom fields, defined under one or more schemas, which allow enhancing any media object into a custom business object.

#### See Also

1. /workflows/Enrich_and_Organize_Metadata/Working_with_metadata
2. https://knowledge.kaltura.com/help/custom-data
3. https://learning.kaltura.com/media/How+to+reate+and+pply+a+ustom+Metadata+Schema/1_8gofc71k
4. https://knowledge.kaltura.com/help/how-to-add-a-kaltura-custom-metadata-schema-profile
5. https://knowledge.kaltura.com/help/what-fields-can-be-configured-in-kaltura-custom-metadata-profiles
6. See an [example app](https://github.com/kaltura/Kaltura-Paid-Content-Gallery-With-PayPal-Sample-App/blob/master/AccountWizard/setupAccount.php) that uses the metadata API 




## Adding Metadata via API

[metadataProfile.add](/console/service/metadataProfile/action/add): manages schema profiles per account

```javascript
metadataProfile.add(metadataProfile,xsdData,viewsData)
```

`xsdData` is the XSD Schema file defining the metadata fields to create, here is an [example](https://github.com/kaltura/Kaltura-Paid-Content-Gallery-With-PayPal-Sample-App/blob/master/AccountWizard/paypalSchema.sdx)

`viewsData` is a custom definition of KMC UI elements for the newly created fields (if left empty, will use default)

The Profile is then parsed, indexed and used to build the new fields on the selected object



[metadata.add](/console/service/metadata/action/add): manages metadata xml per object per profile

```javascript
metadata.add(profileId,KalturaMetadataObjectType,objectId, xml)
```

`profileId`–to which metadata profile this relates

`KalturaMetadataObjectType` – see dropdown at [metadata.add](/console/service/metadata/action/add)

`objectId` –the id of the object to add values to

`xml` –the actual metadata XML (xml must abide the schema/profile XSD and fields order is crucial)

The xml is then parsed and indexed on the specified object, and is now ready for search/update



## Metadata XML

The Metadata schema is case sensitive. `<price></price>` and `<Price></Price>` are different 

Order matters. Make sure to have Metadata XML fields submitted in the same order they appear in the Schema XSD. 

Searchable Date and Integer fields are limited to 4 fields per account (non-searchable is not limited). 

## Example in php:

```php
<?php
//Get the schema XSD:
$metadataPlugin = KalturaMetadataClientPlugin::get($client);

//returns a URL
//or can also use: $metadataPlugin->metadataProfile->get($metadataProfileId)->xsd
$schemaUrl = $metadataPlugin->metadataProfile->serve($metadataProfileId);

//download the XSD file from Kaltura
$schemaXSDFile = file_get_contents($schemaUrl);

//Build a <metadata> template:
$schema = newDOMDocument();

//load and parse the XSD as an XML
$schema->loadXML($schemaXSDFile);

//get all elements of the XSD
$fieldsList = $schema->getElementsByTagName('element');

//Kaltura metadata XML is always wrapped in <metadata>
$metadataTemplate = '<metadata>';
foreach ($fieldsList as $element) {
    if ($element->hasAttribute("name") === false)
        continue;  //valid fields will always have name
    $key = $element->getAttribute('name'); //systemName is the element’s name, not key nor id
    if ($key != 'metadata') //exclude the parent node ‘metadata’ as we’re manually creating it
        $metadataTemplate .= '<' . $key . '>' . '</' . $key . '>';
}
$metadataTemplate .= '</metadata>'; //Manipulatethetemplateaddingyourfieldsvalues:
$metadataXml = simplexml_load_string($metadataTemplate);
$metadataXml->Price = 2.3; //field ’ssystemName= value;

//what object will we set metadata for?
$objectType=KalturaMetadataObjectType::ENTRY;

//the id of the object you wish to update
$objectId='0_3242sdf';
$metadataPlugin->metadata->add($mProfileId, $objectType, $objectId, $metadataXml->asXML())
```

An example metadata string may look like:

```xml
<metadata>
	<field1>value</field1>
	<field2>value</field2>
</metadata>
```



## Object Search By Metadata Fields Values

Search objects via metadata using the [list action](/console/service/media/action/list) 

In the filter parameter, set advancedSearch to KalturaMetadataSearchItem

<img src="/assets/images/metadatasearch.png" alt="metadatasearch" style="zoom:30%;" />

Use [metadataProfile.listFields](/console/service/metadataProfile/action/listFields) to get all searchable `xPath` fields

