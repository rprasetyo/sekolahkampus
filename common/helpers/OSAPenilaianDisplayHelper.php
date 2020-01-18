<?php
namespace app\common\helpers;

use app\models\SaCorrCertificateToManagement;
use app\models\SaAnswerCertificate;

class OSAPenilaianDisplayHelper
{
	public static function getDisplayAttributeYesNo($answer)
    {
		$res = '';
		if($answer->is_yes == 1){
			$res = '
			<span class="label label-success" style="font-size:12px;">
			<i class="fa fa-fw fa-check"></i> '."YA
			</span>
			";
		}else{
			$res = '
			<span class="label label-danger" style="font-size:12px;">
			<i class="fa fa-fw fa-close"></i> <i>'."TIDAK</i>
			</span>";
		}
		
		return $res;
	}
	
    public static function getDisplayAttributeTextEntryNumeric($answer)
    {
		$labelentry = '';
		if($answer->value != "") {
			if (is_numeric($answer->value)){
				//Cek angka atau bukan
				$val = $answer->value*1;
				if($val > 0){
					$labelentry="label label-success";
				}else{
					$labelentry="label label-danger";
				}
			}else{
				$labelentry="label label-danger";
			}
		}
		
		$res = '';
		$res .= '<span class="'.$labelentry.'" style="font-size:12px;">';
		$res .= $answer->value;
		$res .= '</span>';
		
		return $res;
    }

	public static function getLabelAttributeScore($answer, $question)
    {
		$res['labelnilai'] = 'primary';
		$res['bgbox'] = 'info';
		if($answer->score >0) $res['labelnilai'] = 'warning'; //agar terlihat
		if($question->score >0) $res['bgbox'] = 'aqua';
		
		return $res;
    }
	
	public static function getDisplayScoreSustain($answer, $question){
		$labelscore = OSAPenilaianDisplayHelper::getLabelAttributeScore($answer, $question);
		$score = "?";
		if($answer->id_sa_answer_sustain > 0) { $score = $answer->score;}
		$res = '
			<div class="small-box bg-'.$labelscore['bgbox'].'">
				<div class="inner">
				  <h4><span class="label label-'.$labelscore['labelnilai'].'" style="font-size:24px;">'.$score.'</span> / 
				  <span class="label label-primary">'. $question->score.'</span></h4>
				</div>
				<a class="small-box-footer">
				</a>

			</div>
		';
		return $res;
	}
	
	public static function getDisplayScoreCerticate($id_sa_question_certificate, $id_supplier,$id_supplier_assesment){
		//$score_certificate = OSAPenilaianHelper::getScoreCertifcate($certificate->id_sa_question_certificate, $is_dec,$isa_dec);
		$score_certificate = OSAPenilaianHelper::getScoreCertifcate($id_sa_question_certificate, $id_supplier,$id_supplier_assesment);
		if($score_certificate != null){
			$lbl['labelnilai'] = 'primary';
			if($score_certificate->score >0) $lbl['labelnilai'] = 'warning'; //agar terlihat
			
			if($score_certificate->score > 0){
				$res = '<span class="label label-'.$lbl['labelnilai'].'" style="font-size:24px;">'.$score_certificate->score.'</span>';
			}else{
				$res = $score_certificate->score;
			}
		}else{
			$res = "?";
		}
		
		return $res;
	}
	
	public static function getDisplayScoreManagement($answer, $question){
		$labelscore = OSAPenilaianDisplayHelper::getLabelAttributeScore($answer, $question);
		$score = "?";
		$res ="";
		if($answer->id_sa_answer_management > 0) {$score = $answer->score;}
		$res .= '
			<div class="small-box bg-'.$labelscore['bgbox'].'">
				<div class="inner">
				  <h4><span class="label label-'.$labelscore['labelnilai'].'" style="font-size:24px;">'.$score.'</span> / 
				  <span class="label label-primary">'. $question->score.'</span></h4>
				</div>
				<a class="small-box-footer">
				</a>

			</div>
		';
		return $res;
	}
	
	public static function checkVisibilityManagementByAnswerCertificate($id_supplier_assesment, $id_supplier, $id_management_category){
		$statusVisible = true;
		$maps = SaCorrCertificateToManagement::find()->where(
			['id_management_category' => $id_management_category])
			->all();
			
		foreach($maps as $map){
			//Get Answer 
			$answer = SaAnswerCertificate::find()
			->where(['id_supplier_assesment' => $id_supplier_assesment, 
					'id_supplier'=>$id_supplier, 
					//'id_sa_question_certificate'=>$idcer,
					'id_sa_question_opt_certificate'=>$map->id_sa_question_opt_certificate])
			->one();
			if($answer != null){
				if($answer->is_checked == 1){
					return false;
				}
			}
		}
		
		return $statusVisible;
	}
}