!function(){if(jQuery&&jQuery.fn&&jQuery.fn.select2&&jQuery.fn.select2.amd)var e=jQuery.fn.select2.amd;e.define("select2/i18n/sl",[],function(){return{errorLoading:function(){return"Zadetkov iskanja ni bilo mogoče naložiti."},inputTooLong:function(e){var n=e.input.length-e.maximum,i="Prosim zbrišite "+n+" znak";return 2==n?i+="a":1!=n&&(i+="e"),i},inputTooShort:function(e){var n=e.minimum-e.input.length,i="Prosim vpišite še "+n+" znak";return 2==n?i+="a":1!=n&&(i+="e"),i},loadingMore:function(){return"Nalagam več zadetkov…"},maximumSelected:function(e){var n="Označite lahko največ "+e.maximum+" predmet";return 2==e.maximum?n+="a":1!=e.maximum&&(n+="e"),n},noResults:function(){return"Ni zadetkov."},searching:function(){return"Iščem…"}}}),e.define,e.require}();