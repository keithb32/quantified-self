$(document).ready(() => {
    // Initialize values of percent description placeholder 
    let input = $("#pctDescription").val();
    $("#pctDescriptionPlaceholder").text(input || "____");

    // Update percent description preview as user edits input
    $("#pctDescription").on("input", () => {
        let input = $("#pctDescription").val();
        $("#pctDescriptionPlaceholder").text(input || "____");
    })
});
