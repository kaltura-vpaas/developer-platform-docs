---
layout: page
title: Manage Kaltura Sub-Accounts
weight: 110
---

Kaltura’s Multi Account Management feature allows you to configure and edit multiple content accounts in Kaltura (AKA KMC accounts, partner accounts) from a central location. Multi Account Management is suitable for Kaltura’s customers that manage multiple content accounts in Kaltura. For example:

- Universities – When each school/department manages its content in a separate KMC account
- Enterprise - When each Office/Department manages its content in a separate KMC account
- TV/Media Network – when each channel is managing its content in a separate KMC account Kaltura 
- SaaS Value Added Resellers - Organizations that resell Kaltura’s SaaS packages and need central control over the account sold by them
- Kaltura’s SaaS OEM partners – Organizations that fully integrate Kaltura into their service offering yet want to remain on the SaaS platform with ability to manage the KMC accounts sold with their service.

Note: The Multi Account Management feature is enabled for eligible customers. Contact your Kaltura representative to enable this option.

## How are Multiple Accounts Associated within a Single Organization?

Content accounts are managed at Kaltura with complete content separation and API security. Each content account is accessed separately from the KMC, by users that are specifically authorized by the account administrator.

You can read more about the user experience to create and manage sub accounts that is built into the KMC  here: https://knowledge.kaltura.com/help/administration-pages

## Creating Sub Accounts via API

For an in depth example for creating, listing and updating a partner account, refer to [this code example](https://gist.github.com/zoharbabin/c843a8c86122892d78ebfd5cf3b1182e)

The API endpoint group related to creating and working with sub accounts is /console/service/partner

In the first example a sub account is created using /console/service/partner/action/register

Next, all the sub-accounts for a given parent are listed via:/console/service/partner/action/list

Finally, the /console/service/varConsole/action/updateStatus is used to update the status of the partner. 

Here is a fully working web-app that queries a collection of sub-accounts: https://github.com/kaltura-vpaas/kaltura-accounts-entries-export/blob/main/kaltura-entries-export-excel.php#L136

## See Also:

- [partner.count](/console/service/partner/action/count)
- [partner.get](/console/service/partner/action/get)
- [partner.getInfo](/console/service/partner/action/getInfo)
- [partner.getPublicInfo](/console/service/partner/action/getPublicInfo)
- [partner.getSecrets](/console/service/partner/action/getSecrets)
- [partner.getStatistics](/console/service/partner/action/getStatistics)
- [partner.getUsage](/console/service/partner/action/getUsage)
- [partner.list](/console/service/partner/action/list)
- [partner.listFeatureStatus](/console/service/partner/action/listFeatureStatus)
- [partner.listPartnersForUser](/console/service/partner/action/listPartnersForUser)
- [partner.register](/console/service/partner/action/register)
- [partner.registrationValidation](/console/service/partner/action/registrationValidation)
- [partner.update](/console/service/partner/action/update)