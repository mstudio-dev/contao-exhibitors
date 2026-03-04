<?php

declare(strict_types=1);

namespace Mstudio\ContaoExhibitorsBundle\Model;

use Contao\Model;

/**
 * @property int    $id
 * @property int    $pid
 * @property int    $sorting
 * @property int    $tstamp
 * @property string $standplatz
 * @property bool   $reserviert
 * @property string $website
 * @property string $logo
 * @property bool   $published
 */
class ExhibitorModel extends Model
{
    protected static $strTable = 'tl_exhibitor';

    /**
     * Returns all published exhibitors ordered by sorting.
     *
     * @return \Contao\Model\Collection|ExhibitorModel[]|ExhibitorModel|null
     */
    public static function findAllPublished(): \Contao\Model\Collection|self|null
    {
        return static::findBy(
            ['tl_exhibitor.published = ?'],
            [1],
            ['order' => 'tl_exhibitor.sorting ASC']
        );
    }
}
