# Issue 1: Create a widget showing user local time and website time

This is my first attempt at creating a widget that would show the user's local time and the website's local time, if they were in different locations.

I did not get to complete this task and was only able to create a report widget that would show the local time of the website. The other time that is shown is the current time in the UTC timezone.

I tried to create a test for this feature, but I was already reaching the end of the time I allocated myself for this task. If this were a typical work setting, I think I would have asked for help before writing any code, so I can learn the best practices of Matomo, and how another developer would have implemented this solution, as the code base is very new to me.

## Solution

I created a new plugin called **CurrentWebsiteTimeZone**.

This plugin included a report turned widget that will show the time in UTC and the website local time.

The new plugin can be added to the home dashboard under the **Live!** category.

I chose to format the times shown in the `'Piwik\Date::DATETIME_FORMAT_SHORT`' as I saw that this was the format being used in Visits Log feature.

A lot of the logic that I used to create this feature was taken from **'VisitLastActionTime'** class and the **'convertHourToHourInSiteTimezone'** function.

## Notes

The biggest challenge I found in this task was figuring out how the code base was working. My typical way of finding things was to look at the components in the test site then look for them in the code base. I quickly realised that this was not really going to work with the Matomo code base as many of the components were made from templates (from my understanding at least).

When realising this I had to slow down a bit and then go through the documents slowly and created my own '`dummy'` report and widget.

In hindsight I feel like I didn't needed to create a report for this feature. I initially thought that I needed an API function to get the timezone of the website, but after using the default Piwik Site class to `'getTimezoneFor'` function, the only thing I really needed was the `'$idSite'`. I found myself stuck with keeping this feature as a report, was I was not sure how to get the `'$idSite'` from the `'GetLocalandWebsiteTime`' class in the reports directory and then directly hydrate the report/widget from there too.

Since I also made most of the functionality in the API file, I couldn't figure out how to create tests for it within the time I allocated myself. If the functionality was in the `'GetLocalandWebsiteTime`' class, I may have had some extra time to create a test. But again, I'm not too sure that foregoing making it a report is the best solution for this feature as well.

## Proposed Solutions for getting user's timezone

- Using session information like `'$_Session[user_timezone]'`
- Using Carbon package
-- I think this one is a bit too much just to get the user's timezone though
- Using a Javascript Package like Day.js or Moment.js
-- Moment.js will no longer a supported package though
