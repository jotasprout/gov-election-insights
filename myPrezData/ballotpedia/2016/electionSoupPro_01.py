# for Ballotpedia 

from bs4 import BeautifulSoup

# Grab local file I downloaded
# Can I use a variable in the next line and loop through an array for all 51 files?
htmlDoc = open("Florida_2016.htm")
soup = BeautifulSoup(htmlDoc)
allResults = []

# Grab just the results table


# create JSON file in which to put leftover soup
with open("results.json", "w") as outfile:
    json.dump(allResults, outfile)
