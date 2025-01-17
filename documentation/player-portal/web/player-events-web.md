---
layout: page
title:  Player Events for Web
weight: 110
---

The player event system uses an event target-like API to register, unregister and dispatch events. The event's main purpose is to notify the player components about changes to the player state, ads, video progress, etc.

## Player Event Types

### Core Events

Player core events consist of two event types:

- **HTML5 Video Events** - These are various events sent by the browser when handling media that is embedded using the `<video>` element. The player runs on top of the HTML video element, which may trigger the events. Information about these types of events can be found [here](https://developer.mozilla.org/en-US/docs/Web/Guide/Events/Media_events).

- **Player Custom Events** - These are **special** events that indicate a change in the state of the player that **does not exist in the HTML5 video event list** and that are related to the integral behavior of the player. These can include ads, switching to fullscreen, and tracks events.

**A core event enum can be access in the following way:**

```js
player.Event.Core.EVENT_NAME;
```

The full core events list can be found [here](https://github.com/kaltura/playkit-js/blob/master/src/event/event-type.js). 

### UI Events

Player UI events are events which triggers due to user interaction with the player UI.

#### Accessing UI Event Enums

A UI event enum can be access in the following way:

```js
player.Event.UI.EVENT_NAME;
```

The full UI events list can be found [here](/player/web/ui/ui-events)

## Registering to Player Events

You can listen to player events by adding an event listener to the player object, for example:

```javascript
player.addEventListener(player.Event.Core.TRACKS_CHANGED, event => {
  const payload = event.payload;
  // Do something with the payload
});
```

## Dispatching Events From the Player

You can dispatch either custom events or player events with the code below: 

#### Dispatch Your Own Custom Event

```javascript
player.dispatchEvent(
  new FakeEvent('myCustomEventName', {
    myCustomPayloadProp1: 'Hello',
    myCustomPayloadProp2: 'World'
  })
);
```

#### Dispatch An Existing Player Event

```javascript
player.dispatchEvent(new FakeEvent(player.Event.Core.SEEKED));
```

## Player Readiness

The player ready promise indicates the that player has done loading the media and can start playing. The promise is resolved when the `TRACKS_CHANGED` event is dispatched.
A basic usage of this feature looks like this:

```javascript
player.ready().then(() => {
  var tracks = player.getTracks();
});
```
