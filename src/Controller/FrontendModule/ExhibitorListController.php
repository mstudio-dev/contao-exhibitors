<?php

declare(strict_types=1);

namespace Mstudio\ContaoExhibitorsBundle\Controller\FrontendModule;

use Contao\CoreBundle\Controller\FrontendModule\AbstractFrontendModuleController;
use Contao\CoreBundle\DependencyInjection\Attribute\AsFrontendModule;
use Contao\CoreBundle\Twig\FragmentTemplate;
use Contao\FilesModel;
use Contao\ModuleModel;
use Mstudio\ContaoExhibitorsBundle\Model\ExhibitorModel;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

#[AsFrontendModule(
    type: 'exhibitor_list',
    category: 'miscellaneous',
    template: 'frontend_module/exhibitor_list',
)]
class ExhibitorListController extends AbstractFrontendModuleController
{
    protected function getResponse(FragmentTemplate $template, ModuleModel $model, Request $request): Response
    {
        $exhibitors = ExhibitorModel::findAllPublished();

        $rows = [];

        if (null !== $exhibitors) {
            foreach ($exhibitors as $exhibitor) {
                $logoModel = null;

                if ($exhibitor->logo) {
                    $logoModel = FilesModel::findByUuid($exhibitor->logo);
                }

                $rows[] = [
                    'standplatz'  => $exhibitor->standplatz,
                    'reserviert'  => (bool) $exhibitor->reserviert,
                    'website'     => $exhibitor->website,
                    'logo'        => $logoModel,
                ];
            }
        }

        $template->set('rows', $rows);

        return $template->getResponse();
    }
}
