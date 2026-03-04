<?php

declare(strict_types=1);

use Mstudio\ContaoExhibitorsBundle\Model\ExhibitorModel;

// Modell registrieren
$GLOBALS['TL_MODELS']['tl_exhibitor'] = ExhibitorModel::class;

// Backend-Menü-Eintrag
$GLOBALS['BE_MOD']['content']['exhibitors'] = [
    'tables' => ['tl_exhibitor'],
];
