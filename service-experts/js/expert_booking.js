document.querySelectorAll(".comm-msg-act-btn")[0].click()

function checkExpertAv() {
    $('#selecttimeslot')[0].options.length = 0
    const enquiry_date_expert = document.querySelectorAll(".enquiry_date_expert")[0].value
    const expert_user_id = document.getElementById("expert_user_id").value
    const expert_id = document.getElementById("expert_id").value
    const available_time_end = document.getElementById("available_time_end").value
    const available_time_start = document.getElementById("available_time_start").value
    if (webpage_full_link != null) {
        var link = webpage_full_link + 'service-experts/fetch_expert_booking_time.php';
    } else {
        var link = 'service-experts/fetch_expert_booking_time.php';
    }
    $.ajax({
        type: "POST",
        data: { enquiry_date_expert, expert_user_id, expert_id, available_time_start, available_time_end },
        url: link,
        cache: true,
        success: function (html) {
            $('#selecttimeslot').append(html)
        }
    })
}
