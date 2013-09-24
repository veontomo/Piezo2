Feature: functionaluty about authors
As a site visitor
In order to get more complete information
I want to be able to see details about authors

Scenario: viewing all articles by a given author
	Given the following journals are present:
        | name          | link              | description           |
        | Murzilka      | www.murz.com      | advanced child journal| 
        | Phys. Lett    | www.elsevire.com  | expensive journal     |
    Given the following articles are present:
	    | title      | abstract      | url               | page  | year | journal    |
	    | Happy NY   | NY tree       | www.HappyNY.com   | 102   | 1999 | Murzilka   | 
	    | Black hole | event horizon | www.plb.com       | 2     | 2005 | Phys. Lett |
	    | Piezo 	 | as we know 	 | www.hjf.org       | 1223  | 2001 | Murzilka   |
	    | BI action  | higher order  | www.plb.com       | 92    | 1997 | Phys. Lett |
	    | about elec | Maxwell knows | www.nrtdome.it    | 12D   | 2012 | Phys. Lett |
	    | Black ring | to bind them  | www.plb.com       | 39    | 1992 | Murzilka   |
    Given the article entitled "Happy NY" has the following keywords: "k1, k2, k3"
    Given the following articles have been written by authors: 
	    | title  		| surnames   				|
	    | Happy NY 	 	| Galvani, Frank, Mallow	|
	    | Black hole	| Mallow, Einstein, Green 	|
	    | Piezo			| Green, Frank				|  
	 When I am on view page for author "" "Frank"
	 Then I should see the following: "Piezo, Happy NY"