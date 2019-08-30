
var timer;
//On Key up for the movie search bar
$('#movie_query').on('keyup', function() {
  $('#movie_searched tr:not(:first)').remove();
  var count = 0;
  //If the query has three or more characters
  if($('#movie_query').val().length > 3) {
    $.post("movie_search.php", $('#movie_query').serialize(), function(response) {
      let obj = JSON.parse(response);
      //If the post reponse from PHP gives at least one movie
      if(obj.length > 0) {
        //For each movie in the json object
        obj.forEach(function(movie){
          count+=1;
          let table = document.getElementById('movie_searched');
          let row = document.createElement('tr');
          table.append(row);
          //For each element in the movie object (Title, Rating, Year, MovieID)
          Object.keys(movie).forEach(function(movieElement) {
            let cell = document.createElement('td');
            //If this is a Review cell
            if (movie.MovieID == movie[movieElement]) {
              for (let i = 1; i < 6; i++) {
                let star = document.createElement('span');
                star.textContent =' ☆';
                star.onclick = function(){
                  xhr = $.ajax({
                    type: 'post',
                    url: 'review.php',
                    data: {
                      'moviereviewed' : movie[movieElement],
                      'rating' : i
                    },
                    success: function(response) {
                      location.reload();
                    }
                  });
                };
                star.classList.add('star');
                cell.append(star);
              }
            } else {
              cell.innerHTML = movie[movieElement];
            }
            row.append(cell);
          });
          //If the number of movies found is at least one, show table
          if(count > 0) {
            $('#movie_searched').css('visibility', 'visible');
          }
        });
      }
    });
    //document.getElementById('movie_count').textContent = count + ' movies found.';
  } else {
    $('#movie_searched').css('visibility', 'hidden');
    document.getElementById('movie_count').textContent = 'Enter three or more characters.';
  }
});
