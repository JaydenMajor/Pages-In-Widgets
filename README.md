# Pages In Widgets

**Contributors:** jayden-major, ramiy, ethanpil, kzeni

**Version:** 1.9.1

**Tags:** Jayden major, widgets, custom home page, pages on widgets, page, page editor, filter page content, filter page images

**Requires at least:** WordPress 3.5

**Tested up to:** 5.3

**License:** GPLv3

**License URI:** http://www.gnu.org/licenses/gpl.html

Pages In Widgets is a plugin that allows you to insert a the content of a page created in the normal WordPress pages interface into a widget.


## Description 
Pages In Widgets is a plugin that allows you to insert a the content of a page created in the normal WordPress pages interface into a widget.

This most helpful on theme where the from page is a serious of widget areas. By using this widget it allows you to edit widgets areas using the visual editor build into WordPress.

This plugin is open source (GPLv3), any changes can be contributed at [https://github.com/JaydenMajor/Pages-In-Widgets](https://github.com/JaydenMajor/Pages-In-Widgets)

## Installation

### Install From WordPress Repository
1. Find and Install & activate Pages In Widgets - https://wordpress.org/plugins/pages-in-widgets/

2. To use go to widgets and drag & drop the Pages In Widgets widget to the selected section

3. The widget will ask you to select a page and if you want to display the page title

4. Save the content for the selected page will now be included in the widget section

### Install Via Upload 
1. Download the Pages In Widgets plugin from either wordpress.org of jaydenmajor.com/plugins

2. Upload, Install & activate Pages In Widgets

3. To use go to widgets and drag & drop the Pages In Widgets widget to the selected section

4. The widget will ask you to select a page and if you want to display the page title

5. Save the content for the selected page will now be included in the widget secti5

### Install From Git Hub
1. Download or clone from https://github.com/JaydenMajor/Pages-In-Widgets/

2. The directoy pagesingwidgets is the you want to zip and upload or paste in you wp-plugins folder

3. From this point on you can follow Install Via Upload Step 2 onward.


## Frequently Asked Questions

### Why did you develop this plugin?
I developed this plugin because i found that i was writing HTML in text widgets and the sites needed to be edited by non technical people and inserting a page into a widget was the easiest way.

### Can i use filters to change the plugin output?
Yes. There are two filters for each posts and pages output. For content `postsinwidgets_content` and `pagesinwidgets_content` as well as `pagesinwidgets_image` and `postsinwidgets_image` for filtering images.

## Change Log
### 1.9.1
Release Date: December 12, 2019
* Hot Fix - Bug that would have required to open the widget and save. Re saveing widgets no longer required.

### 1.9
Release Date: December 12, 2019
* Added filters and widget options for both content output and images.
* Thanks to @kzeni for providing this update.

### 1.8
Release Date: July 31, 2019
* Added ability to change heading Type.
* Fixed some activation issues after updateing.

### 1.7
Release Date: May 03, 2016
* Added Widget to allow inserting of posts into widgets areas
* Changed plugin structure to better support the above changes
* Changed the way the plugin queries for pages and posts - Should help with some peoples problems with the plugin

### 1.6.1
* Added Output Type Selection
* By Default keep html page formatting i.e. previous version just removed some html tags

### 1.6
Realse Date: Dec 29, 2015
* Added Output Type Selection
* By Default keep html page formatting i.e. previous version just removed some html tags

### 1.5
Realse Date: Dec 06, 2015
* i18n: Use translate.wordpress.org to translate the plugin.
* i18n: Update textdomain, same as the plugin slug.
* Add phpDocs.

### 1.4
Realse Date: Nov 18, 2015
* Added Custom class opton.

### 1.3
Release Date: Oct 16, 2015
* Security: Prevent direct access to php files.
* Security: Prevent direct access to directory.
* i18n: Add translation functions.

### 1.2.1
* Changed widget title form Page Widget -> Pages In Widget.

### 1.2
Release Date: Aug 11, 2015
* Bug Fix: Move away from using PHP 4 style constrictors - Needed for wordpress 4.3.

### 1.1
Release Date: May 13, 2015
* Bug Fix: Fixed issue were widget appeared to loose preferences. (No preferences were lost this was just a display error).

### 1.0
Release Date: May 12, 2015

* Initial release.
