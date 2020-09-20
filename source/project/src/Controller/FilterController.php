<?php

namespace App\Controller;

use App\Controller\Traits\MessageGenerator;
use App\Entity\Filter;
use App\Entity\Profile;
use App\Repository\FilterRepository;
use App\Repository\ProfileRepository;
use App\Service\FilterService;
use App\Service\GoogleDump;
use App\Service\GoogleService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class FilterController extends AbstractController
{
    use MessageGenerator;

    /** @var FilterService */
    private $filterService;
    /** @var GoogleService */
    private $googleService;

    public function __construct(FilterService $filterService, GoogleService $googleService) {
        $this->filterService = $filterService;
        $this->googleService = $googleService;
    }

    /**
     * @Route("/filter", name="config_filter")
     */
    public function filterAction(Request $request) {
        // эмуляция работы с пользовательскими данными
        $uname = 'guest';
        /** @var ProfileRepository $entityProfile */
        $entityProfile = $this->getDoctrine()->getRepository(Profile::class);
        $user_active = $entityProfile->findOneBySomeField($uname);

        if($request->getMethod() === 'POST') {
            if(!empty($_POST)) {
                // проверять на валидацию пока не будем т.к. тест
                if(count($_POST) >= 3) {
                    $db = $this->filterService->getFilter($_POST['add-key']);
                    $formData = json_decode($_POST['json'], true);

                    if($formData['desc'] === 'edit') {
                        // если запись уже есть то обновим
                        if($db) {
                            $this->filterService->update(
                                $db->getId(),
                                $_POST['add-key'],
                                ($_POST['add-depth'] ? $_POST['add-depth'] : 5),
                                ($formData['cb_active'] ? $uname : null)
                            );
                            $this->message('success', sprintf('%s - %d:: Данные обновлены', __CLASS__, __LINE__));
                        } else {
                            $this->filterService->save(
                                $uname,
                                $_POST['add-key'],
                                ($_POST['add-depth'] ? $_POST['add-depth'] : 5),
                                $formData['cb_active']
                            );
                            $this->message('success', sprintf('%s - %d:: Данные добавлены', __CLASS__, __LINE__));
                        }
                    } elseif ($formData['desc'] === 'delete') {
                        // если запись есть то удалим
                        if($db) {
                            $this->filterService->delete($db->getId());
                            $this->message('success', sprintf('%s - %d:: Данные удалены', __CLASS__, __LINE__));
                        }
                    } elseif ($formData['desc'] === 'update') {
                        /** @var FilterRepository $entityFilter */
                        $entityFilter = $this->getDoctrine()->getRepository(Filter::class);
                        $filter = $entityFilter->find($user_active->getFilter());

                        $dump = new GoogleDump($this->googleService);
                        $dump->run(
                            [ 'keyword' => $filter->getKeyword(), 'depth' => $filter->getDepth() ],
                            ('./js/google_parser.js')
                        );
                        $this->message('success', sprintf('%s - %d:: Данные сформированы', __CLASS__, __LINE__));
                    }

                    //return $this->redirectToRoute('main_page');
                } else {
                    $this->message('warning', sprintf('%s - %d:: проблема на front-end', __CLASS__, __LINE__));
                }
            }
        }

        $meta = [
            'title' => 'Редактирование',
            'description' => '',
        ];

        $context = [
            'meta' => $meta,
            'data' => $user_active,//->getFilter()->getKeyword(),
            'list' => $this->filterService->getFilterAll(),
        ];

        return $this->render('filter/index.html.twig', $context);
    }
}
