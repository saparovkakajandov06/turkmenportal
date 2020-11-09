(function (global, factory) {
  typeof exports === 'object' && typeof module !== 'undefined' ? module.exports = factory(require('video.js'), require('global/document')) :
  typeof define === 'function' && define.amd ? define(['video.js', 'global/document'], factory) :
  (global.videojsContribQualityLevels = factory(global.videojs,global.document));
}(this, (function (videojs,document) { 'use strict';

  videojs = videojs && videojs.hasOwnProperty('default') ? videojs['default'] : videojs;
  document = document && document.hasOwnProperty('default') ? document['default'] : document;

  function _inheritsLoose(subClass, superClass) {
    subClass.prototype = Object.create(superClass.prototype);
    subClass.prototype.constructor = subClass;
    subClass.__proto__ = superClass;
  }

  function _assertThisInitialized(self) {
    if (self === void 0) {
      throw new ReferenceError("this hasn't been initialised - super() hasn't been called");
    }
    return self;
  }
  var QualityLevel =
  function QualityLevel(representation) {
    var level = this;
    if (videojs.browser.IS_IE8) {
      level = document.createElement('custom');

      for (var prop in QualityLevel.prototype) {
        if (prop !== 'constructor') {
          level[prop] = QualityLevel.prototype[prop];
        }
      }
    }
    level.id = representation.id;
    level.label = level.id;
    level.width = representation.width;
    level.height = representation.height;
    level.bitrate = representation.bandwidth;
    level.enabled_ = representation.enabled;
    Object.defineProperty(level, 'enabled', {
      get: function get() {
        return level.enabled_();
      },
      set: function set(enable) {
        level.enabled_(enable);
      }
    });
    return level;
  };
  var QualityLevelList =
  function (_videojs$EventTarget) {
    _inheritsLoose(QualityLevelList, _videojs$EventTarget);
    function QualityLevelList() {
      var _this;
      _this = _videojs$EventTarget.call(this) || this;
      var list = _assertThisInitialized(_assertThisInitialized(_this));
      if (videojs.browser.IS_IE8) {
        list = document.createElement('custom');

        for (var prop in QualityLevelList.prototype) {
          if (prop !== 'constructor') {
            list[prop] = QualityLevelList.prototype[prop];
          }
        }
      }
      list.levels_ = [];
      list.selectedIndex_ = -1;
      Object.defineProperty(list, 'selectedIndex', {
        get: function get() {
          return list.selectedIndex_;
        }
      });
      Object.defineProperty(list, 'length', {
        get: function get() {
          return list.levels_.length;
        }
      });
      return list || _assertThisInitialized(_this);
    }
    var _proto = QualityLevelList.prototype;

    _proto.addQualityLevel = function addQualityLevel(representation) {
      var qualityLevel = this.getQualityLevelById(representation.id);

      if (qualityLevel) {
        return qualityLevel;
      }

      var index = this.levels_.length;
      qualityLevel = new QualityLevel(representation);

      if (!('' + index in this)) {
        Object.defineProperty(this, index, {
          get: function get() {
            return this.levels_[index];
          }
        });
      }

      this.levels_.push(qualityLevel);
      this.trigger({
        qualityLevel: qualityLevel,
        type: 'addqualitylevel'
      });
      return qualityLevel;
    };

    _proto.removeQualityLevel = function removeQualityLevel(qualityLevel) {
      var removed = null;

      for (var i = 0, l = this.length; i < l; i++) {
        if (this[i] === qualityLevel) {
          removed = this.levels_.splice(i, 1)[0];

          if (this.selectedIndex_ === i) {
            this.selectedIndex_ = -1;
          } else if (this.selectedIndex_ > i) {
            this.selectedIndex_--;
          }

          break;
        }
      }

      if (removed) {
        this.trigger({
          qualityLevel: qualityLevel,
          type: 'removequalitylevel'
        });
      }

      return removed;
    };
    _proto.getQualityLevelById = function getQualityLevelById(id) {
      for (var i = 0, l = this.length; i < l; i++) {
        var level = this[i];

        if (level.id === id) {
          return level;
        }
      }

      return null;
    };
    _proto.dispose = function dispose() {
      this.selectedIndex_ = -1;
      this.levels_.length = 0;
    };

    return QualityLevelList;
  }(videojs.EventTarget);

  QualityLevelList.prototype.allowedEvents_ = {
    change: 'change',
    addqualitylevel: 'addqualitylevel',
    removequalitylevel: 'removequalitylevel'
  };

  for (var event in QualityLevelList.prototype.allowedEvents_) {
    QualityLevelList.prototype['on' + event] = null;
  }

  var version = "2.0.9";

  var registerPlugin = videojs.registerPlugin || videojs.plugin;
  var initPlugin = function initPlugin(player, options) {
    var originalPluginFn = player.qualityLevels;
    var qualityLevelList = new QualityLevelList();

    var disposeHandler = function disposeHandler() {
      qualityLevelList.dispose();
      player.qualityLevels = originalPluginFn;
      player.off('dispose', disposeHandler);
    };

    player.on('dispose', disposeHandler);

    player.qualityLevels = function () {
      return qualityLevelList;
    };

    player.qualityLevels.VERSION = version;
    return qualityLevelList;
  };
  var qualityLevels = function qualityLevels(options) {
    return initPlugin(this, videojs.mergeOptions({}, options));
  };
  registerPlugin('qualityLevels', qualityLevels);
  qualityLevels.VERSION = version;
  return qualityLevels;
})));
