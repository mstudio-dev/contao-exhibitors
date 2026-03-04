<?php

declare(strict_types=1);

use Contao\DC_Table;
use Contao\DataContainer;
use Contao\Backend;

$GLOBALS['TL_DCA']['tl_exhibitor'] = [
    // Config
    'config' => [
        'dataContainer'    => DC_Table::class,
        'enableVersioning' => true,
        'sql' => [
            'keys' => [
                'id'        => 'primary',
                'published' => 'index',
            ],
        ],
    ],

    // List
    'list' => [
        'sorting' => [
            'mode'        => DataContainer::MODE_SORTABLE,
            'fields'      => ['standplatz'],
            'flag'        => DataContainer::SORT_INITIAL_LETTER_ASC,
            'panelLayout' => 'filter;search,limit',
        ],
        'label' => [
            'fields'      => ['standplatz', 'reserviert'],
            'format'      => '%s',
            'label_callback' => ['tl_exhibitor', 'addStatusIcon'],
        ],
        'global_operations' => [
            'all' => [
                'href'       => 'act=select',
                'class'      => 'header_edit_all',
                'attributes' => 'onclick="Backend.getScrollOffset()" accesskey="e"',
            ],
        ],
        'operations' => [
            'edit' => [
                'href'  => 'act=edit',
                'icon'  => 'edit.svg',
            ],
            'copy' => [
                'href'  => 'act=copy',
                'icon'  => 'copy.svg',
            ],
            'delete' => [
                'href'       => 'act=delete',
                'icon'       => 'delete.svg',
                'attributes' => 'onclick="if(!confirm(\''.($GLOBALS['TL_LANG']['MSC']['deleteConfirm'] ?? 'Wirklich löschen?').'\'))return false;Backend.getScrollOffset()"',
            ],
            'toggle' => [
                'href'         => 'act=toggle&amp;field=published',
                'icon'         => 'visible.svg',
                'showInHeader' => true,
            ],
            'show' => [
                'href' => 'act=show',
                'icon' => 'show.svg',
            ],
        ],
    ],

    // Palettes
    'palettes' => [
        'default' => '{exhibitor_legend},standplatz,reserviert;{contact_legend},website,logo;{publish_legend},published',
    ],

    // Fields
    'fields' => [
        'id' => [
            'sql' => ['type' => 'integer', 'unsigned' => true, 'autoincrement' => true],
        ],
        'tstamp' => [
            'sql' => ['type' => 'integer', 'unsigned' => true, 'default' => 0],
        ],
        'sorting' => [
            'sql' => ['type' => 'integer', 'unsigned' => true, 'default' => 0],
        ],

        // Standplatz
        'standplatz' => [
            'inputType' => 'text',
            'exclude'   => true,
            'search'    => true,
            'filter'    => false,
            'sorting'   => true,
            'flag'      => DataContainer::SORT_INITIAL_LETTER_ASC,
            'eval'      => ['mandatory' => true, 'maxlength' => 64, 'tl_class' => 'w50'],
            'sql'       => ['type' => 'string', 'length' => 64, 'default' => ''],
        ],

        // Reserviert-Flag
        'reserviert' => [
            'inputType' => 'checkbox',
            'exclude'   => true,
            'filter'    => true,
            'eval'      => ['tl_class' => 'w50 m12'],
            'sql'       => ['type' => 'boolean', 'default' => false],
        ],

        // Website
        'website' => [
            'inputType' => 'text',
            'exclude'   => true,
            'search'    => true,
            'eval'      => [
                'rgxp'      => 'url',
                'maxlength' => 255,
                'tl_class'  => 'w50',
                'decodeEntities' => true,
            ],
            'sql' => ['type' => 'string', 'length' => 255, 'default' => ''],
        ],

        // Firmenlogo
        'logo' => [
            'inputType'  => 'fileTree',
            'exclude'    => true,
            'eval'       => [
                'filesOnly'  => true,
                'extensions' => '%contao.image.valid_extensions%',
                'fieldType'  => 'radio',
                'tl_class'   => 'clr',
            ],
            'sql'        => ['type' => 'binary', 'length' => 16, 'notnull' => false, 'fixed' => true],
        ],

        // Veröffentlicht
        'published' => [
            'inputType' => 'checkbox',
            'exclude'   => true,
            'filter'    => true,
            'eval'      => ['doNotCopy' => true, 'tl_class' => 'w50'],
            'sql'       => ['type' => 'boolean', 'default' => false],
        ],
    ],
];

class tl_exhibitor extends Backend
{
    public function addStatusIcon(array $row, string $label): string
    {
        if ($row['reserviert']) {
            return '<span style="color:#b00">&#9632;</span> ' . $label . ' <em>(reserviert)</em>';
        }

        return '<span style="color:#090">&#9632;</span> ' . $label;
    }
}
