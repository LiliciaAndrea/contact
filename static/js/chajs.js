
function chabasic()
{
var xmlhttp;

if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
    document.getElementById("basic").innerHTML=xmlhttp.responseText;
    }
  }
xmlhttp.open("GET","/chabasic.html",true);
xmlhttp.send();
}

function chasocial()
{
var xmlhttp;

if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
    document.getElementById("social").innerHTML=xmlhttp.responseText;
    }
  }
xmlhttp.open("GET","/chasocial.html",true);
xmlhttp.send();
}


function chaother()
{
var xmlhttp;

if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
    document.getElementById("other").innerHTML=xmlhttp.responseText;
    }
  }
xmlhttp.open("GET","/chaother.html",true);
xmlhttp.send();
}



//////

  var w=window.innerWidth    //返回文档显示区的宽度
  || document.documentElement.clientWidth
  || document.body.clientWidth;
  var D=new Function('obj','return document.getElementById(obj);')
  var a=0;
  function expand () {
    D("buttonback").style.width=226+"px";   //238+"px";
    D("buttonback").style.left=-12+"%";   //(w-240)/2-10+"px";
    D("button").style.left=-12+"%";  //(w-240)/2-10+"px";
    D("buttonback").focus();
    D("button").innerHTML="<p>COPY</p>";
    var mb = myBrowser();
    if ("IE" == mb) {
      // alert("我是 IE");
    }
    if ("FF" == mb) {
      // alert("我是 Firefox");
    }
    if ("Chrome" == mb) {
      // alert("我是 Chrome");
    }
    if ("Opera" == mb) {
      // alert("我是 Opera");
    }
    if ("Safari" == mb) {
      // alert("我是 Safari");
      D("buttonback").style.left=-12+"%";  //(w-240)/2+"px";
      D("button").style.left=-12+"%"; //(w-240)/2+"px";
    }
  a=1;
}



  $(document).ready(function(){
    $("#button").click(function(){
      if (a==0) {
        expand ();
      }else{
        var dataPara = getFormJson();
        console.log(dataPara);
        $.ajax({
          type: 'POST',
          url: "http://offer.qnsxj.cn/index.php/Detail/index",
          data: dataPara,
          dataType: "json",
          success: function(data){
            if (data.code==1) {
              alert("验证成功");
              console.log(data);
              window.location.href = 'applynow.html';   
            }else if (data.code==0) {
              alert("验证失败，code不存在或者不是数字");
              console.log(data);
            }else if(data.code==2) {
              alert("尝试了太多次错误的code");
              console.log(data);
            }else if(data.code==3) {
              alert("系统错误");
              console.log(data);
            };
          },
          error: function(data){
            alert("网络故障，请检查您的网络或者联系我们的客服");
          }
        });
      }
    });
  });


/////