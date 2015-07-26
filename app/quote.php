<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class quote extends Model {

	protected $table = 'quote';
	public $timestamps = false;

    protected static function boot()
    {
        parent::boot();
        static::deleting(function($quote) { // before delete() method call this
             $quote->detail()->delete();
             // do the rest of the cleanup...
        });
    }

	public function detail()
	{
		return $this->hasMany('\App\dquote','idquote');
	}
	
	public function pengirim()
	{
		return $this->belongsTo('\App\konsumen','idkonsumen');
	}
	public function penerima()
	{
		return $this->belongsTo('\App\konsumen','idpenerima');
	}
}
