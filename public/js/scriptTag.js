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
/******/ 			Object.defineProperty(exports, name, {
/******/ 				configurable: false,
/******/ 				enumerable: true,
/******/ 				get: getter
/******/ 			});
/******/ 		}
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
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 205);
/******/ })
/************************************************************************/
/******/ ({

/***/ 205:
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(206);


/***/ }),

/***/ 206:
/***/ (function(module, exports) {

//let url = 'https://heightweight.test';
var url = 'https://app.seezerapps.com';
var checkoutForm = document.querySelector('.product-form.product-form-product-template');
if (checkoutForm) {
	console.log(meta.product);
	var xhttp = new XMLHttpRequest();

	xhttp.onreadystatechange = function () {
		if (this.readyState == 4 && this.status == 200) {
			var response = JSON.parse(this.responseText);
			if (response.visible) {
				buildStyles();
				buildElements(checkoutForm);
			}
		}
	};
	xhttp.open("GET", url + '/client/check/' + meta.product.id + '?t=' + Date.now(), false);
	xhttp.withCredentials = true;
	xhttp.send();
}

function buildStyles() {
	var head = document.head;

	var style = document.createElement('style');
	head.appendChild(style);
	style = style.sheet;
	style.type = 'text/css';
	style.insertRule('#hw-button {margin-bottom: .5rem; background-color: #363636; border-color: transparent; color: #f5f5f5; border-width: 1px; cursor: pointer; justify-content: center; padding-bottom: calc(.375em - 1px); padding-left: .75em; padding-right: .75em; padding-top: calc(.375em - 1px); text-align: center; white-space: nowrap; border-radius: 4px; box-shadow: none; display: inline-flex; font-size: 1rem; height: 2.25em; line-height: 1.5; position: relative; vertical-align: top; user-select: none;}', 0);
	style.insertRule('#hw-button:hover {background-color: #2f2f2f; border-color: transparent; color: #f5f5f5;}', 1);
	style.insertRule('#hw-frame {height: 0; width: 100%; transition: height 1s; display: block}', 2);
	style.insertRule('#hw-frame.open {height: 400px;}', 3);
}

function buildElements(checkoutForm) {
	var openButton = document.createElement('button');
	openButton.id = 'hw-button';
	openButton.innerText = 'Calculate weight and height';
	var iframe = document.createElement('iframe');
	iframe.id = 'hw-frame';
	iframe.src = url + '/client/' + meta.product.id;
	iframe.style.border = 'none';
	iframe.scrolling = 'no';
	iframe.allowtransparency = "true";
	openButton.addEventListener('click', toggleForm);
	checkoutForm.insertAdjacentElement('afterend', openButton);
	openButton.insertAdjacentElement('afterend', iframe);
	window.addEventListener("message", sizeCalculated, false);
}

function toggleForm() {
	document.querySelector('#hw-frame').classList.toggle('open');
}

function sizeCalculated(event) {
	var suggestedSize = event.data.suggestedSize;
	document.querySelector('option[value=\'' + suggestedSize + '\']').parentElement.value = event.data.suggestedSize;
}

/***/ })

/******/ });