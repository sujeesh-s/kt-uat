(window.webpackJsonp_N_E=window.webpackJsonp_N_E||[]).push([[22],{"/cER":function(e,t,r){"use strict";var c=r("nKUr"),s=(r("q1tI"),r("YFqc")),n=r.n(s),a=r("OqP1"),o=r("iAvk");t.a=function(e){var t=e.product;return Object(c.jsxs)("div",{className:"ps-product--horizontal",children:[Object(c.jsx)("div",{className:"ps-product__thumbnail",children:Object(a.d)(t)}),Object(c.jsxs)("div",{className:"ps-product__content",children:[Object(c.jsx)(n.a,{href:"/product/[pid]",as:"/product/".concat(t.id),children:Object(c.jsx)("a",{className:"ps-product__title",children:t.title})}),Object(c.jsx)("div",{className:"ps-product__rating",children:Object(c.jsx)(o.a,{})}),Object(a.b)(t)]})]})}},Tblc:function(e,t,r){"use strict";var c=r("vJKn"),s=r.n(c),n=r("nKUr"),a=r("cpVT"),o=r("rg98"),i=r("q1tI"),l=r("OS56"),u=r.n(l),p=r("URQM"),d=r("8tnw"),j=r("rePB"),b=r("wx14"),f=r("1OyB"),h=r("vuIU"),O=r("JX7q"),m=r("Ji7U"),v=r("LK+K"),g=r("TSYQ"),x=r.n(g),y=r("bT9E"),k=r("4i/N"),N=r("bRQS"),w=r("jO45"),P=r("jN4g"),S=r("H84U"),_=r("CWQg"),C=r("uaoM"),E=r("AJpP");function D(e){return!e||e<0?0:e>100?100:e}function I(e){var t=e.success,r=e.successPercent;return t&&"progress"in t&&(Object(C.a)(!1,"Progress","`success.progress` is deprecated. Please use `success.percent` instead."),r=t.progress),t&&"percent"in t&&(r=t.percent),r}var R=function(e,t){var r={};for(var c in e)Object.prototype.hasOwnProperty.call(e,c)&&t.indexOf(c)<0&&(r[c]=e[c]);if(null!=e&&"function"===typeof Object.getOwnPropertySymbols){var s=0;for(c=Object.getOwnPropertySymbols(e);s<c.length;s++)t.indexOf(c[s])<0&&Object.prototype.propertyIsEnumerable.call(e,c[s])&&(r[c[s]]=e[c[s]])}return r},W=function(e,t){var r=e.from,c=void 0===r?E.b.blue:r,s=e.to,n=void 0===s?E.b.blue:s,a=e.direction,o=void 0===a?"rtl"===t?"to left":"to right":a,i=R(e,["from","to","direction"]);if(0!==Object.keys(i).length){var l=function(e){var t=[];return Object.keys(e).forEach((function(r){var c=parseFloat(r.replace(/%/g,""));isNaN(c)||t.push({key:c,value:e[r]})})),(t=t.sort((function(e,t){return e.key-t.key}))).map((function(e){var t=e.key,r=e.value;return"".concat(r," ").concat(t,"%")})).join(", ")}(i);return{backgroundImage:"linear-gradient(".concat(o,", ").concat(l,")")}}return{backgroundImage:"linear-gradient(".concat(o,", ").concat(c,", ").concat(n,")")}},L=function(e){var t=e.prefixCls,r=e.direction,c=e.percent,s=e.strokeWidth,n=e.size,a=e.strokeColor,o=e.strokeLinecap,l=e.children,u=e.trailColor,p=e.success,d=a&&"string"!==typeof a?W(a,r):{background:a},j=u?{backgroundColor:u}:void 0,f=Object(b.a)({width:"".concat(D(c),"%"),height:s||("small"===n?6:8),borderRadius:"square"===o?0:""},d),h=I(e),O={width:"".concat(D(h),"%"),height:s||("small"===n?6:8),borderRadius:"square"===o?0:"",backgroundColor:null===p||void 0===p?void 0:p.strokeColor},m=void 0!==h?i.createElement("div",{className:"".concat(t,"-success-bg"),style:O}):null;return i.createElement(i.Fragment,null,i.createElement("div",{className:"".concat(t,"-outer")},i.createElement("div",{className:"".concat(t,"-inner"),style:j},i.createElement("div",{className:"".concat(t,"-bg"),style:f}),m)),l)},T=r("ODXe"),q=r("Ff2n"),M={className:"",percent:0,prefixCls:"rc-progress",strokeColor:"#2db7f5",strokeLinecap:"round",strokeWidth:1,style:{},trailColor:"#D9D9D9",trailWidth:1},A=function(e){var t=e.map((function(){return Object(i.useRef)()})),r=Object(i.useRef)(null);return Object(i.useEffect)((function(){var e=Date.now(),c=!1;Object.keys(t).forEach((function(s){var n=t[s].current;if(n){c=!0;var a=n.style;a.transitionDuration=".3s, .3s, .3s, .06s",r.current&&e-r.current<100&&(a.transitionDuration="0s, 0s")}})),c&&(r.current=Date.now())})),[t]},F=function(e){var t=e.className,r=e.percent,c=e.prefixCls,s=e.strokeColor,n=e.strokeLinecap,a=e.strokeWidth,o=e.style,l=e.trailColor,u=e.trailWidth,p=e.transition,d=Object(q.a)(e,["className","percent","prefixCls","strokeColor","strokeLinecap","strokeWidth","style","trailColor","trailWidth","transition"]);delete d.gapPosition;var j=Array.isArray(r)?r:[r],f=Array.isArray(s)?s:[s],h=A(j),O=Object(T.a)(h,1)[0],m=a/2,v=100-a/2,g="M ".concat("round"===n?m:0,",").concat(m,"\n         L ").concat("round"===n?v:100,",").concat(m),y="0 0 100 ".concat(a),k=0;return i.createElement("svg",Object(b.a)({className:x()("".concat(c,"-line"),t),viewBox:y,preserveAspectRatio:"none",style:o},d),i.createElement("path",{className:"".concat(c,"-line-trail"),d:g,strokeLinecap:n,stroke:l,strokeWidth:u||a,fillOpacity:"0"}),j.map((function(e,t){var r=1;switch(n){case"round":r=1-a/100;break;case"square":r=1-a/2/100;break;default:r=1}var s={strokeDasharray:"".concat(e*r,"px, 100px"),strokeDashoffset:"-".concat(k,"px"),transition:p||"stroke-dashoffset 0.3s ease 0s, stroke-dasharray .3s ease 0s, stroke 0.3s linear"},o=f[t]||f[f.length-1];return k+=e,i.createElement("path",{key:t,className:"".concat(c,"-line-path"),d:g,strokeLinecap:n,stroke:o,strokeWidth:a,fillOpacity:"0",ref:O[t],style:s})})))};F.defaultProps=M,F.displayName="Line";var U=0;function z(e){return+e.replace("%","")}function B(e){return Array.isArray(e)?e:[e]}function H(e,t,r,c){var s=arguments.length>4&&void 0!==arguments[4]?arguments[4]:0,n=arguments.length>5?arguments[5]:void 0,a=50-c/2,o=0,i=-a,l=0,u=-2*a;switch(n){case"left":o=-a,i=0,l=2*a,u=0;break;case"right":o=a,i=0,l=-2*a,u=0;break;case"bottom":i=a,u=2*a}var p="M 50,50 m ".concat(o,",").concat(i,"\n   a ").concat(a,",").concat(a," 0 1 1 ").concat(l,",").concat(-u,"\n   a ").concat(a,",").concat(a," 0 1 1 ").concat(-l,",").concat(u),d=2*Math.PI*a,j={stroke:"string"===typeof r?r:void 0,strokeDasharray:"".concat(t/100*(d-s),"px ").concat(d,"px"),strokeDashoffset:"-".concat(s/2+e/100*(d-s),"px"),transition:"stroke-dashoffset .3s ease 0s, stroke-dasharray .3s ease 0s, stroke .3s, stroke-width .06s ease .3s, opacity .3s ease 0s"};return{pathString:p,pathStyle:j}}var J=function(e){var t=e.prefixCls,r=e.strokeWidth,c=e.trailWidth,s=e.gapDegree,n=e.gapPosition,a=e.trailColor,o=e.strokeLinecap,l=e.style,u=e.className,p=e.strokeColor,d=e.percent,j=Object(q.a)(e,["prefixCls","strokeWidth","trailWidth","gapDegree","gapPosition","trailColor","strokeLinecap","style","className","strokeColor","percent"]),f=i.useMemo((function(){return U+=1}),[]),h=H(0,100,a,r,s,n),O=h.pathString,m=h.pathStyle,v=B(d),g=B(p),y=g.find((function(e){return"[object Object]"===Object.prototype.toString.call(e)})),k=A(v),N=Object(T.a)(k,1)[0];return i.createElement("svg",Object(b.a)({className:x()("".concat(t,"-circle"),u),viewBox:"0 0 100 100",style:l},j),y&&i.createElement("defs",null,i.createElement("linearGradient",{id:"".concat(t,"-gradient-").concat(f),x1:"100%",y1:"0%",x2:"0%",y2:"0%"},Object.keys(y).sort((function(e,t){return z(e)-z(t)})).map((function(e,t){return i.createElement("stop",{key:t,offset:e,stopColor:y[e]})})))),i.createElement("path",{className:"".concat(t,"-circle-trail"),d:O,stroke:a,strokeLinecap:o,strokeWidth:c||r,fillOpacity:"0",style:m}),function(){var e=0;return v.map((function(c,a){var l=g[a]||g[g.length-1],u="[object Object]"===Object.prototype.toString.call(l)?"url(#".concat(t,"-gradient-").concat(f,")"):"",p=H(e,c,l,r,s,n);return e+=c,i.createElement("path",{key:a,className:"".concat(t,"-circle-path"),d:p.pathString,stroke:u,strokeLinecap:o,strokeWidth:r,opacity:0===c?0:1,fillOpacity:"0",style:p.pathStyle,ref:N[a]})}))}().reverse())};J.defaultProps=M,J.displayName="Circle";var Y=J;function K(e){var t=e.percent,r=D(I({success:e.success,successPercent:e.successPercent}));return[r,D(D(t)-r)]}var Q=function(e){var t=e.prefixCls,r=e.width,c=e.strokeWidth,s=e.trailColor,n=e.strokeLinecap,a=e.gapPosition,o=e.gapDegree,l=e.type,u=e.children,p=r||120,d={width:p,height:p,fontSize:.15*p+6},b=c||6,f=a||"dashboard"===l&&"bottom"||"top",h="[object Object]"===Object.prototype.toString.call(e.strokeColor),O=[E.b.green,e.strokeColor||null],m=x()("".concat(t,"-inner"),Object(j.a)({},"".concat(t,"-circle-gradient"),h));return i.createElement("div",{className:m,style:d},i.createElement(Y,{percent:K(e),strokeWidth:b,trailWidth:b,strokeColor:O,strokeLinecap:n,trailColor:s,prefixCls:t,gapDegree:o||0===o?o:"dashboard"===l?75:void 0,gapPosition:f}),u)},V=function(e){for(var t=e.size,r=e.steps,c=e.percent,s=void 0===c?0:c,n=e.strokeWidth,a=void 0===n?8:n,o=e.strokeColor,l=e.trailColor,u=e.prefixCls,p=e.children,d=Math.round(r*(s/100)),b="small"===t?2:14,f=[],h=0;h<r;h+=1)f.push(i.createElement("div",{key:h,className:x()("".concat(u,"-steps-item"),Object(j.a)({},"".concat(u,"-steps-item-active"),h<=d-1)),style:{backgroundColor:h<=d-1?o:l,width:b,height:a}}));return i.createElement("div",{className:"".concat(u,"-steps-outer")},f,p)},$=function(e,t){var r={};for(var c in e)Object.prototype.hasOwnProperty.call(e,c)&&t.indexOf(c)<0&&(r[c]=e[c]);if(null!=e&&"function"===typeof Object.getOwnPropertySymbols){var s=0;for(c=Object.getOwnPropertySymbols(e);s<c.length;s++)t.indexOf(c[s])<0&&Object.prototype.propertyIsEnumerable.call(e,c[s])&&(r[c[s]]=e[c[s]])}return r},X=(Object(_.a)("line","circle","dashboard"),Object(_.a)("normal","exception","active","success")),G=function(e){Object(m.a)(r,e);var t=Object(v.a)(r);function r(){var e;return Object(f.a)(this,r),(e=t.apply(this,arguments)).renderProgress=function(t){var r,c,s=t.getPrefixCls,n=t.direction,a=Object(O.a)(e).props,o=a.prefixCls,l=a.className,u=a.size,p=a.type,d=a.steps,f=a.showInfo,h=a.strokeColor,m=$(a,["prefixCls","className","size","type","steps","showInfo","strokeColor"]),v=s("progress",o),g=e.getProgressStatus(),k=e.renderProcessInfo(v,g);Object(C.a)(!("successPercent"in a),"Progress","`successPercent` is deprecated. Please use `success.percent` instead."),"line"===p?c=d?i.createElement(V,Object(b.a)({},e.props,{strokeColor:"string"===typeof h?h:void 0,prefixCls:v,steps:d}),k):i.createElement(L,Object(b.a)({},e.props,{prefixCls:v,direction:n}),k):"circle"!==p&&"dashboard"!==p||(c=i.createElement(Q,Object(b.a)({},e.props,{prefixCls:v,progressStatus:g}),k));var N=x()(v,(r={},Object(j.a)(r,"".concat(v,"-").concat(("dashboard"===p?"circle":d&&"steps")||p),!0),Object(j.a)(r,"".concat(v,"-status-").concat(g),!0),Object(j.a)(r,"".concat(v,"-show-info"),f),Object(j.a)(r,"".concat(v,"-").concat(u),u),Object(j.a)(r,"".concat(v,"-rtl"),"rtl"===n),r),l);return i.createElement("div",Object(b.a)({},Object(y.a)(m,["status","format","trailColor","strokeWidth","width","gapDegree","gapPosition","strokeLinecap","percent","success","successPercent"]),{className:N}),c)},e}return Object(h.a)(r,[{key:"getPercentNumber",value:function(){var e=this.props.percent,t=void 0===e?0:e,r=I(this.props);return parseInt(void 0!==r?r.toString():t.toString(),10)}},{key:"getProgressStatus",value:function(){var e=this.props.status;return X.indexOf(e)<0&&this.getPercentNumber()>=100?"success":e||"normal"}},{key:"renderProcessInfo",value:function(e,t){var r,c=this.props,s=c.showInfo,n=c.format,a=c.type,o=c.percent,l=I(this.props);if(!s)return null;var u="line"===a;return n||"exception"!==t&&"success"!==t?r=(n||function(e){return"".concat(e,"%")})(D(o),D(l)):"exception"===t?r=u?i.createElement(P.a,null):i.createElement(k.a,null):"success"===t&&(r=u?i.createElement(w.a,null):i.createElement(N.a,null)),i.createElement("span",{className:"".concat(e,"-text"),title:"string"===typeof r?r:void 0},r)}},{key:"render",value:function(){return i.createElement(S.a,null,this.renderProgress)}}]),r}(i.Component);G.defaultProps={type:"line",percent:0,showInfo:!0,trailColor:null,size:"default",gapDegree:void 0,strokeLinecap:"round"};var Z=G,ee=r("YFqc"),te=r.n(ee),re=r("OqP1"),ce=r("iAvk"),se=r("ygae"),ne=r("1VNF"),ae=r("pU5j"),oe=r("s5ri"),ie=r("3o9y");function le(e,t){var r=Object.keys(e);if(Object.getOwnPropertySymbols){var c=Object.getOwnPropertySymbols(e);t&&(c=c.filter((function(t){return Object.getOwnPropertyDescriptor(e,t).enumerable}))),r.push.apply(r,c)}return r}function ue(e){for(var t=1;t<arguments.length;t++){var r=null!=arguments[t]?arguments[t]:{};t%2?le(Object(r),!0).forEach((function(t){Object(a.a)(e,t,r[t])})):Object.getOwnPropertyDescriptors?Object.defineProperties(e,Object.getOwnPropertyDescriptors(r)):le(Object(r)).forEach((function(t){Object.defineProperty(e,t,Object.getOwnPropertyDescriptor(r,t))}))}return e}var pe=function(e){var t=e.product,r=e.vertical,c=void 0===r||r,s=Object(i.useRef)(null),a=Object(i.useRef)(null),o=Object(i.useState)(null),l=o[0],p=o[1],d=Object(i.useState)(null),j=d[0],b=d[1],f=Object(i.useState)(!1),h=f[0],O=f[1],m=Object(i.useState)(0),v=m[0],g=m[1],x=Object(i.useState)([]),y=x[0],k=x[1];Object(i.useEffect)((function(){var e=[];t&&t.images.length>0&&(t.images.map((function(t){e.push("".concat(ae.c).concat(t.url))})),k(e)),p(s.current),b(a.current)}),[t]);var N,w,P,S={dots:!1,infinite:!0,speed:500,slidesToShow:1,slidesToScroll:1,nextArrow:Object(n.jsx)(oe.a,{}),prevArrow:Object(n.jsx)(ie.a,{})};return y.length>0&&(w=y.map((function(e){return Object(n.jsx)("div",{className:"item",children:Object(n.jsx)("img",{src:e,alt:e})},e)})),P=y.map((function(e,t){return Object(n.jsx)("div",{className:"item",children:Object(n.jsx)("a",{href:"#",onClick:function(e){return e.preventDefault()},children:Object(n.jsx)("img",{src:e,alt:e})})},e)}))),N=c?Object(n.jsx)(u.a,ue(ue({asNavFor:l,ref:function(e){return a.current=e},swipeToSlide:!0,arrows:!1,slidesToShow:3,vertical:!0,infinite:!0,focusOnSelect:!0},{responsive:[{breakpoint:1024,settings:{slidesToShow:4,dots:!1,arrows:!1,vertical:!1,infinite:!1}},{breakpoint:768,settings:{slidesToShow:4,dots:!1,arrows:!1,vertical:!1,infinite:!1}},{breakpoint:480,settings:{slidesToShow:4,dots:!1,arrows:!1,vertical:!1,infinite:!1}}]}),{},{className:"ps-product__variants",children:w})):Object(n.jsx)(u.a,{asNavFor:l,ref:function(e){return a.current=e},swipeToSlide:!0,arrows:!1,slidesToShow:6,vertical:!1,centered:!0,infinite:!1,focusOnSelect:!0,className:"ps-product__variants",children:w}),h&&Object(n.jsx)(ne.a,{mainSrc:y[v],nextSrc:y[(v+1)%y.length],prevSrc:y[(v+y.length-1)%y.length],onCloseRequest:function(){O(!1)},onMovePrevRequest:function(){g((v+y.length-1)%y.length)},onMoveNextRequest:function(){g((v+1)%y.length)}}),Object(n.jsxs)("div",{className:"ps-product__thumbnail","data-vertical":c?"true":"false",children:[Object(n.jsx)("figure",{children:Object(n.jsxs)("div",{className:"ps-wrapper",children:[Object(n.jsx)(u.a,ue(ue({},S),{},{ref:function(e){return s.current=e},asNavFor:j,className:"ps-product__gallery ps-carousel inside",children:P})),Object(n.jsx)("div",{className:"ps-product__badge",children:Object(n.jsxs)("span",{children:["Save ",Object(n.jsx)("br",{})," $280.00"]})})]})}),N]})},de=function(e){var t=e.product;return Object(n.jsx)("div",{className:"ps-product--detail ps-product--hot-deal",children:Object(n.jsxs)("div",{className:"ps-product__header",children:[Object(n.jsx)(pe,{product:t}),Object(n.jsxs)("div",{className:"ps-product__info",children:[Object(n.jsx)("h5",{children:"Investor"}),Object(n.jsx)("h3",{className:"ps-product__name",children:Object(n.jsx)(te.a,{href:"/product/[pid]",as:"/product/".concat(t.id),children:Object(n.jsx)("a",{children:t.title})})}),Object(n.jsxs)("div",{className:"ps-product__meta",children:[!0===t.is_sale?Object(n.jsxs)("h4",{className:"ps-product__price sale",children:[Object(n.jsxs)("del",{className:"mr-2",children:["$",Object(re.f)(t.sale_price)]}),"$",Object(re.f)(t.price)]}):Object(n.jsxs)("h4",{className:"ps-product__price",children:["$",Object(re.f)(t.price)]}),Object(n.jsxs)("div",{className:"ps-product__rating",children:[Object(n.jsx)(ce.a,{}),Object(n.jsx)("span",{children:"(1 review)"})]}),Object(n.jsx)("div",{className:"ps-product__specification",children:Object(n.jsxs)("p",{children:["Status:",Object(n.jsx)("strong",{className:"in-stock",children:"In Stock"})]})})]}),Object(n.jsxs)("div",{className:"ps-product__expires",children:[Object(n.jsx)("p",{children:"Expires In"}),Object(n.jsx)(se.a,{timeTillDate:"12 31 2021, 6:00 am",timeFormat:"MM DD YYYY, h:mm a"})]}),Object(n.jsxs)("div",{className:"ps-product__processs-bar",children:[Object(n.jsx)(Z,{percent:60,showInfo:!1}),Object(n.jsxs)("p",{children:[Object(n.jsx)("strong",{children:"4/79"})," Sold"]})]})]})]})})},je=r("/cER");function be(e,t){var r=Object.keys(e);if(Object.getOwnPropertySymbols){var c=Object.getOwnPropertySymbols(e);t&&(c=c.filter((function(t){return Object.getOwnPropertyDescriptor(e,t).enumerable}))),r.push.apply(r,c)}return r}function fe(e){for(var t=1;t<arguments.length;t++){var r=null!=arguments[t]?arguments[t]:{};t%2?be(Object(r),!0).forEach((function(t){Object(a.a)(e,t,r[t])})):Object.getOwnPropertyDescriptors?Object.defineProperties(e,Object.getOwnPropertyDescriptors(r)):be(Object(r)).forEach((function(t){Object.defineProperty(e,t,Object.getOwnPropertyDescriptor(r,t))}))}return e}t.a=function(e){var t=e.collectionSlug,r=Object(i.useRef)(null),c=Object(i.useState)(null),a=c[0],l=c[1],j=Object(i.useState)(!0),b=j[0],f=j[1];function h(){return(h=Object(o.a)(s.a.mark((function e(){var r;return s.a.wrap((function(e){for(;;)switch(e.prev=e.next){case 0:return f(!0),e.next=3,Object(p.b)(t);case 3:(r=e.sent)&&(l(r.items),setTimeout(function(){f(!1)}.bind(this),250));case 5:case"end":return e.stop()}}),e,this)})))).apply(this,arguments)}var O,m;if(Object(i.useEffect)((function(){!function(){h.apply(this,arguments)}()}),[]),b)O=Object(n.jsx)("p",{children:"Loading..."});else if(a&&a.length>0){var v=a.map((function(e){return Object(n.jsx)(de,{product:e},e.id)})),g=a.map((function(e,t){if(t>1&&t<6)return Object(n.jsx)(je.a,{product:e},e.id)}));O=Object(n.jsx)(u.a,fe(fe({ref:function(e){return r.current=e}},d.b),{},{fade:!0,className:"ps-carousel",children:v})),m=Object(n.jsx)(u.a,fe(fe({},d.b),{},{children:Object(n.jsx)("div",{className:"ps-product-group",children:g},"group-1")}))}else O=Object(n.jsx)("p",{children:"No product found."});return Object(n.jsx)("div",{className:"ps-deal-hot",children:Object(n.jsx)("div",{className:"ps-container",children:Object(n.jsxs)("div",{className:"row",children:[Object(n.jsx)("div",{className:"col-xl-9 col-lg-12 col-md-12 col-sm-12 col-12 ",children:Object(n.jsxs)("div",{className:"ps-block--deal-hot","data-mh":"dealhot",children:[Object(n.jsxs)("div",{className:"ps-block__header",children:[Object(n.jsx)("h3",{children:"New Deals Daily "}),Object(n.jsxs)("div",{className:"ps-block__navigation",children:[Object(n.jsx)("a",{className:"ps-carousel__prev",href:"#",onClick:function(e){return function(e){e.preventDefault(),r.current.slickPrev()}(e)},children:Object(n.jsx)("i",{className:"icon-chevron-left"})}),Object(n.jsx)("a",{className:"ps-carousel__next",href:".ps-carousel--deal-hot",onClick:function(e){return function(e){e.preventDefault(),r.current.slickNext()}(e)},children:Object(n.jsx)("i",{className:"icon-chevron-right"})})]})]}),Object(n.jsx)("div",{className:"ps-product__content",children:O})]})}),Object(n.jsx)("div",{className:"col-xl-3 col-lg-12 col-md-12 col-sm-12 col-12 ",children:Object(n.jsxs)("aside",{className:"widget widget_best-sale","data-mh":"dealhot",children:[Object(n.jsx)("h3",{className:"widget-title",children:"Top Best Seller"}),Object(n.jsx)("div",{className:"widget__content",children:m})]})})]})})})}},bRQS:function(e,t,r){"use strict";var c=r("q1tI"),s={icon:{tag:"svg",attrs:{viewBox:"64 64 896 896",focusable:"false"},children:[{tag:"path",attrs:{d:"M912 190h-69.9c-9.8 0-19.1 4.5-25.1 12.2L404.7 724.5 207 474a32 32 0 00-25.1-12.2H112c-6.7 0-10.4 7.7-6.3 12.9l273.9 347c12.8 16.2 37.4 16.2 50.3 0l488.4-618.9c4.1-5.1.4-12.8-6.3-12.8z"}}]},name:"check",theme:"outlined"},n=r("6VBw"),a=function(e,t){return c.createElement(n.a,Object.assign({},e,{ref:t,icon:s}))};a.displayName="CheckOutlined";t.a=c.forwardRef(a)},ygae:function(e,t,r){"use strict";var c=r("nKUr"),s=r("H+61"),n=r("UlJF"),a=r("7LId"),o=r("VIvw"),i=r("iHvq"),l=r("q1tI"),u=r("wd/R"),p=r.n(u);function d(e){var t=function(){if("undefined"===typeof Reflect||!Reflect.construct)return!1;if(Reflect.construct.sham)return!1;if("function"===typeof Proxy)return!0;try{return Date.prototype.toString.call(Reflect.construct(Date,[],(function(){}))),!0}catch(e){return!1}}();return function(){var r,c=Object(i.a)(e);if(t){var s=Object(i.a)(this).constructor;r=Reflect.construct(c,arguments,s)}else r=c.apply(this,arguments);return Object(o.a)(this,r)}}var j=function(e){Object(a.a)(r,e);var t=d(r);function r(e){var c;return Object(s.a)(this,r),(c=t.call(this,e)).state={seconds:null,minutes:null,hours:null,days:null},c}return Object(n.a)(r,[{key:"componentDidMount",value:function(){var e=this;this.interval=setInterval((function(){var t=e.props,r=t.timeTillDate,c=t.timeFormat,s=p()(r,c),n=p()(),a=p()(s-n),o=a.format("D"),i=a.format("HH"),l=a.format("mm"),u=a.format("ss");e.setState({days:o,hours:i,minutes:l,seconds:u})}),1e3)}},{key:"componentWillUnmount",value:function(){this.interval&&clearInterval(this.interval)}},{key:"render",value:function(){var e=this.state,t=e.days,r=e.hours,s=e.minutes,n=e.seconds;return Object(c.jsxs)("ul",{className:"ps-countdown",children:[Object(c.jsxs)("li",{children:[Object(c.jsx)("span",{className:"days",children:t}),Object(c.jsx)("p",{children:"Days"})]}),Object(c.jsxs)("li",{children:[Object(c.jsx)("span",{className:"hours",children:r}),Object(c.jsx)("p",{children:"Hours"})]}),Object(c.jsxs)("li",{children:[Object(c.jsx)("span",{className:"minutes",children:s}),Object(c.jsx)("p",{children:"Minutes"})]}),Object(c.jsxs)("li",{children:[Object(c.jsx)("span",{className:"seconds",children:n}),Object(c.jsx)("p",{children:"Seconds"})]})]})}}]),r}(l.Component);t.a=j}}]);