var notificationsWrapper = $('.dropdown-notifications');
var notificationsToggle = notificationsWrapper.find('a[data-toggle]');
var notificationsCountElem = notificationsToggle.find('i[data-count]');
var notificationsCount = parseInt(notificationsCountElem.data('count'));
var notifications = notificationsWrapper.find('ul.dropdown-menu');

// Subscribe to the channel we specified in our Laravel Event
var channel = pusher.subscribe('EmergencyAlarm');
// Bind a function to a Event (the full Laravel class)
channel.bind('NewNotification', function (data) {
  var existingNotifications = notifications.html();
  var newNotificationHtml =
  `<a href=/Maps/`+data.Latitude+`/`+data.Longitude+`><div class="media-body"><h6 class="media-heading text-right" style="font-size:medium;margin-top:15px;">` + `<br>` + data.name + `<br>` + `<br>` + data.MRN + `<br>` + `<br>` + `</h6> <p class="notification-text font-large-3 text-muted text-right" style=" font-weight: bold;">` + data.message + `</p><small style="direction: ltr;font-weight: bold;"><p class="media-meta text-muted text-right" style="direction: ltr;font-weight: bold;">` + `<br>` + data.date + `<br>` + data.time +`<br>` +`<br>`+ `<div class="new" style="width:288px;margin-left:-15px;margin-bottom:-25px;color:#0d3073;">`+`</p> </small></div></div></div></a>`;
  notifications.html(newNotificationHtml + existingNotifications);
  
  notificationsCount += 1;
  notificationsCountElem.attr('data-count', notificationsCount);
  notificationsWrapper.find('.notif-count').text(notificationsCount);
  notificationsWrapper.show();
});

channel.bind('LabNotification', function (data) {
  var existingNotifications = notifications.html();

  var newNotificationHtml =
    `<a style="color:#3f81ce;"` + `<div class="media-body"><h6 class="media-heading text-right" style="font-size:medium;margin-top:15px;">` + `<br>` + data.request_approval_cache + `<br>` + `<br>` + `</h6> <p class="notification-text font-large-3 text-muted text-right" style=" font-weight: bold;">` + data.message + data.MRN + `<br>` + `<br>` + `</p><small style="direction: ltr;font-weight: bold;"><p class="media-meta text-muted text-right" style="direction: ltr;font-weight: bold;">` + `<br>` + data.date + `<br>` + data.time +`<br>` +`<br>`+ `<div class="new" style="width:288px;margin-left:-15px;margin-bottom:-35px;color:#0d3073;">`+`</p> </small></div></div></div></a> <br>`;

  notifications.html(newNotificationHtml + existingNotifications);

  notificationsCount += 1;
  notificationsCountElem.attr('data-count', notificationsCount);
  notificationsWrapper.find('.notif-count').text(notificationsCount);
  notificationsWrapper.show();
});

channel.bind('LabNotification_onlinePay', function (data) {
  var existingNotifications = notifications.html();

  var newNotificationHtml =
    `<a style="color:#3f81ce;"` + `<div class="media-body"><h6 class="media-heading text-right" style="font-size:medium;margin-top:15px;">` + `<br>` + data.request_approval + `<br>` + `<br>` + `</h6> <p class="notification-text font-large-3 text-muted text-right" style=" font-weight: bold;">` + data.message + data.MRN + `<br>` + `<br>` + `</p><small style="direction: ltr;font-weight: bold;"><p class="media-meta text-muted text-right" style="direction: ltr;font-weight: bold;">` + `<br>` + data.date + `<br>` + data.time +`<br>` +`<br>`+`<div class="new" style="width:288px;margin-left:-15px;margin-bottom:-35px;color:blue;color:#0d3073;">`+ `</p> </small></div></div></div></a> <br>`;

  notifications.html(newNotificationHtml + existingNotifications);

  notificationsCount += 1;
  notificationsCountElem.attr('data-count', notificationsCount);
  notificationsWrapper.find('.notif-count').text(notificationsCount);
  notificationsWrapper.show();
});

channel.bind('LabNotification_result', function (data) {
  var existingNotifications = notifications.html();
  var newNotificationHtml =
    `<a href=viewImage/`+data.imageName+`><div class="media-body"><h6 class="media-heading text-right" style="font-size:medium;margin-top:15px;">` +`<br>` + data.message  + `<br>` + `<br>` + `</h6> <p class="notification-text font-large-3 text-muted text-right" style=" font-weight: bold;">` + data.MRN + `<br>` + `<br>` +  `</p><small style="direction: ltr;font-weight: bold;"><p class="media-meta text-muted text-right" style="direction: ltr;font-weight: bold;">` + `<br>` + data.date + `<br>` + data.time +`<br>` +`<br>`+`<div class="new" style="width:288px;margin-left:-15px;margin-bottom:-35px;color:blue;color:#0d3073;">`+ `</p> </small></div></div></div></a> <br>`;
    
  notifications.html(newNotificationHtml + existingNotifications);
  notificationsCount += 1;
  notificationsCountElem.attr('data-count', notificationsCount);
  notificationsWrapper.find('.notif-count').text(notificationsCount);
  notificationsWrapper.show();
});


