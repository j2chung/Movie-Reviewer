# Movie-Reviewer
Frame for a movie review website like IMDB or Rotten Tomatoes 

Uses JS (ajax, jquery), PHP, MySQL and HTML.

Dynamic movie searching by keystrokes. Allows the user to create an account, login and rate the movie of their choosing. The database is from https://datasets.imdbws.com/.

# TODO
Dynamic movie searching sends too many XHR requests so multiple results show
  - fix by adding limiting the number of XHR requests being sent every to once every 500 miliseconds
  - fix by aborting the previous XHR request when a new XHR request is made
  
Add a comment section

Make the website look pretty
