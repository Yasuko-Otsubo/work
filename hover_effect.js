$(function(){
    //アニメーション時間
    let duration = 300;

    $("#nav")
        .on("mouseover", function(){
            $(this).stop(true).animate({
                borderwidth: "12px",
                color: "#ae5e9b"
            }, duration);
        });
});
