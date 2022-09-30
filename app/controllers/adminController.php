<?php
class AdminController extends Controller
{
    public function indexActionGetRequest ($params = [])
    {
        if($params['is_entered'] == false) {
            $this->alertReturn($params, "danger", "Erisim Problemi", "Bu sayfaya erisemezsiniz",
            $this->config['root_url'].'main/index', 'Anasayfa');
        } else {
            
        }
    }
}