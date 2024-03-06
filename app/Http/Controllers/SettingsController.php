<?php
namespace App\Http\Controllers;
use App\Models\Ratings;
use App\Models\GeneralSetting;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    
    public function loadgeneralsettings()
    {   
        $data=GeneralSetting::find(1);    
        return view("settings.generalsetting",compact("data")); 
    }

    public function updategeneralsetting(Request $request)
    {
        $data = $request->except('_token');
        $check = GeneralSetting::where('id',1)->update($data);
        if ($check) {
            return redirect("/generalsetting")->with("success", "Settings updated successfully ");
        } else {
            return redirect("/generalsetting")->with("error","Settings not updated !");
        }
    }
    
    public function loadratings()
    {
        $ratings=Ratings::orderBy("maximum","desc")->get();
        return view("settings.rating",compact("ratings"));
    }

    public function updateratings(Request $request)   
    {
        $data=$request->all();
        $check= Ratings::where("rating_name",$data["rating_name"])->update([
            "minimum"=>$data["minimum"],
            "maximum"=>$data["maximum"]
        ]);
        if ($check) {
            return redirect('/ratings')->with('success','Ratings updated successfully');
        } else {
            return redirect('/ratings')->with('error','Ratings not updated !');
        }

    }
    public function loadaccountsetting()
    {
        return view("settings.accountsetting");
    }

    public function loademailsettings()
    {
        return view("settings.emailsetting");
    }

    public function loadpasswordsetting()
    {
        return view("settings.passwordsetting");
    }

    public function loadapisettting()
    {
        return view("settings.apisetting");
    }
    
}