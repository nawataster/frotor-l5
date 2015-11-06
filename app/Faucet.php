<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class Faucet extends Model{

	protected $table = 'faucets';

	protected $fillable = [
		'url',
		'info',
		'referal',
		'duration',
		'until',
		'isactive',
		'priority',
		'updated'
	];

	public $timestamps  = false;

	public static function firstReady(){

		$row	= self::select()
			->where('isactive',true)
			->whereRaw('TIMESTAMPDIFF(SECOND,until,CURRENT_TIMESTAMP())>=0')
			->orderBy('priority', 'desc')
			->first();

		$row->url	= $row->url.($row->referal!=''?'?r='.$row->referal:'');

		return $row;
	}
//______________________________________________________________________________

	public static function updateUntil( $id, $duration, $priority, $isUpdated=TRUE ){
		$data_new	= [
			'until'	=> date('Y-m-d H:i:s', strtotime('+'.$duration.' second')),
			'priority'	=> $priority
		];

		$isUpdated ? $data_new['updated'] = date('Y-m-d H:i:s'):NULL;

		$result	= self::where( 'id', $id )->update( $data_new );

	}
//______________________________________________________________________________

	public static function countFaucets(){

    	return [
    		'n_all'	=> self::all()->count(),

    		'n_act'	=> self::select()
				->where('isactive',TRUE)
				->whereRaw('TIMESTAMPDIFF(SECOND,until,CURRENT_TIMESTAMP())>=0')
				->count()
    	];
	}
//______________________________________________________________________________

	public static function disableFaucet( $id ){
		$data_new	= [
			'isactive'	=> FALSE
		];

		$faucet	= self::where( 'id', $id )->update( $data_new );
	}
//______________________________________________________________________________

}//	Class end
