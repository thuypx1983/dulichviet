<?php
/**
* @file
* Default theme implementation to display the basic html structure of a single
* Drupal page.
*
* Variables:
* - $css: An array of CSS files for the current page.
* - $language: (object) The language the site is being displayed in.
*   $language->language contains its textual representation.
*   $language->dir contains the language direction. It will either be 'ltr' or
*   'rtl'.
* - $html_attributes:  String of attributes for the html element. It can be
*   manipulated through the variable $html_attributes_array from preprocess
*   functions.
* - $html_attributes_array: An array of attribute values for the HTML element.
*   It is flattened into a string within the variable $html_attributes.
* - $body_attributes:  String of attributes for the BODY element. It can be
*   manipulated through the variable $body_attributes_array from preprocess
*   functions.
* - $body_attributes_array: An array of attribute values for the BODY element.
*   It is flattened into a string within the variable $body_attributes.
* - $rdf_namespaces: All the RDF namespace prefixes used in the HTML document.
* - $grddl_profile: A GRDDL profile allowing agents to extract the RDF data.
* - $head_title: A modified version of the page title, for use in the TITLE
*   tag.
* - $head_title_array: (array) An associative array containing the string parts
*   that were used to generate the $head_title variable, already prepared to be
*   output as TITLE tag. The key/value pairs may contain one or more of the
*   following, depending on conditions:
*   - title: The title of the current page, if any.
*   - name: The name of the site.
*   - slogan: The slogan of the site, if any, and if there is no title.
* - $head: Markup for the HEAD section (including meta tags, keyword tags, and
*   so on).
* - $styles: Style tags necessary to import all CSS files for the page.
* - $scripts: Script tags necessary to load the JavaScript files and settings
*   for the page.
* - $page_top: Initial markup from any modules that have altered the
*   page. This variable should always be output first, before all other dynamic
*   content.
* - $page: The rendered page content.
* - $page_bottom: Final closing markup from any modules that have altered the
*   page. This variable should always be output last, after all other dynamic
*   content.
* - $classes String of classes that can be used to style contextually through
*   CSS.
*
* @see bootstrap_preprocess_html()
* @see template_preprocess()
* @see template_preprocess_html()
* @see template_process()
*
* @ingroup templates
*/
?><!DOCTYPE html>
<html<?php print $html_attributes;?><?php print $rdf_namespaces;?>>
<head>
  <link rel="profile" href="<?php print $grddl_profile; ?>" />
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <?php print $head; ?>
  <title><?php print $head_title; ?></title>
  <?php print $styles; ?>
  <!-- HTML5 element support for IE6-8 -->
  <!--[if lt IE 9]>
  <script src="https://cdn.jsdelivr.net/html5shiv/3.7.3/html5shiv-printshiv.min.js"></script>
  <![endif]-->
  <?php print $scripts; ?>
  <!-- vote rate script -->
  <?php

  $node = menu_get_object();
  if ( !empty($node) ) {
    $fivestar = field_view_field('node', $node, 'field_star');
    if($fivestar['#items']['0']){
      if($fivestar['#items']['0']>0){
        $starScript='<script type="application/ld+json">
                            {
                              "@context": "http://schema.org/",
                              "@type": "Review",
                              "itemReviewed": {
                                "@type": "Thing",
                                "name": "'.$node->title.'"
                              },
                              "author": {
                                "@type": "Person",
                                "name": "Hoang viet travel"
                              },
                              "reviewRating": {
                                "@type": "Rating",
                                "ratingValue": "'.(intval($fivestar['#items'][0]['average']/10)).'",
                                "bestRating": "10"
                              },
                              "publisher": {
                                "@type": "Organization",
                                "name": "Du Lịch Hoàng Việt"
                              }
                            }
                            </script>';
      }
      echo $starScript;
    }
  }

  $term = menu_get_object('taxonomy_term', 2);
  if($term){
    if(property_exists($term, 'field_star')){
      $field_star=$term->field_star['und'];
      if($field_star[0]){
        $starScript='<script type="application/ld+json">
                            {
                              "@context": "http://schema.org/",
                              "@type": "Review",
                              "itemReviewed": {
                                "@type": "Thing",
                                "name": "'.$term->name.'"
                              },
                              "author": {
                                "@type": "Person",
                                "name": "Hoang viet travel"
                              },
                              "reviewRating": {
                                "@type": "Rating",
                                "ratingValue": "'.(intval($field_star[0]['rating']/10)).'",
                                "bestRating": "10"
                              },
                              "publisher": {
                                "@type": "Organization",
                                "name": "Du Lịch Hoàng Việt"
                              }
                            }
                            </script>';
      }
    }

  }
  ?>

  <style type="text/css">
    #block-webform-client-block-470{
      display: none;
    }
    .webform-component--product{
      display: none !important;
    }


    .view-news .view-content{
      display: block;
    }
  </style>
  <!-- Google Tag Manager -->
  <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
      new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
      j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
      'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
    })(window,document,'script','dataLayer','GTM-W9LGQDJ');</script>
  <!-- End Google Tag Manager -->

</head>
<body<?php print $body_attributes; ?>>
<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-W9LGQDJ"
                  height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->

<div id="skip-link">
  <a href="#main-content" class="element-invisible element-focusable"><?php print t('Skip to main content'); ?></a>
</div>
<?php print $page_top; ?>
<?php print $page; ?>
<?php print $page_bottom; ?>


<script>
  window.fbAsyncInit = function() {
    FB.init({
      appId      : '1618418868466260',
      xfbml      : true,
      version    : 'v2.8'
    });
    FB.AppEvents.logPageView();
  };

  (function(d, s, id){
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) {return;}
    js = d.createElement(s); js.id = id;
    js.src = "//connect.facebook.net/en_US/sdk.js";
    fjs.parentNode.insertBefore(js, fjs);
  }(document, 'script', 'facebook-jssdk'));
</script>

<script src="https://apis.google.com/js/platform.js" async defer>
  {lang: 'vi'}
</script>

<script type="text/javascript">
  (function($){
    var type=$('#views-exposed-form-search-tour-page #edit-field-type-value');
    var destination=$('#views-exposed-form-search-tour-page #edit-term-node-tid-depth');
    type.change(function(){
      filterDiemDen(type.val());
      destination.val('All');
    })
    $(function(){
      filterDiemDen(type.val());
    })
    function filterDiemDen(type){

      switch (type){
        case "0":
          destination.find('option').each(function(){
            var value=parseInt($(this).attr('value'));
            if(diem_den_trong_nuoc.indexOf(value) > -1){
              $(this).show();
            }else{
              if($(this).val()!='All'){
                $(this).hide();
              }

            }
          })

          break;
        case "1":
          destination.find('option').each(function(){
            var value=parseInt($(this).attr('value'));
            if(diem_den_nuoc_ngoai.indexOf(value) > -1){
              $(this).show();
            }else{
              if($(this).val()!='All'){
                $(this).hide();
              }
            }
          })
          break;
        default:
          destination.find('option').show();
          break;
      }
    }
  })(jQuery)
</script>


<!--Start of Tawk.to Script-->
<script type="text/javascript">
var triggerTawkTo = function () {
	document.getElementById('tawkto-img-trigger').style.display = 'none';
	Tawk_API.showWidget();
	Tawk_API.maximize();
	
	//Tawk_API.toggleVisibility();
	//Tawk_API.toggle();
}
  var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
  
	Tawk_API.onLoad = function(){
		Tawk_API.hideWidget();
	};

	Tawk_API.onChatMinimized = function(){
		Tawk_API.hideWidget();
		document.getElementById('tawkto-img-trigger').style.display = 'block';
	};
	
	Tawk_API.onChatMaximized = function(){
		document.getElementById('tawkto-img-trigger').style.display = 'none';
	};
	
	
  (function(){
    var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
    s1.async=true;
    s1.src='https://embed.tawk.to/58a6b4baa1e7630ada67a405/default';
    s1.charset='UTF-8';
    s1.setAttribute('crossorigin','*');
    s0.parentNode.insertBefore(s1,s0);
  })();
</script>
<!--End of Tawk.to Script-->
</body>
</html>