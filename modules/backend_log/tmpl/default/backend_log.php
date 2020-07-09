<?php
/**
 * The display code for the main welcome page that lists the available mythweb
 * sections.
 *
 * @license     GPL
 *
 * @package     MythWeb
 *
 **/

// Set the desired page title
    $page_title = 'MythTV - '.t('Backend Logs');

// Custom headers
    $headers[] = '<link rel="stylesheet" type="text/css" href="'.skin_url.'/backend_log.css">';

// Print the page header
    require 'modules/_shared/tmpl/'.tmpl.'/header.php';

echo "<pre>\n";
readfile("/var/log/mythtv/mythbackend.log");
echo "\n</pre>\n";
// Print the page footer
    require 'modules/_shared/tmpl/'.tmpl.'/footer.php';
