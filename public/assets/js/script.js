$(document).ready(function () {
  var screenWidth = $(window).width();

  // ------------------------tiny mce editor ------------------- ///

  tinymce.init({
    selector: ".my_tinyeditor",
    plugins:
      "print preview paste importcss searchreplace autolink autosave save directionality code visualblocks visualchars fullscreen image link media template codesample table charmap hr pagebreak nonbreaking anchor  insertdatetime advlist lists wordcount  textpattern noneditable help charmap quickbars emoticons",
    menubar: "file edit view insert format tools table help",
    toolbar:
      "undo redo | bold italic underline strikethrough |  fontsizeselect formatselect | alignleft aligncenter alignright alignjustify | outdent indent |  numlist bullist | forecolor backcolor removeformat | pagebreak | charmap emoticons | fullscreen  preview save print | insertfile image media template link anchor codesample | ltr rtl",

    autosave_ask_before_unload: true,
    autosave_interval: "30s",
    autosave_retention: "2m",
    image_advtab: true,
    themes: "silver",

    importcss_append: false,
    branding: false,
  });
 //////////////// datepicker ////////////////

  $(".my_datepicker").datepicker({
    changeMonth: true,
    changeYear: true,
  });

//////////////// select 2 ////////////////
  

  $(".select2").select2();
  // ----------password toggle------------//

  $(".toggle-password").click(function () {
    $(this).toggleClass("fa-eye fa-eye-slash");
    input = $(this).parent().find("input");
    if (input.attr("type") == "password") {
      input.attr("type", "text");
    } else {
      input.attr("type", "password");
    }
  });
});
