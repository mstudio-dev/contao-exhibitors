# Contao Exhibitors Bundle

A Contao 5 bundle that provides a simple tabular exhibitor list as a frontend module.

## Features

- Backend management for exhibitors (stand number, reserved flag, company website, company logo)
- Frontend module rendering a clean HTML table
- Published/unpublished toggle per record
- German and English translations included

## Requirements

- PHP 8.1 or higher
- Contao 5.0 or higher

## Installation

### Via Packagist

```bash
composer require mstudio-dev/contao-exhibitors:^1.0
```

### Via GitHub (without Packagist)

Add the repository to the `composer.json` of your Contao installation:

```json
"repositories": [
    {
        "type": "vcs",
        "url": "https://github.com/mstudio-dev/contao-exhibitors"
    }
]
```

Then require the bundle:

```bash
composer require mstudio-dev/contao-exhibitors:^1.0
```

### After installation

Run the Contao database migrations to create the `tl_exhibitor` table:

```bash
php bin/console contao:migrate
php bin/console cache:clear
```

## Usage

### Backend

A new menu entry **Exhibitors** appears under **Content** in the Contao backend. Each record has the following fields:

| Field | Description |
|---|---|
| Stand number (`standplatz`) | Designation of the stand (e.g. A1, B3). Mandatory. |
| Reserved (`reserviert`) | Checkbox – marks the stand as reserved. |
| Company website (`website`) | URL of the exhibitor's website. |
| Company logo (`logo`) | Single image selected via the file tree. |
| Published (`published`) | Controls visibility in the frontend. |

### Frontend

Add the **Exhibitor list** module (category: *Miscellaneous*) to any page layout via the Contao module manager. Only published records are shown, ordered by stand number.

## Template customisation

The default template is located at:

```
contao/templates/frontend_module/exhibitor_list.html.twig
```

To override it, copy the file into the `templates/` directory of your Contao installation (or a theme subfolder) and adjust as needed. Contao's Twig template inheritance applies.

## License

LGPL-3.0-or-later – see [LICENSE](LICENSE) for details.

## Author

**Markus Schnagl** · [mstudio.de](https://mstudio.de) · [mail@mstudio.de](mailto:mail@mstudio.de)
