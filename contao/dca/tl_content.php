<?php

use Contao\CoreBundle\DataContainer\PaletteManipulator;
use Contao\StringUtil;
use Contao\DataContainer;
use Contao\Database;
use Contao\Input;

// ---------------------------
// Vorauswahl des Templates /slider_extended.html.twig
// ---------------------------
$GLOBALS['TL_DCA']['tl_content']['config']['onload_callback'][] = static function (DataContainer $dc): void {
    // Den aktuellen CE-Typ zuverlässig ermitteln (neu, edit, Typ-Wechsel)
    $type = null;

    if ($dc->activeRecord && $dc->activeRecord->type) {
        $type = (string) $dc->activeRecord->type;
    } elseif (Input::get('type')) {
        $type = (string) Input::get('type');
    } elseif ($dc->id) {
        $type = (string) Database::getInstance()
            ->prepare('SELECT type FROM tl_content WHERE id=?')
            ->limit(1)
            ->execute($dc->id)
            ->type
        ;
    }

    if ($type !== 'swiper') {
        return;
    }

    // 1) Default setzen
    $GLOBALS['TL_DCA']['tl_content']['fields']['customTpl']['default'] = 'content_element/swiper/slider_extended';

    // 2) Sichtbar im Formular auch wirklich vorauswählen
    $GLOBALS['TL_DCA']['tl_content']['fields']['customTpl']['eval']['load_default'] = true;

    // Optional (strenger): keine leere Option erlauben, dann ist immer etwas gewählt
    // $GLOBALS['TL_DCA']['tl_content']['fields']['customTpl']['eval']['includeBlankOption'] = false;
};

$GLOBALS['TL_DCA']['tl_content']['fields']['customTpl']['load_callback'][] =
    static function ($value, DataContainer $dc) {
        if ($value || !$dc->activeRecord || (string) $dc->activeRecord->type !== 'swiper') {
            return $value;
        }
        return 'content_element/swiper/slider_extended';
};



// ---------------------------
// Felder hinzufügen
// ---------------------------
$GLOBALS['TL_DCA']['tl_content']['fields']['sliderStopAutoplay'] = [
    'label'     => &$GLOBALS['TL_LANG']['tl_content']['sliderStopAutoplay'],
    'inputType' => 'checkbox',
    'eval'      => ['tl_class' => 'w25 clr m12'],
    'sql'       => ['type' => 'boolean', 'default' => false],
];

$GLOBALS['TL_DCA']['tl_content']['fields']['sliderInitClass'] = [
    'label'     => &$GLOBALS['TL_LANG']['tl_content']['sliderInitClass'],
    'inputType' => 'text',
    'eval'      => ['tl_class' => 'w25', 'maxlength' => 64],
    'sql'       => "varchar(64) NOT NULL default ''",
];

$GLOBALS['TL_DCA']['tl_content']['fields']['sliderHideNavigation'] = [
    'label'     => &$GLOBALS['TL_LANG']['tl_content']['sliderHideNavigation'],
    'inputType' => 'checkbox',
    'eval'      => ['tl_class' => 'w25 m12'],
    'sql'       => ['type' => 'boolean', 'default' => false],
];

$GLOBALS['TL_DCA']['tl_content']['fields']['sliderHidePagination'] = [
    'label'     => &$GLOBALS['TL_LANG']['tl_content']['sliderHidePagination'],
    'inputType' => 'checkbox',
    'eval'      => ['tl_class' => 'w25 m12'],
    'sql'       => ['type' => 'boolean', 'default' => false],
];

$GLOBALS['TL_DCA']['tl_content']['fields']['sliderBreakpoints'] = [
    'label'     => &$GLOBALS['TL_LANG']['tl_content']['sliderBreakpoints'],
    'exclude'   => true,
    'inputType' => 'textarea',
    'eval'      => ['tl_class' => 'clr w50', 'rte' => 'ace|json', 'allowHtml' => true],
    'sql'       => 'blob NULL',
    'load_callback' => [static function ($value) {
        if ('' === (string) $value) {
            return null;
        }
        return html_entity_decode($value, ENT_QUOTES, 'UTF-8');
    }],
    'save_callback' => [static function ($value) {
        if ('' === (string) $value) {
            return null;
        }
        return StringUtil::decodeEntities($value);
    }],
];

$GLOBALS['TL_DCA']['tl_content']['fields']['sliderCustomOptions'] = [
    'label'     => &$GLOBALS['TL_LANG']['tl_content']['sliderCustomOptions'],
    'exclude'   => true,
    'inputType' => 'textarea',
    'eval'      => ['tl_class' => 'w50', 'rte' => 'ace|html', 'allowHtml' => true],
    'sql'       => 'blob NULL',
    'load_callback' => [static function ($value) {
        if ('' === (string) $value) {
            return null;
        }
        return html_entity_decode($value, ENT_QUOTES, 'UTF-8');
    }],
    'save_callback' => [static function ($value) {
        if ('' === (string) $value) {
            return null;
        }
        return StringUtil::decodeEntities($value);
    }],
];

// ---------------------------
// Palette erweitern (CE: "swiper")
// ---------------------------
PaletteManipulator::create()
    ->addField('sliderStopAutoplay',   'slider_legend', PaletteManipulator::POSITION_APPEND)
    ->addField('sliderInitClass',      'slider_legend', PaletteManipulator::POSITION_APPEND)
    ->addField('sliderHideNavigation', 'slider_legend', PaletteManipulator::POSITION_APPEND)
    ->addField('sliderHidePagination', 'slider_legend', PaletteManipulator::POSITION_APPEND)
    ->addField('sliderBreakpoints',    'slider_legend', PaletteManipulator::POSITION_APPEND)
    ->addField('sliderCustomOptions',  'slider_legend', PaletteManipulator::POSITION_APPEND)
    ->applyToPalette('swiper', 'tl_content')
;


