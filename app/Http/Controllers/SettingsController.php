<?php
namespace App\Http\Controllers;

use App\Models\Documents;
use App\Models\Ratings;
use App\Models\GeneralSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\DocumentCategory;

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
        $sitedata=GeneralSetting::select('site_logo','site_image')->first()->toArray();
        if($request->has('site_logo')){
            $logo="LOGO-".rand().".".$request->site_logo->extension();
            $destinationPath = public_path('assets/images/');
            $filePath = $destinationPath . $sitedata['site_logo'];
            if($sitedata["site_logo"]!=NULL || $sitedata['site_logo']!="")
            {
                if (file_exists($filePath)) {
                    unlink($filePath);
                    $request->site_logo->move($destinationPath, $logo);
                    $data['site_logo']=$logo;
                }
                else if(!file_exists($filePath))
                {
                    $request->site_logo->move($destinationPath, $logo);
                    $data['site_logo']=$logo;  
                }
            }
            $data['site_logo']=$logo;
        }

        if($request->has('site_image')){
            $imagename= "SITE-".rand().".".$request->site_image->extension();
            $destinationPath = public_path('assets/images/');
            $filePath = $destinationPath . $sitedata['site_image'];
            if($sitedata["site_image"]!=NULL || $sitedata['site_image']!="")
            {
                if (file_exists($filePath)) {
                    unlink($filePath);
                    $request->site_image->move($destinationPath, $imagename);
                    $data['site_image']=$imagename;
                }
                else if(!file_exists($filePath))
                {
                    $request->site_image->move($destinationPath, $imagename);
                    $data['site_image']=$imagename;  
                }
            }
            $data['site_image']=$imagename;
        }
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
                "google_api_key"=> $data["google_api_key"],
                "google_api_secret"=> $data["google_api_secret"],
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
                "fb_api_key"=> $data["fb_api_key"],
                "fb_api_secret"=> $data["fb_api_secret"],
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
                "instagram_api_key"=> $data["instagram_api_key"],
                "instagram_api_secret"=> $data["instagram_api_secret"],
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
                "justdial_api_key"=> $data["justdial_api_key"],
                "justdial_api_secret"=> $data["justdial_api_secret"],
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
        $documents = DB::table('document_category')->orderBy('type','ASC')->get();
        return view("settings.Documents",compact("documents"));
    }

    public function addDocuments(Request $request)
    {   

        $request->validate([
            'interested'=>'required',
            'type_of_immigration'=>'required',
            'documents'=>'required'
        ]);

        $data=$request->except("_token","documents","field_count");
        $documents = $request->input('documents');
        
        foreach ($documents as $document) {
            $checkPreviousData = DocumentCategory::where('name',$document['name'])->where('type',$data['interested'])->where('subcategory',$data["type_of_immigration"])->first();

            if($checkPreviousData){
                return redirect()->back()->with('error','This Document Type Already Exist');
            }
            
            $check = DB::table("document_category")->insert([
                "name" => $document['name'],
                "status" => 1,
                "type" => $data['interested'],
                "subcategory"=> $data["type_of_immigration"],
            ]);
            
            if (!$check) {
               return redirect()->back()->with('error', 'Failed to insert document: ' . $document['name']);
            }

        }
        
        return redirect("/documents")->with("success", "New Document(s) Added Successfully");

    }

    
}