$(function(){

    var baseUrl = $("#baseurl").val();

    $("#city").on('change', function(){

        

        let cityId = this.value;

        $.ajax({
            url: baseUrl + "/getFilmsByCity/" + cityId,
            type: "GET",
            success: function(response){
                
                $("#film").html(response);

                $("#film-grid").show();
                
            }
        });
    });


    $("#film").on('change', function(){

        let filmId = this.value;

        $.ajax({
            url: baseUrl + "/getTheatersByFilm/" + filmId,
            type: "GET",
            success: function(response){
                
                $("#theater-grid").html(response);

                $("#theater-grid").show();
            }
        });
    });    

    $(document).on('click', '.show-selection', function(e){

        let showId = $("input:radio.show-selection:checked").val();
    
        $.ajax({
            url: baseUrl + "/getAvailableSeats/" + showId,
            type: "GET",
            success: function(response){
                                
                $("#seat-selection").html(response);

                $("#seat-selection").show();

                $("#book-button").show();                
            }
        });
    });
});