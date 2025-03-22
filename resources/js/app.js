import './bootstrap';
import videojs from 'video.js';
import rewindFastForward from '@video-js-plugins/videojs-rewind-fast-forward';

// Registrasi plugin
videojs.registerPlugin('rewindFastForward', rewindFastForward);
