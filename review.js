function review(movieid, rating) {
  $.ajax({
    type: 'post',
    url: 'review.php',
    data: {
      'moviereviewed' : movieid,
      'rating' : rating
    },
    success: function(response){
      location.reload();
    }
  });
};
