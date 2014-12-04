/* from http://forum.jquery.com/topic/tablesorter-ip-address-sorting-problem */
$.tablesorter.addParser({ 
    id: "ipAddress2", 
    is: function (s) { 
        return /^\d{1,3}[\.]\d{1,3}[\.]\d{1,3}[\.]\d{1,3}$/.test(s); 
    }, format: function (s) { 
        var a = s.split("."), 
              r = "", 
              l = a.length; 
        for (var i = 0; i < 4; i++) { 
            var item = a[i]; 
            if (item.length == 1) { 
                r += "00" + item; 
            } else if (item.length == 2) { 
                r += "0" + item; 
            } else { 
                r += item; 
            } 
        } 
        return $.tablesorter.formatFloat(r); 
    }, type: "numeric" 
});

$(document).ready(function() 
    {
    $(".tablesorter").tablesorter({
/*      sortList: [[0,0]], */
/*      widthFixed: true, */
/*      widgets: ['zebra', 'filter'], */
      headers: {
        0: {
          sorter:'text'
        },
/*        1: {
          sorter:'ipAddress2'
        },
        2: {
          sorter:'ipAddress2'
        },*/
        14: {
          sorter:'digit'
        }
    },
    widgetOptions : {
      // If there are child rows in the table (rows with class name from "cssChildRow" option) 
      // and this option is true and a match is found anywhere in the child row, then it will make that row 
      // visible; default is false 
      filter_childRows : false, 
 
      // if true, a filter will be added to the top of each table column; 
      // disabled by using -> headers: { 1: { filter: false } } OR add class="filter-false" 
      // if you set this to false, make sure you perform a search using the second method below 
      filter_columnFilters : true, 
 
      // css class applied to the table row containing the filters & the inputs within that row 
      filter_cssFilter : 'tablesorter-filter', 
 
      // add custom filter functions using this option 
      // see the filter widget custom demo for more specifics on how to use this option 
      filter_functions : null, 
 
      // if true, filters are collapsed initially, but can be revealed by hovering over the grey bar immediately 
      // below the header row. Additionally, tabbing through the document will open the filter row when an input gets focus 
      filter_hideFilters : true, 
 
      // Set this option to false to make the searches case sensitive 
      filter_ignoreCase : true, 
 
      // jQuery selector string of an element used to reset the filters 
      filter_reset : 'button.reset', 
 
      // Delay in milliseconds before the filter widget starts searching; This option prevents searching for 
      // every character while typing and should make searching large tables faster. 
      filter_searchDelay : 300, 
 
      // Set this option to true to use the filter to find text from the start of the column 
      // So typing in "a" will find "albert" but not "frank", both have a's; default is false 
      filter_startsWith : false, 
 
      // Filter using parsed content for ALL columns 
      // be careful on using this on date columns as the date is parsed and stored as time in seconds 
      filter_useParsedData : false     
    }
  });

/* http://dl.dropbox.com/u/642364/blogger/scripts/jq-highlight-ts.html */
$(".highlighttable tbody td").hover(function() {
          $(this).parents('tr').find('td').addClass('highlight');
        }, function() {
          $(this).parents('tr').find('td').removeClass('highlight');
        });

});

/*
$('".tablesorter tr').click(function(event) {
     $(this).addClass('selected');
});
*/
