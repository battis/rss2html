<?php

require ("vendor/kellan/magpierss/rss_fetch.inc");

if (isset($_GET["rss"]))
{
	$rss = fetch_rss($_GET["rss"]);

	?><html>
<head>
	<title><?= $rss->channel["title"] ?></title>
	<style type="text/css"><!--
		body {
			font-family: helvetica, arial, sans-serif;
			font-size: 10pt;
		}
		h1 {
			font-weight: bold;
			font-size: 14pt;
		}
		dt {
			font-weight: bold;
			padding-top: 10pt;
		}
		dd {
			padding-top: 4pt;
		}
	--></style>
	<base target="_blank" />
</head>
<body>
<h1><?= $rss->channel["title"] ?></h1>
<dl>	
<?php
	foreach ($rss->items as $item)
	{
		echo "<dt><a href=\"{$item["link"]}\">{$item["title"]}</a></dt>";
		if (isset ($item["content"]["encoded"]))
		{
			echo "<dd>{$item["content"]["encoded"]}</dd>";
		}
		elseif (isset ($item["atom_content"]))
		{
			echo "<dd>{$item["atom_content"]}</dd>";
		}
		else
		{
			while (list($key, $value) = each ($item))
			{
				echo "<dd>{$key} = {$value}</dd>";
			}
		}
	}
?>
</dl>
<?php include_once("{$_SERVER["DOCUMENT_ROOT"]}/components/google-analytics-tracker.php"); ?>
</body>
</html><?php
} else {
?><html>
<head>
	<title>rss2html</title>
</head>
<body>
	<h1>rss2html</h1>
	<p>A quick script to convert RSS feeds into embeddable HTML.</p>
	<p>http://battis.net/sandbox/rss2html?rss=URL_FOR_RSS_FEED</p>
</body>
</html><?php } ?>