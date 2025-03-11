<?php 

namespace Controllers\UserControllers;
use Core\BaseController;

class IntroduceController extends BaseController {
    protected $Model = "UserModels\IntroduceModel";

    public function showIntroduceView() { view('User/UserPages/IntroduceView'); }
}
