# Contao Exhibitors Bundle

A Contao 5 bundle for managing and displaying exhibitors — with a table list view and a filterable card view.

## Features

- Backend management for exhibitors with stand number, location, branch/category, reserved flag, company website and company logo
- Branch/category management as a separate backend module
- **List view:** clean HTML table with logo, location and website link
- **Card view:** responsive card grid with JavaScript category filter
- Logos are linked to the exhibitor's website URL
- Published/unpublished toggle per record
- Image resizing configurable per module instance
- German and English translations included

## Requirements

- PHP 8.1 or higher
- Contao 5.0 or higher

## Installation

### Via Packagist

```bash
composer require mstudio-dev/contao-exhibitors:^1.2
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
composer require mstudio-dev/contao-exhibitors:^1.2
```

### After installation

Run the Contao database migrations to create the required tables:

```bash
php bin/console contao:migrate
php bin/console cache:clear
```

## Usage

### Backend

Two new menu entries appear under **Content** in the Contao backend:

- **Branches** (`tl_exhibitor_category`) — manage the list of categories/branches
- **Exhibitors** (`tl_exhibitor`) — manage individual exhibitor records

Each exhibitor record has the following fields:

| Field | Description |
|---|---|
| Company name (`firmenname`) | Full name of the exhibiting company. Mandatory. |
| Stand number (`standplatz`) | Designation of the stand (e.g. A1, B3). Mandatory. |
| Location (`ort`) | City or location of the exhibitor. |
| Reserved (`reserviert`) | Checkbox – marks the stand as reserved. |
| Branch (`branche`) | Category selected from the branch list. |
| Company website (`website`) | URL of the exhibitor's website. |
| Company logo (`logo`) | Single image selected via the file tree. |
| Published (`published`) | Controls visibility in the frontend. |

### Frontend

Two frontend module types are available (category: *Miscellaneous*):

#### Exhibitor list (`exhibitor_list`)

Renders a table with columns for logo (linked to website), company name, location, stand number, reserved status and website. Add the module to any page layout via the Contao module manager.

#### Exhibitor cards (`exhibitor_cards`)

Renders exhibitors as a card grid. If branches are defined, filter buttons appear above the cards allowing visitors to filter by branch without a page reload. The logo is linked to the exhibitor's website URL.

## Template customisation

Default templates:

```
contao/templates/frontend_module/exhibitor_list.html.twig
contao/templates/frontend_module/exhibitor_cards.html.twig
```

To override a template, copy the file into the `templates/` directory of your Contao installation (or a theme subfolder) and adjust as needed. Contao's Twig template inheritance applies.

## License

LGPL-3.0-or-later – see [LICENSE](LICENSE) for details.

## Author

**Markus Schnagl** · [mstudio.de](https://mstudio.de) · [mail@mstudio.de](mailto:mail@mstudio.de)
