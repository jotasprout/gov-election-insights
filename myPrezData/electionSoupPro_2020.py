# for Ballotpedia 

from bs4 import BeautifulSoup

# Grab local file I downloaded
# Can I use a variable in the next line and loop through an array for all 51 files?
html = open("Florida_2016.html")
soup = BeautifulSoup(html, 'lxml')

allResults = []

headspan = soup.find(id="Results")
justhead = headspan.parent
resultstable = justhead.find_next("table")
lrow = resultstable.select("tr:nth-of-type(5)")
candidates = resultstable.findAll('tr')

# loops to try
i=0
while i < 10:
    print i
    i = i + 1

# the following two loops are equivalent to each other
for counter in range (1,6):
    print counter

numbers = range (1,6)
for count in numbers:
    print (count)

# for candidate in candidates:
    # party = candidate.select("td:nth-of-type(2)")
party = candidates[5].findAll('td')[1].string
    # candidateName = candidate.select("td:nth-of-type(3)")
candidateName = candidates[5].findAll('td')[2].a.string
    # popVotes = candidate.select("td:nth-of-type(5)")
popVotes = candidates[5].findAll('td')[4].string
    # ecVotes = candidate.select("td:nth-of-type(6)")
ecVotes = candidates[5].findAll('td')[5].string

print (f"{party} {candidateName} won {popVotes} popular votes for {ecVotes} electoral college votes.")
    # print (party.get_text())
# cells = hrow.findAll('td')

# for cell in cells:


# 
# Grab just the results table


# create JSON file in which to put leftover soup
# with open("results.json", "w") as outfile:
#    json.dump(allResults, outfile)
# print (candidate)