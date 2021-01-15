$(document).ready(function(){

    $("#city").on('change', function(){

        let cityId = this.value;

        $.ajax({
            url: "http://localhost/getFilmsByCity/" + cityId,
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
            url: "http://localhost/getTheatersByFilm/" + filmId,
            type: "GET",
            success: function(response){
                console.log(response);

                $("#theater-grid").html(response);

                $("#theater-grid").show();
            }
        });
    });
});