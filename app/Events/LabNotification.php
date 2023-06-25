<?php

namespace App\Events;

use Carbon\Carbon;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;

class LabNotification implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     *
     * @return void
     */

    public $request_approval_cache;
    public $date;
    public $time;
    public $Notification;
    public $MRN;
    public $message;

    public function __construct($data)
    {

        //lab data
        $this->request_approval_cache = "Your appointment has been successfully booked! Wait for your results.";
        $this->message="This request was for patient with ";
        $this->MRN="{$data['MRN']}";
        $this->date = date("Y-m-d", strtotime(Carbon::now()));
        $this->time = date("h:i A", strtotime(Carbon::now()));

        if (count($data) > 0) {
            $this->Notification ="{$this->MRN}\n"."{$this->request_approval_cache}\n" . "{$this->date}\n" . "{$this->time}";
            if(session('relative_id')){
                DB::insert('insert into notifications(data,created_at,recipient_id) values(?,?,?)', [$this->Notification, Carbon::now() ,session('relative_id')]);

            }elseif(session('id')){
                DB::insert('insert into notifications(data,created_at,recipient_id) values(?,?,?)', [$this->Notification, Carbon::now() ,session('id')]);
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
        return 'LabNotification';
    }
}
