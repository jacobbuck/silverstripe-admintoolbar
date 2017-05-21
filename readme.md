# silverstripe-admintoolbar

Adds a toolbar to the top of your SilverStripe website front-end with quick links to CMS functionality.

![Screenshot](docs/images/screenshot.png)

## Usage

Place this after the `<body>` in your layout template:

```
$AdminToolbar
```

## Configuration

You can customise the colour scheme to suit your website:

```yaml
AdminToolbar:
  BackgroundColor: '#eeeeee'
  ForegroundColor: '#333333'
```

## Requirements

- Silverstripe 3+

## Installation

The recommended way to install is through Composer:

```
composer require jacobbuck/silverstripe-admintoolbar
```

## Credits

Entypo pictograms by Daniel Bruce — [www.entypo.com](http://www.entypo.com)
