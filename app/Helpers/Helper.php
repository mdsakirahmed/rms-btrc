<?php



use App\Models\StaticOption;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;
use Spatie\Activitylog\Models\Activity;

if (!function_exists('random_code')) {
    function set_static_option($key, $value)
    {
        if (!StaticOption::where('option_name', $key)->first()) {
            StaticOption::create([
                'option_name' => $key,
                'option_value' => $value
            ]);
            return true;
        }
        return false;
    }

    function get_static_option($key)
    {
        if (StaticOption::where('option_name', $key)->first()) {
            $return_val = StaticOption::where('option_name', $key)->first();
            return $return_val->option_value;
        }
        return null;
    }

    function update_static_option($key, $value)
    {
        if (!StaticOption::where('option_name', $key)->first()) {
            StaticOption::create([
                'option_name' => $key,
                'option_value' => $value
            ]);
            return true;
        } else {
            StaticOption::where('option_name', $key)->update([
                'option_name' => $key,
                'option_value' => $value
            ]);
            return true;
        }
        return false;
    }

    function file_uploader($folder_path, $file, $new_file_name = null){
        if ($file && file_exists($file->getRealPath())) {
            if (!file_exists($folder_path)) {
                mkdir($folder_path, 0777, true);
            }
            if ($new_file_name){
                $file->move($folder_path, $new_file_name . '.' .$file->getClientOriginalExtension());
                $folder_pathwith_name = $folder_path . $new_file_name . '.' . $file->getClientOriginalExtension();
            }else{
                $file->move($folder_path, $file->getClientOriginalName());
                $folder_pathwith_name = $folder_path . $file->getClientOriginalName();
            }
            return $folder_pathwith_name;
        }
        return false;
    }

    function file_deleter($file){
        try {
            if ($file)
                File::delete(public_path($file));
        }catch (\Exception$exception){

        }
    }

    function convert_to_initial($full_name){
        $acronym = $word = '';
        foreach(preg_split("/(\s|\-|\.)/", $full_name) as $w) {
            $acronym .= substr($w,0,1);
        }
        return $word . $acronym;
    }

    function money_format_india($num) {
        $explrestunits = "" ;
        if(strlen($num)>3) {
            $lastthree = substr($num, strlen($num)-3, strlen($num));
            $restunits = substr($num, 0, strlen($num)-3); // extracts the last three digits
            $restunits = (strlen($restunits)%2 == 1)?"0".$restunits:$restunits; // explodes the remaining digits in 2's formats, adds a zero in the beginning to maintain the 2's grouping.
            $expunit = str_split($restunits, 2);
            for($i=0; $i<sizeof($expunit); $i++) {
                // creates each of the 2's group and adds a comma to the end
                if($i==0) {
                    $explrestunits .= (int)$expunit[$i].","; // if is first value , convert into integer
                } else {
                    $explrestunits .= $expunit[$i].",";
                }
            }
            $thecash = $explrestunits.$lastthree;
        } else {
            $thecash = $num;
        }
        return $thecash; // writes the final format where $currency is the currency symbol.
    }

    function delete_activity_count(){
        return Activity::where('log_name', 'delete')->where('read', false)->count();
    }

    function edit_activity_count(){
        return Activity::where('log_name', 'edit')->where('read', false)->count();
    }
}
