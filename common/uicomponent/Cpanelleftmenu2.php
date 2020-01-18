<?php
namespace app\common\uicomponent;
use app\models\CpanelLeftmenu;

class Cpanelleftmenu2 {
	public static function getListLeftMenu(){
	//public static function getListLeftMenu($modelLeftMenu,$controler_curentpage,$action_curentpage,$controler,$countChildStatus=false){
		//$lc = new $modelLeftMenu;
		$lc = new Cpanelleftmenu;
		//$datas = $lc->findAllByAttributes(array('id_parent_leftmenu'=>0, 'visible'=>1));
		$datas = $lc::findAll([
			'id_parent_leftmenu' => 0,
			 'visible'=>1,
		]);
		$curentpage=$controler_curentpage."/".$action_curentpage;
		
		
		
		$LIST_DATA = '';
		$LIST_DATA .= '
			<ul class="sidebar-menu">
		';
		
		foreach ($datas as $data)
		{
			//$data->menu_icon="fa-circle-o";
			$TITLE = CpanelLeftmenuDB::getTitle($data) ;
			$auth = UsersAccess::stringToArray($data->auth);
			$access = UsersAccess::checkUserAccess($auth);
			$idLiParent ='p_'.$data->id_leftmenu;
			
			if($access){
				$url = $controler->createUrl($data->url);
				if($data->has_child == 0){	
					if($data->url == $curentpage){
						$li_class_currentpage="active";
						//$div_class_currentpage="toggler active";
					}else{
						$li_class_currentpage="";
						//$div_class_currentpage="toggler";
					}
					$LIST_DATA .= "<li id='".$idLiParent."' class='".$li_class_currentpage."'>
										<a href='".$url."'>
											<i class='fa ".$data->menu_icon."'></i> 
											<span>".Yii::t('strings',$TITLE)."</span>
										</a>
								   </li>";
				}else{
				
					if($countChildStatus){
						//$countOfChild = $lc->countByAttributes(array('id_parent_leftmenu'=>$data->id_leftmenu, 'visible'=>1));
						//$countChildSpan ="<span class='label label-primary pull-right'>".$countOfChild."</span>";
						$childMenuData=$lc->findAllByAttributes(array('id_parent_leftmenu'=>$data->id_leftmenu, 'visible'=>1));
						$countDataMenu = 0 ;
						foreach ( $childMenuData as $menuData){
							$authCountChild = UsersAccess::stringToArray($menuData->auth);
							$accessCountChild = UsersAccess::checkUserAccess($authCountChild);
							if($accessCountChild){
								$countDataMenu = $countDataMenu+1;
							}
						}
						$countChildSpan ="<span class='label label-primary pull-right'>".$countDataMenu."</span>";
					}else{
						$countChildSpan="";
					}
					
					if($data->url == $controler_curentpage){
						$li_class_currentpage="treeview active";
					}
					else{
						$li_class_currentpage="treeview";
					}
					$LIST_DATA .="<li id='".$idLiParent."' class='".$li_class_currentpage."'>
										<a href=//#>
											<i class='fa ".$data->menu_icon."'></i> 
											<span>".Yii::t('strings',$TITLE)."</span>
											".$countChildSpan."
										</a>
								   ";
					$LIST_DATA .= CpanelLeftmenuDB::getChildMenu($modelLeftMenu,$data->id_leftmenu,$controler_curentpage,$action_curentpage,$controler);
					$LIST_DATA .= '</li>';
				}
			}
			
		}
		$LIST_DATA .= '
			</ul>
		';
		
		return $LIST_DATA;
	}	
	
	public static function getChildMenu($modelLeftMenu,$id_parent_leftmenu,$controler_curentpage,$action_curentpage,$controler){
		$lc = new $modelLeftMenu;
		$datas = $lc->findAllByAttributes(array('id_parent_leftmenu'=>$id_parent_leftmenu, 'visible'=>1));
		$curentpage=$controler_curentpage."/".$action_curentpage;
		
		
		
		$LIST_DATA = '';
		$LIST_DATA .= '
			<ul class="treeview-menu" id="tree_'.$id_parent_leftmenu.'">
		';
		foreach ($datas as $data)
		{
			//$data->menu_icon="fa-circle-o";
			$TITLE = CpanelLeftmenuDB::getTitle($data) ;
			$auth = UsersAccess::stringToArray($data->auth);
			$access = UsersAccess::checkUserAccess($auth);
			$idLiChild ='c_'.$data->id_leftmenu;
			if($access){
				if($data->url == $curentpage){
					$li_class_currentpage="active";
					$scriptOpenMenuChild='<script>
											$("li#p_'.$id_parent_leftmenu.'").addClass("active");
											//$("ul#tree_'.$id_parent_leftmenu.'").addClass("menu-open");
										  </script>';
				}else{
					$li_class_currentpage="";
					$scriptOpenMenuChild="";
				}
				$url = $controler->createUrl($data->url);
				$LIST_DATA .= "<li id='".$idLiChild."' class='".$li_class_currentpage."'>
								<a href='".$url."'>
									<i class='fa ".$data->menu_icon."'></i> 
									<span>".Yii::t('strings',$TITLE)."</span>
								</a>
							  </li>"."\n";
				$LIST_DATA .=$scriptOpenMenuChild;
			}
		}
		
		$LIST_DATA .= '
			</ul>
		';
		
		return $LIST_DATA;
	}

	
	public static function getHardCodedLeftMenu(){
		$menuleft = 
				[
                    ['label' => 'Menu', 'options' => ['class' => 'header']],
                    ['label' => 'Dashboard', 'icon' => 'dashboard', 'url' => ['/dashboard/main'], 'visible'=>true],
                    ['label' => 'Data Pegawai', 'icon' => 'user', 'url' => ['/hrm-pegawai/index']],
                    ['label' => 'Kartu RFID', 'icon' => 'credit-card', 'url' => ['/kartu-rfid/index']],
                    ['label' => 'Log RFID', 'icon' => 'history', 'url' => ['/abs-absence/index']],
                    ['label' => 'CPanel', 'icon' => 'list', 'url' => ['/cpanel-leftmenu/index']],
                    ['label' => 'Users', 'icon' => 'users', 'url' => ['/user/index']],
                    [
                        'label' => 'Kehadiran',
                        'icon' => 'building',
                        'url' => '#',
                        'items' => [
                            ['label' => 'Scan Kartu', 'icon' => 'credit-card', 'url' => ['/site/scan']],
                        ],
                    ],
                    ['label' => 'Gii', 'icon' => 'file-code-o', 'url' => ['/gii']],
//                    ['label' => 'Debug', 'icon' => 'dashboard', 'url' => ['/debug']],
                    ['label' => 'About', 'icon' => 'question-circle', 'url' => ['/site/about']],
                    ['label' => 'Contact', 'icon' => 'phone', 'url' => ['/site/contact']],
//                    [
//                        'label' => 'Some tools',
//                        'icon' => 'share',
//                        'url' => '#',
//                        'items' => [
//                            ['label' => 'Gii', 'icon' => 'file-code-o', 'url' => ['/gii'],],
////                            ['label' => 'Debug', 'icon' => 'dashboard', 'url' => ['/debug'],],
//                            [
//                                'label' => 'Level One',
//                                'icon' => 'circle-o',
//                                'url' => '#',
//                                'items' => [
//                                    ['label' => 'Level Two', 'icon' => 'circle-o', 'url' => '#',],
//                                    [
//                                        'label' => 'Level Two',
//                                        'icon' => 'circle-o',
//                                        'url' => '#',
//                                        'items' => [
//                                            ['label' => 'Level Three', 'icon' => 'circle-o', 'url' => '#',],
//                                            ['label' => 'Level Three', 'icon' => 'circle-o', 'url' => '#',],
//                                        ],
//                                    ],
//                                ],
//                            ],
//                        ],
//                    ],
//                    ['label' => 'Login', 'icon' => 'sign-in', 'url' => ['site/login'], 'visible' => Yii::$app->user->isGuest],
                ];
			return $menuleft;
	}
	
	public static function getTitle($data){
			if(Yii::app()->session['_lang'] == 'id'){
				$TITLE = $data->value_indo;
			}else{
				if(Yii::app()->session['_lang'] == 'en'){
					$TITLE = $data->value_eng;
				}else{
					$TITLE = $data->value_indo;
				}
			}
			return $TITLE;
	}

	
}
?>