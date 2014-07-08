





﻿/*
Copyright (c) 2003-2011, CKSource - Frederico Knabben. All rights reserved.
For licensing, see LICENSE.html or http://ckeditor.com/license
*/

(function(){var a=CKEDITOR.tools.cssLength,b=CKEDITOR.env.ie&&(CKEDITOR.env.ie7Compat||CKEDITOR.env.quirks||CKEDITOR.env.version<7);function c(k){return CKEDITOR.env.ie?k.$.clientWidth:parseInt(k.getComputedStyle('width'),10);};function d(k,l){var m=k.getComputedStyle('border-'+l+'-width'),n={thin:'0px',medium:'1px',thick:'2px'};if(m.indexOf('px')<0)if(m in n&&k.getComputedStyle('border-style')!='none')m=n[m];else m=0;return parseInt(m,10);};function e(k){var l=k.$.rows,m=0,n,o,p;for(var q=0,r=l.length;q<r;q++){p=l[q];n=p.cells.length;if(n>m){m=n;o=p;}}return o;};function f(k){var l=[],m=-1,n=k.getComputedStyle('direction')=='rtl',o=e(k),p=new CKEDITOR.dom.element(k.$.tBodies[0]),q=p.getDocumentPosition();for(var r=0,s=o.cells.length;r<s;r++){var t=new CKEDITOR.dom.element(o.cells[r]),u=o.cells[r+1]&&new CKEDITOR.dom.element(o.cells[r+1]);m+=t.$.colSpan||1;var v,w,x,y=t.getDocumentPosition().x;n?w=y+d(t,'left'):v=y+t.$.offsetWidth-d(t,'right');if(u){y=u.getDocumentPosition().x;n?v=y+u.$.offsetWidth-d(u,'right'):w=y+d(u,'left');}else{y=k.getDocumentPosition().x;n?v=y:w=y+k.$.offsetWidth;}x=Math.max(w-v,3);l.push({table:k,index:m,x:v,y:q.y,width:x,height:p.$.offsetHeight,rtl:n});}return l;};function g(k,l){for(var m=0,n=k.length;m<n;m++){var o=k[m];if(l>=o.x&&l<=o.x+o.width)return o;}return null;};function h(k){(k.data||k).preventDefault();};function i(k){var l,m,n,o,p,q,r,s,t,u;function v(){l=null;q=0;o=0;m.removeListener('mouseup',A);n.removeListener('mousedown',z);n.removeListener('mousemove',B);m.getBody().setStyle('cursor','auto');b?n.remove():n.hide();};function w(){var D=l.index,E=CKEDITOR.tools.buildTableMap(l.table),F=[],G=[],H=Number.MAX_VALUE,I=H,J=l.rtl;for(var K=0,L=E.length;K<L;K++){var M=E[K],N=M[D+(J?1:0)],O=M[D+(J?0:1)];N=N&&new CKEDITOR.dom.element(N);O=O&&new CKEDITOR.dom.element(O);if(!N||!O||!N.equals(O)){N&&(H=Math.min(H,c(N)));O&&(I=Math.min