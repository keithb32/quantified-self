$(document).ready(() => {
    // Initialize values of count description placeholder 
    let input = $("#countDescription").val();
    $("#countDescriptionPlaceholder").text(input || "____");

    // Update count description preview as user edits input
    $("#countDescription").on("input", () => {
        let input = $("#countDescription").val();
        $("#countDescriptionPlaceholder").text(input || "____");
    })
});
