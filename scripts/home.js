function Statistic(name, tags, value){
    this.name = name;
    this.tags = tags;
    this.value = value;
}

function roundFloatTo3Decimals(num){
    return parseFloat(num.toFixed(3))
}

const trimTags = (tags) => tags.substring(1, tags.length-1);

$(document).ready(() => {
    $("form").on("submit", (e) => {
        e.preventDefault();
    });

    $("#statsSearch").on("input", () => {
        let searchKey = $("#statsSearch").val();
        let statsToShow = [];
        
        let statsRequest = $.ajax({
            type: "GET",
            url: "?command=getAllStatsJson",
            dataType: "json",
        });        

        statsRequest.done((stats) => {
            stats.forEach((stat, i) => {
                if (stat.tags.includes(searchKey)){
                    let s = new Statistic(stat.description, trimTags(stat.tags), stat.value || roundFloatTo3Decimals(stat.numerator/stat.denominator))
                    statsToShow.push(s);
                }
            }) 

            if (searchKey){
                $("#initialStatsList").addClass("d-none");

                $("#searchStatsList").empty();
                statsToShow.forEach((s) => {
                    $("#searchStatsList").append(`
                        <section class='card my-2'>
                            <div class='d-flex flex-col justify-content-between align-items-center card-body px-4'>
                                <div>
                                    <h4>${s.name}</h4>
                                    <p class='my-3'>tags: ${s.tags}</p>
                                </div>
                                <div class='d-flex flex-col align-items-center'>
                                    <div class='d-inline-block px-2'>
                                        <h1>${s.name.includes("Percent") ? s.value*100 +"%" : s.value}</h1>
                                    </div>
                                </div>
                            </div>
                        </section>   
                    `);
                })
            }
            else {
                $("#searchStatsList").empty();
                $("#initialStatsList").removeClass("d-none");
            }
        })
    });
});