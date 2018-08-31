# -----------------------------
# for requestingTranskribus.py
# -----------------------------
# Transkribus username / nom d'utilisateur Transkribus
# ex : username = 'username@mail.fr'
username = ''

# Transkribus password / mot de passe Transkribus
# ex : password = 'mypassword'
password = ''

# Targeted collection name(s)
# ex : collectionnames = ['collectionname', 'anothercollectionname', 'yetanotherone']
collectionnames = ['timeUS']

# Targeted document status
# values can only be : 'NEW', 'IN PROGRESS', 'DONE' or 'FINAL'
# ex : status = ['DONE', 'IN PROGRESS'] or status = ['FINAL']
status = ['DONE']


# -----------------------------
# for fromPAGEtoText.py
# -----------------------------
# Targeted collection name(s). Collection must have been downloaded with requestingTranskribus.py first.
# ex : textcollectionnames = ['collectionname'] or textcollectionnames = ['firstcollection', 'secondcollection']
textcollectionnames =  ['timeUS']


# -----------------------------
# for toSingleXML.py
# -----------------------------
# Targeted collection name(s). Collection must have been downloaded with requestingTranskribus.py first.
# ex : singlecollectionnames = ['collectionname'] or signlecollectionnames = ['firstcollection', 'secondcollection']
singlecollectionnames =  ['timeUS']
