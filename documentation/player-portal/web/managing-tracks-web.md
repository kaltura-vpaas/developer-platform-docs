---
layout: page
title: Managing Tracks for Web Player
weight: 110
---
The Kaltura Player uses a comprehensive API to handle all kind of tracks, including video (bitrate), audio, and text (language) tracks. This document demonstrates how to use the API to manage those player tracks.

## Track Availability

Tracks are available only when the video source has loaded. There are two ways to verify that tracks are available:

**Using the `TRACKS_CHANGED` event:**

```javascript
player.addEventListener(player.Event.TRACKS_CHANGED, function(event) {
  var tracks = event.payload.tracks;
  console.log('This source has ' + tracks.length + ' tracks');
});
```

**Using the `ready` promise:**

```javascript
player.ready().then(function() {
  var tracks = player.getTracks();
  console.log('This source has ' + tracks.length + ' tracks');
});
```

## Retrieve Tracks

#### Getting All Track Types

The code below shows how to get all of the player tracks using the `getTracks` method:

```javascript
var tracks = player.getTracks();
console.log('This source has ' + tracks.length + ' tracks');
```

#### Getting Specific Track Types

It's also possible to get a specific kind of track.
The code below shows how to get a specific track by passing a parameter to the `getTracks` method:

```javascript
var videoTracks = player.getTracks(player.Track.VIDEO);
var audioTracks = player.getTracks(player.Track.AUDIO);
var textTracks = player.getTracks(player.Track.TEXT);
console.log('This source has ' + videoTracks.length + ' video tracks');
console.log('This source has ' + audioTracks.length + ' audio tracks');
console.log('This source has ' + textTracks.length + ' text tracks');
```

#### Getting the Current Active Tracks

The code below shows how to get the current active player tracks using the `getActiveTracks` method:

```javascript
var activeTracks = player.getActiveTracks();
console.log('The active video track is: ' + activeTracks.video);
console.log('The active audio track is: ' + activeTracks.audio);
console.log('The active text track is: ' + activeTracks.text);
```

## Video Tracks

This section demonstrates how to manage video tracks 

#### Adaptive Bitrate and Manual Selection

There are two ways to use video tracks (or bitrate): _Adaptive Bitrate_ and _Manual Selection_.

When _Adaptive Bitrate_ is enabled, the player controls the video track selection according to the network conditions. This is the default mode.

When selecting a specific video track manually, the player switches from _Adaptive Bitrate_ mode to _Manual Selection_.

> **Important:** On Safari browsers, only the _Adaptive Bitrate_ mode is available.

#### Getting the Current Mode

The player exposes the current mode using the `isAdaptiveBitrateEnabled` method:

```javascript
if (player.isAdaptiveBitrateEnabled()) {
  console.log('The current bitrate mode is Adaptive Bitrate');
} else {
  console.log('The current bitrate mode is Manual Selection');
}
```

You can also use the `ABR_MODE_CHANGED` event to expose the current mode:

```javascript
player.addEventListener(player.Event.ABR_MODE_CHANGED, function(event) {
  if (event.payload.mode === 'auto') {
    console.log('The player has switched to Adaptive Bitrate');
  } else {
    // manual
    console.log('The player has switched to Manual Selection');
  }
});
```

#### Video Track Selection

To select a specific video track (bitrate), use the `selectTrack` method.

The code below shows how to force the player to play the top bitrate track:

```javascript
var videoTracks = player.getTracks(player.Track.VIDEO);
var topBandwidthTrack;
var topBandwidth = 0;
for (var i = 0; i < videoTracks.length; i++) {
  if (videoTracks[i].bandwidth > topBandwidth) {
    topBandwidthTrack = videoTracks[i];
    topBandwidth = topBandwidthTrack.bandwidth;
  }
}
player.selectTrack(topBandwidthTrack);
```

By selecting a specific video track, the player switches to _Manual Selection_ mode.

To go back to the _Adaptive Bitrate_ mode, use the `enableAdaptiveBitrate` method:

```javascript
player.addEventListener(player.Event.ABR_MODE_CHANGED, function(event) {
  // event.payload.mode === "auto"
});
player.enableAdaptiveBitrate();
```

Once the video track has changed, either automatically or manually, the player triggers a `VIDEO_TRACK_CHANGED` event:

```javascript
player.addEventListener(player.Event.VIDEO_TRACK_CHANGED, function(event) {
  console.log('The new bitrate is: ' + event.payload.selectedVideoTrack.bandwidth);
});
```

## Audio Tracks

This section shows you how to manage audio tracks.

#### Audio Track Selection

To select a specific audio track, use the `selectTrack` method.

The code below shows how to select the _Spanish_ audio track:

```javascript
var audioTracks = player.getTracks(player.Track.AUDIO);
for (var i = 0; i < audioTracks.length; i++) {
  if (audioTracks[i].language === 'es') {
    player.selectTrack(audioTracks[i]);
  }
}
```

Once the audio track has changed, the player triggers an `AUDIO_TRACK_CHANGED` event:

```javascript
player.addEventListener(player.Event.AUDIO_TRACK_CHANGED, function(event) {
  console.log('The new audio track is: ' + event.payload.selectedAudioTrack.label);
});
```

## Text Tracks

This section shows you how to manage text tracks.

#### Text Track Selection

To select a specific text track, use the `selectTrack` method.

The code below shows how to select the _Spanish_ text track:

```javascript
var textTracks = player.getTracks(player.Track.TEXT);
for (var i = 0; i < textTracks.length; i++) {
  if (textTracks[i].language === 'es') {
    player.selectTrack(textTracks[i]);
  }
}
```

Once the text track has changed, the player triggers a `TEXT_TRACK_CHANGED` event:

```javascript
player.addEventListener(player.Event.TEXT_TRACK_CHANGED, function(event) {
  console.log('The new text track is: ' + event.payload.selectedTextTrack.label);
});
```

#### Disabling the Text Track

To disable the text track, use the `hideTextTrack` method.

In this case the player triggers a `TEXT_TRACK_CHANGED` event with 'off' track:

```javascript
player.addEventListener(player.Event.TEXT_TRACK_CHANGED, function(event) {
  // event.payload.selectedTextTrack.label === 'Off'
});
player.hideTextTrack();
```

> ### Text Track default label
>
> A Text Track has language and label properties. The label is set by the label property in the manifest.
> However, in case the manifest does not have a label property - the language property will be set as the tracks label.
> You can set a custom label to a Text Track - read about it [here](/player/web/configuration-playkit-web#configcustomlabels)