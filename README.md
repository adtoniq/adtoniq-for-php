## Adtoniq for PHP
Version Adtoniq-PHP-1.0.0

#### What this code does:

This PHP repository consists of several pieces:

1) The Adtoniq for PHP library required to integrate with Adtoniq services. This is in the `src` directory. Prior to integrating with Adtoniq, you should contact Adtoniq at support@adtoniq.com to obtain an Adtoniq API key.

2) An example website showing how to integrate Adtoniq. This is in the `example` directory.

3) PHP Unit tests for the Adtoniq library. This is in the `tests` directory.

Adtoniq for PHP implements the server-to-server communications required between your webserver and Adtoniq. Once a day Adtoniq will initiate communications with your webserver, using a secure protocol, to transmit the latest JavaScript required to ensure Adtoniq continues functioning as new ad block rules are added, or ad blockers are enhanced with new capabilities. In addition, once you are live with Adtoniq, Adtoniq will monitor your website to determine if ad blockers are adding new filter list rules specifically to block ads on your website, and if they are, Adtoniq will immediately send your site an update to ensure your advertising is not blocked. These updates sent by Adtoniq are cached between updates from Adtoniq - you can read more about caching below.

By default, Adtoniq's serves will communicate with your website using the root of your website over https, for example https://www.mysizte.com/. You can customize this URL to be any URL you like, for example https://www.mysizte.com/adtoniq. To customize your update URL, contact adtoniq at support@adtoniq.com and request a custom update URL.

#### Installation Steps:

1) Place the contents of the `/src` folder into the new project, preferably a library or includes folder.

2) On any page that you want the plugin to work, you must add the following code at the top of the PHP code and in the `<head>` section of the page:

```
<?php require_once('path/to/src/adtoniq.php'); ?>

<!DOCTYPE html>
<html>
<head>
...
<?php echo $adtoniq->getHeadCode(); ?>
</head>
</html>
```

This code injection is often placed in a file that the site uses globally as in the test site provided in the `/example` folder (see `/example/header.php`) or may need to be added to a series of individual pages. As for the head code, that only needs to go somewhere within the `<head>` tag, but the `require_once` code *must to appear before any code is rendered to the DOM* in other words *before* the initial `<html>` tag.

3) Within the `adtoniq.php` file, put your API key for the site in the following spot:

```
$adtoniq_config = array(
		'apiKey' => 'Your-API-Key-Here',
		...
	);
```

Don't have an API key? Contact Adtoniq at support@adtoniq.com to get an API key. 

4) Finally, on any page where ads appear, add the following code somewhere within the `<body>` tag:

```
<?php echo $adtoniq->getBodyCode(); ?>
```

This code is part of our ad block detection tests. It should be at the top of the body to run as early as possible.

### Code Snippet Caching / Updating

The `adtoniq.php` file provides a default implementation of the required injected code snippet persistent store. This implementation
uses a simple filesystem storage. <b>This requires that you create a writable directory
named `fs` on your server.</b> Provide a `jsPath` option in the `$adtoniq_config` options to select a different location for storage of the code snippet. This path and directory must be writable by PHP code when served.

Our ad-block handling code is regularly updated in response to changes to ad-block rules, so it is best practice to retrieve the
latest version once a day. You can change the default expiry by providing a `jsExpiry` option (expiry in seconds). The provided implementation retrieves the latest code on the first run and stores it in the
defined location on the filesystem.

You can provide your own `loadScript` and `saveScript` functions using database, memcache, redis or other technologies by 
specifying `loadScript` and `saveScript` options in the `$adtoniq_config` options.

 
