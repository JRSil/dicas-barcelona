!function(){if(jQuery&&jQuery.fn&&jQuery.fn.select2&&jQuery.fn.select2.amd)var n=jQuery.fn.select2.amd;n.define("select2/i18n/lt",[],function(){function t(n,e,i,t){return n%10==1&&(n%100<11||19<n%100)?e:2<=n%10&&n%10<=9&&(n%100<11||19<n%100)?i:t}return{inputTooLong:function(n){var e=n.input.length-n.maximum,i="Pašalinkite "+e+" simbol";return i+=t(e,"į","ius","ių")},inputTooShort:function(n){var e=n.minimum-n.input.length,i="Įrašykite dar "+e+" simbol";return i+=t(e,"į","ius","ių")},loadingMore:function(){return"Kraunama daugiau rezultatų…"},maximumSelected:function(n){var e="Jūs galite pasirinkti tik "+n.maximum+" element";return e+=t(n.maximum,"ą","us","ų")},noResults:function(){return"Atitikmenų nerasta"},searching:function(){return"Ieškoma…"}}}),n.define,n.require}();