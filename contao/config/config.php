<?php

declare(strict_types=1);

use Mstudio\ContaoExhibitorsBundle\Model\ExhibitorCategoryModel;
use Mstudio\ContaoExhibitorsBundle\Model\ExhibitorModel;

// Modelle registrieren
$GLOBALS['TL_MODELS']['tl_exhibitor']          = ExhibitorModel::class;
$GLOBALS['TL_MODELS']['tl_exhibitor_category'] = ExhibitorCategoryModel::class;

// Backend-Menü-Einträge
$GLOBALS['BE_MOD']['content']['exhibitor_categories'] = [
    'tables' => ['tl_exhibitor_category'],
];
$GLOBALS['BE_MOD']['content']['exhibitors'] = [
    'tables' => ['tl_exhibitor'],
];
