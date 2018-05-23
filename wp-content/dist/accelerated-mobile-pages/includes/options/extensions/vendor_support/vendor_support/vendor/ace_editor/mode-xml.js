ace.define("ace/mode/xml_highlight_rules",["require","exports","module","ace/lib/oop","ace/mode/text_highlight_rules"],function(e,t,n){"use strict";var r=e("../lib/oop"),a=e("./text_highlight_rules").TextHighlightRules,o=function(e){this.$rules={start:[{token:"string.cdata.xml",regex:"<\\!\\[CDATA\\[",next:"cdata"},{token:["punctuation.xml-decl.xml","keyword.xml-decl.xml"],regex:"(<\\?)(xml)(?=[\\s])",next:"xml_decl",caseInsensitive:!0},{token:["punctuation.instruction.xml","keyword.instruction.xml"],regex:"(<\\?)([-_a-zA-Z0-9]+)",next:"processing_instruction"},{token:"comment.xml",regex:"<\\!--",next:"comment"},{token:["xml-pe.doctype.xml","xml-pe.doctype.xml"],regex:"(<\\!)(DOCTYPE)(?=[\\s])",next:"doctype",caseInsensitive:!0},{include:"tag"},{token:"text.end-tag-open.xml",regex:"</"},{token:"text.tag-open.xml",regex:"<"},{include:"reference"},{defaultToken:"text.xml"}],xml_decl:[{token:"entity.other.attribute-name.decl-attribute-name.xml",regex:"(?:[-_a-zA-Z0-9]+:)?[-_a-zA-Z0-9]+"},{token:"keyword.operator.decl-attribute-equals.xml",regex:"="},{include:"whitespace"},{include:"string"},{token:"punctuation.xml-decl.xml",regex:"\\?>",next:"start"}],processing_instruction:[{token:"punctuation.instruction.xml",regex:"\\?>",next:"start"},{defaultToken:"instruction.xml"}],doctype:[{include:"whitespace"},{include:"string"},{token:"xml-pe.doctype.xml",regex:">",next:"start"},{token:"xml-pe.xml",regex:"[-_a-zA-Z0-9:]+"},{token:"punctuation.int-subset",regex:"\\[",push:"int_subset"}],int_subset:[{token:"text.xml",regex:"\\s+"},{token:"punctuation.int-subset.xml",regex:"]",next:"pop"},{token:["punctuation.markup-decl.xml","keyword.markup-decl.xml"],regex:"(<\\!)([-_a-zA-Z0-9]+)",push:[{token:"text",regex:"\\s+"},{token:"punctuation.markup-decl.xml",regex:">",next:"pop"},{include:"string"}]}],cdata:[{token:"string.cdata.xml",regex:"\\]\\]>",next:"start"},{token:"text.xml",regex:"\\s+"},{token:"text.xml",regex:"(?:[^\\]]|\\](?!\\]>))+"}],comment:[{token:"comment.xml",regex:"--\x3e",next:"start"},{defaultToken:"comment.xml"}],reference:[{token:"constant.language.escape.reference.xml",regex:"(?:&#[0-9]+;)|(?:&#x[0-9a-fA-F]+;)|(?:&[a-zA-Z0-9_:\\.-]+;)"}],attr_reference:[{token:"constant.language.escape.reference.attribute-value.xml",regex:"(?:&#[0-9]+;)|(?:&#x[0-9a-fA-F]+;)|(?:&[a-zA-Z0-9_:\\.-]+;)"}],tag:[{token:["meta.tag.punctuation.tag-open.xml","meta.tag.punctuation.end-tag-open.xml","meta.tag.tag-name.xml"],regex:"(?:(<)|(</))((?:[-_a-zA-Z0-9]+:)?[-_a-zA-Z0-9]+)",next:[{include:"attributes"},{token:"meta.tag.punctuation.tag-close.xml",regex:"/?>",next:"start"}]}],tag_whitespace:[{token:"text.tag-whitespace.xml",regex:"\\s+"}],whitespace:[{token:"text.whitespace.xml",regex:"\\s+"}],string:[{token:"string.xml",regex:"'",push:[{token:"string.xml",regex:"'",next:"pop"},{defaultToken:"string.xml"}]},{token:"string.xml",regex:'"',push:[{token:"string.xml",regex:'"',next:"pop"},{defaultToken:"string.xml"}]}],attributes:[{token:"entity.other.attribute-name.xml",regex:"(?:[-_a-zA-Z0-9]+:)?[-_a-zA-Z0-9]+"},{token:"keyword.operator.attribute-equals.xml",regex:"="},{include:"tag_whitespace"},{include:"attribute_value"}],attribute_value:[{token:"string.attribute-value.xml",regex:"'",push:[{token:"string.attribute-value.xml",regex:"'",next:"pop"},{include:"attr_reference"},{defaultToken:"string.attribute-value.xml"}]},{token:"string.attribute-value.xml",regex:'"',push:[{token:"string.attribute-value.xml",regex:'"',next:"pop"},{include:"attr_reference"},{defaultToken:"string.attribute-value.xml"}]}]},this.constructor===o&&this.normalizeRules()};(function(){this.embedTagRules=function(e,t,n){this.$rules.tag.unshift({token:["meta.tag.punctuation.tag-open.xml","meta.tag."+n+".tag-name.xml"],regex:"(<)("+n+"(?=\\s|>|$))",next:[{include:"attributes"},{token:"meta.tag.punctuation.tag-close.xml",regex:"/?>",next:t+"start"}]}),this.$rules[n+"-end"]=[{include:"attributes"},{token:"meta.tag.punctuation.tag-close.xml",regex:"/?>",next:"start",onMatch:function(e,t,n){return n.splice(0),this.token}}],this.embedRules(e,t,[{token:["meta.tag.punctuation.end-tag-open.xml","meta.tag."+n+".tag-name.xml"],regex:"(</)("+n+"(?=\\s|>|$))",next:n+"-end"},{token:"string.cdata.xml",regex:"<\\!\\[CDATA\\["},{token:"string.cdata.xml",regex:"\\]\\]>"}])}}).call(a.prototype),r.inherits(o,a),t.XmlHighlightRules=o}),ace.define("ace/mode/behaviour/xml",["require","exports","module","ace/lib/oop","ace/mode/behaviour","ace/token_iterator","ace/lib/lang"],function(e,t,n){"use strict";function d(e,t){return-1<e.type.lastIndexOf(t+".xml")}var r=e("../../lib/oop"),a=e("../behaviour").Behaviour,h=e("../../token_iterator").TokenIterator,o=(e("../../lib/lang"),function(){this.add("string_dquotes","insertion",function(e,t,n,r,a){if('"'==a||"'"==a){var o=a,i=r.doc.getTextRange(n.getSelectionRange());if(""!==i&&"'"!==i&&'"'!=i&&n.getWrapBehavioursEnabled())return{text:o+i+o,selection:!1};var l=n.getCursorPosition(),u=r.doc.getLine(l.row).substring(l.column,l.column+1),s=new h(r,l.row,l.column),g=s.getCurrentToken();if(u==o&&(d(g,"attribute-value")||d(g,"string")))return{text:"",selection:[1,1]};if(g||(g=s.stepBackward()),!g)return;for(;d(g,"tag-whitespace")||d(g,"whitespace");)g=s.stepBackward();var c=!u||u.match(/\s/);if(d(g,"attribute-equals")&&(c||">"==u)||d(g,"decl-attribute-equals")&&(c||"?"==u))return{text:o+o,selection:[1,1]}}}),this.add("string_dquotes","deletion",function(e,t,n,r,a){var o=r.doc.getTextRange(a);if(!a.isMultiLine()&&('"'==o||"'"==o)&&r.doc.getLine(a.start.row).substring(a.start.column+1,a.start.column+2)==o)return a.end.column++,a}),this.add("autoclosing","insertion",function(e,t,n,r,a){if(">"==a){var o=n.getCursorPosition(),i=new h(r,o.row,o.column),l=i.getCurrentToken()||i.stepBackward();if(!l||!(d(l,"tag-name")||d(l,"tag-whitespace")||d(l,"attribute-name")||d(l,"attribute-equals")||d(l,"attribute-value")))return;if(d(l,"reference.attribute-value"))return;if(d(l,"attribute-value")){var u=l.value.charAt(0);if('"'==u||"'"==u){var s=l.value.charAt(l.value.length-1),g=i.getCurrentTokenColumn()+l.value.length;if(g>o.column||g==o.column&&u!=s)return}}for(;!d(l,"tag-name");)l=i.stepBackward();var c=i.getCurrentTokenRow(),m=i.getCurrentTokenColumn();if(d(i.stepBackward(),"end-tag-open"))return;var x=l.value;if(c==o.row&&(x=x.substring(0,o.column-m)),this.voidElements.hasOwnProperty(x.toLowerCase()))return;return{text:"></"+x+">",selection:[1,1]}}}),this.add("autoindent","insertion",function(e,t,n,r,a){if("\n"==a){var o=n.getCursorPosition(),i=r.getLine(o.row),l=new h(r,o.row,o.column),u=l.getCurrentToken();if(u&&-1!==u.type.indexOf("tag-close")){for(;u&&-1===u.type.indexOf("tag-name");)u=l.stepBackward();if(!u)return;var s=u.value,g=l.getCurrentTokenRow();if(!(u=l.stepBackward())||-1!==u.type.indexOf("end-tag"))return;if(this.voidElements&&!this.voidElements[s]){var c=r.getTokenAt(o.row,o.column+1),m=(i=r.getLine(g),this.$getIndent(i)),x=m+r.getTabString();return c&&"</"===c.value?{text:"\n"+x+"\n"+m,selection:[1,x.length,1,x.length]}:{text:"\n"+x}}}}})});r.inherits(o,a),t.XmlBehaviour=o}),ace.define("ace/mode/folding/xml",["require","exports","module","ace/lib/oop","ace/lib/lang","ace/range","ace/mode/folding/fold_mode","ace/token_iterator"],function(e,t,n){"use strict";function u(e,t){return-1<e.type.lastIndexOf(t+".xml")}var r=e("../../lib/oop"),s=(e("../../lib/lang"),e("../../range").Range),a=e("./fold_mode").FoldMode,g=e("../../token_iterator").TokenIterator,o=t.FoldMode=function(e,t){a.call(this),this.voidElements=e||{},this.optionalEndTags=r.mixin({},this.voidElements),t&&r.mixin(this.optionalEndTags,t)};r.inherits(o,a);var i=function(){this.tagName="",this.closing=!1,this.selfClosing=!1,this.start={row:0,column:0},this.end={row:0,column:0}};(function(){this.getFoldWidget=function(e,t,n){var r=this._getFirstTagInLine(e,n);return r?r.closing||!r.tagName&&r.selfClosing?"markbeginend"==t?"end":"":!r.tagName||r.selfClosing||this.voidElements.hasOwnProperty(r.tagName.toLowerCase())?"":this._findEndTagInLine(e,n,r.tagName,r.end.column)?"":"start":""},this._getFirstTagInLine=function(e,t){for(var n=e.getTokens(t),r=new i,a=0;a<n.length;a++){var o=n[a];if(u(o,"tag-open")){if(r.end.column=r.start.column+o.value.length,r.closing=u(o,"end-tag-open"),!(o=n[++a]))return null;for(r.tagName=o.value,r.end.column+=o.value.length,a++;a<n.length;a++)if(o=n[a],r.end.column+=o.value.length,u(o,"tag-close")){r.selfClosing="/>"==o.value;break}return r}if(u(o,"tag-close"))return r.selfClosing="/>"==o.value,r;r.start.column+=o.value.length}return null},this._findEndTagInLine=function(e,t,n,r){for(var a=e.getTokens(t),o=0,i=0;i<a.length;i++){var l=a[i];if(!((o+=l.value.length)<r)&&u(l,"end-tag-open")&&(l=a[i+1])&&l.value==n)return!0}return!1},this._readTagForward=function(e){var t=e.getCurrentToken();if(!t)return null;var n=new i;do{if(u(t,"tag-open"))n.closing=u(t,"end-tag-open"),n.start.row=e.getCurrentTokenRow(),n.start.column=e.getCurrentTokenColumn();else if(u(t,"tag-name"))n.tagName=t.value;else if(u(t,"tag-close"))return n.selfClosing="/>"==t.value,n.end.row=e.getCurrentTokenRow(),n.end.column=e.getCurrentTokenColumn()+t.value.length,e.stepForward(),n}while(t=e.stepForward());return null},this._readTagBackward=function(e){var t=e.getCurrentToken();if(!t)return null;var n=new i;do{if(u(t,"tag-open"))return n.closing=u(t,"end-tag-open"),n.start.row=e.getCurrentTokenRow(),n.start.column=e.getCurrentTokenColumn(),e.stepBackward(),n;u(t,"tag-name")?n.tagName=t.value:u(t,"tag-close")&&(n.selfClosing="/>"==t.value,n.end.row=e.getCurrentTokenRow(),n.end.column=e.getCurrentTokenColumn()+t.value.length)}while(t=e.stepBackward());return null},this._pop=function(e,t){for(;e.length;){var n=e[e.length-1];if(!t||n.tagName==t.tagName)return e.pop();if(!this.optionalEndTags.hasOwnProperty(n.tagName))return null;e.pop()}},this.getFoldWidgetRange=function(e,t,n){var r=this._getFirstTagInLine(e,n);if(!r)return null;var a,o=[];if(r.closing||r.selfClosing){l=new g(e,n,r.end.column);for(var i={row:n,column:r.start.column};a=this._readTagBackward(l);)if(a.selfClosing){if(!o.length)return a.start.column+=a.tagName.length+2,a.end.column-=2,s.fromPoints(a.start,a.end)}else if(a.closing)o.push(a);else if(this._pop(o,a),0==o.length)return a.start.column+=a.tagName.length+2,s.fromPoints(a.start,i)}else for(var l=new g(e,n,r.start.column),u={row:n,column:r.start.column+r.tagName.length+2};a=this._readTagForward(l);)if(a.selfClosing){if(!o.length)return a.start.column+=a.tagName.length+2,a.end.column-=2,s.fromPoints(a.start,a.end)}else if(a.closing){if(this._pop(o,a),0==o.length)return s.fromPoints(u,a.start)}else o.push(a)}}).call(o.prototype)}),ace.define("ace/mode/xml",["require","exports","module","ace/lib/oop","ace/lib/lang","ace/mode/text","ace/mode/xml_highlight_rules","ace/mode/behaviour/xml","ace/mode/folding/xml"],function(e,t,n){"use strict";var r=e("../lib/oop"),a=e("../lib/lang"),o=e("./text").Mode,i=e("./xml_highlight_rules").XmlHighlightRules,l=e("./behaviour/xml").XmlBehaviour,u=e("./folding/xml").FoldMode,s=function(){this.HighlightRules=i,this.$behaviour=new l,this.foldingRules=new u};r.inherits(s,o),function(){this.voidElements=a.arrayToMap([]),this.blockComment={start:"\x3c!--",end:"--\x3e"},this.$id="ace/mode/xml"}.call(s.prototype),t.Mode=s});