// Change bg color on hover for count type
let countTypeDiv = document.getElementById("countType");

countTypeDiv.addEventListener("mouseover", () => {
    countTypeDiv.style.backgroundColor = "lightgray";
})

countTypeDiv.addEventListener("mouseout", () => {
    countTypeDiv.style.removeProperty("background-color");
})

// Change bg color on hover for rate type
let rateTypeDiv = document.getElementById("rateType");

rateTypeDiv.addEventListener("mouseover", () => {
    rateTypeDiv.style.backgroundColor = "lightgray";
})

rateTypeDiv.addEventListener("mouseout", () => {
    rateTypeDiv.style.removeProperty("background-color");
})

// Change bg color on hover for rate type
let pctTypeDiv = document.getElementById("pctType");

pctTypeDiv.addEventListener("mouseover", () => {
    pctTypeDiv.style.backgroundColor = "lightgray";
})

pctTypeDiv.addEventListener("mouseout", () => {
    pctTypeDiv.style.removeProperty("background-color");
})
