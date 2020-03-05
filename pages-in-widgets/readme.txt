=== Pages In Widgets ===
Contributors: jayden-major, ramiy, ethanpil, kzeni, Jeroen-1978
Tags: Jayden major, widgets, custom home page, pages on widgets, page, page editor, one page section, page in widget section, filter page content, filter page images
Requires at least: 3.5
Tested up to: 5.3
Stable tag: 1.9.4
License: GPLv3
License URI: http://www.gnu.org/licenses/gpl.html

Pages In Widgets is a simple plugin that allows you to insert a the content of a page created in the normal WordPress pages interface into a widget.

== Description ==
Pages In Widgets is a plugin that allows you to insert a the content of a page created in the normal WordPress pages interface into a widget.

This most helpful on theme where the from page is a serious of widget areas. By using this widget it allows you to edit widgets areas using the visual editor build into WordPress.

This plugin is open source (GPLv3), any changes can be contributed at [https://github.com/JaydenMajor/Pages-In-Widgets](https://github.com/JaydenMajor/Pages-In-Widgets)

== Installation ==
= Install From WordPress Repository =
1. Find and Install & activate Pages In Widgets
2. To use go to widgets and drag & drop the Pages In Widgets widget to the selected section
3. The widget will ask you to select a page and if you want to display the page title
4. Save the content for the selected page will now be included in the widget section

= Install Via Upload =
1. Download the Pages In Widgets plugin from either wordpress.org of jaydenmajor.com/plugins
2. Upload, Install & activate Pages In Widgets
3. To use go to widgets and drag & drop the Pages In Widgets widget to the selected section
4. The widget will ask you to select a page and if you want to display the page title
5. Save the content for the selected page will now be included in the widget sectiion

== Frequently Asked Questions ==

= Why did you developed this plugin? =
I developed this plugin because i found that i was writing HTML in text widgets and the sites needed to be edited by non technical people and inserting a page into a widget was the easiest way.

= Can i use filters to change the plugin output? =
Yes. There are two filters for each posts and pages output. For content `postsinwidgets_content` and `pagesinwidgets_content` as well as `pagesinwidgets_image` and `postsinwidgets_image` for filtering images.

== Screenshots ==
1. Screenshot of the plugin working in a widget area.
2. New updated screenshot of the widget options.

== Change Log ==
= 1.9.4 =
Release Data: March 6, 2020
* Feature - Include the option to sho private posts in the posts in pages widget

= 1.9.3 =
Release Date: December 17, 2019
* Bug Fix - Fixed an issue were the output of the post title would be an h4 even when configured otherwise. - This bug weas only posts and not for pages.

= 1.9.2 =
Release Date: December 13, 2019
* Bug Fix - Fixed an issue were the image output wasn't being output.

= 1.9.1 = 
Release Date: December 12, 2019
* Hot Fix - Bug that would have required to open the widget and save. Re saveing widgets no longer required.

= 1.9 =
Release Date: December 12, 2019
* Added Filters for both content and images.
* Thanks to @kzeni for provideing this update.

= 1.8 =
Release Date: July 31, 2019
* Added ability to change heading Type.
* Fixed some activation issues after updateing.

= 1.7 =
Release Date: May 03, 2016
* Added Widget to allow inserting of posts into widgets areas
* Changed plugin structure to better support the above changes
* Changed the way the plugin queries for pages and posts - Should help with some peoples problems with the plugin

= 1.6.1 =
* Updated Widget to add adisional checks.
* Changed the way the plugin outputs data to display the page.

= 1.6 =
Release Date: Dec 29, 2015
* Added Output Type Selection
* By Default keep html page formatting i.e. previous version just removed some html tags

= 1.5 =
Release Date: Dec 06, 2015
* i18n: Use [translate.wordpress.org](https://translate.wordpress.org/) to translate the plugin.
* i18n: Update textdomain, same as the plugin slug.
* Add phpDocs.

= 1.4 =
Release Date: Nov 18, 2015
* Added Custom class opton.

= 1.3 =
Release Date: Oct 16, 2015
* Security: Prevent direct access to php files.
* Security: Prevent direct access to directory.
* i18n: Add translation functions.

= 1.2.1 =
* Changed widget title form Page Widget -> Pages In Widget.

= 1.2 =
Release Date: Aug 11, 2015
* Bug Fix: Move away from using PHP 4 style constrictors - Needed for wordpress 4.3.

= 1.1 =
Release Date: May 13, 2015
* Bug Fix: Fixed issue were widget appeared to loose preferences. (No preferences were lost this was just a display error).

= 1.0 =
Release Date: May 12, 2015
* Initial release.

== Upgrade Notice ==
= 1.9 =
Added filters for both post and page, content and images.

= 1.7 =
Added Widget to allow inserting of posts into widgets areas

= 1.6 =
Some users have had some problems with version 1.6 please use 1.6.1 or later.

= 1.1=
This version fixes the bugs in version 1.0 please update.

= 1.0 =
This version contains major bugs please use a newer version.
