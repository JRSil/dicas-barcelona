!function(a){a.fn.serializeForm=function(){if(this.length<1)return!1;var h={},r=h,i=':input[type!="checkbox"][type!="radio"], input:checked',e=function(){if(!this.disabled){var i=this.name.replace(/\[([^\]]+)?\]/g,",$1").split(","),e=i.length-1,t=a(this);if(i[0]){for(var n=0;n<e;n++)r=r[i[n]]=r[i[n]]||(""===i[n+1]||"0"===i[n+1]?[]:{});void 0!==r.length?r.push(t.val()):r[i[e]]=t.val(),r=h}}};return this.filter(i).each(e),this.find(i).each(e),h}}(jQuery);