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
use Mstudio\ContaoExhibitorsBundle\Model\ExhibitorModel;
use Symfony\Component\DependencyInjection\Attribute\Autowire;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

#[AsFrontendModule(
    type: 'exhibitor_list',
    category: 'miscellaneous',
    template: 'mod_exhibitor_list',
)]
class ExhibitorListController extends AbstractFrontendModuleController
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
                    'firmenname' => $exhibitor->firmenname,
                    'standplatz' => $exhibitor->standplatz,
                    'reserviert' => (bool) $exhibitor->reserviert,
                    'website'    => $exhibitor->website,
                    'logoPath'   => $logoPath,
                    'logoAlt'    => $exhibitor->firmenname,
                ];
            }
        }

        $template->set('rows', $rows);

        return $template->getResponse();
    }
}
