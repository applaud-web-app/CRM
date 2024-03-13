<?php
namespace App\Http\Controllers;

use App\Models\Documents;
use App\Models\Ratings;
use App\Models\GeneralSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class SettingsController extends Controller
{
    
    public function loadgeneralsettings()
    {   
        $data=GeneralSetting::orderby('id','desc')->first();    
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

    public function loadEmailSettings()
    {
        $data=DB::table("general_settings")->select("smtp_host","smtp_port","smtp_security","username","smtppassword")->orderBy("id","desc")->first();
        return view("settings.emailsetting",compact("data"));   
    }

    public function loadpasswordsetting()
    {
        return view("settings.passwordsetting");
    }

    public function loadApiSettting()
    {
        $data=DB::table("general_settings")->select("google_api_key","google_api_secret","fb_api_key","fb_api_secret","instagram_api_key","instagram_api_secret","justdial_api_key","justdial_api_secret")->orderBy("id","desc")->first();
        return view("settings.apisetting",compact("data"));
    }
    
    public function updateEmailSetting(Request $request)
    {
        $data=$request->except("_token");
        try
        {
            $check= DB::table("general_settings")->where("id",1)->update($data);
            return redirect("/emailsetting")->with("success","Details updated");
             
        }
        catch(\Exception $e)
        {
            return redirect("/emailsetting")->with("error","Details not updated");
        }
    }

    public function updateGoogleApi(Request $request)
    {
        $data=$request->except("_token");
        try
        {
            $check= DB::table("general_settings")->where("id",1)->update([
                "google_api_key"=> $data["api_key"],
                "google_api_secret"=> $data["api_secret"],
            ]);
            return redirect("/apisetting")->with("success","Details updated");
        }
        catch(\Exception $e)
        {
            return redirect("/apisetting")->with("error","Not updated");
        }
    }

    public function updateFbApi(Request $request )
    {
        $data=$request->except("_token");
        try
        {
            $check= DB::table("general_settings")->where("id",1)->update([
                "fb_api_key"=> $data["api_key"],
                "fb_api_secret"=> $data["api_secret"],
            ]);
            return redirect("/apisetting")->with("success","Details updated");
        }
        catch(\Exception $e)
        {
            return redirect("/apisetting")->with("error","Not updated");
        }
    }

    public function updateInstagramApi(Request $request )
    {
        $data=$request->except("_token");
        try
        {
            $check= DB::table("general_settings")->where("id",1)->update([
                "instagram_api_key"=> $data["api_key"],
                "instagram_api_secret"=> $data["api_secret"],
            ]);
            return redirect("/apisetting")->with("success","Details updated");
        }
        catch(\Exception $e)
        {
            return redirect("/apisetting")->with("error","Not updated");
        }
    }

    public function updateJdApi(Request $request )
    {
        $data=$request->except("_token");
        try
        {
            $check= DB::table("general_settings")->where("id",1)->update([
                "justdial_api_key"=> $data["api_key"],
                "justdial_api_secret"=> $data["api_secret"],
            ]);
            return redirect("/apisetting")->with("success","Details updated");
        }
        catch(\Exception $e)
        {
            return redirect("/apisetting")->with("error","Not updated");
        }
    }

    public function DocumentSetting()
    {
        // dd('klk');
        $documents=DB::table('document_category')->orderBy('type','ASC')->get();
        return view("settings.Documents",compact("documents"));
    }

    public function addDocuments(Request $request)
    {
        $check= DB::table("document_category")->insert([
            "name"=> $request->name,
            "type"=>$request->type,
            "status"=> 1,
        ]);
        if($check){
            return redirect("/documents")->with("success","New Dcoument Type Added Successfully");
        }else{  
            return redirect("/documents")->with("error","Some Error Occured");
        }
        // dd($data);
    }
}