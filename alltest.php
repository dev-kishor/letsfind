<?php

// Set the timezone to the user's timezone
date_default_timezone_set('America/New_York');

// Define the event details
$event = [
    'summary' => 'Birthday Party',
    'description' => 'Come celebrate my birthday!',
    'location' => '123 Main St, Anytown USA',
    'start' => '2023-04-20T19:00:00',
    'end' => '2023-04-20T22:00:00'
];

// Generate the iCalendar file
$ical = "BEGIN:VCALENDAR
VERSION:2.0
PRODID:-//My Calendar//EN
CALSCALE:GREGORIAN
BEGIN:VEVENT
DTSTART:" . date('Ymd\THis', strtotime($event['start'])) . "
DTEND:" . date('Ymd\THis', strtotime($event['end'])) . "
SUMMARY:" . $event['summary'] . "
DESCRIPTION:" . $event['description'] . "
LOCATION:" . $event['location'] . "
END:VEVENT
END:VCALENDAR";

// Set the filename and content type
$filename = 'birthday.ics';
header('Content-type: text/calendar');
header('Content-Disposition: attachment; filename="' . $filename . '"');

// Output the iCalendar file to the browser
echo $ical;

// Save the iCalendar file to the server
file_put_contents($filename, $ical);