<?php

declare(strict_types=1);

namespace Mstudio\ContaoExhibitorsBundle\Model;

use Contao\Model;

/**
 * @property int    $id
 * @property int    $sorting
 * @property int    $tstamp
 * @property string $title
 */
class ExhibitorCategoryModel extends Model
{
    protected static $strTable = 'tl_exhibitor_category';

    /**
     * @return \Contao\Model\Collection|ExhibitorCategoryModel[]|ExhibitorCategoryModel|null
     */
    public static function findAllSorted(): \Contao\Model\Collection|self|null
    {
        return static::findAll(['order' => 'tl_exhibitor_category.title ASC']);
    }
}
