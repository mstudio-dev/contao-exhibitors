<?php

declare(strict_types=1);

// Template-Auswahl für das Ausstellerlisten-Modul einblenden
$GLOBALS['TL_DCA']['tl_module']['palettes']['exhibitor_list'] =
    '{title_legend},name,headline,type;'
    . '{image_legend:hide},imgSize;'
    . '{template_legend:hide},customTpl;'
    . '{protected_legend:hide},protected;'
    . '{expert_legend:hide},guests,cssID';
