<?php

namespace App\Controller;

use App\Entity\Filter;
use App\Entity\GoogleCache;
use App\Entity\Profile;
use App\Repository\ProfileRepository;
use App\Service\GoogleDump;
use App\Service\GoogleSerialize;
use App\Service\GoogleService;

use App\Controller\Traits\MessageGenerator;
use PhpParser\Node\Stmt\Foreach_;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class GoogleController
 * @package App\Controller
 */
class GoogleController extends AbstractController
{
    use MessageGenerator;

    /** @var GoogleService $googleService */
    private $googleService;

    public function __construct(GoogleService $service) {
        $this->googleService = $service;
    }

    /**
     * @Route("/show", name="google_all_scraper")
     */
    public function googleAllAction(Request $request) {
        $uname = 'guest';   // эмуляция работы с пользовательскими данными

        /** @var ProfileRepository $entityProfile */
        $entityProfile = $this->getDoctrine()->getRepository(Profile::class);
        $user_active = $entityProfile->findOneBySomeField($uname);
        $filter = $this->getDoctrine()->getRepository(Filter::class)->find($user_active->getFilter()->getId());

        // сериализуем данные для вывода
        $serializer = new GoogleSerialize($this->googleService, GoogleCache::$gkey_search);
        $result = $serializer->serialize([ 'keyword' => $filter->getKeyword(), 'depth' => $filter->getDepth() ]);

        $meta = [
            'title' => 'Данные Google | Вывод базы',
            'description' => '',
        ];

        $context = [
            'meta' => $meta,
        ];

        if(isset($result)) {
            $context['data'] = $result;
            $context['th_tbl'] = $result[0];
            $context['state']  = 'ok';
        } else {
            $context['data'] = 'В разделе настройки выберите нужный шаблон и обновите базу!!';
            $context['state'] = 'no';
        }

        return $this->render('google/show.html.twig', $context);
    }

    /**
     * @Route ("/stat", name="google_stat")
     */
    public function statAction(Request $request) {
        $uname = 'guest';   // эмуляция работы с пользовательскими данными

        /** @var ProfileRepository $entityProfile */
        $entityProfile = $this->getDoctrine()->getRepository(Profile::class);
        $user_active = $entityProfile->findOneBySomeField($uname);
        $filter = $this->getDoctrine()->getRepository(Filter::class)->find($user_active->getFilter()->getId());

        // сериализуем данные для вывода
        $serializer = new GoogleSerialize($this->googleService, GoogleCache::$gkey_search, true);
        $result = $serializer->serialize([ 'keyword' => $filter->getKeyword(), 'depth' => $filter->getDepth() ], 10000);

        $meta = [
            'title' => 'Данные Google | СТАТИСТИКА',
            'description' => '',
        ];

        $context['meta'] = $meta;

        if(isset($result)) {
            $context['data'] = $result;
            $context['th_tbl'] = $result[0];
            $context['state']  = 'ok';
        } else {
            $context['data'] = 'Тут отобразим статистику';
            $context['state'] = 'no';
        }

        return $this->render('google/stat.html.twig', $context);
    }
}

