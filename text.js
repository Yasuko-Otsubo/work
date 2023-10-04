'use strict';

/*
const DATA_URL = 'js/text.json';

fetch(DATA_URL)
  .then(function(response){
  return response.json();
  })
 .then(function(jsonData){
  // JSONデータを扱った処理など
  // console.log(jsonData);
    if(DATA_URL == $('#table td')){
      $(document).ready(function(){
          $('#table td').on('click', function(){
              $.ajax({url:'js/text.json', dataType: 'json'})
              .done(function(data){
                let q_area = document.querySelector('#table td');
                let q_line = document.createElement('p');
                q_line.setAttribute("id",'q${i}'); 
                q_line.textContent = (data[0].weight);
                q_area.appendChild(q_line); 
              })
                .fail(function(){
                  window.alert('読み込みエラー');          
})
});
      })    }
 });
*/


 /**********************候補 *********************/

    $(document).ready(function(){
    $.ajax({url: "js/text.json", dataType: "json"})
      .done(function (data){

        //エリアの要素取得
        let q_area = document.querySelector('#table td');

        //タグ入れ
        let q_line = document.createElement('p');

        //属性
        q_line.setAttribute("weight",'q${i}'); 
          //console.log(data[0].hiduke);
          q_line.textContent = (data[0].weight);
          q_area.appendChild(q_line);
        /*
        let aaa = $("#table td");
        console.log(aaa);
        */
        /*
        for($i=0; $i <= max; $i += $i){
          
          ◎jsonのhidukeとカレンダーの日付が一致していたら

                  if(aaa == data[0].hiduke){
          ◎dbの内容をtdに追加
          q_line.textContent = (data);
          q_area.appendChild(q_line); 
        }

        }
        console.log($('#table td'));*/
        })
      })


      //



//◎console.log(data[0].weight);



/**********tdを押したときにhtmlに出力する*************
$(document).ready(function(){
    $('#table td').on('click', function(){
        let work = $(this).text() + 'aaa';
        $(this).text(work);
});
});
*/



/********jsonをconsole.logに呼び出す*********
$(document).ready(function(){
    //ファイル読み込み

    $.ajax({url:'js/text.json', dataType: 'json'})
    .done(function(data){
        
        //console.log(data);
        data.forEach(function(item, index){
            console.log(item);
        });
    })
    .fail(function(){
        window.alert('読み込みエラー');
    });
});
*/



/*****************  間違いたち *******************

$(document).ready(function(){
    $('#table td').on('click', function(){
        $.ajax({url:'js/text.json', dataType: 'json'})
        .done(function(data){
          */

          //data.forEach(function(item, index){
              //console.log(item);
          //});

          /*
          ✕ let work = data;
          $(this).text(work);
          */
          //$(this).text($('#table td p')+= data);
          // ✕ $('this').append('aaa');
          // ✕ $('td').after('data');
          // ✕　$(this).children('data');
          //$thisのchildrenにセットするなどの書き方をする
            /*
        })
    .fail(function(){
        window.alert('読み込みエラー');
    });
*/
        /*
        let work = $(this).text() + 'aaa';
        $(this).text(work);
        */
//});
//});

        

/*****************  間違いたち ********************/
        //let word = $(this).text() + 'aaa';
        //✕ $(this).append("<p>" + cell[0] + "</p><p>" + cell[1] + "</p>");
        /*
        let data_json = JSON.parse(data);
        let data_id = data_json[0]["id"];
        $(this).children(data_id);
        */
        

      
/********************************sample*************************************

    $(function () {
  
        $.ajax({ url: "json/chapter1_test.json", dataType: "json" }) //,
        
          .done(function (data) {
            //console.log(data[2].text);
            console.log(data);
            let i = 0;
            let tokuten = 11;
            let tresure;
            if(tokuten == 15) {
                $(".text1").text(data[3].text);
                $(".next1").text("クリック ▶");
              } else if(tokuten <= 14 && tokuten >= 10) {
                $(".text1").text(data[2].text);
                $(".next1").text("クリック ▶");
              } else if (tokuten <= 9 && tokuten >= 5) {
                $(".text1").text(data[1].text);
                $(".next1").text("クリック ▶");
              } else if (tokuten <= 4 && tokuten >= 0) {
                $(".text1").text(data[0].text);
                $(".next1").text("クリック ▶");
              }
              i = 4;
            $("#test3").click(function () {
              $(".text1").text(data[i].text);
              $(".next1").text("クリック ▶");
                
                i = i + 1;
            });
           
          })
          .fail(function () {
            alert("読み込みエラー");
          });
      });
*/
