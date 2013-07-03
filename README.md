# Plugins Exporter
Easily (one-click) export any installed Wordpress plugin. It adds an 'Export' link to each plugin Action Links list in the Plugins Admin Page.

-----------------------

### Overview

Adds an 'Export' link to each plugin Action Links list in the Plugins Admin Page.

### Installation

This add-on can be treated as both a WP plugin and a theme include.

**Install as Plugin**

Copy the 'wp-plugins-exporter' folder into your plugins folder
Activate the plugin via the Plugins Admin Page

**Include within theme**

1.	Copy the 'wp-plugins-exporter' folder into your theme folder (can use sub folders). You can place the folder anywhere inside the 'wp-content' directory
2.	Edit your functions.php file and add the code below (Make sure the path is correct to include the wp-plugins-exporter.php file)

```php
include_once('wp-plugins-exporter/wp-plugins-exporter.php');
```
