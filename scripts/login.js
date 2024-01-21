let savedBgColor = localStorage.getItem("landingBgColor");
let colorPicker = document.getElementById("color-picker");
let body = document.querySelector("body");
let resetBtn = document.getElementById("reset-bg-btn");

// set background to last saved bg color
if (savedBgColor) {
    colorPicker.value = savedBgColor;
    body.style.backgroundColor = savedBgColor;
}
body.style.visibility = "visible";

colorPicker.addEventListener("input", () => {
    let newColor = colorPicker.value;

    localStorage.setItem("landingBgColor", newColor);

    body.style.backgroundColor = newColor;
})

resetBtn.addEventListener("click", () => {
    localStorage.setItem("landingBgColor", "#53cbfb");
    body.style.backgroundColor = "#53cbfb";
})
