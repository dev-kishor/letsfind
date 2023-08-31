$("#country_id").on("change", function () {
    let country_id = this.value
    $.ajax({
        type: "POST",
        url: "../state_process.php",
        data: 'country_id=' + country_id,
        success: function(data) {
            $("#state_id").html(data);
            $('#state_id').trigger("chosen:updated");
        }
    });
  });
$("#state_id").on("change", function () {
    let state_id = this.value
    $.ajax({
        type: "POST",
        url: "../city_process.php",
        data: 'state_id=' + state_id,
        success: function(data) {
            $("#city_id").html(data);
            $('#city_id').trigger("chosen:updated");
        }
    });
  });

