<?php

namespace App\Events;

use Carbon\Carbon;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;

class LabNotification_result implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     *
     * @return void
     */

    public $date;
    public $time;
    public $Notification;
    public $MRN;
    public $message;
    public $imageName;

    public function __construct($data,$imageName)
    {

        //lab data
        $this->message = "Test results has been uploded click on this message to see it!";
        $this->MRN = "This request was for patient with "."{$data['MRN']}";
        $this->date = date("Y-m-d", strtotime(Carbon::now()));
        $this->time = date("h:i A", strtotime(Carbon::now()));
        $this->imageName=$imageName;
        
        if (count($data) > 0) {
            $this->Notification = "{$this->message}\n" . "{$this->MRN}\n" ."{$this->imageName}\n"."{$this->date}\n" . "{$this->time}";
            if(session('relative_id')){
                DB::insert('insert into notifications(data,created_at,recipient_id) values(?,?,?)', [$this->Notification, Carbon::now(), session('relative_id')]);

            }elseif(session('doctorid')){
                DB::insert('insert into notifications(data,created_at,recipient_id) values(?,?,?)', [$this->Notification, Carbon::now(), session('doctorid')]);

            }elseif(session('id')){
                DB::insert('insert into notifications(data,created_at,recipient_id) values(?,?,?)', [$this->Notification, Carbon::now(), session('id')]);

            }else {
                DB::insert('insert into notifications(data,created_at,recipient_id) values(?,?,?)', [$this->Notification, Carbon::now(), 0]);

            }       
        }
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        //return new Channel('EmergencyAlarm');
        return ['EmergencyAlarm'];
    }
    public function broadcastAs()
    {
        return 'LabNotification_result';
    }
}
