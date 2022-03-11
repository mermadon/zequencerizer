

var passageTitle = "hm doesn't work";
var un = "Drangles";

$(document).on(':passageend', function (ev) {
    
    passageTitle = ev.passage.title;
    if(un != "Drangles")
    {
        $("#userName").val(un);
        $("#userName").attr('value', un);
        
        document.getElementById('userName').value = un;
        AjaxCallWithPromise();
    }
});

function myFunction(){
    $("#userName").val(un);
    $("#userName").attr('value', un);
    document.getElementById('userName').value = "dicks";
}

document.addEventListener("submit", (e) => {
        
        
    const form = e.target;
    
    if(form["method"] == "post")
    {
        AjaxPost();
        e.preventDefault();
    }else if(form["method"] == "get")
    {		
        un = $("#userName").val();
        AjaxCallWithPromise();
        
        e.preventDefault();
    }
    
});

function AjaxPost() {

    var dat = $("#feedbackBox").serializeArray();
    dat.push({name: 'passage', value: passageTitle});

    dat.push({name: 'userName', value: $("#userName").val()});

    //console.log($("#userName").val());

    $.ajax({
        url:'postFeedback.php',
        data:dat,
        type:'POST',
        success:function(data){

            console.log(data);
            $('#what-you-searched').html(data);
        },
        error:function(){
            console.log("Error");
        }
    });
}

function AjaxCallWithPromise() {
    var dat = $("#userName").serializeArray();
    dat.push({name: 'passage', value: passageTitle});

    $.ajax({
        url:'postFeedback.php',
        data:dat,
        type:'GET',
        success:function(data){

            $('#what-you-searched').html(data);
            
            $("#feedbackBox").val(data);
        },
        error:function(){
            console.log("Error");
        }
    });
}