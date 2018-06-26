# for Ballotpedia 

from bs4 import BeautifulSoup

# Grab local file I downloaded
# Can I use a variable in the next line and loop through an array for all 51 files?
html = open("Florida_2016.html")
soup = BeautifulSoup(html, 'html.parser')

allResults = []

headspan = soup.find(id="Results")
justhead = headspan.parent
resultstable = justhead.find_next("table")
hrow = resultstable.select("tr:nth-of-type(2)")
print (hrow)
# Grab just the results table


# create JSON file in which to put leftover soup
# with open("results.json", "w") as outfile:
#    json.dump(allResults, outfile)
