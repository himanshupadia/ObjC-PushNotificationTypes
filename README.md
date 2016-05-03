# ObjC-PushNotificationTypes
Types of Push Notification in Objective-C <br />
<h4>RTFFile: Push_Notification_steps</h4>
You can find the steps to creates required certificates for push notification.
<h4>phpFile: newspush</h4>
specify the $deviceToken in which you want to test the push notification.<br />
specify the 'category' => "ACCEPT_ACTION" <br />
More categories: <br />
1) ACCEPT_ACTION <br />
2) REJECT_ACTION <br />
3) REPLY_ACTION <br />
Create new type and add new category... <br />

<h4>AppDelegate.m</h4>
Handle your push notification action event in handleActionWithIdentifier function.

