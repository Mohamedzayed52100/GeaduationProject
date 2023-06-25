<?php

namespace App\Events;

use Carbon\Carbon;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;

class NewNotification implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     *
     * @return void
     */

    public $MRN;
    public $name;
    public $message;
    public $date;
    public $time;
    public $Notification;
    public $Latitude;
    public $Longitude;


    public function __construct($data, $Latitude, $Longitude)
    {

        $this->MRN = "{$data['MRN']}";
        $this->name = "{$data['name']}";
        $this->message = "Need to go Hospital Now!";
        $this->Latitude=$Latitude;
        $this->Longitude=$Longitude;
        $this->date = date("Y-m-d", strtotime(Carbon::now()));
        $this->time = date("h:i A", strtotime(Carbon::now()));


        $this->Notification = "{$data['name']}\n" . "{$data['MRN']}\n" . "{$this->message}\n" . "{$this->date}\n" . "{$this->time}";
        if (count($data['MRN']) > 0) {
            if (session('relative_id')) {
                DB::insert('insert into notifications(data,created_at,recipient_id) values(?,?,?)', [$this->Notification, Carbon::now(), session('relative_id')]);
            } elseif(session('doctorid')) {
                DB::insert('insert into notifications(data,created_at,recipient_id) values(?,?,?)', [$this->Notification, Carbon::now(), session('doctorid')]);
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
        return 'NewNotification';
    }
}