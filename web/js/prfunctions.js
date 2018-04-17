$(document).ready(function(){
  $('.dropdown-trigger').dropdown();
});
$(document).ready(function(){

    $("#js-select-team").on('change', function() {

        console.log($(this).val());
        var arrayTeam = $(this).val(),
            tokens = arrayTeam.split('_-_-'),
            teamName=tokens[0],
            teamId=tokens[1],
            table2=document.getElementById('table2'),
            table1=document.getElementById('table1'),
            transferButtons=document.getElementById('transfer-buttons'),
            transferTableNames=document.getElementById('transfer-table-names'),
            rows = document.getElementById('table2').getElementsByTagName("tr").length;
        table1.style.display="block";
        table2.style.display="block";
        transferButtons.style.display="block";
        transferTableNames.style.display="block";
        
        table2.innerHTML='<thead><tr><th>Name</th><th>Position</th><th>Quality</th><th>Speed</th><th>Select</th></tr></thead>';

        var path = 'http://localhost/manager/web/app_dev.php/transfer-players';
        $.ajax({
           type:'post',
           url:path,
           data:{
            teamName:teamName,
               teamId:teamId,
               selectTeam:true
           },
            success:function (data,status) {
                console.log(data);
                if(data.length>0) {

                    /*alert(data[0].available);*/
                    var table2 = document.getElementById("table2");


                    for (var i = 0; i < data.length; i++){

                        // create new row and cells
                         var newRow = table2.insertRow(table2.length),
                             cell1 = newRow.insertCell(0),
                             cell2 = newRow.insertCell(1),
                             cell3 = newRow.insertCell(2),
                             cell4 = newRow.insertCell(3);
                                     cell5 = newRow.insertCell(4);
                            // add values to the cells
                            var name = data[i].name,
                                position = data[i].position,
                                quality = data[i].quality,
                                speed = data[i].speed,
                                id = data[i].id,
                                team = $("#js-select-team").val(),
                                tokens = team.split("_-_-"),
                                teamName = tokens[0],
                                teamId = tokens[1];


                            newRow.setAttribute("id", id);
                            cell1.innerHTML = name;
                            cell2.innerHTML = position;
                            cell3.innerHTML = quality;
                            cell4.innerHTML = speed;
                            cell5.innerHTML = "<label><input type='checkbox' class='filled-in' name='check-tab2'/><span></span></label>";
                    }
                }

            },error: function(){
               /* alert('error');*/
            }
        });
    });
});
$(document).ready(function(){
    $("#js-choose-team").on('change', function() {
        console.log($(this).val());
        var arrayTeam = $(this).val(),
            tokens = arrayTeam.split('_-_-'),
            teamName=tokens[0],
            teamId=tokens[1];
        var path = 'http://localhost/manager/web/app_dev.php/';
        $.ajax({
            type:'post',
            url:path,
            data:{
                teamName:teamName,
                teamId:teamId,
                chooseTeam:true
            },
            success:function (data,status) {
                console.log(data);
                if(data.length>0) {
                    /*alert(data);*/
                }
            },error: function(){
                /* alert('error');*/
            }
        });
    });
});
$(document).ready(function(){
   $('#js-select-formation').on('change',function(){
       var formation=$(this).val();
       document.getElementById('formationStatus').innerHTML='';
      $.ajax({
        type:'post',
          path:'http://localhost/manager/web/app_dev.php/play/resume/formation',
          data:{
            formation:formation,
              changeFormation:true
          },
          success:function(data,status){
            if(data==123){
                document.getElementById('formationStatus').innerHTML=data;
                alert('Not enough players');
                return;
            }
            var players = JSON.parse(data),
                playersDiv = document.getElementById('js-show-starting-players');
            playersDiv.innerHTML='';
              var goalieStop=false,
                  midStop=false,
                  defStop=false,
                  strikerStop=false;
            for(var i=0; i<players.length-1;i++){
                if((players[i]['position']=='striker') && (strikerStop==false)){
                    playersDiv.innerHTML+='Strikers: <br>';
                    strikerStop=true;
                }
                if(players[i]['position']=='midfielder' && midStop==false){
                    playersDiv.innerHTML+='<br> Midfielders: <br>';
                    midStop=true;
                }
                if(players[i]['position']=='defender' && defStop==false){
                    playersDiv.innerHTML+='<br> Defenders: <br>';
                    defStop=true;
                }
                if(players[i]['position']=='goalie' && goalieStop==false){
                    playersDiv.innerHTML+='<br> Goalie: <br>';
                    goalieStop=true;
                }
                playersDiv.innerHTML+=players[i]['name']+'<br>';
            }

          },
          error:function(){
            alert('error on select formation!');
          }
      });
   });
});