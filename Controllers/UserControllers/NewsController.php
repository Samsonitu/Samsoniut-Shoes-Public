<?php

namespace Controllers\UserControllers;

use Core\BaseController;
use Models\UserModels\NewsModel;

class NewsController extends BaseController {
    protected $Model = "UserModels\NewsModel"; 

    public function showNewsView() 
    {
        $newsList = $this->Database->getAllNews();
        view('User/UserPages/News/NewsView', compact('newsList'));
    }

    public function showNewsDetailsView($newsSlug)
    {
        $newsDetailsInfo = $this->Database->getNewsDetailsInfo($newsSlug);
        $newsRelatedList = $this->Database->getNewsRelated($newsSlug, $newsDetailsInfo[0]['newsCatId']);
        view('User/UserPages/News/NewsDetailsView', compact('newsDetailsInfo', 'newsRelatedList'));
    }

    public static function getNewsShortInfo()
    {
        $newsModel = new NewsModel();
        return $newsModel->getNewsShortInfo();
    }
}