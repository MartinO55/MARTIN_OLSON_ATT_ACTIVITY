# Flashtalking Coding Exercise

So the way I read this problem is that the objective is to download some remote data,  manipulate and transform that data, then reuppload it to a different remote server using a different protocol. I don't see any requirement for, or place the source code can be uploaded to, so I guess this git repository will have to serve if anyone wants to see it.

A quick following of the first link provided confirms the data is there and is properly formatted JSON, but I am hesitant to try the second link because I don't know if there have been any conditions placed on the server with regards to the number of times it can be accessed or such.

With no additional instructions as to how this script should work, where it should run, etc, I think we just run it as a web dashboard page to make sure it is doing the correct things as we build the script.

## Actual Assignment

So we have a massive JSON file. remove all the categories from it except the below ones:

a. mbrand
b. skudisplayname
c. mprice
d. mlistprice
e. mmodel
f. mlargeimage
g. mid
h. mproductpageurl
i. mname
j. salesrank
k. mstarratings
l. mproductid
m. devicetype
n. mmobileproductpageurl
o. mproductpageurles
p. mdescription
q. mduetoday
r. pdppageurl

Next, Remove all of the apple products.

Then, make sure the only category of device in the file are smartphones - this and the next two steps are confusing; doesn't removing everything not a smartphone just automatically remove watches and tablets?

Next, from the category 'skudisplayname', remove teh colour information

Finally, turn the whole thing into a CSV file and upload it to the given address using the provided credentials

## Method

So the two ways to do this would be to either remove the offending information from the JSON file, or to create a new set of data and return that instead.

Upload data to this FTP
a. host: flashtalking.exavault.com
user: japac_testing
password: h8wDT*9D%L(H&4gw
ports: ftp-21 sftp-22
ftp://japac_testing:h8wDT*9D%L(H&4gw@flashtalking.exavault.com/
