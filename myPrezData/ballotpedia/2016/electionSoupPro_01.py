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

# candidates = resultstable.findAll('tr')

    # party = candidate.select("td:nth-of-type(2)")
    # candidateName = candidate.select("td:nth-of-type(3)")
    # popVotes = candidate.select("td:nth-of-type(5)")
    # ecVotes = candidate.select("td:nth-of-type(6)")
    # print (f"{party} {candidateName} won {popVotes} popular votes for {ecVotes} electoral college votes.")
    # print (party.get_text())
# cells = hrow.findAll('td')

# for cell in cells:


# 
# Grab just the results table


# create JSON file in which to put leftover soup
# with open("results.json", "w") as outfile:
#    json.dump(allResults, outfile)
