<?php

namespace App\Http\Controllers\Frontend;
use Illuminate\Http\Request;
use App\Http\Controllers\Meta as Controller;
use App\Models\Dashboard\DataCheckList as M_DataCheckList;
use App\Models\Dashboard\CeklistKendaraan as M_CeklistKendaraan;
use App\Models\Dashboard\ChecklistImg as M_ChecklistImg;
use Validator;
use Carbon\Carbon;
use Str;
use Image;

class Temporary extends Controller
{
    
	public function index($code){
		
		$data['title']   = 'Temporary URL';

		$meta	= self::meta();
		$data	= array_merge($meta, $data) ;
		
		$result  = M_CeklistKendaraan::where('status', 'order')->where('unix_url', $code)->with('img')->first();
		if((empty($result)) OR (is_null($result))){
			return redirect('/');
		}
		$dataChecklist	= M_DataCheckList::where('id', $result->data_checklist_id)->first();
		
		foreach($result->img as $key=>$val){
			$result->img[$key]['rael_img'] = url('/assets/images/'.$dataChecklist->member_id.'/'.$result->img[$key]['path_img']);
		}
		 
		$unix_url	= $result->unix_url;
		$unix_url	= Str::substr($unix_url, 17, 10);
		$start		= Carbon::createFromTimestamp($unix_url);
		$end 		= Carbon::now();
		$different 	= $start->diffInDays($end);


		$data['dataChecklist']   	= $dataChecklist;
		$data['data']   			= $result;
		if($different >= 1){
			abort(404);
		}else{
	
			return view('frontend.content.temporary',compact('data'));
		}
	}

	public function update_checklistform(request $request, $id){
		
        $validator = Validator::make($request->all(), [
            'nama_pengirim' => 'required',
            'alamat_pengirim' => 'required',
            'tlp_pengirim' => 'required',
            'nama_penerima' => 'required',
            'alamat_penerima' => 'required',
			'hp_penerima' => 'required',
			'jenis_kendaraan' => 'required',
			'nopol_kendaraan' => 'required',
			'no_rangka' => 'required',
			'no_mesin' => 'required',
			'warna_kendaraan' => 'required',
			'kondisi_unit' => 'required',
        ]);

        if($validator->fails()){
            return $this->sendResponseError(json_encode($validator->errors()), $validator->errors());       
        }
		
		$input = M_CeklistKendaraan::where('unix_url', $id)->update([
		'nama_pengirim'       		=> $request->nama_pengirim,
		'alamat_pengirim'          	=> $request->alamat_pengirim,
		'tlp_pengirim' 				=> $request->tlp_pengirim,
		'nama_penerima'   			=> $request->nama_penerima,
		'alamat_penerima'      		=> $request->alamat_penerima,
		'hp_penerima'   			=> $request->hp_penerima,
		'jenis_kendaraan'   		=> $request->jenis_kendaraan,
		'nopol_kendaraan'   		=> $request->nopol_kendaraan,
		'no_rangka'   				=> $request->no_rangka,
		'no_mesin'   				=> $request->no_mesin,
		'warna_kendaraan'   		=> $request->warna_kendaraan,
		'kondisi_unit'   			=> $request->kondisi_unit,
		'catatan'   				=> $request->catatan,
		'ac'   						=> $request->ac,
		'antena'   					=> $request->antena,
		'asbak'   					=> $request->asbak,
		'ban_serep'   				=> $request->ban_serep,
		'buku'   					=> $request->buku,
		'dongkrak'   				=> $request->dongkrak,
		'dop_roda'   				=> $request->dop_roda,
		'spion_luar'   				=> $request->spion_luar,
		'spion_dalam'   			=> $request->spion_dalam,
		'karpet_depan'   			=> $request->karpet_depan,
		'karpet_tengah'   			=> $request->karpet_tengah,
		'karpet_belakang'   		=> $request->karpet_belakang,
		'kotak_p3k'   				=> $request->kotak_p3k,
		'klakson'   				=> $request->klakson,
		'kunci_kontak'   			=> $request->kunci_kontak,
		'lighter'   				=> $request->lighter,
		'penahan_lumpur'   			=> $request->penahan_lumpur,
		'radio'   					=> $request->radio,
		'sabuk_pengaman'   			=> $request->sabuk_pengaman,
		'sandaran_kepala'   		=> $request->sandaran_kepala,
		'segitiga_pengaman'   		=> $request->segitiga_pengaman,
		'stnk'   					=> $request->stnk,
		'talang_air'   				=> $request->talang_air,
		'tool_set'   				=> $request->tool_set,
		'wiper_depan'   			=> $request->wiper_depan,
		'wiper_belakang'   			=> $request->wiper_belakang,
		'kilometer'   				=> $request->kilometer,
		'bahan_bakar'   			=> $request->bahan_bakar,
		'status'   					=> 'selesai',
		]);

		$result  		= M_CeklistKendaraan::where('unix_url', $id)->with('img')->first();
		$dataChecklist	= M_DataCheckList::where('id', $result->data_checklist_id)->first();
		
		$originalPath   = public_path('/assets/images/'.$dataChecklist->member_id.'/');

		if(!is_dir($originalPath)) {
			mkdir($originalPath, 0755, true);
		}

		foreach($result->img as $images){

		}
		$oldfile 		= '';
		$oldfile_id		= '';
		$checklistId 	= $result->id;
		
		if(isset($result->img[0])){
			$oldfile 	= $result->img[0]['path_img'];
			$oldfile_id = $result->img[0]['id'];
		}
		 
		$userfile1 = $this->upload_img($oldfile, $request->file('userfile1'), $oldfile_id, $checklistId, $originalPath);
		
		$oldfile 		= '';
		$oldfile_id		= '';
		if(isset($result->img[1])){
			$oldfile 	= $result->img[1]['path_img'];
			$oldfile_id = $result->img[1]['id'];
		}
		 
		$userfile1 = $this->upload_img($oldfile, $request->file('userfile2'), $oldfile_id, $checklistId, $originalPath);
		
		$oldfile 		= '';
		$oldfile_id		= '';
		if(isset($result->img[2])){
			$oldfile 	= $result->img[2]['path_img'];
			$oldfile_id = $result->img[2]['id'];
		}
		 
		$userfile1 = $this->upload_img($oldfile, $request->file('userfile3'), $oldfile_id, $checklistId, $originalPath);
		
		$oldfile 		= '';
		$oldfile_id		= '';
		if(isset($result->img[3])){
			$oldfile 	= $result->img[3]['path_img'];
			$oldfile_id = $result->img[3]['id'];
		}
		 
		$userfile1 = $this->upload_img($oldfile, $request->file('userfile4'), $oldfile_id, $checklistId, $originalPath);
		
		
		if($input){
			return $this->sendResponseUpdate($input);
		}else{
			return $this->sendResponseError('Nothing is change');
		}
		
	}

	private function upload_img($oldfile, $newfile, $id, $checklistId, $originalPath){

		if(!empty($newfile)){
				
			$originalImage  = $newfile;
			$thumbnailImage = Image::make($originalImage);
			$time           = time();
			

			if(file_exists($originalPath.$oldfile)) {
				@unlink($originalPath.$oldfile);
			}
			
			 
			$thumbnailImage->resize(400,270);
			$thumbnailImage->save($originalPath.$time.$originalImage->getClientOriginalName());
			$userfile = $time.$originalImage->getClientOriginalName();

			if(!empty($oldfile)){
			$input = M_ChecklistImg::where('id', $id)->update([
						'path_img'   		=> $userfile,
					]);
			}else{
				$input = M_ChecklistImg::create([
					'checklist_kendaraan_id' => $checklistId,
					'path_img'   			 => $userfile,
				]);
			}
			return $input;
			
		}

		return null;

	}

}