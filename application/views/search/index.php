<div id="cse" style="width: 100%;">Molimo sačekajte</div>
<script src="http://www.google.com/jsapi" type="text/javascript"></script>
<script type="text/javascript"> 
  google.load('search', '1', {language : 'hr', style : google.loader.themes.MINIMALIST});
  google.setOnLoadCallback(function() {
    var customSearchOptions = {};
    var googleAnalyticsOptions = {};
    googleAnalyticsOptions['queryParameter'] = 'q';
    googleAnalyticsOptions['categoryParameter'] = '';
    customSearchOptions['googleAnalyticsOptions'] = googleAnalyticsOptions;  var customSearchControl = new google.search.CustomSearchControl(
      'partner-pub-5920907941595022:0417076365', customSearchOptions);
    customSearchControl.setResultSetSize(google.search.Search.FILTERED_CSE_RESULTSET);
    var options = new google.search.DrawOptions();
    options.setAutoComplete(true);
    options.enableSearchResultsOnly(); 
    customSearchControl.draw('cse', options);
    function parseParamsFromUrl() {
      var params = {};
      var parts = window.location.search.substr(1).split('\x26');
      for (var i = 0; i < parts.length; i++) {
        var keyValuePair = parts[i].split('=');
        var key = decodeURIComponent(keyValuePair[0]);
        params[key] = keyValuePair[1] ?
            decodeURIComponent(keyValuePair[1].replace(/\+/g, ' ')) :
            keyValuePair[1];
      }
      return params;
    }

    var urlParams = parseParamsFromUrl();
    var queryParamName = "q";
    if (urlParams[queryParamName]) {
      customSearchControl.execute(urlParams[queryParamName]);
    }
  }, true);
</script>

<style type="text/css">
  .gsc-control-cse {
    font-family: Arial, sans-serif;
    border-color: #1F1F1F;
    background-color: transparent;
  }
  .gsc-control-cse .gsc-table-result {
    font-family: Arial, sans-serif;
  }
  input.gsc-input {
    border-color: #BBBBBB;
  }
  input.gsc-search-button {
    border-color: #000000;
    background-color: #333333;
  }
  .gsc-tabHeader.gsc-tabhInactive {
    border-color: #777777;
    background-color: #777777;
  }
  .gsc-tabHeader.gsc-tabhActive {
    border-color: #333333;
    background-color: #333333;
  }
  .gsc-tabsArea {
    border-color: #333333;
  }
  .gsc-webResult.gsc-result,
  .gsc-results .gsc-imageResult {
    border-color: #666666;
    background-color: #333333;
  }
  .gsc-webResult.gsc-result:hover,
  .gsc-imageResult:hover {
    border-color: #666666;
    background-color: #333333;
  }
  .gsc-webResult.gsc-result.gsc-promotion:hover {
    border-color: #666666;
    background-color: #333333;
  }
  .gs-webResult.gs-result a.gs-title:link,
  .gs-webResult.gs-result a.gs-title:link b,
  .gs-imageResult a.gs-title:link,
  .gs-imageResult a.gs-title:link b {
    color: #64D9FF;
  }
  .gs-webResult.gs-result a.gs-title:visited,
  .gs-webResult.gs-result a.gs-title:visited b,
  .gs-imageResult a.gs-title:visited,
  .gs-imageResult a.gs-title:visited b {
    color: #666666;
  }
  .gs-webResult.gs-result a.gs-title:hover,
  .gs-webResult.gs-result a.gs-title:hover b,
  .gs-imageResult a.gs-title:hover,
  .gs-imageResult a.gs-title:hover b {
    color: #999999;
  }
  .gs-webResult.gs-result a.gs-title:active,
  .gs-webResult.gs-result a.gs-title:active b,
  .gs-imageResult a.gs-title:active,
  .gs-imageResult a.gs-title:active b {
    color: #33ffff;
  }
  .gsc-cursor-page {
    color: #64D9FF;
  }
  a.gsc-trailing-more-results:link {
    color: #64D9FF;
  }
  .gs-webResult .gs-snippet,
  .gs-imageResult .gs-snippet,
  .gs-fileFormatType {
    color: #AAAAAA;
  }
  .gs-webResult div.gs-visibleUrl,
  .gs-imageResult div.gs-visibleUrl {
    color: #c0c0c0;
  }
  .gs-webResult div.gs-visibleUrl-short {
    color: #c0c0c0;
  }
  .gs-webResult div.gs-visibleUrl-short {
    display: block;
  }
  .gs-webResult div.gs-visibleUrl-long {
    display: none;
  }
  .gs-promotion div.gs-visibleUrl-short {
    display: none;
  }
  .gs-promotion div.gs-visibleUrl-long {
    display: block;
  }
  .gsc-cursor-box {
    border-color: #666666;
  }
  .gsc-results .gsc-cursor-box .gsc-cursor-page {
    border-color: #777777;
    background-color: #333333;
    color: #64D9FF;
  }
  .gsc-results .gsc-cursor-box .gsc-cursor-current-page {
    border-color: #333333;
    background-color: #333333;
    color: #666666;
  }
  .gsc-webResult.gsc-result.gsc-promotion {
    border-color: #CCCCCC;
    background-color: #E6E6E6;
  }
  .gsc-completion-title {
    color: #64D9FF;
  }
  .gsc-completion-snippet {
    color: #AAAAAA;
  }
  .gs-promotion a.gs-title:link,
  .gs-promotion a.gs-title:link *,
  .gs-promotion .gs-snippet a:link {
    color: #0000CC;
  }
  .gs-promotion a.gs-title:visited,
  .gs-promotion a.gs-title:visited *,
  .gs-promotion .gs-snippet a:visited {
    color: #0000CC;
  }
  .gs-promotion a.gs-title:hover,
  .gs-promotion a.gs-title:hover *,
  .gs-promotion .gs-snippet a:hover {
    color: #444444;
  }
  .gs-promotion a.gs-title:active,
  .gs-promotion a.gs-title:active *,
  .gs-promotion .gs-snippet a:active {
    color: #00CC00;
  }
  .gs-promotion .gs-snippet,
  .gs-promotion .gs-title .gs-promotion-title-right,
  .gs-promotion .gs-title .gs-promotion-title-right *  {
    color: #333333;
  }
  .gs-promotion .gs-visibleUrl,
  .gs-promotion .gs-visibleUrl-short {
    color: #00CC00;
  }</style>