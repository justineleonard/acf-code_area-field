# ACF-Code Area Field

Adds a 'Code Area' textarea editor to the  [Advanced Custom Fields](http://wordpress.org/extend/plugins/advanced-custom-fields/) WordPress plugin.

-----------------------

### Overview

The 'Code Area' field allows you to add custom CSS, Javascript, HTML and PHP to an advanced custom field, whcih can be use anywhere in your wordpress template files.

The code area uses [Code Mirror](http://codemirror.net) and has various themes to suit.

**CSS**
Type your css, no ```<style>``` tags needed

**Javascript**
Type your Javascript, no ```<script>``` tags needed

**PHP**
Type your PHP, no ```<?php ?>``` tags needed (Note, you can not open and close php tags anywhere in your code)

Output all types of code in the usual fashion ```the_field('code_area_field');```

### Screenshots

![ScreenShot](https://raw.github.com/taylormsj/acf-code_area-field/master/screenshot-1.jpg)
Code Area field options

![ScreenShot](https://raw.github.com/taylormsj/acf-code_area-field/master/screenshot-2.jpg)
Editing a Code Area field


### Compatibility

This add-on will work with:

* version 4 and up


### Installation

This add-on can be treated as both a WP plugin and a theme include.

**Install as Plugin**

1. Copy the 'acf-code_area' folder into your plugins folder
2. Activate the plugin via the Plugins admin page
