<?php

namespace App\Controller;

use App\Entity\Filter;
use App\Entity\Profile;
use App\Repository\FilterRepository;
use App\Repository\ProfileRepository;
use App\Service\GoogleDump;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    /**
     * @Route("/", name="main_page")
     */
    public function mainAction(Request $request)
    {
        // эмуляция работы с пользовательскими данными
        $uname = 'guest';

        if($request->getMethod() == 'POST') {
            if(!empty($_POST)) {
                $formData = json_decode($_POST['json'], true);
                if($formData['desc'] === 'update') {
                    /** @var ProfileRepository $entityProfile */
                    $entityProfile = $this->getDoctrine()->getRepository(Profile::class);
                    $user_active = $entityProfile->findOneBySomeField($uname);

                    /** @var FilterRepository $entityFilter */
                    $entityFilter = $this->getDoctrine()->getRepository(Filter::class);
                    $filter = $entityFilter->find($user_active->getFilter());

                    $dump = new GoogleDump($this->googleService);
                    $dump->run(
                        [ 'keyword' => $filter->getKeyword(), 'depth' => $filter->getDepth() ],
                        ('./public/js/google_parser.js')
                    );
                    $this->message('success', sprintf('%s - %d:: Данные сформированы', __CLASS__, __LINE__));
                }
            }
        }

        $meta = [
            'title' => 'Главная страница',
            'description' => '',
        ];

        $context = [
            'data'   => 'тут будет какая то инфа',
        ];
        $context['meta'] = $meta;
        return $this->render('main/index.html.twig', $context);
    }
}
