<?php

declare(strict_types=1);

namespace Mstudio\ContaoExhibitorsBundle\Controller\FrontendModule;

use Contao\CoreBundle\Controller\FrontendModule\AbstractFrontendModuleController;
use Contao\CoreBundle\DependencyInjection\Attribute\AsFrontendModule;
use Contao\CoreBundle\Image\ImageFactoryInterface;
use Contao\CoreBundle\Twig\FragmentTemplate;
use Contao\FilesModel;
use Contao\ModuleModel;
use Contao\StringUtil;
use Mstudio\ContaoExhibitorsBundle\Model\ExhibitorCategoryModel;
use Mstudio\ContaoExhibitorsBundle\Model\ExhibitorModel;
use Symfony\Component\DependencyInjection\Attribute\Autowire;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

#[AsFrontendModule(
    type: 'exhibitor_cards',
    category: 'miscellaneous',
    template: 'frontend_module/exhibitor_cards',
)]
class ExhibitorCardsController extends AbstractFrontendModuleController
{
    public function __construct(
        private readonly ImageFactoryInterface $imageFactory,
        #[Autowire('%kernel.project_dir%')]
        private readonly string $projectDir,
    ) {
    }

    protected function getResponse(FragmentTemplate $template, ModuleModel $model, Request $request): Response
    {
        $exhibitors = ExhibitorModel::findAllPublished();
        $size = StringUtil::deserialize($model->imgSize);

        $rows = [];

        if (null !== $exhibitors) {
            foreach ($exhibitors as $exhibitor) {
                $logoPath = null;

                if ($exhibitor->logo) {
                    $logoModel = FilesModel::findByUuid($exhibitor->logo);

                    if (null !== $logoModel) {
                        if (!empty($size[0]) || !empty($size[1]) || !empty($size[2])) {
                            try {
                                $imageObj = $this->imageFactory->create(
                                    $this->projectDir . '/' . $logoModel->path,
                                    $size,
                                );
                                $logoPath = $imageObj->getUrl($this->projectDir);
                            } catch (\Exception) {
                                $logoPath = $logoModel->path;
                            }
                        } else {
                            $logoPath = $logoModel->path;
                        }
                    }
                }

                $rows[] = [
                    'firmenname'   => $exhibitor->firmenname,
                    'standplatz'   => $exhibitor->standplatz,
                    'ort'          => $exhibitor->ort,
                    'reserviert'   => (bool) $exhibitor->reserviert,
                    'website'      => $exhibitor->website,
                    'logoPath'     => $logoPath,
                    'logoAlt'      => $exhibitor->firmenname,
                    'brancheId'    => (int) $exhibitor->branche,
                    'brancheLabel' => '',
                ];
            }
        }

        $categories = [];
        $categoryCollection = ExhibitorCategoryModel::findAllSorted();

        if (null !== $categoryCollection) {
            foreach ($categoryCollection as $cat) {
                $categories[] = [
                    'id'    => (int) $cat->id,
                    'title' => $cat->title,
                ];
            }

            // Fill brancheLabel in rows
            $catMap = array_column($categories, 'title', 'id');
            foreach ($rows as &$row) {
                if ($row['brancheId'] && isset($catMap[$row['brancheId']])) {
                    $row['brancheLabel'] = $catMap[$row['brancheId']];
                }
            }
            unset($row);
        }

        $template->set('rows', $rows);
        $template->set('categories', $categories);

        return $template->getResponse();
    }
}
