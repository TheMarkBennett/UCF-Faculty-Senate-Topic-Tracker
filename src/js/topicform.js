console.log("Teast");
$(document).ready(function () {
  $(".js-example-basic-single").select2();
  console.log("Teast");
  $(".topic-tracker-status").select2({
    selectOnClose: true,
    theme: "bootstrap4",
    maximumSelectionLength: 2,
    placeholder: "Select a state",
  });
});
