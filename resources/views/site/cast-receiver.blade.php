<!DOCTYPE html>
<html>
<head>
    <link href="/css/bootstrap.min.css" rel="stylesheet">
    <style type="text/css">
        body {
            overflow:hidden;
        }
        div#message {
            height:720PX;
            width:1280PX;
            text-align:center;
            border:0px solid silver;
            display: table-cell;
            vertical-align:middle;
            color:#FFFFFF;
            background-color:#000000;
            font-weight:bold;
            font-family:Verdana, Geneva, sans-serif;
            font-size:40px;
        }
    </style>
    <script type="text/javascript" src="//www.gstatic.com/cast/sdk/libs/receiver/2.0.0/cast_receiver.js"></script>
    <title>D&D Screen Receiver</title>
</head>
<body>
<div id="message">Talk to me</div>
<video id='video' loop />
<script type="text/javascript">
    // Turn on debugging so that you can see what is going on.  Please turn this off
    // on your production receivers.
    cast.receiver.logger.setLevelValue(cast.receiver.LoggerLevel.DEBUG);

    console.log('Starting receiver application');
    window.mediaElement = document.getElementById('video');
    // Create the media manager. This will handle all media messages by default.
    window.mediaManager = new cast.receiver.MediaManager(window.mediaElement);

    // Start the receiver manager
    console.log('Starting receiver manager');
    window.castReceiverManager = cast.receiver.CastReceiverManager.getInstance();
    castReceiverManager.onSenderDisconnected = function (event) {
        console.log("Sender disconnected");
        if (window.castReceiverManager.getSenders().length == 0 &&
                event.reason == cast.receiver.system.DisconnectReason.REQUESTED_BY_SENDER) {
            window.close();
        }
    };

    // create a CastMessageBus to handle messages for a custom namespace
    window.messageBus = window.castReceiverManager.getCastMessageBus('urn:x-cast:dnd.screens');

    // handler for the CastMessageBus message event
    window.messageBus.onMessage = function(event) {
        console.log('Message [' + event.senderId + ']: ' + event.data);
        // display the message from the sender
        document.getElementById("message").innerHTML=event.data;
        // inform all senders on the CastMessageBus of the incoming message event
        // sender message listener will be invoked
        window.messageBus.send(event.senderId, event.data);
    }

    // The default inactivity is normally 10 seconds, since we are encouraging you
    // to debug this receiver, we are setting it to 10 minutes. As setting a break
    // point might inadvertently trigger a timeout. The purpose of the timer is to
    // speed the recognition of disconnection of a sender.  As the TCP/IP standard
    // mechanisms can be quite slow.
    castReceiverManager.start({maxInactivity: 600});
</script>
</body>
</html>