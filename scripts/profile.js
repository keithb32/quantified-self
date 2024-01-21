let editBioBtn = document.getElementById("editBioBtn");

editBioBtn.addEventListener("mouseover", ()=>{
    let bio = document.getElementById("bio");
    bio.style.fontStyle = "italic";
})

editBioBtn.addEventListener("mouseout", ()=>{
    let bio = document.getElementById("bio");
    bio.style.fontStyle = "";
})