debugger;

var options = {
    width: 640,
    height: 360,
    plugins: {
        videoJsResolutionSwitcher: {
            default: 480,
            dynamicLabel: true
        }
    }
};

var player = videojs('content_video', options);

// player.on(['loadstart', 'play', 'playing', 'firstplay', 'pause', 'ended', 'adplay', 'adplaying', 'adfirstplay', 'adpause', 'adended', 'contentplay', 'contentplaying', 'contentfirstplay', 'contentpause', 'contentended', 'contentupdate', 'loadeddata', 'loadedmetadata'], function (e) {
//     console.warn('VIDEOJS player event: ', e.type);
// });
