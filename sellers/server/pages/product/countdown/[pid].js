(function() {
var exports = {};
exports.id = 5856;
exports.ids = [5856];
exports.modules = {

/***/ 4772:
/***/ (function(__unused_webpack_module, __webpack_exports__, __webpack_require__) {

"use strict";
// ESM COMPAT FLAG
__webpack_require__.r(__webpack_exports__);

// EXPORTS
__webpack_require__.d(__webpack_exports__, {
  "default": function() { return /* binding */ _pid_; }
});

// EXTERNAL MODULE: external "react/jsx-runtime"
var jsx_runtime_ = __webpack_require__(5282);
// EXTERNAL MODULE: external "react"
var external_react_ = __webpack_require__(9297);
// EXTERNAL MODULE: external "next/router"
var router_ = __webpack_require__(6731);
// EXTERNAL MODULE: ./repositories/ProductRepository.js
var ProductRepository = __webpack_require__(8930);
// EXTERNAL MODULE: ./components/elements/skeletons/SkeletonProductDetail.jsx
var SkeletonProductDetail = __webpack_require__(6239);
// EXTERNAL MODULE: ./components/elements/BreadCrumb.jsx
var BreadCrumb = __webpack_require__(9616);
// EXTERNAL MODULE: ./components/partials/product/ProductWidgets.jsx + 3 modules
var ProductWidgets = __webpack_require__(3543);
// EXTERNAL MODULE: ./components/partials/product/CustomerBought.jsx
var CustomerBought = __webpack_require__(8405);
// EXTERNAL MODULE: ./components/partials/product/RelatedProduct.jsx
var RelatedProduct = __webpack_require__(5331);
// EXTERNAL MODULE: ./components/layouts/ContainerPage.jsx
var ContainerPage = __webpack_require__(1596);
// EXTERNAL MODULE: ./components/elements/detail/thumbnail/ThumbnailDefault.jsx
var ThumbnailDefault = __webpack_require__(6305);
// EXTERNAL MODULE: ./components/elements/detail/description/DefaultDescription.jsx
var DefaultDescription = __webpack_require__(8645);
// EXTERNAL MODULE: ./components/elements/detail/modules/ModuleProductDetailDescription.js
var ModuleProductDetailDescription = __webpack_require__(1544);
// EXTERNAL MODULE: ./components/elements/detail/modules/ModuleDetailShoppingActions.jsx
var ModuleDetailShoppingActions = __webpack_require__(9672);
// EXTERNAL MODULE: ./components/elements/detail/modules/ModuleProductDetailSpecification.js
var ModuleProductDetailSpecification = __webpack_require__(1123);
// EXTERNAL MODULE: ./components/elements/detail/modules/ModuleProductDetailSharing.js
var ModuleProductDetailSharing = __webpack_require__(3665);
// EXTERNAL MODULE: ./components/elements/detail/modules/ModuleDetailActionsMobile.jsx
var ModuleDetailActionsMobile = __webpack_require__(3582);
// EXTERNAL MODULE: ./components/elements/detail/modules/ModuleDetailTopInformation.jsx
var ModuleDetailTopInformation = __webpack_require__(2805);
// EXTERNAL MODULE: ./components/elements/CountDown.jsx
var CountDown = __webpack_require__(472);
;// CONCATENATED MODULE: ./components/elements/detail/modules/ModuleDetailCountdown.js





const ModuleDetailCountdown = () => {
  return /*#__PURE__*/(0,jsx_runtime_.jsxs)("div", {
    className: "ps-product__countdown",
    children: [/*#__PURE__*/(0,jsx_runtime_.jsxs)("figure", {
      children: [/*#__PURE__*/jsx_runtime_.jsx("figcaption", {
        children: "Don't Miss Out! This promotion will expires in"
      }), /*#__PURE__*/jsx_runtime_.jsx(CountDown/* default */.Z, {
        timeTillDate: "12 31 2020, 6:00 am",
        timeFormat: "MM DD YYYY, h:mm a"
      })]
    }), /*#__PURE__*/(0,jsx_runtime_.jsxs)("figure", {
      children: [/*#__PURE__*/jsx_runtime_.jsx("figcaption", {
        children: "Sold Items"
      }), /*#__PURE__*/(0,jsx_runtime_.jsxs)("div", {
        className: "ps-product__progress-bar ps-progress",
        "data-value": "13",
        children: [/*#__PURE__*/jsx_runtime_.jsx("div", {
          className: "ps-progress__value",
          children: /*#__PURE__*/jsx_runtime_.jsx("span", {})
        }), /*#__PURE__*/(0,jsx_runtime_.jsxs)("p", {
          children: [/*#__PURE__*/jsx_runtime_.jsx("b", {
            children: "20/85"
          }), " Sold"]
        })]
      })]
    })]
  });
};

/* harmony default export */ var modules_ModuleDetailCountdown = (ModuleDetailCountdown);
;// CONCATENATED MODULE: ./components/elements/detail/ProductDetailCountdown.jsx













const ProductDetailCountdown = ({
  product
}) => {
  return /*#__PURE__*/(0,jsx_runtime_.jsxs)("div", {
    className: "ps-product--detail ps-product--fullwidth",
    children: [/*#__PURE__*/(0,jsx_runtime_.jsxs)("div", {
      className: "ps-product__header",
      children: [/*#__PURE__*/jsx_runtime_.jsx(ThumbnailDefault/* default */.Z, {
        product: product
      }), /*#__PURE__*/(0,jsx_runtime_.jsxs)("div", {
        className: "ps-product__info",
        children: [/*#__PURE__*/jsx_runtime_.jsx(ModuleDetailTopInformation/* default */.Z, {
          product: product
        }), /*#__PURE__*/jsx_runtime_.jsx(ModuleProductDetailDescription/* default */.Z, {
          product: product
        }), /*#__PURE__*/jsx_runtime_.jsx(modules_ModuleDetailCountdown, {}), /*#__PURE__*/jsx_runtime_.jsx(ModuleDetailShoppingActions/* default */.Z, {
          product: product
        }), /*#__PURE__*/jsx_runtime_.jsx(ModuleProductDetailSpecification/* default */.Z, {}), /*#__PURE__*/jsx_runtime_.jsx(ModuleProductDetailSharing/* default */.Z, {}), /*#__PURE__*/jsx_runtime_.jsx(ModuleDetailActionsMobile/* default */.Z, {})]
      })]
    }), /*#__PURE__*/jsx_runtime_.jsx(DefaultDescription/* default */.Z, {})]
  });
};

/* harmony default export */ var detail_ProductDetailCountdown = (ProductDetailCountdown);
;// CONCATENATED MODULE: ./pages/product/countdown/[pid].jsx













const ProductDefaulCountdown = () => {
  const router = (0,router_.useRouter)();
  const {
    pid
  } = router.query;
  const {
    0: product,
    1: setProduct
  } = (0,external_react_.useState)(null);
  const {
    0: loading,
    1: setLoading
  } = (0,external_react_.useState)(false);

  async function getProduct(pid) {
    setLoading(true);
    const responseData = await ProductRepository/* default.getProductsById */.Z.getProductsById(pid);

    if (responseData) {
      setProduct(responseData);
      setTimeout(function () {
        setLoading(false);
      }.bind(this), 250);
    }
  }

  (0,external_react_.useEffect)(() => {
    getProduct(pid);
  }, [pid]);
  const breadCrumb = [{
    text: 'Home',
    url: '/'
  }, {
    text: 'Shop',
    url: '/shop'
  }, {
    text: product ? product.title : 'Loading...'
  }]; // Views

  let productView;

  if (!loading) {
    if (product) {
      productView = /*#__PURE__*/jsx_runtime_.jsx(detail_ProductDetailCountdown, {
        product: product
      });
    } else {}
  } else {
    productView = /*#__PURE__*/jsx_runtime_.jsx(SkeletonProductDetail/* default */.Z, {});
  }

  return /*#__PURE__*/(0,jsx_runtime_.jsxs)(ContainerPage/* default */.Z, {
    title: product ? product.title : 'Loading...',
    children: [/*#__PURE__*/jsx_runtime_.jsx(BreadCrumb/* default */.Z, {
      breacrumb: breadCrumb,
      layout: "fullwidth"
    }), /*#__PURE__*/jsx_runtime_.jsx("div", {
      className: "ps-page--product",
      children: /*#__PURE__*/(0,jsx_runtime_.jsxs)("div", {
        className: "ps-container",
        children: [/*#__PURE__*/(0,jsx_runtime_.jsxs)("div", {
          className: "ps-page__container",
          children: [/*#__PURE__*/jsx_runtime_.jsx("div", {
            className: "ps-page__left",
            children: productView
          }), /*#__PURE__*/jsx_runtime_.jsx("div", {
            className: "ps-page__right",
            children: /*#__PURE__*/jsx_runtime_.jsx(ProductWidgets/* default */.Z, {})
          })]
        }), /*#__PURE__*/jsx_runtime_.jsx(CustomerBought/* default */.Z, {
          layout: "fullwidth",
          collectionSlug: "deal-of-the-day"
        }), /*#__PURE__*/jsx_runtime_.jsx(RelatedProduct/* default */.Z, {
          collectionSlug: "shop-recommend-items"
        })]
      })
    })]
  });
};

/* harmony default export */ var _pid_ = (ProductDefaulCountdown);

/***/ }),

/***/ 953:
/***/ (function(module) {

"use strict";
module.exports = require("antd");;

/***/ }),

/***/ 2376:
/***/ (function(module) {

"use strict";
module.exports = require("axios");;

/***/ }),

/***/ 2470:
/***/ (function(module) {

"use strict";
module.exports = require("moment");;

/***/ }),

/***/ 8417:
/***/ (function(module) {

"use strict";
module.exports = require("next/dist/next-server/lib/router-context.js");;

/***/ }),

/***/ 2238:
/***/ (function(module) {

"use strict";
module.exports = require("next/dist/next-server/lib/router/utils/get-asset-path-from-route.js");;

/***/ }),

/***/ 701:
/***/ (function(module) {

"use strict";
module.exports = require("next/head");;

/***/ }),

/***/ 6731:
/***/ (function(module) {

"use strict";
module.exports = require("next/router");;

/***/ }),

/***/ 9297:
/***/ (function(module) {

"use strict";
module.exports = require("react");;

/***/ }),

/***/ 6302:
/***/ (function(module) {

"use strict";
module.exports = require("react-image-lightbox");;

/***/ }),

/***/ 6873:
/***/ (function(module) {

"use strict";
module.exports = require("react-lazyload");;

/***/ }),

/***/ 79:
/***/ (function(module) {

"use strict";
module.exports = require("react-redux");;

/***/ }),

/***/ 9080:
/***/ (function(module) {

"use strict";
module.exports = require("react-slick");;

/***/ }),

/***/ 5282:
/***/ (function(module) {

"use strict";
module.exports = require("react/jsx-runtime");;

/***/ })

};
;

// load runtime
var __webpack_require__ = require("../../../webpack-runtime.js");
__webpack_require__.C(exports);
var __webpack_exec__ = function(moduleId) { return __webpack_require__(__webpack_require__.s = moduleId); }
var __webpack_exports__ = __webpack_require__.X(0, [1664,5484,3574,4247,7517,2641,8260,4731,7786,9500,1596,8483,5671,8006,1117,8661,8283,1380,5963,9775,7037,472], function() { return __webpack_exec__(4772); });
module.exports = __webpack_exports__;

})();