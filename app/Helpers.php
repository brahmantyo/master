<?php namespace App;

class Helpers {

	public static function getResiStatus($status){
		switch($status){
			case 0 : return 'Pending';break;
			case 1 : return 'Muat';break;
            case 2 : return 'Berangkat';break;
			default: return 'Status tidak diketahui';
		}
	}

	public static function getQuoteStatus($status){
		switch($status){
			case 0 : return 'Pending';break;
			case 1 : return 'Process';break;
			default: return 'Status tidak diketahui';
		}
	}
	public static function awsomeFilterLabel($label,$content){
		return '<span class="input-group">
                    <div class="input-group-btn">
                      <button type="button" class="btn btn-success btn-md disabled">'.$label.'</button>
                    </div>
                    <input class="form-control input-md" type="text" disabled value="'.$content.'"></input>
                </span>';
	}
    public static function currency($value,$decimal=0,$country=NULL,$vat=FALSE){
        switch($country){
            case "id" : $money = new Money("Rp ",0.1,",","."); break;
            case "us" : $money = new Money("$ ",0.2,".",","); break;
            default : $money = new Money("");
        }
        $money->setDecimal(0);
        if(strip_tags(!isset($_POST['export']))){
            return $money->display($value);
        } else {
            return $value;
        }
    }
    
    public static function number($number,$decimal=0){
        return number_format($number,$decimal,",",".");
    }
    
    public static function dateToMySqlSystem($date){
        /*//$result = date_create_from_format("d-m-Y",$date);
        $result = date_create_from_format("d-m-Y",$date);
        //return $result->format("Y-m-d");
        return date_create($result, "Y-m-d");*/
        return \Carbon\Carbon::parse($date)->format('Y-m-d');
    }
    
    public static function dateFromMySqlSystem($date){
        /*$result = date_create_from_format("Y-m-d",$date);
        //return $result->format("d-m-Y");
        return date_format($result,"d-m-Y");*/
        return \Carbon\Carbon::parse($date)->format('d-m-Y');
    }
}