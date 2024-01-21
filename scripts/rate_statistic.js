$(document).ready(() => {
    // Initialize values of rate description placeholders
    let input1 = $("#rateDescription1").val();
    $("#rateDescription1Placeholder").text(input1 || "____");

    let input2 = $("#rateDescription2").val();
    $("#rateDescription2Placeholder").text(input2 || "____");

    // Update rate description preview as user edits input
    $("#rateDescription1").on("input", () => {
        let input = $("#rateDescription1").val();
        $("#rateDescription1Placeholder").text(input || "____");
    })

    $("#rateDescription2").on("input", () => {
        let input = $("#rateDescription2").val();
        $("#rateDescription2Placeholder").text(input || "____");
    })
});
