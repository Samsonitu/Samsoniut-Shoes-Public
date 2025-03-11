<?php 

namespace Controllers\UserControllers;
use Core\BaseController;

class StoreSystemController extends BaseController {
    protected $Model = "UserModels\StoreSystemModel";

    public function showStoreSystemView() { view('User/UserPages/SystemStoriesView'); }
}
