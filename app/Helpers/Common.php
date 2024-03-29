<?php // Code within app\Helpers\Helper.php

namespace App\Helpers;

use App\Models\Activity;
use App\Models\Followup;
use App\Models\GeneralSetting;
use App\Models\User;
use Google\Client;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\ExployeeScore;
use Spatie\Permission\Models\Role;

class Common
{
  // public static function immigration()
  // {
  //   return $defaultArray = [
  //       "visa" => [
  //           'tourist visa' => ['Passport', 'Indentity Proof', 'High School Marksheet'],
  //           'x visa' => ['Passport'],
  //           'business visa' => ['Passport', 'Identity Proof', 'GSTIN'],
  //           'student visa' => ['field1', 'field2', 'field3'],
  //           'employee visa' => ['field1', 'field2'],
  //       ],
  //       "iets" => [
  //           "academic" => ['field1', 'field2', 'field3'],
  //           "general training" => ["field1", "field2", "field3"],
  //       ],
  //       "pte" => [
  //           "general" => ["field1"],
  //           "academic" => ["field1", "field2", "field3"],
  //       ],
  //     ];
  // }

  public static function immigration()
  {
    return $defaultArray = [
        "visa" => [
            'tourist visa',
            'x visa',
            'business visa',
            'student visa',
            'employee visa',
        ],
        "ielts" => [
            "academic",
            "general training",
        ],
        "pte" => [
            "general",
            "academic",
        ],
      ];
  }


    public static function loadimmigration()
    {
      $data = DB::table("document_category")->select('type', 'subcategory', 'field_type', 'name')->get()->toArray();
          $mergedArray = []; 

        foreach ($data as $value) {
            $type = strtolower($value->type);
            $subcategory = strtolower($value->subcategory);
            $name = strtolower($value->name);

            // Check if type exists in merged array
            if (!isset($mergedArray[$type])) {
                $mergedArray[$type] = [];
            }

            // Check if subcategory exists in type array
            if (!isset($mergedArray[$type][$subcategory])) {
                $mergedArray[$type][$subcategory] = [];
            }
            
            // Check if the name already exists in the subcategory array
            $existsIndex = null;
            foreach ($mergedArray[$type][$subcategory] as $index => $item) {
                if (strtolower($item['name']) === $name) {
                    $existsIndex = $index;
                    break;
                }
            }

            // If the name already exists, replace the existing data with the new one
            if ($existsIndex !== null) {
                $mergedArray[$type][$subcategory][$existsIndex] = [
                    'name' => $value->name,
                    'field_type' => $value->field_type
                ];
            } else {
                // If the name doesn't already exist, add it to the subcategory array
                $mergedArray[$type][$subcategory][] = [
                    'name' => $value->name,
                    'field_type' => $value->field_type
                ];
            }
        }
        return $mergedArray;
    }


    public function sendNotification($sender,$receiver,$notes)
    {
        
        $accessToken = $this->getAccessToken();
        if (!$accessToken) {
            die('Failed to obtain access token');
        }
    
        if(!Auth::user()->hasRole('Superadmin')) {
            
            $superadminToken = Role::where('name', 'Superadmin')->firstOrFail() ->users 
            ->pluck('device_token')
            ->first();
            $fcmtoken = DB::table('activities')
            ->where('activities.sender_id', $sender)
            ->where('activities.receiver_id', $receiver)
            ->join('users as sender', 'activities.sender_id', '=', 'sender.id')
            ->join('users as receiver', 'activities.receiver_id', '=', 'receiver.id')
            ->select('sender.device_token as sender_token', 'receiver.device_token as receiver_token')
            ->first();  
            $tokens=([
                'sender_token'=> $fcmtoken->sender_token,
                'receiver_token'=> $fcmtoken->receiver_token,
                'admin_token'=> $superadminToken
            ]);
        }
        else
        {
            $fcmtoken = DB::table('activities')
            ->where('activities.sender_id', $sender)
            ->where('activities.receiver_id', $receiver)
            ->join('users as sender', 'activities.sender_id', '=', 'sender.id')
            ->join('users as receiver', 'activities.receiver_id', '=', 'receiver.id')
            ->select('sender.device_token as sender_token', 'receiver.device_token as receiver_token')
            ->first();
            $tokens=([
                'sender_token'=> $fcmtoken->sender_token,
                'receiver_token'=> $fcmtoken->receiver_token,
            ]);
        }
            $image = asset('assets/images/logo.jpg');
            $url = 'https://fcm.googleapis.com/v1/projects/laravelpushnotification-78b76/messages:send';
            
            foreach ($tokens as $token) {
                $data = [
                    "message" => [
                        "token" => $token,
                        "webpush" => [
                            "notification" => [
                                "title" =>"CRM Notification",
                                "body" => $notes,
                                "image" => $image,
                                // "actions" => [
                                //     [
                                //         "action" => "open_url",
                                //         "title" => "Open Website",
                                //     ]
                                //     ],
                                // "data" => [
                                //         "url" => "https://google.com"
                                //     ]
                            ],
                        ]
                    ]
                ];

                $notify_data = json_encode($data);
                $headers = [
                    'Authorization: Bearer ' . $accessToken,
                    'Content-Type: application/json',
                ];
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, $url);
                curl_setopt($ch, CURLOPT_POST, true);
                curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
                curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                curl_setopt($ch, CURLOPT_POSTFIELDS, $notify_data);
                $result = curl_exec($ch);

                if ($result === false) {
                    die('curl failed' . curl_error($ch));
                } else {
                    print_r(json_decode($result, true));
                }
                curl_close($ch);
            }
    }

    
    private function getAccessToken()
    {
        $serviceAccountFile = public_path('service-account.json');
        $serviceAccountJson = json_decode(file_get_contents($serviceAccountFile), true);
        $client = new Client();
        $client->setAuthConfig($serviceAccountJson);
        $client->addScope('https://www.googleapis.com/auth/firebase.messaging');
        // Get access token
        $accessToken = $client->fetchAccessTokenWithAssertion();
        if (isset($accessToken['access_token'])) {
            return $accessToken['access_token'];
        } else {
            return null;
        }
    }

    public static function getNotificationCount(){
        $userId = Auth::id();
        if(Auth::user()->hasRole('Superadmin')){
            $unReadNotification = Activity::where('admin_read',0)->count();
            $topNotification = Activity::with('sender')->latest()->take(5)->get();
        }else{
            $unReadNotification = Activity::where('reciver_read',0)->Where('receiver_id',$userId)->count();
            $topNotification = Activity::with('sender')->Where('receiver_id',$userId)->latest()->take(5)->get();
        }
        return [
            'unreadMessage'=>$unReadNotification,
            'topNotification'=>$topNotification
        ];
    }

    public static function userImage()
    {
        $userId = Auth::id();
        // $image=Role::where('id',$userId)->select("profile_img")->first();
        $image=User::where('id', $userId) 
            ->pluck('profile_img')
            ->first();
        return $image;
    }


    public function followupReminder($user)
    {

        $accessToken = $this->getAccessToken();
        if (!$accessToken) {
            die('Failed to obtain access token');
        }

        $tokensAndNotes = User::join('followup', 'users.username', '=', 'followup.added_by')
        ->select('users.device_token', 'followup.notes','followup.next_followup')
        ->get();
        $image = asset('assets/images/logo.jpg');
        $url = 'https://fcm.googleapis.com/v1/projects/laravelpushnotification-78b76/messages:send';
        
        foreach ($tokensAndNotes as $token) {
            $data = [
                "message" => [
                    "token" => $token->device_token,
                    "webpush" => [
                        "notification" => [
                            "title" =>"Follow Up Reminder for ".$token->next_followup,
                            "body" => $token->notes,
                            "image" => $image,
                        ],
                    ]
                ]
            ];

            $notify_data = json_encode($data);
            $headers = [
                'Authorization: Bearer ' . $accessToken,
                'Content-Type: application/json',
            ];
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
            curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $notify_data);
            $result = curl_exec($ch);

            if ($result === false) {
                die('curl failed' . curl_error($ch));
            } else {
                print_r(json_decode($result, true));
            }
            curl_close($ch);
        }

    }

    public function addenquiryPoints($leadsdata,$reason)
    {
        $userId = Auth::id();
        $roletarget=Role::where('id',$userId)->select('target')->first();
        $percent=(1/$roletarget->target)*100;
        $points = ExployeeScore::create([
            "point" => DB::raw('ROUND(IFNULL(point, 0) +'. $percent.',3)'),
            "reason"=>$reason,
            "emp_id"=>$leadsdata->assigned_by,
            "target"=>$roletarget->target
        ]);
    }

    public function addleadpoint($leadsdata,$reason)
    {
        $userId = Auth::id();
        $roletarget=Role::where('id',$userId)->select('target')->first();
        $percent=(1/$roletarget->target)*100;
        $points = ExployeeScore::create([
            "point" => DB::raw('ROUND(IFNULL(point, 0) +'. $percent.',3)'),
            "reason"=>$reason,
            "emp_id"=>$leadsdata->assigned_to,
            "target"=>$roletarget->target
        ]);
    }
    public function deductleadPoints($leadsdata,$reason)    
    {
        $userId = Auth::id();
        $roletarget=Role::where('id',$userId)->select('target')->first();
        $percent=(1/$roletarget->target)*100;
        $points = ExployeeScore::create([
            "point" => DB::raw('ROUND(IFNULL(point, 0) -'. $percent.',3)'),
            "reason"=>$reason,
            "emp_id"=>$leadsdata->assigned_to,
            "target"=>$roletarget->target
        ]);
    }

    public function sitedata()
    {
        $data=GeneralSetting::first()->toArray();
        return $data;
    }

    public function userHasPermission($permission){
        $role =  Auth::user()->roles->first();
        if($role->hasPermissionTo($permission)){
            return true;
        }else{
            return false;
        }
    }
  }