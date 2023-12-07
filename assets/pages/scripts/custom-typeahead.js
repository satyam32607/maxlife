var ComponentsTypeahead = function () {

    var handleTwitterTypeahead = function() {
        // Example #3
        var custom = new Bloodhound({
          datumTokenizer: function(d) { return d.tokens; },
          queryTokenizer: Bloodhound.tokenizers.whitespace,
          remote: {
            url: path+'ajaxrequest/auto_search?query=%QUERY',
            wildcard: '%QUERY'
          }
        });
         
        custom.initialize();
         
        if (App.isRTL()) {
          $('#auto_search_users').attr("dir", "rtl");  
        }  
        $('#auto_search_users').typeahead(null, {
          name: 'datypeahead_example_3',
          displayKey: 'value',
          source: custom.ttAdapter(),
          hint: (App.isRTL() ? false : true),
          templates: {
            suggestion: Handlebars.compile([
              '<div class="media">',
                    '<div class="pull-left">',
                        '<div class="media-object">',
                            '<a href="{{href_tag}}" target="_blank"><img src="{{img}}" width="50" height="50"/></a>',
                        '</div>',
                    '</div>',
                    '<div class="media-body">',
                        '<a href="{{href_tag}}" target="_blank"><h6 class="media-heading">{{value}}</h6></a>',
                        '<p>{{desc}}</p>',
                    '</div>',
              '</div>',
            ].join(''))
          }
        });


    }

    return {
        //main function to initiate the module
        init: function () {
            handleTwitterTypeahead();           
        }
    };

}();

jQuery(document).ready(function() {    
   ComponentsTypeahead.init(); 
});