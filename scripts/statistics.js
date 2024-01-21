let statistics = document.querySelectorAll(".card-body");

document.addEventListener("keydown", (e) => {
    if (e.key == "Tab"){
        for (let i = 0; i < statistics.length; i++){
            let stat = statistics[i];
            if (stat === document.activeElement){
                stat.style.backgroundColor = "lightgray";
            }
            else {
                stat.style.backgroundColor = "";
            }
        }
    }
})

