jQuery(function() {

  var course = jQuery('.wwtc_select_course');
  jQuery(course).change(function(){

    var dataid = jQuery(this).attr("data-id");//jQuery(this).data("id");
    jQuery('.wwtc_select_location').filter(function(){ return jQuery(this).attr("data-id") == dataid}).prop("selectedIndex", 0);
    jQuery('.wwtc_select_location').filter(function(){ return jQuery(this).attr("data-id") == dataid}).prop("disabled", false);

    jQuery('.wwtc_select_course_iframe').filter(function(){ return jQuery(this).attr("data-id") == dataid}).val('');
    jQuery('.wwtc_select_course_iframe').filter(function(){ return jQuery(this).attr("data-id") == dataid}).prop("disabled", true);

    jQuery('.wwtc_select_course_page').filter(function(){ return jQuery(this).attr("data-id") == dataid}).prop("disabled", true);
    jQuery(".wwtc_select_course_page").filter(function(){ return jQuery(this).attr("data-id") == dataid}).val(null).trigger("change");

  });

  var location = jQuery('.wwtc_select_location');
  jQuery(location).change(function(){
    
    var location_dataid = jQuery(this).attr("data-id");
    
    jQuery('.wwtc_select_course_iframe').filter(function(){ return jQuery(this).attr("data-id") == location_dataid}).val('');
    jQuery('.wwtc_select_course_iframe').filter(function(){ return jQuery(this).attr("data-id") == location_dataid}).prop("disabled", false);

    jQuery('.wwtc_select_course_page').filter(function(){ return jQuery(this).attr("data-id") == location_dataid}).prop('disabled', false);   
    jQuery(".wwtc_select_course_page").filter(function(){ return jQuery(this).attr("data-id") == location_dataid}).val(null).trigger("change");

  });

  jQuery(".add_button").click(function(){

    jQuery('.wwtc_select_course_page').select2("destroy");  

    var clone = jQuery(this).closest('tr').clone(true);
    var lastid = jQuery(this).closest('tr').data("id");
    var nextid = parseInt(jQuery("#row_id").val());

    clone.find('.wwtc_select_course').each(function(i) {
      jQuery(this).attr('name', "wwtc_courses_data[" + nextid + "][course]");
      jQuery(this).attr('data-id', nextid);
    });
    clone.find('.wwtc_select_location').each(function(i) {
      jQuery(this).attr('name', "wwtc_courses_data[" + nextid + "][location]");
      jQuery(this).attr('disabled', true);
      jQuery(this).attr('data-id', nextid);
    });

    clone.find('.wwtc_select_course_page').each(function(i) {
      jQuery(this).attr('name', "wwtc_courses_data[" + nextid + "][course_page]");
      jQuery(this).attr('disabled', true);
      jQuery(this).attr('data-id', nextid);
      jQuery(this).select2();
    });

    clone.find('.wwtc_select_course_iframe').each(function(i) {
      jQuery(this).attr('name', "wwtc_courses_data[" + nextid + "][course_iframe]");
      jQuery(this).attr('disabled', true);
      jQuery(this).val('');
      jQuery(this).attr('data-id', nextid);
    });

    jQuery('.wwtc_select_course_page').select2();  
    clone.attr('data-id', nextid);

    jQuery("td:last-child", clone).html('<a href="javascript:void(0);" class="remove_button">Remove</a>');
    clone.insertAfter( ".tr_clone:last");

    jQuery("#row_id").val((nextid+1));

  });

  jQuery("table.wwtc_course_table").on('click','.remove_button',function(){

      var rm_tr = jQuery(this).parent();
      rm_tr.find('.wwtc_select_course').each(function(i) {
        jQuery(this).attr('selectedIndex', 0);
      });
      rm_tr.find('.wwtc_select_location').each(function(i) {
        jQuery(this).attr('selectedIndex', 0);
      });
      rm_tr.find('.wwtc_select_course_iframe').each(function(i) {
        //jQuery(this).val('');
      });
      rm_tr.find('.wwtc_select_course_page').each(function(i) {
        jQuery(this).attr('selectedIndex', 0);
      });
      jQuery(this).parent().parent().remove();
  });

  jQuery(function($) {
    jQuery('.multiselect').select2();
  });

  // add more button script for state page

  jQuery(".add_button_state").click(function(){

    var clone = jQuery(this).closest('tr').clone(true);
    var lastid = jQuery(this).closest('tr').data("id");
    var nextid = parseInt(jQuery("#row_id").val());

    clone.find('.wwtc_course_state').each(function(i) {
      jQuery(this).attr('name', "wwtc_location_states[" + nextid + "]");
      jQuery(this).attr('data-id', nextid);
      jQuery(this).val('');
    });
    clone.attr('data-id', nextid);

    jQuery("td:last-child", clone).html('<a href="javascript:void(0);" class="remove_button_state">Remove</a>');
    clone.insertAfter( ".tr_clone:last");

    jQuery("#row_id").val((nextid+1));

  });

  jQuery("table.wwtc_course_state_table").on('click','.remove_button_state',function(){

      var rm_tr = jQuery(this).parent();
      rm_tr.find('.wwtc_course_state').each(function(i) {
        jQuery(this).val('');
      });
      jQuery(this).parent().parent().remove();
  });

});