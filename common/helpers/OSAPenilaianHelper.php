<?php


namespace app\common\helpers;


use app\models\SaAnswerManagement;
use app\models\SaAnswerSustain;
use app\models\SaAnswerCertificate;
use app\models\SaAnswerManagementSearch;
use app\models\SaQuestionCertificate;
use app\models\SaQuestionOptCertificate;
use app\models\SaQuestionManagement;
use app\models\SaQuestionSustain;
use app\models\SupplierAssesment;
use app\models\SaScoreCertificate;

class OSAPenilaianHelper
{
	public static function hitungPenilaianCertificate($modelAnswerCertificate, $idcer, $idceropt)
    {
        $question = SaQuestionCertificate::find()->where(
			['id_sa_question_certificate' => $idcer])
			->one();

        if($question != null){
			/* Perhtiungan Poinnya ada 2 :
			//A. Dihitung per opsi sertifikat 
			//B. Dihitung jika salah satu opsi dipilih
			*/
			
			/*A. Dihitung per opsi sertifikat 
			Dicek dari field scored_if_option_selected = 0 di tabel  sa_question_certificate
			selanjutnya dicek valuenya dari masing-masing optionnya
			Nilainya dijumlahnya untuk diupdate di tabel sa_score_certificate sebagai nilai per questions
			*/
			if($question->scored_if_option_selected == 0){
				//Iterate options
				$options = SaQuestionOptCertificate::find()
					->where(['id_sa_question_certificate' => $question->id_sa_question_certificate])
					//->orderBy('no')
					->all();
				$total_score_per_question = 0;
				foreach($options as $option) {
					if($modelAnswerCertificate->is_checked == 1){
						$modelAnswerCertificate->score = $option->score;
						$modelAnswerCertificate->save(false);
						$total_score_per_question += $modelAnswerCertificate->score;
					}else{
						$modelAnswerCertificate->score = 0;
						$modelAnswerCertificate->save(false);
					}
				}
				
				//Simpan total scorenya di induknya
				//echo $modelAnswerCertificate->id_supplier_assesment;
				OSAPenilaianHelper::saveSaScoreCertificate($question->id_sa_question_certificate, 
					$modelAnswerCertificate->id_supplier,
					$modelAnswerCertificate->id_supplier_assesment,
					$total_score_per_question);
			}
			
			/*
			B. Dihitung jika salah satu opsi dipilih
			Dicek dari field scored_if_option_selected = 1 di tabel  sa_question_certificate
			selanjutnya dicek valuenya dari masing-masing optionnya
			Nilainya dicek per opsi. Jika true salah satu otomatis return nilai tersebut
			*/
			if($question->scored_if_option_selected == 1){
				//Yang diiterasi adalah jawabannya
				$answers = SaAnswerCertificate::find()->where(
					[
						'id_sa_question_certificate' => $question->id_sa_question_certificate,
						'id_supplier_assesment' => $modelAnswerCertificate->id_supplier_assesment,
						'id_supplier' => $modelAnswerCertificate->id_supplier,
					])
					->all();
				$total_score_per_question = 0;
				$statFoundScore = false;
				foreach($answers as $answer) {
					if($answer->is_checked == 1){
						$statFoundScore = true;
						break;
					}
				}
				
				if($statFoundScore == true){
					$total_score_per_question = $question->score;
				}
				//echo $total_score_per_question;
				//Simpan total scorenya di induknya
				OSAPenilaianHelper::saveSaScoreCertificate($question->id_sa_question_certificate, 
					$modelAnswerCertificate->id_supplier,
					$modelAnswerCertificate->id_supplier_assesment,
					$total_score_per_question);
			}
		}
	}
	
	public static function getScoreCertifcate($id_sa_question_certificate, $id_supplier,$id_supplier_assesment){
		$model = SaScoreCertificate::find()->where(
			[
				'id_sa_question_certificate' => $id_sa_question_certificate,
				'id_supplier_assesment' => $id_supplier_assesment,
				'id_supplier' => $id_supplier,
			])
			->one();
			
		return $model;
		
			
		if($model != null){
			return $model;
		}else{
			return new SaScoreCertificate;
		}
	}
	
	public static function saveSaScoreCertificate($id_sa_question_certificate, $id_supplier,$id_supplier_assesment, $score){
		$model = SaScoreCertificate::find()->where(
			[
				'id_sa_question_certificate' => $id_sa_question_certificate,
				'id_supplier_assesment' => $id_supplier_assesment,
				'id_supplier' => $id_supplier,
			])
			->one();
		if($model == null){
			$model = new SaScoreCertificate;
			$model->id_sa_question_certificate = $id_sa_question_certificate;
			$model->id_supplier_assesment = $id_supplier_assesment;
			$model->id_supplier = $id_supplier;
		}
		$model->score = $score;
		$model->save(false);
	}
	
    public static function hitungPenilaianJwbManagement($modelAnswerManagement, $id_sa_question_management)
    {
        $question = SaQuestionManagement::find()->where(
			['id_sa_question_management' => $id_sa_question_management])
			->one();

        if($question != null){
			if($question->score > 0){
				
				//A. Perhitungan untuk Type Jawaban Yes/No
				if($question->id_mst_type_question == 2){
					//echo "SCORE:".$question->score; 
					if($question->with_comment == 0){
						if($modelAnswerManagement->is_yes == 1){
							$modelAnswerManagement->score = $question->score;
							$modelAnswerManagement->save(false);
						}else{
							$modelAnswerManagement->score = 0;
							$modelAnswerManagement->save(false);
						}
					}
					
					//Ini yang mempertimbangkan comment
					if($question->with_comment == 1){
						
						if($modelAnswerManagement->is_yes == 1 && $modelAnswerManagement->comment != ""){
							//echo "withkomen";
							$modelAnswerManagement->score = $question->score;
							$modelAnswerManagement->save(false);
						}else{
							//echo "komenbelmada";
							$modelAnswerManagement->score = 0;
							$modelAnswerManagement->save(false);
						}
					}
					//echo '.NILAI:'.$modelAnswerManagement->score;
				}
				
				
				//B. Perhitungan untuk Type Jawaban Entry
				if($question->id_mst_type_question == 3){
					if (is_numeric($modelAnswerManagement->value)){
						$val = $modelAnswerManagement->value*1;
						if($val > 0){
							$modelAnswerManagement->score = $question->score;
							$modelAnswerManagement->save(false);
						}else{
							$modelAnswerManagement->score = 0;
							$modelAnswerManagement->save(false);
						}
					}else{
						$modelAnswerManagement->score = 0;
						$modelAnswerManagement->save(false);
					}
					//echo '.NILAI:'.$modelAnswerManagement->score;
				}
			}else{
				//echo "TIDAK ADA PENILAIAN";
			}
			
		}
    }
	
	public static function hitungPenilaianJwbSustain($modelAnswerSustain, $id_sa_question_sustain)
    {
        $question = SaQuestionSustain::find()->where(
			['id_sa_question_sustain' => $id_sa_question_sustain])
			->one();

        if($question != null){
			if($question->score > 0){
				
				//A. Perhitungan untuk Type Jawaban Yes/No
				if($question->id_mst_type_question == 2){
					//echo "SCORE:".$question->score;
					if($question->with_comment == 0){
						if($modelAnswerSustain->is_yes == 1){
							$modelAnswerSustain->score = $question->score;
							$modelAnswerSustain->save(false);
						}else{
							$modelAnswerSustain->score = 0;
							$modelAnswerSustain->save(false);
						}
					}
					
					//Ini yang mempertimbangkan comment
					if($question->with_comment == 1){
						
						if($modelAnswerSustain->is_yes == 1 && $modelAnswerSustain->comment != ""){
							//echo "withkomen";
							$modelAnswerSustain->score = $question->score;
							$modelAnswerSustain->save(false);
						}else{
							//echo "komenbelmada";
							$modelAnswerSustain->score = 0;
							$modelAnswerSustain->save(false);
						}
					}
					//echo '.NILAI:'.$modelAnswerSustain->score;
				}
				
				
				//B. Perhitungan untuk Type Jawaban Entry
				if($question->id_mst_type_question == 3){
					if (is_numeric($modelAnswerSustain->value)){
						$val = $modelAnswerSustain->value*1;
						if($val > 0){
							$modelAnswerSustain->score = $question->score;
							$modelAnswerSustain->save(false);
						}else{
							$modelAnswerSustain->score = 0;
							$modelAnswerSustain->save(false);
						}
					}else{
						$modelAnswerSustain->score = 0;
						$modelAnswerSustain->save(false);
					}
					//echo '.NILAI:'.$modelAnswerSustain->score;
				}
			}else{
				//echo "TIDAK ADA PENILAIAN";
			}
			
		}
    }
	

	
	public static function getTotalScore($id_supplier, $id_supplier_assesment){
		/* 
		1. Score Sertifikat
		*/
		$scorecertificates = SaScoreCertificate::find()
				->where(['id_supplier_assesment' => $id_supplier_assesment, 
						'id_supplier'=>$id_supplier])
				->all();
		$SCORE_CERTIFICATE = 0;
		foreach($scorecertificates as $scorecertificate){
			$SCORE_CERTIFICATE = $SCORE_CERTIFICATE + $scorecertificate->score;
		}
		
		
		/* 
		2. Score Sustain 
		*/
		$scoressutains = SaAnswerSustain::find()
				->where(['id_supplier_assesment' => $id_supplier_assesment, 
						'id_supplier'=>$id_supplier])
				->all();
		$SCORE_SUSTAIN = 0;
		foreach($scoressutains as $scoressutain){
			$SCORE_SUSTAIN = $SCORE_SUSTAIN + $scoressutain->score;
		}
		//echo $SCORE_SUSTAIN." ";
		
		/* 3. Score Management */
		$scoremanagements = SaAnswerManagement::find()
				->where(['id_supplier_assesment' => $id_supplier_assesment, 
						'id_supplier'=>$id_supplier])
				->all();
		$SCORE_MANAGEMENT = 0;
		foreach($scoremanagements as $scoremanagement){
			$SCORE_MANAGEMENT = $SCORE_MANAGEMENT + $scoremanagement->score;
		}
		//echo $SCORE_MANAGEMENT;
		
		$TOTAL_SCORE = $SCORE_SUSTAIN + $SCORE_MANAGEMENT + $SCORE_CERTIFICATE;
		
		//Update total score ke Supplier Assesment
		if (($model = SupplierAssesment::findOne($id_supplier_assesment)) !== null) {
            $model->score_total = $TOTAL_SCORE;
			$model->save(false);
        }

		
		
		return $TOTAL_SCORE;
	}
	
	public static function checkMaksimumScore($supplier, $score){
		$res ='';
		if(isset($supplier->typeOfSupplier)){
			if($score > $supplier->typeOfSupplier->max_score){
				$batasmax = $supplier->typeOfSupplier->max_score;
				$type = $supplier->typeOfSupplier->type_of_supplier;
				$res = '<div class="alert alert-danger">TOTAL SCORE MELEBIHI NILAI MAKSIMUM (<b>'.$batasmax.'</b>) untuk type supplier ini ('.$type.')! Silakan cek kembali!</div>';
			}else{
				//$res = "PAS";
			}
		}
		
		return $res;
	}
}