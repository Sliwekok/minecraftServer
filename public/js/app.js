/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};
/******/
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/
/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId]) {
/******/ 			return installedModules[moduleId].exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			i: moduleId,
/******/ 			l: false,
/******/ 			exports: {}
/******/ 		};
/******/
/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);
/******/
/******/ 		// Flag the module as loaded
/******/ 		module.l = true;
/******/
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/
/******/
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;
/******/
/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;
/******/
/******/ 	// define getter function for harmony exports
/******/ 	__webpack_require__.d = function(exports, name, getter) {
/******/ 		if(!__webpack_require__.o(exports, name)) {
/******/ 			Object.defineProperty(exports, name, { enumerable: true, get: getter });
/******/ 		}
/******/ 	};
/******/
/******/ 	// define __esModule on exports
/******/ 	__webpack_require__.r = function(exports) {
/******/ 		if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 			Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 		}
/******/ 		Object.defineProperty(exports, '__esModule', { value: true });
/******/ 	};
/******/
/******/ 	// create a fake namespace object
/******/ 	// mode & 1: value is a module id, require it
/******/ 	// mode & 2: merge all properties of value into the ns
/******/ 	// mode & 4: return value when already ns object
/******/ 	// mode & 8|1: behave like require
/******/ 	__webpack_require__.t = function(value, mode) {
/******/ 		if(mode & 1) value = __webpack_require__(value);
/******/ 		if(mode & 8) return value;
/******/ 		if((mode & 4) && typeof value === 'object' && value && value.__esModule) return value;
/******/ 		var ns = Object.create(null);
/******/ 		__webpack_require__.r(ns);
/******/ 		Object.defineProperty(ns, 'default', { enumerable: true, value: value });
/******/ 		if(mode & 2 && typeof value != 'string') for(var key in value) __webpack_require__.d(ns, key, function(key) { return value[key]; }.bind(null, key));
/******/ 		return ns;
/******/ 	};
/******/
/******/ 	// getDefaultExport function for compatibility with non-harmony modules
/******/ 	__webpack_require__.n = function(module) {
/******/ 		var getter = module && module.__esModule ?
/******/ 			function getDefault() { return module['default']; } :
/******/ 			function getModuleExports() { return module; };
/******/ 		__webpack_require__.d(getter, 'a', getter);
/******/ 		return getter;
/******/ 	};
/******/
/******/ 	// Object.prototype.hasOwnProperty.call
/******/ 	__webpack_require__.o = function(object, property) { return Object.prototype.hasOwnProperty.call(object, property); };
/******/
/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "/";
/******/
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 0);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/js/app.js":
/*!*****************************!*\
  !*** ./resources/js/app.js ***!
  \*****************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */
//enable bootstrap tooltips
function enableTooltips() {
  $('[data-toggle="tooltip"]').tooltip();
}

enableTooltips();

__webpack_require__(/*! ./settings.js */ "./resources/js/settings.js");

__webpack_require__(/*! ./create.js */ "./resources/js/create.js");

__webpack_require__(/*! ./index.js */ "./resources/js/index.js");

/***/ }),

/***/ "./resources/js/create.js":
/*!********************************!*\
  !*** ./resources/js/create.js ***!
  \********************************/
/*! no static exports found */
/***/ (function(module, exports) {

// that file mostly takes care of validating and working around on file views/settings/create
$(function () {
  // add some animations while creating new server
  // animate 'add' button to show 1st part of form
  $('#create > #add').click(function () {
    $('#create > #add, #messageNoServers').animate({
      opacity: 0,
      left: "-500",
      queue: false
    }, 500).hide(0);
    $("#create > #dataAboutServer").fadeIn(500);
  }); // animate 'next' button to slide to 2nd part of form

  $('#create').find("#generalData > .next").click(function () {
    // sprawdzanie czy nazwa serwera, wersja i jego opis jest uzupełniony poprawnie
    if ($('#serverName').val().length == 0 || $('#serverName').val().length > 64) {
      $('#errorServerName').text('Wprowadź poprawną długość znaków').show(0);
      return;
    } else {
      $('#errorServerName').hide(0);
    }

    if ($('#serverDescription').val().length > 128) {
      $('#errorServerDescription').text('Wprowadź poprawną długość znaków').show(0);
      return;
    }

    if ($('#version').val().length == 0 || $('#version').val().length > 10) {
      $('#errorVersion').text('Podaj poprawną wersję serwera').show(0);
      return;
    } else {
      $('#errorServerDescription').hide(0);
    }

    $('#create').find('#generalData').animate({
      opacity: 0,
      left: "-500",
      queue: false
    }, 500).hide(0);
    $('#create').find('#serverSettings').animate({
      opacity: 1,
      left: "0",
      queue: false
    }, 500).css("display", "block");
  }); //animate button 'previous' to slide back to previous part of form

  $('#create').find("#serverSettings > .previous").click(function () {
    $('#create').find('#serverSettings').animate({
      opacity: 0,
      left: "500",
      queue: false
    }, 500).hide(0);
    $('#create').find('#generalData').animate({
      opacity: 1,
      left: "0",
      queue: false
    }, 500).css("display", "block");
  }); // show current amount of characters, to prevent too long names

  $('#create').find("#serverName").keyup(function () {
    var chars = $(this).val().length;
    $('#maxNameLength > .currentAmount').text(chars);

    if (chars > 64) {
      $('#maxNameLength').attr("style", "color: rgb(255, 104, 104) !important");
    }

    if (chars <= 64) {
      $('#maxNameLength').attr("style", "color: rgb(104, 180, 255) !important");
    }
  });
  $('#create').find('#serverDescription').keyup(function () {
    var chars = $(this).val().length;
    $('#maxDescriptionLength > .currentAmount').text(chars);

    if (chars > 128) {
      $('#maxDescriptionLength').attr("style", "color: rgb(255, 104, 104) !important");
    }

    if (chars <= 128) {
      $('#maxDescriptionLength').attr("style", "color: rgb(104, 180, 255) !important");
    }
  });
});

/***/ }),

/***/ "./resources/js/index.js":
/*!*******************************!*\
  !*** ./resources/js/index.js ***!
  \*******************************/
/*! no static exports found */
/***/ (function(module, exports) {

$(function () {
  var container = $('#serverFound'); // depending on status (given in class and data parameter) change #generalData background-color

  function changeBackgroundStatus() {
    var box = container.find('#generalData'),
        status = box.attr("data-server-status");
    color = '';

    switch (status) {
      case 'online':
        color = 'rgb(142, 255, 90)';
        break;

      case 'offline':
        color = 'rgb(255, 104, 104)';
        break;

      case 'banned':
        color = 'rgb(255, 104, 104)';
        break;
    }

    box.find('#onlineStatus').css('background-color', color);
  }

  changeBackgroundStatus();
  container.find('p#copy[data-toggle="tooltip"]') // copy ip of server 
  .click(function () {
    // var tekst = navigator.clipboard.writeText(zmienna.val());
    alert('WIP - potrzeba HTTPS / localhosta by dzialalo, Copy:' + $(this).text()); // let user know he has copied ip

    $(this).attr("data-original-title", "Skopiowano!").tooltip('show');
  }) // on leaving cursor change back to original title
  .mouseover(function () {
    $(this).attr("data-original-title", "Kliknij aby skopiować!");
  }); // on hover over dashboard .menuItem show arrow

  $('#dashboard').find('.menuItem').hover(function () {
    $(this).find('span.arrowRedirect').toggle();
  });
  container.find('#serverAction').click(function () {
    var caption = $(this).find('p#caption');
    caption.html('Szukanie diamentów ...').css({
      backgroundcolor: 'rgb(128, 128, 128)',
      userselect: 'none'
    });
    $.ajax({
      url: '/settings/action',
      type: 'get',
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      error: function error(_error) {
        caption.html('nie działa :(((( <i class="icon-off"></i>').css({
          backgroundcolor: 'rgb(142, 255, 90)',
          userselect: 'auto'
        });
        console.log(_error);
        refreshDiv(container.find('#generalData'), '/settings/');
      },
      success: function success() {
        caption.html('działa!!! <i class="icon-off"></i>').css({
          backgroundcolor: 'rgb(142, 255, 90)',
          userselect: 'auto'
        });
        refreshDiv(container.find('#generalData'), '/settings/');
      }
    }); // refresh the container with new data

    function refreshDiv(div, url) {
      var parentDiv = div.parent(),
          loadedDiv = url + ' #generalData'; // jquery .load loads into that container, so we need to go 1 div upper 

      parentDiv.load(loadedDiv, function () {
        changeBackgroundStatus();
        enableTooltips();
      });
    }
  });
});

/***/ }),

/***/ "./resources/js/settings.js":
/*!**********************************!*\
  !*** ./resources/js/settings.js ***!
  \**********************************/
/*! no static exports found */
/***/ (function(module, exports) {

$(function () {
  // on click on .menuItem in dashboard.blade change current site    
  $('.redirect').click(function () {
    window.location.href = $(this).attr("data-page-redirect");
    if ($(this).attr("data-page-redirect") == "/settings/account") window.location.href = "/account";
  }); // if alert is visible - autofade him after 15 seconds
  // wip

  setTimeout(function () {
    $('alert').alert('close');
  }, 1500);
});

/***/ }),

/***/ "./resources/sass/app.scss":
/*!*********************************!*\
  !*** ./resources/sass/app.scss ***!
  \*********************************/
/*! no static exports found */
/***/ (function(module, exports) {

// removed by extract-text-webpack-plugin

/***/ }),

/***/ 0:
/*!*************************************************************!*\
  !*** multi ./resources/js/app.js ./resources/sass/app.scss ***!
  \*************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

__webpack_require__(/*! D:\Programy\Laragon\laragon\www\pizzeria\resources\js\app.js */"./resources/js/app.js");
module.exports = __webpack_require__(/*! D:\Programy\Laragon\laragon\www\pizzeria\resources\sass\app.scss */"./resources/sass/app.scss");


/***/ })

/******/ });