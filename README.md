# Election Insights
Compare different outcomes based on certain candidates or candidate groups.

For example, if all "Left wing" candidates combined their votes, could they have collectively defeated Trump?

At present, I'm using only the popular vote for each state. Electoral College results (and other interactive yummy goodness) coming soon.

See my _interactive data visualization of presidential election results_ moving content from old to new host right this very second.

* Python scripts for scraping various data sources
* D3.js for data viz

## Examples

<img src="https://www.roxorsoxor.com/imgs/snagsforgh/electionsInsights/ppp-everyone.png" width="640">

Above includes every candidate -- but, of course, only President Trump and Secretary Clinton are displayed on the map as winners.

<img src="https://www.roxorsoxor.com/imgs/snagsforgh/electionsInsights/ppp-allLeftVStrump.png" width="640">

Above shows slightly different results if we combined all the "left" candidates versus President Trump. 

However, if we also combine "right" candidates and have a Left vs Right battle royale:

<img src="https://www.roxorsoxor.com/imgs/snagsforgh/electionsInsights/ppp-allLeftAllRight.png" width="640">

Below shows results if only socialist candidates [except for Jill Stein (Green Party)] ran. Gray states are those with no socialist candidates (or there were socialist candidates but they received zero votes).

<img src="https://jotascript.files.wordpress.com/2018/11/allsocialistsnogreen.png" width="640">

### Future
- Menu will be dynamic. Only candidates used for map will appear in legend. A candidate may appear in the legend but not in the map because they were a candidate in a state but they did not win.
- User will be able to click candidate(s) in the legend to add or remove them from map.

## Schema
![Schema diagram showing tables with columns for candidates, states, party affiliations, and election results.](https://jotascript.files.wordpress.com/2018/10/schema_101618.png)

Like the U.S. Constitution, this schema is a living document and evolves over time.

## Note to Self
Check this out

http://election.princeton.edu/for-fellow-geeks/
