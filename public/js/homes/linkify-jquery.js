!function(e,t){"use strict";function n(e,t,n){var i=n[n.length-1];e.replaceChild(i,t);for(var r=n.length-2;r>=0;r--)e.insertBefore(n[r],i),i=n[r]}function i(e,t,n){for(var i=[],r=0;r<e.length;r++){var o=e[r];if(o.isLink){var a=o.toHref(t.defaultProtocol),l=f.resolve(t.format,o.toString(),o.type),s=f.resolve(t.formatHref,a,o.type),u=f.resolve(t.attributes,a,o.type),d=f.resolve(t.tagName,a,o.type),c=f.resolve(t.linkClass,a,o.type),m=f.resolve(t.target,a,o.type),y=f.resolve(t.events,a,o.type),v=n.createElement(d);if(v.setAttribute("href",s),v.setAttribute("class",c),m&&v.setAttribute("target",m),u)for(var h in u)v.setAttribute(h,u[h]);if(y)for(var k in y)v.addEventListener?v.addEventListener(k,y[k]):v.attachEvent&&v.attachEvent("on"+k,y[k]);v.appendChild(n.createTextNode(l)),i.push(v)}else i.push("nl"===o.type&&t.nl2br?n.createElement("br"):n.createTextNode(o.toString()))}return i}function r(e,t,o){if(!e||"object"!=typeof e||e.nodeType!==s)throw new Error("Cannot linkify "+e+" - Invalid DOM Node type");if("A"===e.tagName)return e;for(var a=e.firstChild;a;){switch(a.nodeType){case s:r(a,t,o);break;case u:var f=a.nodeValue,d=l(f),c=i(d,t,o);n(e,a,c),a=c[c.length-1]}a=a.nextSibling}return e}function o(e,t){var n=void 0===arguments[2]?null:arguments[2];try{n=n||window&&window.document||global&&global.document}catch(i){}if(!n)throw new Error("Cannot find document implementation. If you are in a non-browser environment like Node.js, pass the document implementation as the third argument to linkifyElement.");return t=f.normalize(t),r(e,t,n)}function a(e){function t(e){return e=o.normalize(e),this.each(function(){o.helper(this,e,n)})}var n=void 0===arguments[1]?null:arguments[1];e.fn=e.fn||{};try{n=n||window&&window.document||global&&global.document}catch(i){}if(!n)throw new Error("Cannot find document implementation. If you are in a non-browser environment like Node.js, pass the document implementation as the third argument to linkifyElement.");"function"!=typeof e.fn.linkify&&(e.fn.linkify=t,e(n).ready(function(){e("[data-linkify]").each(function(){var t=e(this),n=t.data(),i=n.linkify,r=n.linkifyNlbr,o={linkAttributes:n.linkifyAttributes,defaultProtocol:n.linkifyDefaultProtocol,events:n.linkifyEvents,format:n.linkifyFormat,formatHref:n.linkifyFormatHref,newLine:n.linkifyNewline,nl2br:!!r&&0!==r&&"false"!==r,tagName:n.linkifyTagname,target:n.linkifyTarget,linkClass:n.linkifyLinkclass},a="this"===i?t:t.find(i);a.linkify(o)})}))}var l=t.tokenize,f=t.options,s=1,u=3;o.helper=r,o.normalize=f.normalize;var d=void 0;try{d=document}catch(c){d=null}"undefined"!=typeof e&&d&&a(e,d),window.linkifyElement=o}(window.jQuery,window.linkify);