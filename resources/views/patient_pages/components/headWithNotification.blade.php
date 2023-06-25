<div class="head bg-white p-15 between-flex">
    <div class="notification">
      <a href="#">
      <div class="notBtn" href="#">
        <!--Number supports double digets and automaticly hides itself when there is nothing between divs -->
        <div class="dropdown dropdown-notifications">
          <a href="#notifications-panel" class="dropdown-toggle" data-toggle="dropdown"><i data-count="0" class="glyphicon glyphicon-bell notification-icon"></i><span class="notif-count"></span></a>
        </div>
        <svg style="margin-left:  50px; margin-top:-60px" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="" class="bi bi-bell-fill" viewBox="0 0 16 16">
          <path d="M8 16a2 2 0 0 0 2-2H6a2 2 0 0 0 2 2zm.995-14.901a1 1 0 1 0-1.99 0A5.002 5.002 0 0 0 3 6c0 1.098-.5 6-2 7h14c-1.5-1-2-5.902-2-7 0-2.42-1.72-4.44-4.005-4.901z" />
        </svg>
        <div class="boxnot" style="z-index:20;">
          <div class="display">
            <div class="cont" >
              <h4 style="margin-left: 10px;margin-top:5px">New Notifications</h4>
              <div class="sec">
                <div class="collapse navbar-collapse">
                  <ul class="nav navbar-nav">
                    <li class="dropdown dropdown-notifications">
                      <div class="dropdown-container">
                        <div class="dropdown-toolbar">
                          <div class="dropdown-toolbar-actions">No New Notifications!</div>
                        </div>
                        <ul class="dropdown-menu"></ul>
                        <div class="dropdown-footer text-center"></div>
                      </div>
                    </li>
                  </ul>
                </div>
              </div>
              <h4 style="margin-left: 10px;margin-top:5px">Old Notifications</h4>
                @php 
                $notification = DB::table('notifications')
                ->select('*')
                ->where('notifications.recipient_id', '=', session('id'))
                ->orderByDesc('notifications.created_at')->get();
                @endphp
              @foreach($notification as $notification)
              <div class="sec new">
                <div class="collapse navbar-collapse">
                  <ul class="nav navbar-nav">
                    <li class="dropdown dropdown-notifications">
                      <div class="dropdown-container">
                        <a style="color:blue;">
                          <div class="media-body">
                            <p class="notification-text font-large-2 text-muted text-right" style="color:darkslategray;font-weight:bold;"> {{$notification->data}}
                          </div>
                          <a href="{{ route('notifications.delete',$notification->notification_id) }}" onclick="event.preventDefault();document.getElementById('delete-form-{{$notification->notification_id}}').submit();">
                            <button class="btn-notify" type="submit" class='centerMe' onclick="event.preventDefault();document.getElementById('delete-form-{{$notification->notification_id}}').submit();">
                              <span class="span-notify">DELETE</span>
                              <svg class="svgnotify" xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                               <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                              </svg>
                            </button>
                            <form id="delete-form-{{$notification->notification_id}}" + action="{{route('notifications.delete', $notification->notification_id)}}" method="post">
                              @csrf @method('DELETE')
                            </form>
                          </a>
                      </div>
                    </li>
                  </ul>
                </div>
              </div>
              @endforeach
            </div>
          </div>
        </div>
      </div>
    </a>
  </div>
  <div class="icons d-flex align-center">    
    <a href="/Patientprofile"> 
      <img style="width:120 px;height:120 px;border-radius:30%;"  src="{{asset('PatientImages')}}/{{session('patient_login')->patient_image}}" alt="Patient Image" />
    </a>
  </div> 
    
</div>
      


    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
<script src="https://js.pusher.com/7.2/pusher.min.js"></script>


<script>
    // Enable pusher logging - don't include this in production
    Pusher.logToConsole = true;
    var pusher = new Pusher('8007b724a7c01004ad11', {
        encrypted: false

    });
</script>
<script src="{{asset('js/pusherNotifications.js')}}"></script>


