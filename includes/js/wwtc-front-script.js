jQuery(function ($) {
  $("#wwtc_course").prop("selectedIndex", 0);
  $("#wwtc_location").prop("selectedIndex", 0);

  $("#wwtc_location").prop("disabled", true);
  $(".wwtc_booking_shortcode #wwtc_location").prop("disabled", true);

  $($(".booking-form-main #wwtc_course")).change(function () {
    var course_id = $(this).val(); //alert(course_val);

    $("#wwtc_location").prop("selectedIndex", 0);
    $("#wwtc_location").prop("disabled", false);

    var form = $(this).closest("form");
    $.ajax({
      type: "POST",
      url: $("#wwtc_action_url").val(),
      data: {
        course_id: course_id,
        flag: "course_page",
        action: "get_course_locations",
      },
      success: function (response) {
        $("#wwtc_location").html(response);
      },
    });
  });

  $($(".booking-form-main #wwtc_discount_course")).change(function () {
    var course_id = $(this).val(); //alert(course_val);

    $("#wwtc_location1").prop("selectedIndex", 0);
    $("#wwtc_location1").prop("disabled", false);

    var form = $(this).closest("form");
    $.ajax({
      type: "POST",
      url: $("#wwtc_action_url").val(),
      data: {
        course_id: course_id,
        flag: "course_page",
        action: "get_discount_course_locations",
      },
      success: function (response) {
        $("#wwtc_location1").html(response);
      },
    });
  });
  $(".wwtc_booking_shortcode #wwtc_course").prop("selectedIndex", 0);
  $(".wwtc_booking_shortcode #wwtc_location").prop("selectedIndex", 0);

  $($("#wwtc_location_reverse")).change(function () {
    var location_id = $(this).val();

    $("#wwtc_course_reverse").prop("selectedIndex", 0);
    $("#wwtc_course_reverse").prop("disabled", false);

    var form = $(this).closest("form");
    $.ajax({
      type: "POST",
      url: $("#wwtc_action_url_reverse").val(),
      data: {
        location_id: location_id,
        flag: "course_page",
        action: "get_location_course",
      },
      success: function (response) {
        $("#wwtc_course_reverse").html(response);
      },
    });
  });

  $($("#wwtc_location_reverse_popup")).change(function () {
    var location_id = $(this).val();

    $("#wwtc_course_reverse_popup").prop("selectedIndex", 0);
    $("#wwtc_course_reverse_popup").prop("disabled", false);

    var form = $(this).closest("form");
    $.ajax({
      type: "POST",
      url: $("#wwtc_action_url_reverse_popup").val(),
      data: {
        location_id: location_id,
        flag: "course_page",
        action: "get_location_course",
      },
      success: function (response) {
        $("#wwtc_course_reverse_popup").html(response);
      },
    });
  });

  $($(".booking-form-main #wwtc_location")).change(function () {
    var location_id = $(this).val();
    var course_id = $(this).find(":selected").attr("data-cid");

    var form = $(this).closest("form");
    $.ajax({
      type: "POST",
      url: $("#wwtc_action_url").val(),
      data: {
        course_id: course_id,
        location_id: location_id,
        action: "get_location_coursepage",
      }, //data:course_val,
      success: function (response) {
        if (response != "") {
          window.location.href = response;
        }
      },
    });
  });

  $($(".booking-form-main #wwtc_location1")).change(function () {
    var location_id = $(this).val();
    var course_id = $(this).find(":selected").attr("data-cid");

    var form = $(this).closest("form");
    $.ajax({
      type: "POST",
      url: $("#wwtc_action_url").val(),
      data: {
        course_id: course_id,
        location_id: location_id,
        action: "get_discount_location_coursepage",
      }, //data:course_val,
      success: function (response) {
        if (response != "") {
          window.location.href = response;
        }
      },
    });
  });

  //book now button shortcode script
  $(".wwtc_booking_shortcode #wwtc_course").prop("selectedIndex", 0);
  $(".wwtc_booking_shortcode #wwtc_location").prop("selectedIndex", 0);

  $($(".wwtc_booking_shortcode #wwtc_course")).change(function () {
    var course_id = $(this).val(); //alert(course_val);
    $(".wwtc_booking_shortcode #wwtc_location").prop("selectedIndex", 0);
    $(".wwtc_booking_shortcode #wwtc_location").prop("disabled", false);

    var form = $(this).closest("form");
    $.ajax({
      type: "POST",
      url: $(".wwtc_booking_shortcode #wwtc_action_url").val(),
      data: {
        course_id: course_id,
        flag: "course_page",
        action: "get_course_locations",
      },
      success: function (response) {
        $(".wwtc_booking_shortcode #wwtc_location").html(response);
      },
    });
  });

  $(".wwtc_booking_shortcode #wwtc_discount_course").prop("selectedIndex", 0);
  $(".wwtc_booking_shortcode #wwtc_location1").prop("selectedIndex", 0);

  $($(".wwtc_booking_shortcode #wwtc_discount_course")).change(function () {
    var course_id = $(this).val(); //alert(course_val);
    $(".wwtc_booking_shortcode #wwtc_location1").prop("selectedIndex", 0);
    $(".wwtc_booking_shortcode #wwtc_location1").prop("disabled", false);

    var form = $(this).closest("form");
    $.ajax({
      type: "POST",
      url: $(".wwtc_booking_shortcode #wwtc_action_url").val(),
      data: {
        course_id: course_id,
        flag: "course_page",
        action: "get_discount_course_locations",
      },
      success: function (response) {
        $(".wwtc_booking_shortcode #wwtc_location1").html(response);
      },
    });
  });

  $($(".wwtc_booking_shortcode #wwtc_location")).change(function () {
    var location_id = $(this).val();
    var course_id = $(this).find(":selected").attr("data-cid");

    var form = $(this).closest("form");
    $.ajax({
      type: "POST",
      url: $(".wwtc_booking_shortcode #wwtc_action_url").val(),
      data: {
        course_id: course_id,
        location_id: location_id,
        action: "get_location_coursepage",
      }, //data:course_val,
      success: function (response) {
        window.location.href = response;
      },
    });
  });

  $($(".wwtc_booking_shortcode #wwtc_location1")).change(function () {
    var location_id = $(this).val();
    var course_id = $(this).find(":selected").attr("data-cid");

    var form = $(this).closest("form");
    $.ajax({
      type: "POST",
      url: $(".wwtc_booking_shortcode #wwtc_action_url").val(),
      data: {
        course_id: course_id,
        location_id: location_id,
        action: "get_discount_location_coursepage",
      }, //data:course_val,
      success: function (response) {
        window.location.href = response;
      },
    });
  });
  $($("#wwtc_course_reverse")).change(function () {
    var course_id = $(this).val();
    var location_id = $("#wwtc_location_reverse").val();

    var form = $(this).closest("form");
    $.ajax({
      type: "POST",
      url: $("#wwtc_action_url_reverse").val(),
      data: {
        course_id: course_id,
        location_id: location_id,
        action: "get_location_coursepage",
      }, //data:course_val,
      success: function (response) {
        window.location.href = response;
      },
    });
  });

  $($("#wwtc_course_reverse_popup")).change(function () {
    var course_id = $(this).val();
    var location_id = $("#wwtc_location_reverse_popup").val();

    var form = $(this).closest("form");
    $.ajax({
      type: "POST",
      url: $("#wwtc_action_url_reverse_popup").val(),
      data: {
        course_id: course_id,
        location_id: location_id,
        action: "get_location_coursepage",
      }, //data:course_val,
      success: function (response) {
        window.location.href = response;
      },
    });
  });

  //booking iframe shortcode script
  $(".booking-iframe-main #wwtc_course").prop("selectedIndex", 0);
  $(".booking-iframe-main #wwtc_location").prop("selectedIndex", 0);

  $($(".booking-iframe-main #wwtc_course")).change(function () {
    var course_id = $(this).val(); //alert(course_val);

    $(".booking-iframe-main #wwtc_location").prop("selectedIndex", 0);
    $(".booking-iframe-main #wwtc_location").prop("disabled", false);

    var form = $(this).closest("form");
    $.ajax({
      type: "POST",
      url: $(".booking-iframe-main #wwtc_action_url").val(),
      data: {
        course_id: course_id,
        flag: "course_iframe",
        action: "get_course_locations",
      },
      success: function (response) {
        $(".booking-iframe-main #wwtc_location").html(response);
      },
    });
  });

$($(".booking-iframe-main #wwtc_location")).change(function () {
    var location_id = $(this).val();
    var course_id = $(this).find(":selected").attr("data-cid");

    var form = $(this).closest("form");
    $.ajax({
      type: "POST",
      url: $(".booking-iframe-main #wwtc_action_url").val(),
      data: {
        course_id: course_id,
        location_id: location_id,
        action: "get_location_course_iframe",
      }, //data:course_val,
      success: function (response) {
        $("#show_course_iframe").html(response);
      },
    });
  });

 //booking iframe shortcode script
 $(".booking-iframe-main-discount #wwtc_course1").prop("selectedIndex", 0);
 $(".booking-iframe-main-discount #wwtc_location1").prop("selectedIndex", 0);

 $($(".booking-iframe-main-discount #wwtc_course1")).change(function () {
   var course_id = $(this).val(); //alert(course_val);

   $(".booking-iframe-main-discount #wwtc_location1").prop("selectedIndex", 0);
   $(".booking-iframe-main-discount #wwtc_location1").prop("disabled", false);

   var form = $(this).closest("form");
   $.ajax({
     type: "POST",
     url: $(".booking-iframe-main-discount #wwtc_action_url1").val(),
     data: {
       course_id: course_id,
       flag: "course_iframe",
       action: "get_discount_course_locations",
     },
     success: function (response) {
       $(".booking-iframe-main-discount #wwtc_location1").html(response);
     },
   });
 });
  $($(".booking-iframe-main-discount #wwtc_location1")).change(function () {
    var location_id = $(this).val();
    var course_id = $(this).find(":selected").attr("data-cid");
    var form = $(this).closest("form");
    $.ajax({
      type: "POST",
      url: $(".booking-iframe-main-discount #wwtc_action_url1").val(),
      data: {
        course_id: course_id,
        location_id: location_id,
        action: "get_discount_location_course_iframe",
      }, //data:course_val,
      success: function (response) {
        $("#show_course_iframe1").html(response);
      },
    });
  });
});

