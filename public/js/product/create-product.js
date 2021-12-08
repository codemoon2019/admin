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
/******/ 	return __webpack_require__(__webpack_require__.s = 1);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/js/product/create-product.js":
/*!************************************************!*\
  !*** ./resources/js/product/create-product.js ***!
  \************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

$(document).ready(function () {
  var ckEditor = CKEDITOR;
  var submit = false;
  var productDescription = ckEditor.instances['txtProductDescription'];
  $('.single-select').select2({
    theme: 'bootstrap4',
    width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
    placeholder: $(this).data('placeholder'),
    allowClear: Boolean($(this).data('allow-clear'))
  });
  $('#create-product').submit(function (event) {
    event.preventDefault();
    submit = true;
    var form = $(this);
    var formData = new FormData(this);
    formData.append('description', productDescription.getData());
    var url = form.attr('action');

    if (validateFields() == 0) {
      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });
      $.ajax({
        type: "POST",
        url: url,
        data: formData,
        // serializes the form's elements.\
        cache: false, 
        contentType: false,
        processData: false,
        beforeSend: function beforeSend() {
          Swal.fire({
            html: 'Please wait while creating new product ...',
            allowOutsideClick: false,
            showConfirmButton: false,
            willOpen: function willOpen() {
              Swal.showLoading();
            }
          });
        },
        success: function success(data) {
          $('#create-product')[0].reset();
          productDescription.setData('');
          Swal.fire({
            icon: 'success',
            text: data.internalMessage
          });
          window.location = '/product/inventory';
        }
      });
    } else {
      return false;
    }
  });
  $(document).on('keyup change', '.validate-field', function () {
    if (submit != false) {
      validateFields();
    }
  });
});

function validateFields() {
  for (var i = 0, countError = 0, inputFieldsCount = $('.validate-field').length; i < inputFieldsCount; i++) {
    var errorMessage = document.getElementsByClassName("validate-field")[i].getAttribute("error-message");

    if (document.getElementsByClassName("validate-field")[i].value == "") {
      countError += 1;
      document.getElementsByClassName("validate-field")[i].style.border = "1px solid red";
      document.getElementsByClassName("error-message")[i].textContent = errorMessage;
    } else {
      document.getElementsByClassName("validate-field")[i].style.border = "1px solid #e3e3e3";
      document.getElementsByClassName("error-message")[i].textContent = "";
    }
  }

  return countError;
}

/***/ }),

/***/ 1:
/*!******************************************************!*\
  !*** multi ./resources/js/product/create-product.js ***!
  \******************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! C:\Users\Rhom\Desktop\purefolder\purehappilifeadmin\resources\js\product\create-product.js */"./resources/js/product/create-product.js");


/***/ })

/******/ });