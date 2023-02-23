/******/ (() => { // webpackBootstrap
/******/ 	var __webpack_modules__ = ({

/***/ "./node_modules/axios/index.js":
/*!*************************************!*\
  !*** ./node_modules/axios/index.js ***!
  \*************************************/
/***/ (() => {

throw new Error("Module build failed: Error: ENOENT: no such file or directory, open '/Users/giuseppegarozzo/Desktop/Boolean/Final Project/boolbnb-final-project/node_modules/axios/index.js'");

/***/ }),

/***/ "./resources/js/common.js":
/*!********************************!*\
  !*** ./resources/js/common.js ***!
  \********************************/
/***/ ((__unused_webpack_module, __unused_webpack_exports, __webpack_require__) => {

__webpack_require__(/*! bootstrap */ "./node_modules/bootstrap/dist/js/bootstrap.esm.js");
window.axios = __webpack_require__(/*! axios */ "./node_modules/axios/index.js");
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

/***/ }),

/***/ "./node_modules/bootstrap/dist/js/bootstrap.esm.js":
/*!*********************************************************!*\
  !*** ./node_modules/bootstrap/dist/js/bootstrap.esm.js ***!
  \*********************************************************/
/***/ (() => {

throw new Error("Module build failed: Error: ENOENT: no such file or directory, open '/Users/giuseppegarozzo/Desktop/Boolean/Final Project/boolbnb-final-project/node_modules/bootstrap/dist/js/bootstrap.esm.js'");

/***/ })

/******/ 	});
/************************************************************************/
/******/ 	// The module cache
/******/ 	var __webpack_module_cache__ = {};
/******/ 	
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/ 		// Check if module is in cache
/******/ 		var cachedModule = __webpack_module_cache__[moduleId];
/******/ 		if (cachedModule !== undefined) {
/******/ 			return cachedModule.exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = __webpack_module_cache__[moduleId] = {
/******/ 			// no module.id needed
/******/ 			// no module.loaded needed
/******/ 			exports: {}
/******/ 		};
/******/ 	
/******/ 		// Execute the module function
/******/ 		__webpack_modules__[moduleId](module, module.exports, __webpack_require__);
/******/ 	
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/ 	
/************************************************************************/
var __webpack_exports__ = {};
// This entry need to be wrapped in an IIFE because it need to be isolated against other modules in the chunk.
(() => {
/*!******************************!*\
  !*** ./resources/js/back.js ***!
  \******************************/
__webpack_require__(/*! ./common */ "./resources/js/common.js");

// MY JavaScript

//app.blade.php
var controlBtn = document.querySelector('.controls');
var dropMenu = controlBtn.querySelector('.drop-menu');
if (controlBtn && dropMenu) {
  controlBtn.addEventListener('click', function () {
    dropMenu.classList.toggle('hidden');
  });
}

// create.blade.php
var addButton = document.querySelector("#add-image");
var imageFields = document.querySelector("#image-fields");
if (addButton && imageFields) {
  var count = 1;
  addButton.addEventListener("click", function () {
    var newField = document.createElement("div");
    newField.innerHTML = "\n        <div class=\"mb-3\">\n        <label for=\"image\" class=\"form-label\">Immagine ".concat(++count, "</label>\n        <input type=\"file\" class=\"form-control\" id=\"image\" name=\"image[]\">\n        </div>\n    ");
    imageFields.appendChild(newField);
  });
}

// index.blade.php
var deleteBtn = document.querySelectorAll('.delete-button');
var deletePopup = document.querySelector('.delete-popup-backdrop');
var cancelBtn = document.querySelector('.cancel-button');
var deleteSuccess = document.querySelector('.alert-danger');
if (deleteBtn && deletePopup && cancelBtn) {
  var hideSuccessMessage = function hideSuccessMessage() {
    deleteSuccess.classList.add('d-none');
  };
  deleteBtn.forEach(function (element) {
    element.addEventListener('click', function () {
      console.log('cliccato');
      deletePopup.classList.remove('hidden');
      document.body.style.overflow = 'hidden';
    });
  });
  cancelBtn.addEventListener('click', function () {
    deletePopup.classList.add('hidden');
    document.body.style.overflow = 'visible';
  });
  ;
  if (document.body.contains(deleteSuccess)) {
    setTimeout(hideSuccessMessage, 10000);
  }
  ;
}
})();

/******/ })()
;