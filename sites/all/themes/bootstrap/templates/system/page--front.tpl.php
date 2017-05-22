<?php
/**
 * @file
 * Default theme implementation to display a single Drupal page.
 *
 * The doctype, html, head and body tags are not in this template. Instead they
 * can be found in the html.tpl.php template in this directory.
 *
 * Available variables:
 *
 * General utility variables:
 * - $base_path: The base URL path of the Drupal installation. At the very
 *   least, this will always default to /.
 * - $directory: The directory the template is located in, e.g. modules/system
 *   or themes/bartik.
 * - $is_front: TRUE if the current page is the front page.
 * - $logged_in: TRUE if the user is registered and signed in.
 * - $is_admin: TRUE if the user has permission to access administration pages.
 *
 * Site identity:
 * - $front_page: The URL of the front page. Use this instead of $base_path,
 *   when linking to the front page. This includes the language domain or
 *   prefix.
 * - $logo: The path to the logo image, as defined in theme configuration.
 * - $site_name: The name of the site, empty when display has been disabled
 *   in theme settings.
 * - $site_slogan: The slogan of the site, empty when display has been disabled
 *   in theme settings.
 *
 * Navigation:
 * - $main_menu (array): An array containing the Main menu links for the
 *   site, if they have been configured.
 * - $secondary_menu (array): An array containing the Secondary menu links for
 *   the site, if they have been configured.
 * - $breadcrumb: The breadcrumb trail for the current page.
 *
 * Page content (in order of occurrence in the default page.tpl.php):
 * - $title_prefix (array): An array containing additional output populated by
 *   modules, intended to be displayed in front of the main title tag that
 *   appears in the template.
 * - $title: The page title, for use in the actual HTML content.
 * - $title_suffix (array): An array containing additional output populated by
 *   modules, intended to be displayed after the main title tag that appears in
 *   the template.
 * - $messages: HTML for status and error messages. Should be displayed
 *   prominently.
 * - $tabs (array): Tabs linking to any sub-pages beneath the current page
 *   (e.g., the view and edit tabs when displaying a node).
 * - $action_links (array): Actions local to the page, such as 'Add menu' on the
 *   menu administration interface.
 * - $feed_icons: A string of all feed icons for the current page.
 * - $node: The node object, if there is an automatically-loaded node
 *   associated with the page, and the node ID is the second argument
 *   in the page's path (e.g. node/12345 and node/12345/revisions, but not
 *   comment/reply/12345).
 *
 * Regions:
 * - $page['help']: Dynamic help text, mostly for admin pages.
 * - $page['highlighted']: Items for the highlighted content region.
 * - $page['content']: The main content of the current page.
 * - $page['sidebar_first']: Items for the first sidebar.
 * - $page['sidebar_second']: Items for the second sidebar.
 * - $page['header']: Items for the header region.
 * - $page['footer']: Items for the footer region.
 *
 * @see bootstrap_preprocess_page()
 * @see template_preprocess()
 * @see template_preprocess_page()
 * @see bootstrap_process_page()
 * @see template_process()
 * @see html.tpl.php
 *
 * @ingroup templates
 */
?>
<div id="header-top">
    <div class="container">
           <?php print render($page['header_top']); ?>
    </div>
</div>
<div role="banner" id="page-header">
  <div class="header-background" style="background-image: url('http://artkaslowdds.com/wp-content/uploads/2015/03/kaslow-background.png')">
    <div class="container">
      <div class="row">
        <?php print render($page['header']); ?>
      </div>
    </div>
  </div>
   <div class="navigation">
       <div class="container">
           <?php print render($page['navigation']); ?>
       </div>
   </div>
    <div class="home-banner">
        <?php print render($page['home_banner']); ?>
    </div>
</div> <!-- /#page-header -->

<div class="main-container <?php print $container_class; ?>">
  <div class="row">

    <?php if (!empty($page['sidebar_first'])): ?>
      <aside class="col-sm-3" role="complementary">
        <?php print render($page['sidebar_first']); ?>
      </aside>  <!-- /#sidebar-first -->
    <?php endif; ?>

    <section<?php print $content_column_class; ?>>
      <div class="content-container">
          <?php print render($page['content']); ?>
      </div>
    </section>

    <?php if (!empty($page['sidebar_second'])): ?>
      <aside class="col-sm-3" role="complementary">
        <?php print render($page['sidebar_second']); ?>
      </aside>  <!-- /#sidebar-second -->
    <?php endif; ?>

  </div>
</div>
<?php if($page['after_content']):?>
<div class="after-content">
    <div class="<?php print $container_class; ?>">
        <?php print render($page['after_content']); ?>
    </div>
</div>
<?php endif;?>

<?php if($page['before_footer']):?>
<div class="before-footer">
    <div class="<?php print $container_class; ?>">
        <?php print render($page['before_footer']); ?>
    </div>
</div>
<?php endif;?>
<?php
echo '<nav id="mobile-menu">';
function render_menu_tree($menu_tree) {
    print '<ul>';
    foreach ($menu_tree as $link) {
        print '<li>';
        $link_path = '#';
        $link_title = $link['link']['link_title'];
        if($link['link']['link_path']) {
            $link_path = drupal_get_path_alias($link['link']['link_path']);
        }
        print '<a href="/' . str_replace('http://www.hoangviettravel.com.vn/','',str_replace('<front>','',$link_path)) . '">' . $link_title . '</a>';
        if(count($link['below']) > 0) {
            render_menu_tree($link['below']);
        }
        print '</li>';
    }
    print '</ul>';
}
$main_menu_tree = menu_tree_all_data('main-menu', null, 3);

render_menu_tree($main_menu_tree);
echo '</nav>';
?>
<footer class="footer">

        <?php if($page['footer_1']):?>
        <div class="footer-1">
                <?php print render($page['footer_1'])?>
        </div>
        <?php endif;?>
      <?php if($page['footer_2']):?>
        <div class="footer-2">
            <?php print render($page['footer_2'])?>
        </div>
        <?php endif;?>
      <?php if($page['footer_3']):?>
          <div class="footer-3">
            <?php print render($page['footer_3'])?>
            </div>
        <?php endif;?>

    <div class="bottom"><?php print render($page['footer_bottom']); ?></div>
</footer>
