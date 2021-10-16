---
layout: page
title: Hardening Security with Media Access Control Rules
weight: 110
---

Kaltura has two different mechanisms for enforcing access control without requiring cross-dependency that are effective for all connected devices:

* Scheduling - Used for enforcing access control on the entry-level across all connected devices. This mechanism is based on a single start/end window. It is recommended to use the scheduling mechanism if and when it meets your business requirements. Scheduling is easier to setup via the API and can be self-served by non-technical users, either through the KMC or through MediaSpace.

* Advanced Access Control - Used for more fine-grain control on the flavor level, Advanced Access control allows both multiple-scheduling windows and multiple rules beyond scheduling. For example (“Don’t serve the HD flavor in Canada”, “Playback on iPads is not allowed 8 hours after TV air date”). This mechanism is more complex. 
  

Both Scheduling and Advanced Access-Control are fully enforced on the server-side and by mobile applications when they retrieve content via Kaltura APIs.

>Note: It is recommended to always use these methods and not, for example, store returned m3u8 urls, as m3u8 urls are only temporary.

## Scheduling Access

When using the scheduling mechanism, setting the scheduling window on an entry, either via KMC, or via API, will have the access control logic enforced cross-device.

To provide a better UX than just a black screen when accessing content outside its scheduling window, for example, display a message as “This video cannot be played at this time” or “Video can only be accessed between X – Y, try again in T hours”, you should also use the <a href="/api-docs/#/baseEntry.getContextData">baseEntry.getContextData</a> API method. This method allows retrieving the scheduling window and presenting a message dialog to the end user when <a href="/api-docs/#/KalturaEntryContextDataResult">isScheduledNow</a> is returned false.



## Advanced Access Control

An Access Control Profile defines authorized and restricted domains where your content can or cannot be displayed, countries from which it can or cannot be viewed, white and black lists of IP addresses and authorized and unauthorized domains and devices in which your media can be embedded.

For information on Kaltura session-based restrictions, refer to [Kaltura's API Authentication and Security][1]. 

[1]: http://knowledge.kaltura.com/node/229

### <span></span>Access Control API

The access control API service <a href="/api-docs/#/accessControlProfile" target="_blank">accessControlProfile</a>  provides the following actions:

**<a href="/api-docs/#/accessControlProfile" target="_blank">accessControlProfile</a>**

*   <a href="/api-docs/#/accessControlProfile.add" target="_blank">addAction</a>
*   <a href="/api-docs/#/accessControlProfile.get" target="_blank">getAction</a>
*   [updateAction][2]
*   <a href="/api-docs/#/accessControlProfile.delete" target="_blank">deleteAction</a>
*   <a href="/api-docs/#/accessControlProfile.list" target="_blank">listAction</a>

[2]: /api-docs/#/accessControlProfile.update

**<a href="/api-docs/#/KalturaAccessControlProfile" target="_blank">KalturaAccessControlProfile </a>**

The API object <a href="/api-docs/#/KalturaAccessControlProfile" target="_blank">KalturaAccessControlProfile </a>is composed of an ordered set of rules of type <a href="/api-docs/#/KalturaRule" target="_blank">KalturaRule</a>.

<p class="Subheading">
  <a href="/api-docs/#/KalturaRule" target="_blank">KalturaRule</a>
</p>


The KalturaRule type contains the following attributes:

| Name           | Type                                       | Writable | Description                                                  |
| -------------- | ------------------------------------------ | -------- | ------------------------------------------------------------ |
| actions        | KalturaAccessControlActionArray            | V        | Actions to be performed by the player in case the rule is fulfilled. |
| conditions     | KalturaConditionArray                      | V        | Conditions to validate the rule.                             |
| contexts       | KalturaAccessControlContextTypeHolderArray | V        | Indicates what contexts should be tested by this rule.       |
| message        | string                                     | V        | Message to be thrown to the player in case the rule is fulfilled. |
| stopProcessing | boolean                                    | V        | Indicates that when this rule has been met there is no need to continue checking the rest of the rules. |

Rules are evaluated according to their order and evaluated only if they are configured to run in the current context, according to their contexts attribute. A KalturaRule is considered  fulfilled only if all its conditions are evaluated as true. The available context types are in the[ KalturaAccessControlContextType][3].

[3]: /api-docs/#/KalturaAccessControlContextType

**KalturaAccessControlContextType**

| Name      | Type   | Value |
| --------- | ------ | ----- |
| DOWNLOAD  | string | 2     |
| PLAY      | string | 1     |
| THUMBNAIL | string | 3     |


All rules are evaluated, unless one of the rule's stop processing flag is true and the rule condition was fulfilled. Each rule that matches the conditions, adds the actions to the outcome actions and its message to the outcome messages. All of the actions are performed for rules that are evaluated and their conditions are true. Each rule is composed of a set of conditions <a href="/api-docs/#/KalturaConditionArray" target="_blank">KalturaCondition</a>  and an action [KalturaAccessControlAction.][4]  The action types are described in <a href="/api-docs/#/KalturaAccessControlActionType" target="_blank">KalturaAccessControlActionType. </a>The logical relation between the set of conditions in a single rule uses the AND operator, meaning that all conditions must be evaluated to true in order to consider the rule as fulfilled.

[4]: /api-docs/#/KalturaAccessControlAction

<p class="Subheading">
  <a href="/api-docs/#/KalturaConditionArray" target="_blank">KalturaCondition </a>
</p>


The condition types are:

<p class="Subheading">
  <a href="/api-docs/#/KalturaConditionArray" target="_blank">KalturaConditionType</a> 
</p>


| Name                   | Type   | Value                 | Description                                                  |
| ---------------------- | ------ | --------------------- | ------------------------------------------------------------ |
| AUTHENTICATED          | string | 1                     | Validate that the user is authenticated, specific privileges may be defined. |
| COUNTRY                | string | 2                     | Validate that the request came from a specific country, calculated according to request IP. |
| FIELD_COMPARE          | string | 7                     | Validate that the field number compared correctly to all listed numeric values. |
| FIELD_MATCH            | string | 6                     | Validate that the field text matches any of listed textual values. |
| IP_ADDRESS             | string | 3                     | Validate that the request came from a specific IP range.     |
| METADATA_FIELD_COMPARE | string | metadata.FieldCompare | Validate that all metadata elements number compared correctly to all listed numeric values. |
| METADATA_FIELD_MATCH   | string | metadata.FieldMatch   | Validate that any of the metadata elements text matches any of listed textual values. |
| SITE                   | string | 4                     | Validate that the request came from a specific domain, wildcards are supported. |
| USER_AGENT             | string | 5                     | Validate that the request came from a specific user agent, regular expressions are supported. |

 The objects available that implement the condition objects are:

*   <a href="/api-docs/#/KalturaAuthenticatedCondition" target="_blank">KalturaAuthenticatedCondition</a> **Note: **This object should be configured only on an entry level access control objects.
*   <a href="/api-docs/#/KalturaCompareMetadataCondition" target="_blank">KalturaCompareMetadataCondition</a>
*   <a href="/api-docs/#/KalturaFieldCompareCondition" target="_blank">KalturaFieldCompareCondition</a>
*   [KalturaCountryCondition][5]
*   <a href="/api-docs/#/KalturaFieldMatchCondition" target="_blank">KalturaFieldMatchCondition</a>
*   <a href="/api-docs/#/KalturaIpAddressCondition" target="_blank">KalturaIpAddressCondition</a>
*   <a href="/api-docs/#/KalturaMatchMetadataCondition" target="_blank">KalturaMatchMetadataCondition</a>
*   <a href="/api-docs/#/KalturaUserAgentCondition" target="_blank">KalturaUserAgentCondition</a>
*   <a href="/api-docs/#/KalturaSiteCondition" target="_blank">KalturaSiteCondition</a>

[5]: /api-docs/#/KalturaCountryCondition

For example:

Rule #1 – conditions: KS is not valid -> action: block

Rule #2 – conditions: country is not US -> action: block

If no rule applies, no action will be taken and the content will be allowed.

**Understanding the Compare and Match Condition Objects** 

FIELD_COMPARE<span> </span>and FIELD_MATCH<span> </span>differentiate generic fields from generic values. A field is any implementation of [KalturaStringField][6] for textual matching or [KalturaIntegerField][7] for numeric comparison.

[6]: #KalturaStringField
[7]: #KalturaIntegerField

<a name="KalturaStringField"></a>KalturaStringField implementations:

*   KalturaCountryContextField – Represents the current request's country context as calculated based on the IP address.
*   KalturaIpAddressContextField – Represents the current request's IP address context.
*   KalturaUserAgentContextField – Represents the current request's user agent context.
*   KalturaUserEmailContextField – Represents the current session's user e-mail address context.
*   KalturaEvalStringField (Falcon only: Requires Admin Console permission) – Evaluates a PHP statement, depends on the execution context.

<a name="KalturaIntegerField"></a>KalturaIntegerField implementations:

*   KalturaTimeContextField – Represents the current time context on Kaltura servers.

FIELD\_COMPARE and FIELD\_MATCH use [KalturaIntegerValue][8] for numeric comparison values and [KalturaStringValue][9] for textual matches.

[8]: #KalturaIntegerValue
[9]: #KalturaStringValue

<a name="KalturaIntegerValue"></a>KalturaIntegerValue may contain a numeric value or may be implemented as [KalturaIntegerField][7].

<a name="KalturaStringValue"></a>KalturaStringValue may contain a string value or may be implemented as [KalturaStringField][6].

METADATA\_FIELD\_COMPARE<span> and <span>METADATA_FIELD_MATCH </span></span>also use [KalturaIntegerValue][8] and [KalturaStringValue][9] for sets of values. For the metadata condition objects, the field used is from the metadata fields of a specific xPath in the metadata XML (instead of the field object).

The profile ID attribute indicates the metadata profile ID to use.

The xPath attribute may contain the full xPath to the field in the following formats:

*   xPath with a slash  
    For example:  /metadata/myElementName
*   Using a local name function   
    For example: /\*[local-name()='metadata']/\*[local-name()='myElementName']
*   Using only the field name  
    For example: myElementName will be searched as //myElementName

**KalturaAccessControlActionType**

The following set of actions are defined:

1.  **KalturaAccessControlBlockAction - **Block access
2.  **KalturaAccessControlPreviewAction - **Preview – play only the first X seconds of a video

**<a href="/api-docs/#/KalturaAccessControlScope" target="_blank">KalturaAccessControlScope</a>**

The **<a href="/api-docs/#/KalturaAccessControlScope" target="_blank">KalturaAccessControlScope</a>**API contains a predefined list of context variables: 


| contexts  | KalturaAccessControlContextTypeHolderArray | V    | Indicates what contexts should be tested. No context means any context. |
| --------- | ------------------------------------------ | ---- | ------------------------------------------------------------ |
| ip        | string                                     | V    | IP to be used to test geographic location conditions.        |
| ks        | string                                     | V    | Kaltura session to be used to test session and user conditions. |
| referrer  | string                                     | V    | URL to be used to test domain conditions.                    |
| time      | int                                        | V    | Unix timestamp (in seconds) to be used to test entry scheduling, keep null to use now. |
| userAgent | string                                     | V    | Browser or client application to be used to test agent conditions. |

## Examples  

The following examples are in PHP and effectively will be the same across all client libraries. 

>Note that the xpath property may contain the full xpath to the field in three formats:

* Slashed xPath, e.g. /metadata/myElementName
* Using local-name function, e.g. /*[local-name()='metadata']/*[local-name()='myElementName']
* Using only the field name, e.g. myElementName, it will be searched as //myElementName

### Device-specific Scheduling Window  

Condition #1: User agent MATCH 'ipad' (regular expression)

{% highlight php %} 
<?php
$value1 = new KalturaStringValue();
$value1->value = '.*ipad.*';
$condition1 = new KalturaUserAgentCondition();
$condition1->values = array($value1);
{% endhighlight %}


Condition #2: Current time => entry's {metadata_123/ipadSunrise}
    
{% highlight php %}
<?php
$condition2 = new KalturaCompareMetadataCondition();
$condition2->comparison = KalturaSearchConditionComparison::LESS_THAN_OR_EQUAL;
$condition2->xPath = 'ipadSunrise';
$condition2->profileId = 123;
$condition2->value = new KalturaTimeContextField();
{% endhighlight %}
    

Condition #3: Current time <= entry's {metadata_123/ipadSunset}
    
{% highlight php %}
<?php
$condition3 = new KalturaCompareMetadataCondition();
$condition3->comparison = KalturaSearchConditionComparison::GREATER_THAN_OR_EQUAL;
$condition3->xPath = 'ipadSunset';
$condition3->profileId = 123;
$condition3->value = new KalturaTimeContextField();
{% endhighlight %}
    
**Actions: none**
    
{% highlight php %}
<?php
$rule->conditions = array($condition1, $condition2, $condition3);
$rule->stopProcessing = true;
{% endhighlight %}
    
**The next rule should be defined with no conditions and one block action in order to block all requests that didn't stop processing on the first rule.**
    

### Block long-form content on mobile devices

Condition #1: User agent MATCH ‘Mobile devices of brands X, Y, Z’ (regular expression) 
    
{% highlight php %}
<?php
$value1 = new KalturaStringValue();
$value1->value = '.*X.*';
$value2 = new KalturaStringValue();
$value2->value = '.*Y.*';
$value3 = new KalturaStringValue();
$value3->value = '.*Z.*';
$condition1 = new KalturaUserAgentCondition();
$condition1->values = array($value1, $value2, $value3);
{% endhighlight %}
    
Condition #2: Entry’s {metadata_123/FormatType} Equals 'Long Form'
    
{% highlight php %}
<?php
$value1 = new KalturaStringValue();
$value1->value = 'Long Form';
$condition2 = new KalturaMatchMetadataCondition();
$condition2->xPath = 'FormatType';
$condition2->profileId = 123;
$condition2->values = array($value1);
$rule->conditions = array($condition1, $condition2);
{% endhighlight %}
    
**Actions: Block**
    
{% highlight php %}
<?php
$rule->actions = array(new KalturaAccessControlBlockAction());
{% endhighlight %}
    

### Block language-specific content for consumers in a specific geography

Condition #1: Region Equals Quebec (First phase will be limited to countries)
    
{% highlight php %}
<?php
$value1 = new KalturaStringValue();
$value1->value = 'Quebec';
$condition1 = new KalturaCountryCondition();
$condition1->values = array($value1);
{% endhighlight %}
    
Condition #2: entry’s {metadata_123/AudioLanguage} NOT Equals 'French'
    
{% highlight php %}
<?php
$value1 = new KalturaStringValue();
$value1->value = 'French';
$condition2 = new KalturaMatchMetadataCondition();
$condition2->xPath = 'AudioLanguage';
$condition2->profileId = 123;
$condition2->values = array($value1);
$condition2->not = true;
{% endhighlight %}
    
**Actions: Block**
    
{% highlight php %}
<?php
$rule->actions = array(new KalturaAccessControlBlockAction());
{% endhighlight %}
    

### Block content for unidentified devices

Condition #1: User agent NOT MATCH ‘Mobile devices of brands X, Y, Z’ (regular expression)
    
{% highlight php %}
<?php
$value1 = new KalturaStringValue();
$value1->value = '.*X.*';
$value2 = new KalturaStringValue();
$value2->value = '.*Y.*';
$value3 = new KalturaStringValue();
$value3->value = '.*Z.*';
$condition1 = new KalturaUserAgentCondition();
$condition1->values = array($value1, $value2, $value3);
$condition1->not = true;
{% endhighlight %}

**Actions: Block**

{% highlight php %}   
<?php
$rule->actions = array(new KalturaAccessControlBlockAction());
{% endhighlight %}
