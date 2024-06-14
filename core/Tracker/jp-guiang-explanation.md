# Issue 2: Tracker Code Generator Bug

When setting the URL for a website, if it contains `'www'` the cookie domain name will be incorrectly set when **"Track Visitors across all subdomains"** setting is selected.

URL: `'www.test.jayps'`
Cookie Domain: `'*.www.test.jayps'`

## Solution

Where: Production and Development Environment

To track where the issue was coming from, I first looked at where the `Tracker Code` was being generated.

I found that the TrackerCodeGenerator file was creating and there was no function that would cleanse the input URL, which resulted in the bug.

To fix this issue I chose to use a regex alongside the php preg_replace function to sanitise the URL before creating the tracker code.

I checked this was resolved by changing the URL name in my database and seeing if the Tracker Code Generator was working as expected.

I also decided to update the Tracker Code Generator test '`testJavascriptTrackingCodeWithAllOptions'`  for this feature by adding a URL with `'www.'` at the start.

At first run through the test, it was actually failing. Upon inspection I realised that I also needed to sanitise the URL when it is creating all of the domains provided and not just the Cookie Domain. 

To fix this I also included the regex in the loop where the domains were being set. After this change, all tests were passing.

## Notes

While running the tests I noticed that the Cookie Domain being set was only expecting `'*.localhost'`.

I would have liked to create a new test called '`testGeneratedCookieDomainWithWww'` and it would only test one url with `'www.'` in it like `'www.jayps.test'`.

The test would verify that the cookie domain and the set domains generated in the tracker code are sanitised and the expected output would be the following.

`'  _paq.push([\"setCookieDomain\", \"*.jayps.test\"]);'`
`'  _paq.push([\"setDomains\", [\"*.jayps.test\"]]);'`

I was not able to implement this test due to time constraints.

Another test that I would have liked to implement is making sure that the regex is only sanitising the URL if the `'www.'` was at the start of the URL.

Test Case: '`www.jayps.test'`
Expected: `'jayps.test'`

Test Case: `'www.jaypswww.test'`
Expected: `jaypswww.test`'

In retrospect the regex to sanitise the URLS could be included in a new function called `'sanitiseUrls()'` in the TrackerCodeGenerator Class, which would accept an array of URLs and then sanitise them.