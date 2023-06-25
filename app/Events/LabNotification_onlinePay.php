<?php

namespace App\Events;

use Carbon\Carbon;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;

class LabNotification_onlinePay implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $request_approval;
    public $date;
    public $time;
    public $Notification;
    public $MRN;
    public $message;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->request_approval = "Your lab appointment request has been successfully send! Please check your gmail for processing the online payment.";
        $this->message = "This request was for patient with ";
        $this->MRN = "{$data['MRN']}";
        $this->date = date("Y-m-d", strtotime(Carbon::now()));
        $this->time = date("h:i A", strtotime(Carbon::now()));

        if (count($data) > 0) {
            $this->Notification = "{$this->MRN}\n" . "{$this->request_approval}\n" . "{$this->date}\n" . "{$this->time}";
            if(session('relative_id')){
                DB::insert('insert into notifications(data,created_at,recipient_id) values(?,?,?)', [$this->Notification, Carbon::now(),session('relative_id')]);

            }elseif(session('id')){
                DB::insert('insert into notifications(data,created_at,recipient_id) values(?,?,?)', [$this->Notification, Carbon::now(),session('id')]);
       
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
        return 'LabNotification_onlinePay';
    }
}
