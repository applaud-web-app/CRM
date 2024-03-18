<?php // Code within app\Helpers\Helper.php

namespace App\Helpers;

use App\Models\Activity;
use App\Models\User;
use Google\Client;
use Illuminate\Support\Facades\DB;


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
        "iets" => [
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
       
        // $fcmtoken = Activity::select('User.device_token as token','activities.sender_id as sid,activities.receiver_id as rid,activities.activity as notes, activities.done_by as sender')->where('receiver_id',5)->with('senderToken','reciverToken')->first();
        // $fcmtoken = Activity::where('sender_id',1)->where('receiver_id',5)->with('senderToken','reciverToken')->first();


        $fcmtoken = DB::table('activities')
        ->where('activities.sender_id', $sender)
        ->where('activities.receiver_id', $receiver)
        ->join('users as sender', 'activities.sender_id', '=', 'sender.id')
        ->join('users as receiver', 'activities.receiver_id', '=', 'receiver.id')
        ->select('sender.device_token as sender_token', 'receiver.device_token as receiver_token')
        ->first();
        $image = asset('assets/images/logo.jpg');
        $url = 'https://fcm.googleapis.com/v1/projects/laravelpushnotification-78b76/messages:send';
        // dd($fcmtoken,$sender,$receiver,$notes);
        // dd($fcmtoken);
        foreach ($fcmtoken as $token) {
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
  }