<script type="text/javascript" src="//www.gstatic.com/cv/js/sender/v1/cast_sender.js"></script>
<script type="text/javascript">
    var applicationID = '{{ config('castAppId') }}';
    var namespace = 'urn:x-cast:dnd.screens';
    /**
     * Cast initialization timer delay
     **/
    var CAST_API_INITIALIZATION_DELAY = 1000;
    /**
     * Progress bar update timer delay
     **/
    var PROGRESS_BAR_UPDATE_DELAY = 1000;
    /**
     * Session idle time out in miliseconds
     **/
    var SESSION_IDLE_TIMEOUT = 300000;

    /**
     * global variables
     */
    var currentMediaSession = null;
    var currentVolume = 0.5;
    var progressFlag = 1;
    var mediaCurrentTime = 0;
    var session = null;
    var storedSession = null;
    var timer = null;

    /**
     * Call initialization
     */
    if (!chrome.cast || !chrome.cast.isAvailable) {
        setTimeout(initializeCastApi, CAST_API_INITIALIZATION_DELAY);
    }

    /**
     * initialization
     */
    function initializeCastApi() {
        // default app ID to the default media receiver app
        // optional: you may change it to your own app ID/receiver
        var applicationIDs = [
            applicationID
        ];


        // auto join policy can be one of the following three
        // 1) no auto join
        // 2) same appID, same URL, same tab
        // 3) same appID and same origin URL
        var autoJoinPolicyArray = [
            chrome.cast.AutoJoinPolicy.PAGE_SCOPED,
            chrome.cast.AutoJoinPolicy.TAB_AND_ORIGIN_SCOPED,
            chrome.cast.AutoJoinPolicy.ORIGIN_SCOPED
        ];

        // request session
        var sessionRequest = new chrome.cast.SessionRequest(applicationIDs[0]);
        var apiConfig = new chrome.cast.ApiConfig(sessionRequest,
                sessionListener,
                receiverListener,
                autoJoinPolicyArray[1]);

        chrome.cast.initialize(apiConfig, onInitSuccess, onError);
    }

    /**
     * initialization success callback
     */
    function onInitSuccess() {
        //
    }

    /**
     * generic error callback
     * @param {Object} e A chrome.cast.Error object.
     */
    function onError(e) {
        console.log('Error' + e);
    }

    /**
     * generic success callback
     * @param {string} message from callback
     */
    function onSuccess(message) {
        console.log(message);
    }

    /**
     * callback on success for stopping app
     */
    function onStopAppSuccess() {
        console.log('Session stopped');
    }

    /**
     * session listener during initialization
     * @param {Object} e session object
     * @this sessionListener
     */
    function sessionListener(e) {
        console.log('New session ID: ' + e.sessionId);
        session = e;
        if (session.media.length != 0) {
            onMediaDiscovered('sessionListener', session.media[0]);
        }
        session.addMediaListener(
                onMediaDiscovered.bind(this, 'addMediaListener'));
        session.addUpdateListener(sessionUpdateListener.bind(this));
    }

    /**
     * session update listener
     * @param {boolean} isAlive status from callback
     * @this sessionUpdateListener
     */
    function sessionUpdateListener(isAlive) {
        if (!isAlive) {
            session = null;
            if (timer) {
                clearInterval(timer);
            }
            else {
                timer = setInterval(updateCurrentTime.bind(this),
                        PROGRESS_BAR_UPDATE_DELAY);
            }
        }
    }

    /**
     * receiver listener during initialization
     * @param {string} e status string from callback
     */
    function receiverListener(e) {
        if (e === 'available') {
            console.log('receiver found');
        }
        else {
            console.log('receiver list empty');
        }
    }

    /**
     * select a media URL
     * @param {string} m An index for media URL
     */
    function selectMedia(url, pic, title, html) {
        console.log('media selected - ' + title);
        currentMediaURL = url;
        currentMediaTitle = title;
        currentMediaThumb = pic;
        currentMediaHTML = html;
    }

    /**
     * launch app and request session
     */
    function launchApp() {
        console.log('launching app...');
        chrome.cast.requestSession(onRequestSessionSuccess, onLaunchError);
        if (timer) {
            clearInterval(timer);
        }
    }

    /**
     * callback on success for requestSession call
     * @param {Object} e A non-null new session.
     * @this onRequestSesionSuccess
     */
    function onRequestSessionSuccess(e) {
        console.log('session success: ' + e.sessionId);
        saveSessionID(e.sessionId);
        session = e;
        session.addUpdateListener(sessionUpdateListener.bind(this));
        if (session.media.length != 0) {
            onMediaDiscovered('onRequestSession', session.media[0]);
        }
        session.addMediaListener(
                onMediaDiscovered.bind(this, 'addMediaListener'));
    }

    /**
     * callback on launch error
     */
    function onLaunchError() {
        console.log('launch error');
    }

    /**
     * save session ID into localStorage for sharing
     * @param {string} sessionId A string for session ID
     */
    function saveSessionID(sessionId) {
        // Check browser support of localStorage
        if (typeof(Storage) != 'undefined') {
            // Store sessionId and timestamp into an object
            var object = {id: sessionId, timestamp: new Date().getTime()};
            localStorage.setItem('storedSession', JSON.stringify(object));
        }
    }

    /**
     * join session by a given session ID
     */
    function joinSessionBySessionId() {
        if (storedSession) {
            chrome.cast.requestSessionById(storedSession.id);
        }
    }

    /**
     * stop app/session
     */
    function stopApp() {
        session.stop(onStopAppSuccess, onError);
        if (timer) {
            clearInterval(timer);
        }
    }

    /**
     * load media
     * @param {string} mediaURL media URL string
     * @this loadMedia
     */
    function loadMedia(mediaURL) {
        if (!session) {
            console.log('no session');
            return;
        }

        console.log('loading...' + currentMediaURL);

        var mediaInfo = new chrome.cast.media.MediaInfo(currentMediaURL);
        session.sendMessage(namespace, currentMediaHTML, onSuccess.bind(this, "Message sent: "), onError);

        mediaInfo.metadata = new chrome.cast.media.GenericMediaMetadata();
        mediaInfo.metadata.metadataType = chrome.cast.media.MetadataType.GENERIC;
        mediaInfo.contentType = 'video/mp4';

        mediaInfo.metadata.title = currentMediaTitle;
        mediaInfo.metadata.images = [{'url':  currentMediaThumb}];

        var request = new chrome.cast.media.LoadRequest(mediaInfo);
        request.autoplay = true;
        request.currentTime = 0;

        session.loadMedia(request,
                onMediaDiscovered.bind(this, 'loadMedia'),
                onMediaError);

    }

    /**
     * callback on success for loading media
     * @param {string} how info string from callback
     * @param {Object} mediaSession media session object
     * @this onMediaDiscovered
     */
    function onMediaDiscovered(how, mediaSession) {
        console.log('new media session ID:' + mediaSession.mediaSessionId);
        currentMediaSession = mediaSession;
        currentMediaSession.addUpdateListener(onMediaStatusUpdate);
        mediaCurrentTime = currentMediaSession.currentTime;
        if (!timer) {
            timer = setInterval(updateCurrentTime.bind(this),
                    PROGRESS_BAR_UPDATE_DELAY);
        }
    }

    /**
     * callback on media loading error
     * @param {Object} e A non-null media object
     */
    function onMediaError(e) {
        console.log('media error');
    }

    /**
     * get media status initiated by sender when necessary
     * currentMediaSession gets updated
     * @this getMediaStatus
     */
    function getMediaStatus() {
        if (!session || !currentMediaSession) {
            return;
        }

        currentMediaSession.getStatus(null,
                mediaCommandSuccessCallback.bind(this, 'got media status'),
                onError);
    }

    /**
     * callback for media status event
     * @param {boolean} isAlive status from callback
     */
    function onMediaStatusUpdate(isAlive) {
        //
    }

    /**
     * Updates the progress bar shown for each media item.
     */
    function updateCurrentTime() {
        if (!session || !currentMediaSession) {
            return;
        }

        if (currentMediaSession.media && currentMediaSession.media.duration != null) {
            var cTime = currentMediaSession.getEstimatedTime();
        }
        else {
            if (timer) {
                clearInterval(timer);
            }
        }
    }

    /**
     * callback on success for media commands
     * @param {string} info A message string
     */
    function onSeekSuccess(info) {
        console.log(info);
        setTimeout(function() {progressFlag = 1},PROGRESS_BAR_UPDATE_DELAY);
    }

    /**
     * callback on success for media commands
     * @param {string} info A message string
     */
    function mediaCommandSuccessCallback(info) {
        console.log(info);
    }
</script>