/**
 * Author: Luca Bonaldo
 */
function sl_handler_ajax(form_id, labels, queries) {
  (function($) {

    var label_wait = '<option value="0">' + labels.wait + '</option>';
    var label_regioni = labels.regioni;
    var label_province = '<option value="0">' + labels.province + '</option>';
    var label_comuni = '<option value="0">' + labels.comuni + '</option>';

    /**
     * inizializzazione delle componenti
     */
    $('select#sl-regioni-' + form_id + ' option[value="0"]').html(label_regioni);

    $("select#sl-province-" + form_id).html(label_province);
    $("select#sl-comuni-" + form_id).html(label_comuni);
    $("select#sl-province-" + form_id + ", select#sl-comuni-" + form_id).attr("disabled", "disabled");
    $("select#sl-province-" + form_id + ", select#sl-comuni-" + form_id).css("color", "#999");
    /**
     * Listener per select sl-regioni
     */

    $("select#sl-regioni-" + form_id).change(function() {

      $("select#sl-province-" + form_id).html(label_wait);
      $("select#sl-comuni-" + form_id).html(label_comuni);
      $("select#sl-province-" + form_id + ", select#sl-comuni-" + form_id).attr("disabled", "disabled");
      $("select#sl-province-" + form_id + ", select#sl-comuni-" + form_id).css("color", "#999");

      var regione = $("select#sl-regioni-" + form_id + " option:selected").attr('value');
      var provincia_x = queries.province;

//      console.log("url: " + sl_AjaxObject.url);
//      console.log("type: province");
//      console.log("id: " + regione);
//      console.log("action: " + sl_AjaxObject.action);
//      console.log("field: " + provincia_x);

      $.post(sl_AjaxObject.url,
              {
                type: 'province',
                id: regione,
                action: sl_AjaxObject.action,
                field: provincia_x
              },
      function(data) {
        console.log(data);
        $("select#sl-province-" + form_id).removeAttr("disabled");
        $("select#sl-province-" + form_id).html(label_province + data);
        $("select#sl-province-" + form_id).css("color", "#444");
      });

    });

    /**
     * Listener per select sl-province
     */
    $("select#sl-province-" + form_id).change(function() {

      $("select#sl-comuni-" + form_id).attr("disabled", "disabled");
      $("select#sl-comuni-" + form_id).html(label_wait);

      var provincia = $("select#sl-province-" + form_id + " option:selected").attr('value');
      var comune_x = queries.comuni;

//      console.log("url: " + sl_AjaxObject.url);
//      console.log("type: comuni");
//      console.log("id: " + provincia);
//      console.log("action: " + sl_AjaxObject.action);
//      console.log("field: " + comune_x);

      $.post(sl_AjaxObject.url,
              {
                type: 'comuni',
                id: provincia,
                action: sl_AjaxObject.action,
                field: comune_x
              },
      function(data) {
        console.log(data);
        $("select#sl-comuni-" + form_id).removeAttr("disabled");
        $("select#sl-comuni-" + form_id).html(label_comuni + data);
        $("select#sl-comuni-" + form_id).css("color", "#444");
      });
    });

  })(jQuery);
}


function sl_init_with_values(form_id, regione_id, provincia_id, comune_id) {
  (function($) {

    /*
     * Init select regioni
     */
    $('select#sl-regioni-' + form_id + ' option[value="' + regione_id + '"]').attr("selected", "selected");

    /*
     * init select province
     */
    var provincia_x = $('input#query-province-' + form_id).attr("value");

//    console.log("url: " + sl_AjaxObject.url);
//    console.log("type: province");
//    console.log("id: " + regione_id);
//    console.log("action: " + sl_AjaxObject.action);
//    console.log("field: " + provincia_x);

    $.post(sl_AjaxObject.url,
            {
              type: 'province',
              id: regione_id,
              action: sl_AjaxObject.action,
              field: provincia_x
            },
    function(data) {
      //console.log(data);
      $("select#sl-province-" + form_id).removeAttr("disabled");
      var label = $('select#sl-province-' + form_id + ' option[value="0"]');
      $("select#sl-province-" + form_id).html(label + data);
      $('select#sl-province-' + form_id + ' option[value="' + provincia_id + '"]').attr("selected", "selected");
      $("select#sl-province-" + form_id).css("color", "#444");
    });


    /*
     * Init select comuni
     */
    var comune_x = $('input#query-comuni-' + form_id).attr("value");

//    console.log("url: " + sl_AjaxObject.url);
//    console.log("type: comuni");
//    console.log("id: " + comune_id);
//    console.log("action: " + sl_AjaxObject.action);
//    console.log("field: " + comune_x);

    $.post(sl_AjaxObject.url,
            {
              type: 'comuni',
              id: provincia_id,
              action: sl_AjaxObject.action,
              field: comune_x
            },
    function(data) {
      //console.log(data);
      $("select#sl-comuni-" + form_id).removeAttr("disabled");
      var label = $('select#sl-comuni-' + form_id + ' option[value="0"]');
      $("select#sl-comuni-" + form_id).html(label + data);
      $('select#sl-comuni-' + form_id + ' option[value="' + comune_id + '"]').attr("selected", "selected");
      $("select#sl-comuni-" + form_id).css("color", "#444");
    });

  })(jQuery);
}
