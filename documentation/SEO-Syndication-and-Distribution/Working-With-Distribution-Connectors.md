---
layout: page
title: Distributing to Social Networks
weight: 110
---

Kaltura has a [rich system](https://knowledge.kaltura.com/help/content-distribution-and-syndication#content-syndication) for integrating with many social networks. The Kaltura API is also capable of extracting data from or editing the distribution system. 

As an example, if one of your entries `entryId` is already distributed to Youtube and you want to retrieve the id of the content on the Youtube, the following example illustrates how:

First query [distributionProfile.list](/console/service/distributionProfile/action/list) to find the `id` of the Youtube distribution profile. Provide this `id` to the `distributionProfileIdEqual` and filter as well by `entryIdEqual`. The result will look like this:

```json
"objects": [
    {
      "id": 100417113,
      "createdAt": 1625373489,
      "updatedAt": 1625374788,
      "submittedAt": 1625374788,
      "entryId": "1_3w9gfolz",
      "partnerId": 3465853,
      "distributionProfileId": 2917543,
      "status": 2,
      "sunStatus": 2,
      "thumbAssetIds": "",
      "flavorAssetIds": "1_uneafeix",
      "assetIds": "",
      "sunrise": 1623029234,
      "remoteId": "XEwe-9kODZM",
      "validationErrors": [],
      "hasSubmitResultsLog": false,
      "hasSubmitSentDataLog": false,
      "hasUpdateResultsLog": false,
      "hasUpdateSentDataLog": false,
      "hasDeleteResultsLog": false,
      "hasDeleteSentDataLog": false,
      "objectType": "KalturaEntryDistribution"
    },
```

The `remoteId` field will be the Youtube id of the video that has been distributed. Using the youtube convention

`https://www.youtube.com/watch?v=<entryId>`

you can subsitute the `remoteId` and the video will be playable.

There are many ways to access the distribution api. Refer to these resources for a complete list:

/console/service/entryDistribution

- [entryDistribution.add](/console/service/entryDistribution/action/add)
- [entryDistribution.delete](/console/service/entryDistribution/action/delete)
- [entryDistribution.get](/console/service/entryDistribution/action/get)
- [entryDistribution.list](/console/service/entryDistribution/action/list)
- [entryDistribution.retrySubmit](/console/service/entryDistribution/action/retrySubmit)
- [entryDistribution.serveReturnedData](/console/service/entryDistribution/action/serveReturnedData)
- [entryDistribution.serveSentData](/console/service/entryDistribution/action/serveSentData)
- [entryDistribution.submitAdd](/console/service/entryDistribution/action/submitAdd)
- [entryDistribution.submitDelete](/console/service/entryDistribution/action/submitDelete)
- [entryDistribution.submitFetchReport](/console/service/entryDistribution/action/submitFetchReport)
- [entryDistribution.submitUpdate](/console/service/entryDistribution/action/submitUpdate)
- [entryDistribution.update](/console/service/entryDistribution/action/update)
- [entryDistribution.validate](/console/service/entryDistribution/action/validate)



/console/service/distributionProfile

- [distributionProfile.add](/console/service/distributionProfile/action/add)
- [distributionProfile.delete](/console/service/distributionProfile/action/delete)
- [distributionProfile.get](/console/service/distributionProfile/action/get)
- [distributionProfile.list](/console/service/distributionProfile/action/list)
- [distributionProfile.listByPartner](/console/service/distributionProfile/action/listByPartner)
- [distributionProfile.update](/console/service/distributionProfile/action/update)
- [distributionProfile.updateStatus](/console/service/distributionProfile/action/updateStatus)



/console/service/distributionProvider

